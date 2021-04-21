<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = trans('lang.admins');
        $admins = Admin::OrderBy('id', 'desc')->paginate(10);
        return view('Admin.pages.admins.index', compact('admins', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = trans('lang.admin_create');
        return view('Admin.pages.admins.create', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required',
                'email' => 'required|unique:admins,email',
                'phone' => 'required|unique:admins,phone',
                'password' => 'required',
                'image' => 'required|image',

            ]);

        $admin = Admin::create($data);
        session()->flash('success', trans('lang.added_successfully'));
        return redirect('admin/admins');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $data['title'] = trans('lang.admin_edit');
        return view('Admin.pages.admins.edit', compact('admin', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name' => 'required',
                'is_active' => 'required|in:0,1',
                'email' => 'required|unique:admins,email,' . $request->id,
                'phone' => 'required|unique:admins,phone,' . $request->id,
                'password' => 'nullable',
                'image' => 'nullable|image',

            ]);


        $admin = Admin::where('id', $request->id)->first();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->is_active = $request->is_active;
        if ($request->password != null) {
            $admin->password = $request->password;

        }
        if ($request->image != null) {
            $admin->image = $request->image;

        }

        $admin->save();
        session()->flash('success', trans('lang.updated_successfully'));
        return redirect('admin/admins');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            Admin::whereIn('id', $request->id)->delete();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed']);
        }
        return response()->json(['message' => 'Success']);
    }
}
