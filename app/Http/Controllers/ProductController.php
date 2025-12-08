<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('umkm')
            ->where('umkm_id', Auth::id())
            ->paginate(10);

        return view('products.index', compact('products'));
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
            'verification_status' => 'required|boolean'
        ]);

        $productData = $request->all();
        $productData['umkm_id'] = Auth::id(); // Set the current user as the UMKM

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;
        }

        Product::create($productData);

        return redirect()->route('dashboard')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Ensure the user can only view their own products
        if ($product->umkm_id !== Auth::id() && !Auth::user()->admin) {
            abort(403);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Ensure the user can only edit their own products
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
        // Ensure the user can only update their own products
        if ($product->umkm_id !== Auth::id() && !Auth::user()->admin) {
            abort(403);
        }

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required|date',
            'verification_status' => 'required|boolean'
        ]);

        $productData = $request->all();

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $productData['product_image'] = $imagePath;
        }

        $product->update($productData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Ensure the user can only delete their own products
        if ($product->umkm_id !== Auth::id() && !Auth::user()->admin) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}