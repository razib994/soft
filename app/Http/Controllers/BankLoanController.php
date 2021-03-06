<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankLoan;
use App\OtherLoan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;

class BankLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));

        return view('backend.pages.bankloan.index', ['bankloans'=>BankLoan::all(),'start_date'=>$start_date,'end_date'=>$end_date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.bankloan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bankLoans = new BankLoan();
        $bankLoans->investor_name  = $request->investor_name;
        $bankLoans->date  = $request->date;
        $bankLoans->save();
        Session::flash('message', 'Bank Loan Created Successfully');
        return redirect()->route('bankloans.index');
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
        $bankloans = BankLoan::find($id);
        return view('backend.pages.bankloan.edit',compact('bankloans'));
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
        $bankLoans = BankLoan::find($id);
        $bankLoans->investor_name  = $request->investor_name;
        $bankLoans->date  = $request->date;
        $bankLoans->save();
        Session::flash('message', 'Bank Loan Updated Successfully');
        return redirect()->route('bankloans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankloans = BankLoan::find($id);
        if(!is_null($bankloans)) {
            $bankloans->delete();
        }
        Session::flash('message', 'Bank Loan Deleted Successfully');
        return redirect()->route('bankloans.index');
    }
    public function createPDFBankLoan($start_date, $end_date){
        $pdf = PDF::loadView('backend.pages.bankloan.bankloan', ['bankloans'=>BankLoan::all(), 'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('bankloan-info.pdf');

    }
}
