<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankTransfer;
use App\Client;
use App\Widraw;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank_transfers = BankTransfer::all();
        $banks = Bank::all();
        return view('backend.pages.bank_transfers.index', compact(['banks','bank_transfers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('backend.pages.bank_transfers.create',compact('banks'));
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
            'form_bank_id' => 'required',
            'to_bank_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
       ]);
       $banktransfer = new BankTransfer();
       $banktransfer->form_bank_id = $request->form_bank_id;
       $banktransfer->to_bank_id = $request->to_bank_id;
       $banktransfer->amount = $request->amount;
       $banktransfer->date = $request->date;
       $banktransfer->save();
        Session::flash('message', 'BankTransfer Created Successfully');
        return redirect()->route('bank_transfers.index');
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
        $bank_transfers = BankTransfer::find($id);
        $banks = Bank::all();
        return view('backend.pages.bank_transfers.edit', compact(['banks','bank_transfers']));
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
        $banktransfer =BankTransfer::find($id);
        $request->validate([
            'form_bank_id' => 'required',
            'to_bank_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ]);

        $banktransfer->form_bank_id = $request->form_bank_id;
        $banktransfer->to_bank_id = $request->to_bank_id;
        $banktransfer->amount = $request->amount;
        $banktransfer->date = $request->date;
        $banktransfer->save();
        Session::flash('message', 'BankTransfer Updated Successfully');
        return redirect()->route('bank_transfers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank_transfer= BankTransfer::find($id);
        if(!is_null($bank_transfer)) {
            $bank_transfer->delete();
        }
        Session::flash('message', 'Bank Transfer Deleted Successfully');
        return redirect()->route('bank_transfers.index');
    }
    public function createPDFBankTransfer() {
        $bank_transfers = BankTransfer::all();
        $banks = Bank::all();
        $pdf = PDF::loadView('backend.pages.bank_transfers.pdf', compact(['banks','bank_transfers']));
        // download PDF file with download method
        return $pdf->download('Bank-Transfer.pdf');
    }

}
