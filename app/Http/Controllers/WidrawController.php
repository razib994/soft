<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Exports\VisitorExport;
use App\Exports\WithdrawExport;
use App\Widraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;

class WidrawController extends Controller
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
        if(is_null($this->user) || !$this->user->can('withdraw.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $widraws= Widraw::where('date', '>=', $start_date)
        ->where('date', '<=', $end_date)
        ->get();
        }elseif($today=$start_date) {
            $widraws = Widraw::all();
        }

        return view('backend.pages.widraw.index', compact(['widraws','start_date','end_date']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('withdraw.create')) {
            abort(403, 'Unauthorized Access');
        }
        $banks = Bank::all();
        return view('backend.pages.widraw.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('withdraw.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'bank_id'       => 'required|max:50',
            'checkno'       => 'required',
            'date'          => 'required',
            'amount'        => 'required',


        ]);
        if($request->hasFile('check_image')) {
        $image      = $request->file('check_image');
        $imageName  =  $image->getClientOriginalName();
        $dircetory  = 'images/';
        $image->move($dircetory, $imageName);
        // create
        $widraw = new Widraw();
        $widraw->bank_id          = $request->bank_id;
        $widraw->checkno          = $request->checkno;
        $widraw->date             = $request->date;
        $widraw->branch_name      = $request->branch_name;
        $widraw->check_image      = $dircetory.$imageName;
        $widraw->widraw_name      = $request->widraw_name;
        $widraw->amount           = $request->amount;
        $widraw->save();
        } else {
            $widraw = new Widraw();
            $widraw->bank_id          = $request->bank_id;
            $widraw->checkno          = $request->checkno;
            $widraw->date             = $request->date;
            $widraw->branch_name      = $request->branch_name;
            $widraw->widraw_name      = $request->widraw_name;
            $widraw->amount           = $request->amount;
            $widraw->save();

        }


        Session::flash('message', 'Widraw create Successfully');
        return redirect()->route('widraws.index');
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
        if(is_null($this->user) || !$this->user->can('withdraw.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $widraws = Widraw::find($id);
        return view('backend.pages.widraw.edit', compact('widraws'));
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
        if(is_null($this->user) || !$this->user->can('withdraw.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $widraw = Widraw::find($id);
        $request->validate([
            'bank_id'       => 'required|max:50',
            'checkno'       => 'required',
            'date'          => 'required',
            'amount'        => 'required',


        ]);
        if($request->hasFile('check_image')) {
            $image      = $request->file('check_image');
            $imageName  =  $image->getClientOriginalName();
            $dircetory  = 'images/';
            $image->move($dircetory, $imageName);
            // create

            $widraw->bank_id          = $request->bank_id;
            $widraw->checkno          = $request->checkno;
            $widraw->date             = $request->date;
            $widraw->branch_name      = $request->branch_name;
            $widraw->check_image      = $dircetory.$imageName;
            $widraw->widraw_name      = $request->widraw_name;
            $widraw->amount           = $request->amount;
            $widraw->save();
        } else {
            $widraw = Widraw::find($id);
            $widraw->bank_id          = $request->bank_id;
            $widraw->checkno          = $request->checkno;
            $widraw->date             = $request->date;
            $widraw->branch_name      = $request->branch_name;
            $widraw->widraw_name      = $request->widraw_name;
            $widraw->amount           = $request->amount;
            $widraw->save();

        }


        Session::flash('message', 'Widraw create Successfully');
        return redirect()->route('widraws.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('withdraw.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $widraw = Widraw::find($id);
        if(!is_null($widraw)) {
            $widraw->delete();
        }
        Session::flash('message', 'Widraw Amount Deleted Successfully');
        return redirect('admin/widraws');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new WithdrawExport(), 'withdraw.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new WithdrawExport(), 'withdraw.csv');
    }
    public function createPDFwithdraw($start_date, $end_date) {
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $widraws= Widraw::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        }elseif($today=$start_date) {
            $widraws = Widraw::all();
        }


        $pdf = PDF::loadView('backend.pages.widraw.pdf', compact(['widraws','start_date','end_date']));
        // download PDF file with download method
        return $pdf->download('Withdraw-infor.pdf');
    }
}
