<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get view setting from session or default to 'Cards'
        $view_setting = $request->session()->get('view_setting', 'Cards');

        // Update view setting if 'view' parameter is present in the request
        if ($request->has('view')) {
            $view_setting = $request->input('view');
            $request->session()->put('view_setting', $view_setting);
        }

        // Fetch products based on view setting and apply pagination
        if ($view_setting == 'Cards') {
            $products = Product::paginate(9); // Adjust pagination as needed
            return view('products.index', compact('view_setting', 'products'));
        } elseif ($view_setting == 'List') {
            $products = Product::paginate(10); // Adjust pagination as needed
            return view('products.index', compact('view_setting', 'products'));
        }

        // Default case if none of the above
        $products = Product::paginate(9); // Default pagination
        return view('products.index', compact('view_setting', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'gift_points' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);
        $imagePath = null;

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = mt_rand(100, 999) . Carbon::now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('public/images/products', $fileName);
            $imagePath = $fileName;
        }

        $slug = Str::slug($request->input('name'));
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'gift_points' => $request->input('gift_points'),
            'image' => $imagePath,
            'category' => $request->input('category'),
            'brand' => $request->input('brand'),
            'stock' => $request->input('stock'),
            'status' => $request->input('status'),
            'slug' => $slug,
        ]);
        return redirect()->route('products.index')->with('status', 'Product created successfully.');
    }

    /**
     * Display the specified resource...
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    // ProductController.php
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0', // Ensure price is a positive number
            'brand' => 'nullable|string|max:255', // Brand is optional
            'gift_points' => 'nullable|numeric|min:0', // Gift Points is optional and should be a positive number
            'stock' => 'required|integer|min:0', // Stock must be an integer and cannot be negative
            'status' => 'required|in:active,inactive', // Status must be either 'active' or 'inactive'
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file (optional)
        ]);

        // Update the product with validated data
        $product->update($request->except('image')); // Exclude 'image' if you're handling it separately

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products/images'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        session()->flash('success', 'Product deleted successfully.');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Soft delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Product deleted successfully.');
    }

    // Method to restore a product from trash
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trashed')->with('status', 'Product restored successfully.');
    }

    // Method to permanently delete a product from trash
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('products.trashed')->with('status', 'Product permanently deleted.');
    }
}
