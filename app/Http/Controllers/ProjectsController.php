<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\ProjectExport;
use App\Project;
use App\User;
use App\Visitor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ProjectsController extends Controller
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
        if(is_null($this->user) || !$this->user->can('project.view')) {
            abort(403, 'Unauthorized Access');
        }
        $projects = Project::all();
       return view('backend.pages.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('project.create')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('project.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'project_name'      => 'required|max:50',
            'project_address'   => 'required',
            'date'              => 'required',


        ]);
        // Users Create
        $project = new Project();
        $project->project_name      = $request->project_name;
        $project->project_address   = $request->project_address;
        $project->date              = $request->date;
        $project->save();


        Session::flash('message', 'Project Created Successfully');
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.projects.show', ['project' => Project::findOrFail($id)]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('project.edit')) {
            abort(403, 'Unauthorized Access');
        }

        $projects = Project::find($id);
        return view('backend.pages.projects.edit', compact('projects'));
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
        if(is_null($this->user) || !$this->user->can('project.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $project = Project::find($id);
        $request->validate([
            'project_name'      => 'required|max:50',
            'project_address'   => 'required',
            'date'              => 'required',


        ]);
        // Update Project
        $project->project_name      = $request->project_name;
        $project->project_address   = $request->project_address;
        $project->date              = $request->date;
        $project->save();


        Session::flash('message', 'Project Updated Successfully');
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('project.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $project = Project::find($id);
        if(!is_null($project)) {
            $project->delete();
        }
        Session::flash('message', 'Project Deleted Successfully');
        return redirect('admin/projects');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new ProjectExport, 'project.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new ProjectExport, 'project.csv');
    }


    public function createPDF() {
        $projects = Project::all();
        $pdf = PDF::loadView('backend.pages.projects.pdf', compact('projects'));
        // download PDF file with download method
        return $pdf->download('projects.pdf');
    }

}
