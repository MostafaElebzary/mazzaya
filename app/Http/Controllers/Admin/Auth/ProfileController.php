<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $data['title'] = trans('lang.editProfile');
        $admin = Admin::where('id', Auth::guard('admins')->user()->id)->first();


        return view('Admin.pages.profile', compact('admin', 'data'));
    }

    public function updateProfile(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'name' => 'required',
                'email' => 'required|unique:admins,email,' . $request->id,
                'phone' => 'required|unique:admins,phone,' . $request->id,
                'password' => 'nullable',
                'image' => 'nullable|image',

            ]);


        $admin = Admin::where('id', $request->id)->first();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        if ($request->password != null) {
            $admin->password = $request->password;

        }
        if ($request->image != null) {
            $admin->image = $request->image;

        }

        $admin->save();
        session()->flash('success', trans('lang.updated_successfully'));

        return redirect('admin/profile');
    }


}
