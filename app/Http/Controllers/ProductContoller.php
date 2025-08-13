<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class ProductContoller extends Controller
{
public function addProduct(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric',
        'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $product = new Product();
    $product->product_name = $request->input('product_name');
    $product->product_price = $request->input('product_price');
    $product->category_id = $request->input('category_id');
    if ($request->hasFile('product_image')) {
        $directory = 'products';

        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        $imagePath = $request->file('product_image')->store($directory, 'public');
        $product->product_image = $imagePath;
    }

    $product->save();

    return redirect()->route('all.products')->with('success', 'Product added successfully!');
}

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('all.products')->with('error', 'Product not found!');
        }
        // Delete product image if exists
        if ($product->product_image && \Storage::disk('public')->exists($product->product_image)) {
            \Storage::disk('public')->delete($product->product_image);
        }
        $product->delete();
        return redirect()->route('all.products')->with('success', 'Product deleted successfully!');
    }

    public function allProducts()
    {
        $categories = Category::all();
        $products = Product::with('category')->get();
        return view('products.AllProducts',['products' => $products , 'categories' => $categories]); 
    }
}
