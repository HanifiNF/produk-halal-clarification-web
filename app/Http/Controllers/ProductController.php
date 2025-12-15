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

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Display all products for admin users.
     */
    public function adminIndex()
    {
        $currentUser = Auth::user();
        if (!$currentUser->admin && !$currentUser->data_access) {
            abort(403, 'Unauthorized access. Admin or data access required.');
        }

        $products = Product::with('umkm')
            ->paginate(10);

        return view('products.admin-index', compact('products'));
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
            'date' => 'required|date',
        ]);

        $productData = $request->all();
        $productData['umkm_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;

            // 🔥 CALL ML API
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://127.0.0.1:8000/predict', [
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
                'date' => 'required|date',
            ]);
        }

        $productData = $request->all();

        // Handle image update
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;

            // 🔥 CALL ML API
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://127.0.0.1:8000/predict', [
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