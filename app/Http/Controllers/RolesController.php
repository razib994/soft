<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
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
        if(is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Unauthorized Access');
        }
        $roles = Role::all();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Unauthorized Access');
        }
        $all_permissions = Permission::all();
        $permissions_group = User::getpermissionGroups();
        return view('backend.pages.roles.create', compact('all_permissions','permissions_group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('role.view')) {
            abort(403, 'Unauthorized Access');
        }
       $request->validate([
            'name' => 'required|unique:roles|max:255',
        ], [
            'name.required' => 'Please give a role Name'
       ]);

        $role = Role::create(['name' => $request->name, 'guard_name' =>'admin']);
        $permission = $request->input('permissions');
        if(!empty($permission)){
            $role->syncPermissions($permission);
        }
        Session::flash('message', 'Role Created Successfully');
        return redirect('admin/roles');
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
        if(is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $role = Role::findById($id,'admin');
        $all_permissions = Permission::all();
        $permissions_group = User::getpermissionGroups();
        return view('backend.pages.roles.edit', compact('role','all_permissions','permissions_group'));
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
        if(is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'name' => 'required|max:255|unique:roles,name,'.$id
        ], [
            'name.required' => 'Please give a role Name'
        ]);

        $role = Role::findById($id,'admin');
        $permission = $request->input('permissions');
        if(!empty($permission)){
            $role->name= $request->name;
            $role->save();
            $role->syncPermissions($permission);
        }
        Session::flash('message', 'Role Updated Successfully');
        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $role = Role::findById($id,'admin');
        if(!is_null($role)) {
            $role->delete();
        }
        Session::flash('message', 'Role Deleted Successfully');
        return redirect('admin/roles');
    }
}
