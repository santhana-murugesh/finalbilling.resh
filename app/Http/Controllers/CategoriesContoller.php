<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesContoller extends Controller
{
    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'cat_description' => 'required|string|max:500',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'cat_description' => $request->cat_description,
        ]);

        return redirect()->route('all.categories')->with('success', 'Category added successfully!');
    }

    public function allCategories()
    {
        $categorys = Category::all(); 
        return view('categories.AllCategories', compact('categorys'));
    }


    public function DestroyCategories($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category deleted successfully!');
    }
}
