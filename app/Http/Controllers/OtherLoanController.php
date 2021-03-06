<?php

namespace App\Http\Controllers;

use App\InvestMoney;
use App\OtherLoan;
use App\Bank;
use App\Widraw;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtherLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $othersloans = OtherLoan::all();
        return view('backend.pages.othersloans.index', compact('othersloans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('backend.pages.othersloans.create',compact('banks'));
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
            'date' => 'required|max:20',
            
        ]);
        $others= new OtherLoan();
        $others->purpose_name  = $request->purpose_name;
        $others->date  = $request->date;
        $others->amount  = $request->amount;
        $others->save();
        Session::flash('message', 'Invest Money Created Successfully');
        return redirect()->route('othersloans.index');
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
        $otherloans = OtherLoan::find($id);
        return view('backend.pages.othersloans.edit',compact('otherloans'));
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
         $request->validate([
            'date' => 'required|max:20',
           
        ]);
        $others = OtherLoan::find($id);
        $others->purpose_name  = $request->purpose_name;
        $others->date  = $request->date;
        $others->amount  = $request->amount;
        $others->save();
        Session::flash('message', 'Invest Money Updated Successfully');
        return redirect()->route('othersloans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $others = OtherLoan::find($id);
        if(!is_null($others)) {
            $others->delete();
        }
        Session::flash('message', 'Invest Money Deleted Successfully');
        return redirect()->route('othersloans.index');
    }
    public function createPDFotherloan() {
        $othersloans = OtherLoan::all();
        $pdf = PDF::loadView('backend.pages.othersloans.pdf', compact('othersloans'));
        // download PDF file with download method
        return $pdf->download('Otherloans.pdf');
    }
}
