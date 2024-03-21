<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserInfo::orderBy('created_at', 'DESC')->get();
        return view('users.home', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required'
        ];

        if ($request->profile_pic != "") {
            $rules['profile_pic'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('user.create')->withInput()->withErrors($validator);
        }

        // storing user info in database
        $user = new UserInfo();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->bio = $request->bio;
        $user->save();

        if ($request->profile_pic != "") {

            // Storing image
            $profile_pic = $request->profile_pic;
            $ext = $profile_pic->getClientOriginalExtension();
            $pic_name = time() . '.' . $ext;

            // save image to profiles directory
            $profile_pic->move(public_path("/uploads/profiles"), $pic_name);

            // save image in database
            $user->profile_pic = $pic_name;
            $user->save();
        }

        return redirect()->route('user.index')->with('success', 'User Added SuccessFully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = UserInfo::findOrFail($id);
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = UserInfo::findOrFail($id);

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
        ];

        if ($request->profile_pic != "") {
            $rules['profile_pic'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)->withInput()->withErrors($validator);
        }

        // updating user info in database
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password!=""){
            $user->password = Hash::make($request->password);
        }
        $user->bio = $request->bio;
        $user->save();

        if ($request->profile_pic != "") {

            // delete old image
            File::delete(public_path('/uploads/profiles/' . $user->profile_pic));

            // Storing image
            $profile_pic = $request->profile_pic;
            $ext = $profile_pic->getClientOriginalExtension();
            $pic_name = time() . '.' . $ext;

            // save image to profiles directory
            $profile_pic->move(public_path("/uploads/profiles"), $pic_name);

            // save image in database
            $user->profile_pic = $pic_name;
            $user->save();

            return redirect()->route('user.index')->with('success', 'User Updated SuccessFully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = UserInfo::findOrFail($id);
        FIle::delete('uploads/profiles/'.$user->profile_pic);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User Deleted SuccessFully');
    }
}
