<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AdminsController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Unauthorized Access');
        }
        $admins = Admin::all();
        return view('backend.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Unauthorized Access');
        }
        $roles = Role::all();
        return view('backend.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'name'      => 'required|max:50',
            'email'     => 'required|max:50|email|unique:admins',
            'username'  => 'required|max:50',
            'password'  => 'required|min:6|max:50|confirmed',

        ]);
        // Admins Create
        $admin = new Admin();
        $admin->name       = $request->name;
        $admin->email      = $request->email;
        $admin->username   = $request->username;
        $admin->password   = Hash::make($request->password);
        $admin->save();

        // Role Assigne
        if($request->roles){
            $admin->assignRole($request->roles);
        }

        Session::flash('message', 'admins Created Successfully');
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $admin = Admin::find($id);
        $roles = Role::all();
        return view('backend.pages.admins.edit', compact('admin', 'roles'));
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
        if(is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Unauthorized Access');
        }
        // Admins Create
        $admin = Admin::find($id);
         $request->validate([
             'name'      => 'required|max:50',
             'email'     => 'required|max:50|email|unique:admins,email,'.$id,
             'username'    => 'required|max:50|unique:admins,username,'.$id,
             'password'  => 'nullable|min:6|max:50|confirmed',

         ]);

        $admin->name       = $request->name;
        $admin->email      = $request->email;
        $admin->username   = $request->username;
        if($request->password){
            $admin->password   = Hash::make($request->password);
        }
        $admin->save();

        // Role Assigne
        $admin->roles()->detach();
        if($request->roles){
            $admin->assignRole($request->roles);
        }
        Session::flash('message', 'admins Updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $admin = Admin::find($id);
        if(!is_null($admin)) {
            $admin->delete();
        }
        Session::flash('message', 'admins Deleted Successfully');
        return redirect('admin/admins');
    }
}
