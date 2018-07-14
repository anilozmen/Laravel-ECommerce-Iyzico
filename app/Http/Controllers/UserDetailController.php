<?php

namespace App\Http\Controllers;

use App\Category;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $user = auth()->user()->id;
        $userDetails = UserDetail::where('user_id',$user)->get();
        return view('profile',compact('userDetails','categoriesss'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categoriesss = Category::orderBy('category_name','asc')->get();
        $userDetails = UserDetail::find($id);
        return view('profile-edit',compact('userDetails','categoriesss'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,
            [
                "phone" => "required|numeric|unique:user_details",
                "m_phone" => "required|numeric|unique:user_details",
                "address" => "required",
                "city" => "required",
                "country" => "required",
                "zipcode" => "required|numeric",

            ]);
        $input = $request->only('phone','m_phone','address','city','country','zipcode');
        $userDetail = UserDetail::find($id);
        $userDetail->update($input);

        Session::flash("status", 1);
        return redirect("/profile");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
