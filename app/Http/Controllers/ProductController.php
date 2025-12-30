<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource for regular users.
     */
    public function index(Request $request)
    {
        $query = Product::with('umkm');
        $currentUser = Auth::user();

        // Check if user_id parameter is provided (for pembina to view binaan products)
        if ($request->has('user_id')) {
            $userId = $request->user_id;

            // Verify that the authenticated user is pembina for the requested user
            $targetUser = User::find($userId);
            if (!$targetUser || $targetUser->pembina_id !== Auth::user()->id) {
                abort(403, 'Unauthorized access to this user\'s products.');
            }

            $query->where('umkm_id', $userId);
        } else if ($currentUser->data_access) {
            // Data access users can see all products
            // Don't apply any additional filters
        } else {
            // Regular users can only see their own products
            $query->where('umkm_id', Auth::id());
        }

        // Handle search
        $search = $request->get('search');
        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        // Handle sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Validate sort parameters to prevent injection
        $validSortColumns = ['created_at', 'date', 'verification_status'];
        if (!in_array($sortBy, $validSortColumns)) {
            $sortBy = 'created_at';
        }

        $validSortOrders = ['asc', 'desc'];
        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'desc';
        }

        $products = $query->orderBy($sortBy, $sortOrder)->paginate(10);
        $products->appends(['search' => $search, 'sort_by' => $sortBy, 'sort_order' => $sortOrder]);

        return view('products.index', compact('products', 'sortBy', 'sortOrder', 'search'));
    }

    /**
     * Display all products for admin users.
     */
    public function adminIndex(Request $request)
    {
        $currentUser = Auth::user();
        if (!$currentUser->admin && !$currentUser->data_access) {
            abort(403, 'Unauthorized access. Admin or data access required.');
        }

        $query = Product::with('umkm');

        // Handle search
        $search = $request->get('search');
        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        // Handle sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Validate sort parameters to prevent injection
        $validSortColumns = ['created_at', 'date', 'verification_status'];
        if (!in_array($sortBy, $validSortColumns)) {
            $sortBy = 'created_at';
        }

        $validSortOrders = ['asc', 'desc'];
        if (!in_array($sortOrder, $validSortOrders)) {
            $sortOrder = 'desc';
        }

        $products = $query->orderBy($sortBy, $sortOrder)
            ->paginate(10);
        $products->appends(['search' => $search, 'sort_by' => $sortBy, 'sort_order' => $sortOrder]);

        return view('products.admin-index', compact('products', 'sortBy', 'sortOrder', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Users can only create products for themselves
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $productData = $request->all();
        $productData['umkm_id'] = Auth::id();
        $productData['date'] = now(); // Set date to current date/time

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;

            // 🔥 CALL ML API
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://klasifikasihalalmodel-production.up.railway.app/predict', [
                    'multipart' => [
                        [
                            'name'     => 'file',
                            'contents' => fopen(storage_path('app/public/' . $imagePath), 'r'),
                            'filename' => basename($imagePath)
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody(), true);
                $productData['verification_status'] = ($result['status_sertifikasi'] === 'PerluSertifikasi') ? 1 : 0;
            } catch (\Exception $e) {
                // fallback jika ML API gagal
                $productData['verification_status'] = 0;
            }
        } else {
            // jika tidak ada gambar, default 0
            $productData['verification_status'] = 0;
        }

        Product::create($productData);

        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $currentUser = Auth::user();
        // Ensure the user can only view their own products
        if ($product->umkm_id !== Auth::id() && !$currentUser->admin && !$currentUser->data_access) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Only admin users can edit products, data access users can only view
        if ($product->umkm_id !== Auth::id() && !Auth::user()->admin) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $currentUser = Auth::user();

        // Authorization
        if ($product->umkm_id !== Auth::id() && !$currentUser->admin) {
            abort(403);
        }

        // Validation
        if ($currentUser->admin) {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'date' => 'required|date',
                'verification_status' => 'required|boolean'
            ]);
        } else {
            $request->validate([
                'nama_produk' => 'required|string|max:255',
                'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $productData = $request->all();

        // Prevent regular users from updating the date field
        if (!$currentUser->admin) {
            unset($productData['date']); // Remove date from update data if not admin
        }

        // Handle image update
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;

            // 🔥 CALL ML API
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'https://klasifikasihalalmodel-production.up.railway.app/predict', [
                    'multipart' => [
                        [
                            'name'     => 'file',
                            'contents' => fopen(storage_path('app/public/' . $imagePath), 'r'),
                            'filename' => basename($imagePath)
                        ]
                    ]
                ]);

                $result = json_decode($response->getBody(), true);
                $productData['verification_status'] = ($result['status_sertifikasi'] === 'PerluSertifikasi') ? 1 : 0;
            } catch (\Exception $e) {
                // fallback jika ML API gagal
                $productData['verification_status'] = $product->verification_status;
            }
        } else {
            // jika tidak ada gambar baru, jangan ubah verification_status
            $productData['verification_status'] = $product->verification_status;
        }

        $product->update($productData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Only admin users can delete products
        if ($product->umkm_id !== Auth::id() && !Auth::user()->admin) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}