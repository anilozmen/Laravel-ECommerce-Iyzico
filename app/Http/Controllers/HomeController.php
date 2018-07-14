<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $products = Product::orderBy('id','desc')->get();
        return view('index', compact( 'products','categoriesss'));
    }

    public function category($slug){
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $category = Category::where("slug",$slug)->first();
        $products = Product::with('categories')->where('category_id',$category->id)->get();
        return view('category-details', compact('category','products','categoriesss'));
    }

    public function product($slug){
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $product = Product::where("slug",$slug)->first();
        $bcrumb = $product->categories()->distinct()->get();
        return view('product-detail', compact('product','bcrumb','categoriesss'));
    }

    public function contact(){
        $categoriesss = Category::orderBy('category_name','asc')->get();
        return view('contact', compact('categoriesss'));
    }
}
