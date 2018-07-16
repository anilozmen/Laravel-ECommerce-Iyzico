<?php

namespace App\Http\Controllers;

use App\Category;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $categoryMenu = Category::orderBy('category_name','asc')->get();
        $userDetails = UserDetail::where('user_id',Auth::id())->get();
        return view('profile',compact('userDetails','categoryMenu'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $categoryMenu = Category::orderBy('category_name','asc')->get();
        $userDetails = UserDetail::find(Auth::id());
        return view('profile-edit',compact('userDetails','categoryMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,
            [
                "phone" => "required|numeric",
                "m_phone" => "required|numeric",
                "address" => "required",
                "city" => "required",
                "country" => "required",
                "zipcode" => "required|numeric",

            ]);
        $input = $request->only('phone','m_phone','address','city','country','zipcode');
        $userDetail = UserDetail::find(Auth::id());
        $userDetail->update($input);

        Session::flash("status", 1);
        return redirect()->route('profile.index');
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
