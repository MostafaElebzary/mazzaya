<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalSeo;
use Illuminate\Http\Request;

class GlobalSEOController extends Controller
{
    public function index(){
        $data['title'] = "Global SEO";
        $global_seo = GlobalSeo::first();
         return view('Admin.pages.globalSeo', compact('global_seo', 'data'));

    }

    public function update(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'keywords' => 'required',
                'description' => 'required',
                'author' => 'required',
                'site_map_link' => 'required',
                'google_analytics' => 'nullable',

            ]);


        $admin = GlobalSeo::where('id', $request->id)->first();

        $admin->keywords = $request->keywords;
        $admin->description = $request->description;
        $admin->author = $request->author;
        $admin->site_map_link = $request->site_map_link;

        if ($request->google_analytics != null) {
            $admin->google_analytics = $request->google_analytics;
            $admin->is_google = 1;
        }else{
            $admin->google_analytics = "";
            $admin->is_google = 0;
        }

        $admin->save();
        session()->flash('success', trans('lang.updated_successfully'));

        return redirect()->back();
    }

}
