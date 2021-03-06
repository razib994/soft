<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Cash;
use App\Models\Admin;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index(){
        if(is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Unauthorized Access');
        }
        $banks = Bank::all();
        $cashs = Cash::all();
        $total_roles        = count(Role::select('id')->get());
        $total_admins       = count(Admin::select('id')->get());
        $total_permissions  = count(Permission::select('id')->get());
        return view ('backend.pages.dashboard.index', compact('total_roles','total_admins','total_permissions','banks','cashs'));
    }
    public function projectDashboard(){
        $projects = Project::all();
        return view ('backend.pages.dashboard.project-dashboard', compact('projects'));
    }
    public function collectionDashboard(){
        $projects = Project::all();
        return view ('backend.pages.dashboard.collerction', compact('projects'));
    }
}
