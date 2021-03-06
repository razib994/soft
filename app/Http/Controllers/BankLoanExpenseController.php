<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankLoan;
use App\BankLoanExpense;
use App\OtherLoan;
use App\OtherLoanExpense;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Session;

class BankLoanExpenseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $bankloans = BankLoan::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date){
            $bankloandexpense = BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('investor_id',$bankloans->id);
        } elseif($start_date=$today){
            $bankloandexpense = BankLoanExpense::all()->where('investor_id',$bankloans->id);
        }
        return view('backend.pages.bankloanexpense.index',['bankloans'=>$bankloans, 'bankloandexpense'=>$bankloandexpense,'start_date'=>$start_date,'end_date'=>$end_date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->data['bankloans'] = BankLoan::findOrFail($id);
        $this->data['banks'] = Bank::all();
        return view('backend.pages.bankloanexpense.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
         $request->validate([
            'date' => 'required|max:20',
            'payment_method'    => 'required',
        ]);
        $formData= $request->all();
        $formData['investor_id'] = $id;

        $bankloanexpense = new BankLoanExpense($formData);
        $bankloanexpense->investor_id = $request->investor_id;
        $bankloanexpense->bank_id = $request->bank_id;
        $bankloanexpense->check_no = $request->check_no;
        $bankloanexpense->date = $request->date;
        $bankloanexpense->amount = $request->amount;
        $bankloanexpense->payment_method = $request->payment_method;
        $bankloanexpense->note = $request->note;
        $bankloanexpense->save();
        Session::flash('message', 'Bank Loan Expense create Successfully');
        return redirect()->route('bankloanex.bankloanexpense',['id' => $id]);
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
    public function edit($id, $investor_id)
    {
        $bankloans= BankLoan::findOrFail($id);
        $bankloanexpense = BankLoanExpense::findOrFail($investor_id);
        $banks = Bank::all();
        return view('backend.pages.bankloanexpense.edit',compact(['banks','bankloanexpense','bankloans' ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $investor_id)
    {
         $request->validate([
            'date' => 'required|max:20',
            'payment_method'    => 'required',
        ]);

        $bankloanexpense = BankLoanExpense::find ($investor_id);
        $bankloanexpense->investor_id = $request->investor_id;
        $bankloanexpense->bank_id = $request->bank_id;
        $bankloanexpense->check_no = $request->check_no;
        $bankloanexpense->date = $request->date;
        $bankloanexpense->amount = $request->amount;
        $bankloanexpense->payment_method = $request->payment_method;
        $bankloanexpense->note = $request->note;
        $bankloanexpense->save();
        Session::flash('message', 'Bank Loan Expense Updated Successfully');
        return redirect()->route('bankloanex.bankloanexpense',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $investor_id)
    {
        $bankloanexpense =BankLoanExpense::find($investor_id);
        if(!is_null($bankloanexpense)) {
            $bankloanexpense->delete();
        }
        Session::flash('message', 'Bank Loan Refund Deleted Successfully');
        return redirect()->route('bankloanex.bankloanexpense', ['id' => $id]);
    }
    public function createPDFBankLoanExpensepdf($id, $start_date, $end_date){
        $bankloans = BankLoan::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date){
            $bankloandexpense = BankLoanExpense::all()->whereBetween('date',[$start_date,$end_date])->where('investor_id',$bankloans->id);
        } elseif($start_date=$today){
            $bankloandexpense = BankLoanExpense::all()->where('investor_id',$bankloans->id);
        }
        $pdf = PDF::loadView('backend.pages.bankloanexpense.pdf',['bankloans'=>$bankloans, 'bankloandexpense'=>$bankloandexpense,'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('bankexpense-info.pdf');
    }
}
