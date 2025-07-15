<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BillingContoller extends Controller
{
   public function BillingMethod()
   {    
        $categories = Category::all();
        $products = Product::all();
       return view('Billing',compact('products','categories')); 
   }
}
