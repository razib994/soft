<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Deposit;
use App\Exports\DepositExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
class DepositController extends Controller
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

    public function index(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('deposit.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $deposits= Deposit::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->get();
        }elseif($today=$start_date) {
            $deposits = Deposit::all();
        }
        return view('backend.pages.deposit.index',compact(['deposits','start_date','end_date']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('deposit.view')) {
            abort(403, 'Unauthorized Access');
        }
        $banks = Bank::all();
        return view('backend.pages.deposit.create', compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'bank_id'       => 'required|max:50',
            'checkno'       => 'required',
            'date'          => 'required',
            'amount'        => 'required',


        ]);
        if($request->hasFile('check_image')) {
            $image = $request->file('check_image');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);
            // create
            $deposit = new Deposit();
            $deposit->bank_id = $request->bank_id;
            $deposit->checkno = $request->checkno;
            $deposit->date = $request->date;
            $deposit->branch_name = $request->branch_name;
            $deposit->check_image = $dircetory . $imageName;
            $deposit->depositers_name = $request->depositers_name;
            $deposit->amount = $request->amount;
            $deposit->save();
        } else {
            $deposit = new Deposit();
            $deposit->bank_id = $request->bank_id;
            $deposit->checkno = $request->checkno;
            $deposit->date = $request->date;
            $deposit->branch_name = $request->branch_name;
            $deposit->depositers_name = $request->depositers_name;
            $deposit->amount = $request->amount;
            $deposit->save();
        }


        Session::flash('message', 'Deposit create Successfully');
        return redirect()->route('deposits.index');
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
        $deposits = Deposit::find($id);
        $banks = Bank::all();
        return view('backend.pages.deposit.edit', compact('deposits', 'banks'));
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
        $deposit =Deposit::find($id);
        $request->validate([
            'bank_id'       => 'required|max:50',
            'checkno'       => 'required',
            'date'          => 'required',
            'amount'        => 'required',


        ]);
        if($request->hasFile('check_image')) {
            $image = $request->file('check_image');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);
            // create

            $deposit->bank_id = $request->bank_id;
            $deposit->checkno = $request->checkno;
            $deposit->date = $request->date;
            $deposit->branch_name = $request->branch_name;
            $deposit->check_image = $dircetory . $imageName;
            $deposit->depositers_name = $request->depositers_name;
            $deposit->amount = $request->amount;
            $deposit->save();
        } else {
            $deposit =Deposit::find($id);
            $deposit->bank_id = $request->bank_id;
            $deposit->checkno = $request->checkno;
            $deposit->date = $request->date;
            $deposit->branch_name = $request->branch_name;
            $deposit->depositers_name = $request->depositers_name;
            $deposit->amount = $request->amount;
            $deposit->save();
        }


        Session::flash('message', 'Deposit Update Successfully');
        return redirect()->route('deposits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $deposit = Deposit::find($id);
        if(!is_null($deposit)) {
            $deposit->delete();
        }
        Session::flash('message', 'Deposit Amount Deleted Successfully');
        return redirect('admin/deposits');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new DepositExport(), 'deposit.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new DepositExport(), 'deposit.csv');
    }
     public function createPDFdeposit($start_date, $end_date) {
         $today =  date("Y-m-d");
         if($today != $start_date ) {
             $deposits= Deposit::where('date', '>=', $start_date)
                 ->where('date', '<=', $end_date)
                 ->get();
         }elseif($today=$start_date) {
             $deposits = Deposit::all();
         }


         $pdf = PDF::loadView('backend.pages.deposit.pdf', compact(['deposits','start_date','end_date']));
         // download PDF file with download method
         return $pdf->download('Deposit-info.pdf');

    }
}
