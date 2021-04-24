<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $data['title'] = trans('lang.settings');
        $setting = Setting::first();

        return view('Admin.pages.Settings', compact('setting', 'data'));

    }

    public function update(Request $request)
    {


        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'phone1' => 'required',
                'phone2' => 'required',
                'email1' => 'required',
                'email2' => 'required',
                'address1_ar' => 'required',
                'address1_en' => 'required',
                'address2_ar' => 'required',
                'address2_en' => 'required',
                'logo_white' => 'nullable|image',
                'logo_black' => 'nullable|image',
                'fav_ico' => 'nullable|image',
                'breadcrumb' => 'nullable|image',
                'facebook' => 'required',
                'twitter' => 'required',
                'youtube' => 'required',
                'instagram' => 'required',
                'snapchat' => 'required',
                'linkedin' => 'required',
                'system_time_zone' => 'required',


            ]);


        $admin = Setting::first();

        $admin->title_ar = $request->title_ar;
        $admin->title_en = $request->title_en;
        $admin->phone1 = $request->phone1;
        $admin->phone2 = $request->phone2;
        $admin->email1 = $request->email1;
        $admin->email2 = $request->email2;
        $admin->address1_ar = $request->address1_ar;
        $admin->address1_en = $request->address1_en;
        $admin->address2_ar = $request->address2_ar;
        $admin->address2_en = $request->address2_en;

        $admin->facebook = $request->facebook;
        $admin->twitter = $request->twitter;
        $admin->youtube = $request->youtube;
        $admin->instagram = $request->instagram;
        $admin->snapchat = $request->snapchat;
        $admin->linkedin = $request->linkedin;
        $admin->system_time_zone = $request->system_time_zone;


        if ($request->logo_white != null) {
            $admin->logo_white = $request->logo_white;

        }
        if ($request->logo_black != null) {
            $admin->logo_black = $request->logo_black;

        }
        if ($request->fav_ico != null) {
            $admin->fav_ico = $request->fav_ico;

        }
        if ($request->breadcrumb != null) {
            $admin->breadcrumb = $request->breadcrumb;

        }

        $admin->save();
        session()->flash('success', trans('lang.updated_successfully'));

        return redirect()->back();
    }

}
