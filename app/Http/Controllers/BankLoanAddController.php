<?php

namespace App\Http\Controllers;

use App\Bank;
use App\BankLoan;
use App\BankLoanAdd;
use App\OtherLoan;
use App\OtherLoanAdd;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankLoanAddController extends Controller
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
        $bankloan_added = BankLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->where('investor_id',$bankloans->id);
        } elseif($start_date=$today){
            $bankloan_added = BankLoanAdd::all()->where('investor_id',$bankloans->id);
        }
        return view('backend.pages.bankloanadd.index',['bankloan_adds'=>$bankloan_added, 'bankloans'=>$bankloans,'start_date'=>$start_date,'end_date'=>$end_date]);
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
        return view('backend.pages.bankloanadd.create',$this->data);
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

        $bankloanadds = new BankLoanAdd($formData);
        $bankloanadds->investor_id = $request->investor_id;
        $bankloanadds->bank_id = $request->bank_id;
        $bankloanadds->check_no = $request->check_no;
        $bankloanadds->date = $request->date;
        $bankloanadds->amount = $request->amount;
        $bankloanadds->payment_method = $request->payment_method;
        $bankloanadds->note = $request->note;
        $bankloanadds->save();
        Session::flash('message', 'Bank Loan Add create Successfully');
        return redirect()->route('bankloans.bankloanadd',['id' => $id]);
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
        $bankloans = BankLoan::findOrFail($id);
        $bankloan_add = BankLoanAdd::findOrFail($investor_id);
        $banks = Bank::all();
        return view('backend.pages.bankloanadd.edit',compact(['banks','bankloan_add','bankloans' ]));
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

        $bankloanadds = BankLoanAdd::find ($investor_id);
        $bankloanadds->investor_id = $request->investor_id;
        $bankloanadds->bank_id = $request->bank_id;
        $bankloanadds->check_no = $request->check_no;
        $bankloanadds->date = $request->date;
        $bankloanadds->amount = $request->amount;
        $bankloanadds->payment_method = $request->payment_method;
        $bankloanadds->note = $request->note;
        $bankloanadds->save();
        Session::flash('message', 'Bank Loan Add Updated Successfully');
        return redirect()->route('bankloans.bankloanadd',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $investor_id)
    {
        $bankloanadd =BankLoanAdd::find($investor_id);
        if(!is_null($bankloanadd)) {
            $bankloanadd->delete();
        }
        Session::flash('message', 'Bank Loan Deleted Successfully');
        return redirect()->route('bankloans.bankloanadd', ['id' => $id]);
    }
    public function createPDFBankLoanAddpdf($id, $start_date, $end_date){
        $bankloans = BankLoan::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date){
            $bankloan_added = BankLoanAdd::all()->whereBetween('date',[$start_date,$end_date])->where('investor_id',$bankloans->id);
        } elseif($start_date=$today){
            $bankloan_added = BankLoanAdd::all()->where('investor_id',$bankloans->id);
        }
        $pdf = PDF::loadView('backend.pages.bankloanadd.bankloanaddpdf', ['bankloan_adds'=>$bankloan_added, 'bankloans'=>$bankloans,'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('bankadd-info.pdf');
    }
}
