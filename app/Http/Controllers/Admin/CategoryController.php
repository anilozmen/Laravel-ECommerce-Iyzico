<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Images;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoriesss = Category::orderBy('category_name', 'asc')->get();
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view('admin.category', compact('categories', 'categoriesss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoriesss = Category::orderBy('category_name', 'asc')->get();
        $categories = Category::pluck('category_name', 'id')->all();
        return view("admin.category-create", compact('categories', 'categoriesss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            "category_name" => "required|max:255"
        ]);

        $categories = Category::create($request->all());

        Session::flash("status", 1);
        return redirect("/admin-category");

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoriesss = Category::orderBy('category_name', 'asc')->get();
        $category = Category::find($id);
        $categories = Category::pluck('category_name', 'id')->all();
        return view("admin.category-edit", compact('category', 'categories', 'categoriesss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,
            [
                "category_name" => "required|max:255"
            ]);
        $input = $request->all();
        $category = Category::find($id);
        $category->update($input);

        Session::flash("status", 1);
        return redirect("/admin-category");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $products = Product::where('category_id', $id)->get();

        if ($products) {
            foreach ($products as $product) {
                foreach ($product->images as $image) {
                    unlink(public_path("uploads/" . $image->name));
                    unlink(public_path("uploads/thumb_" . $image->name));
                }
            }
            foreach ($products as $product){
                Images::where("imageable_id", $product->id)->where("imageable_type", "App\Product")->delete();
            }
        }

        $kategori = Category::find($id);
        $kategori->allProducts()->detach();
        $kategori->delete();

        Session::flash("status", 1);
        return redirect("/admin-category");
    }
}
