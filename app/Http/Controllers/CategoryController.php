<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\CategoryExport;
use App\Exports\ProjectExport;
use App\User;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;


class CategoryController extends Controller
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
        if(is_null($this->user) || !$this->user->can('category.view')) {
            abort(403, 'Unauthorized Access');
        }
        $categories = Category::all();
        return view('backend.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('category.create')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('category.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'category_name' => 'required',
        ]);
        $categories = new Category();
        $categories->category_name = $request->category_name;
        $categories->save();
        Session::flash('message', 'Categories Created Successfully');
        return redirect()->route('categories.index');
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
        if(is_null($this->user) || !$this->user->can('category.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $user = User::find($id);
        $categories = Category::find($id);
        return view('backend.pages.categories.edit', compact('categories','user'));
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
        if(is_null($this->user) || !$this->user->can('category.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $categories = Category::find($id);
        $request->validate([
            'category_name' => 'required',
        ]);
        $categories->category_name = $request->category_name;
        $categories->save();
        Session::flash('message', 'Categories Updates Successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('category.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $category = Category::find($id);
        if(!is_null($category)) {
            $category->delete();
        }
        Session::flash('message', 'Category Deleted Successfully');
        return redirect('admin/categories');
    }

    public function exportIntoEXCEL(){
        return Excel::download(new CategoryExport(), 'category.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new CategoryExport(), 'category.csv');
    }

    public function createPDF() {
        $categories = Category::all();
        $pdf = PDF::loadView('backend.pages.categories.pdf', compact('categories'));
        // download PDF file with download method
        return $pdf->download('category.pdf');
    }

}
