<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Exports\VisitorExport;
use App\Professional;
use App\User;
use App\Visitor;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class VisitorsController extends Controller
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
        if(is_null($this->user) || !$this->user->can('visitor.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $today =  date("Y-m-d");
        if($start_date!=$today){
            $visitors = DB::table('visitors')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
        } else {
            $visitors = Visitor::all();
        }



        return view('backend.pages.visitors.index', (['visitors'=>$visitors, 'start_date'=>$start_date, 'end_date'=>$end_date]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('visitor.create')) {
            abort(403, 'Unauthorized Access');
        }

        return view('backend.pages.visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('visitor.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'name'              => 'required|max:50',
            'phone'             => 'required',
            'date'              => 'required',
            'profession_id'     => 'required',

        ]);
        if($request->hasFile('check_file') AND $request->hasFile('check_file_one') AND $request->hasFile('check_file_two')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);

            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
        // Users Create
        $visitor = new Visitor();
        $visitor->name            = $request->name;
        $visitor->email           = $request->email;
        $visitor->phone           = $request->phone;
        $visitor->area            = $request->area;
        $visitor->land            = $request->land;
        $visitor->width           = $request->width;
        $visitor->height          = $request->height;
        $visitor->store           = $request->store;
        $visitor->building        = $request->building;
        $visitor->demand          = $request->demand;
        $visitor->profession_id     = $request->profession_id;
        $visitor->organization    = $request->organization;
        $visitor->date            = $request->date;
        $visitor->remark          = $request->remark;
        $visitor->report          = $request->report;
        $visitor->contact_person  = $request->contact_person;
        $visitor->check_file      = $dircetory . $imageName;
        $visitor->check_file_one      = $dircetory_one . $imageName_one;
        $visitor->check_file_two      = $dircetory_two . $imageName_two;
        $visitor->address  = $request->address;
        $visitor->save();
        } elseif($request->hasFile('check_file') AND $request->hasFile('check_file_one') ){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);

            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);


            // Users Create
            $visitor = new Visitor();
            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file      = $dircetory . $imageName;
            $visitor->check_file_one      = $dircetory_one . $imageName_one;

            $visitor->address  = $request->address;
            $visitor->save();
        } elseif($request->hasFile('check_file') AND $request->hasFile('check_file_two')){
    $image = $request->file('check_file');
        $imageName = $image->getClientOriginalName();
        $dircetory = 'images/';
        $image->move($dircetory, $imageName);


        $image_two= $request->file('check_file_two');
        $imageName_two = $image_two->getClientOriginalName();
        $dircetory_two = 'images/';
        $image_two->move($dircetory_two, $imageName_two);
        // Users Create
        $visitor = new Visitor();
        $visitor->name            = $request->name;
        $visitor->email           = $request->email;
        $visitor->phone           = $request->phone;
        $visitor->area            = $request->area;
        $visitor->land            = $request->land;
        $visitor->width           = $request->width;
        $visitor->height          = $request->height;
        $visitor->store           = $request->store;
        $visitor->building        = $request->building;
        $visitor->demand          = $request->demand;
        $visitor->profession_id     = $request->profession_id;
        $visitor->organization    = $request->organization;
        $visitor->date            = $request->date;
        $visitor->remark          = $request->remark;
        $visitor->report          = $request->report;
        $visitor->contact_person  = $request->contact_person;
        $visitor->check_file      = $dircetory . $imageName;

        $visitor->check_file_two      = $dircetory_two . $imageName_two;
        $visitor->address  = $request->address;
        $visitor->save();
    } elseif( $request->hasFile('check_file_one') AND $request->hasFile('check_file_two')){


            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
            // Users Create
            $visitor = new Visitor();
            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;

            $visitor->check_file_one      = $dircetory_one . $imageName_one;
            $visitor->check_file_two      = $dircetory_two . $imageName_two;
            $visitor->address  = $request->address;
            $visitor->save();
        } elseif($request->hasFile('check_file')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);


            // Users Create
            $visitor = new Visitor();
            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file      = $dircetory . $imageName;
            $visitor->address  = $request->address;
            $visitor->save();
        } elseif( $request->hasFile('check_file_one')){


            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);


            // Users Create
            $visitor = new Visitor();
            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;

            $visitor->check_file_one      = $dircetory_one . $imageName_one;

            $visitor->address  = $request->address;
            $visitor->save();
        } elseif($request->hasFile('check_file_two')){

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
            // Users Create
            $visitor = new Visitor();
            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file_two      = $dircetory_two . $imageName_two;
            $visitor->address  = $request->address;
            $visitor->save();
        } else {
            $visitor = new Visitor();
        $visitor->name            = $request->name;
        $visitor->email           = $request->email;
        $visitor->phone           = $request->phone;
        $visitor->area            = $request->area;
        $visitor->land            = $request->land;
        $visitor->width           = $request->width;
        $visitor->height          = $request->height;
        $visitor->store           = $request->store;
        $visitor->building        = $request->building;
        $visitor->demand          = $request->demand;
        $visitor->profession_id     = $request->profession_id;
        $visitor->organization    = $request->organization;
        $visitor->date            = $request->date;
        $visitor->remark          = $request->remark;
        $visitor->report          = $request->report;
        $visitor->contact_person  = $request->contact_person;
        $visitor->address  = $request->address;
        $visitor->save();

        }

        Session::flash('message', 'Visistor Created Successfully');
        return redirect()->route('visitors.index');
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
        if(is_null($this->user) || !$this->user->can('visitor.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $user = User::find($id);
       $visitors = Visitor::find($id);
        return view('backend.pages.visitors.edit', compact('visitors','user'));
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
        if(is_null($this->user) || !$this->user->can('visitor.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $visitor = Visitor::find($id);
        $request->validate([
            'name'              => 'required|max:50',
            'phone'             => 'required',
            'date'              => 'required',
            'profession_id'     => 'required',

        ]);

        if($request->hasFile('check_file') AND $request->hasFile('check_file_one') AND $request->hasFile('check_file_two')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);

            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
        // Users Create

        $visitor->name            = $request->name;
        $visitor->email           = $request->email;
        $visitor->phone           = $request->phone;
        $visitor->area            = $request->area;
        $visitor->land            = $request->land;
        $visitor->width           = $request->width;
        $visitor->height          = $request->height;
        $visitor->store           = $request->store;
        $visitor->building        = $request->building;
        $visitor->demand          = $request->demand;
        $visitor->profession_id     = $request->profession_id;
        $visitor->organization    = $request->organization;
        $visitor->date            = $request->date;
        $visitor->remark          = $request->remark;
        $visitor->report          = $request->report;
        $visitor->contact_person  = $request->contact_person;
        $visitor->check_file      = $dircetory . $imageName;
        $visitor->check_file_one      = $dircetory_one . $imageName_one;
        $visitor->check_file_two      = $dircetory_two . $imageName_two;
        $visitor->address  = $request->address;
        $visitor->save();
        }  elseif($request->hasFile('check_file') AND $request->hasFile('check_file_one')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);

            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);


            // Users Create

            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file      = $dircetory . $imageName;
            $visitor->check_file_one      = $dircetory_one . $imageName_one;

            $visitor->address  = $request->address;
            $visitor->save();
        }  elseif($request->hasFile('check_file') AND $request->hasFile('check_file_two')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
            // Users Create

            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file      = $dircetory . $imageName;

            $visitor->check_file_two      = $dircetory_two . $imageName_two;
            $visitor->address  = $request->address;
            $visitor->save();
        }  elseif($request->hasFile('check_file_one') AND $request->hasFile('check_file_two')){


            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);

            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
            // Users Create

            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;

            $visitor->check_file_one      = $dircetory_one . $imageName_one;
            $visitor->check_file_two      = $dircetory_two . $imageName_two;
            $visitor->address  = $request->address;
            $visitor->save();
        }  elseif($request->hasFile('check_file')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);



            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;
            $visitor->check_file      = $dircetory . $imageName;
            $visitor->address  = $request->address;
            $visitor->save();
        }  elseif($request->hasFile('check_file_one')){


            $image_one = $request->file('check_file_one');
            $imageName_one = $image_one->getClientOriginalName();
            $dircetory_one = 'images/';
            $image_one->move($dircetory_one, $imageName_one);


            // Users Create

            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;

            $visitor->check_file_one      = $dircetory_one . $imageName_one;

            $visitor->address  = $request->address;
            $visitor->save();
        }  elseif($request->hasFile('check_file_two')){


            $image_two= $request->file('check_file_two');
            $imageName_two = $image_two->getClientOriginalName();
            $dircetory_two = 'images/';
            $image_two->move($dircetory_two, $imageName_two);
            // Users Create

            $visitor->name            = $request->name;
            $visitor->email           = $request->email;
            $visitor->phone           = $request->phone;
            $visitor->area            = $request->area;
            $visitor->land            = $request->land;
            $visitor->width           = $request->width;
            $visitor->height          = $request->height;
            $visitor->store           = $request->store;
            $visitor->building        = $request->building;
            $visitor->demand          = $request->demand;
            $visitor->profession_id     = $request->profession_id;
            $visitor->organization    = $request->organization;
            $visitor->date            = $request->date;
            $visitor->remark          = $request->remark;
            $visitor->report          = $request->report;
            $visitor->contact_person  = $request->contact_person;

            $visitor->check_file_two      = $dircetory_two . $imageName_two;
            $visitor->address  = $request->address;
            $visitor->save();
        }  else {

        $visitor->name            = $request->name;
        $visitor->email           = $request->email;
        $visitor->phone           = $request->phone;
        $visitor->area            = $request->area;
        $visitor->land            = $request->land;
        $visitor->width           = $request->width;
        $visitor->height          = $request->height;
        $visitor->store           = $request->store;
        $visitor->building        = $request->building;
        $visitor->demand          = $request->demand;
        $visitor->profession_id     = $request->profession_id;
        $visitor->organization    = $request->organization;
        $visitor->date            = $request->date;
        $visitor->remark          = $request->remark;
        $visitor->report          = $request->report;
        $visitor->contact_person  = $request->contact_person;
        $visitor->address  = $request->address;
        $visitor->save();

}
        Session::flash('message', 'Visistor Updated Successfully');
        return redirect()->route('visitors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('visitor.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $visitor = Visitor::find($id);
        if(!is_null($visitor)) {
            $visitor->delete();
        }
        Session::flash('message', 'Visitor Deleted Successfully');
        return redirect('admin/visitors');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new VisitorExport(), 'visitor_data.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new VisitorExport(), 'visitor_data.csv');
    }
    public function createPDF($start_date, $end_date) {
        $today =  date("Y-m-d");
        if($start_date!=$today){
            $visitors = DB::table('visitors')
                ->whereBetween('date', [$start_date, $end_date])
                ->get();
        } else {
            $visitors = Visitor::all();
        }
        $pdf = PDF::loadView('backend.pages.visitors.pdf', compact('visitors'))->setPaper('a4', 'landscape');
        // download PDF file with download method
        return $pdf->download('visitors.pdf');
    }

}
