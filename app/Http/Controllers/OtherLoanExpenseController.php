<?php

namespace App\Http\Controllers;

use App\Bank;
use App\OtherLoan;
use App\OtherLoanAdd;
use App\OtherLoanExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtherLoanExpenseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $othersloans = OtherLoan::findOrFail($id);
        $otheradds = OtherLoanExpense::all()->where('investor_id',$othersloans->id);
        return view('backend.pages.otherloanexpense.index',compact(['otheradds', 'othersloans']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->data['othersloans'] = OtherLoan::findOrFail($id);
        $this->data['banks'] = Bank::all();
        return view('backend.pages.otherloanexpense.create',$this->data);
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

        $otheradds = new OtherLoanExpense($formData);
        $otheradds->investor_id = $request->investor_id;
        $otheradds->bank_id = $request->bank_id;
        $otheradds->check_no = $request->check_no;
        $otheradds->date = $request->date;
        $otheradds->amount = $request->amount;
        $otheradds->payment_method = $request->payment_method;
        $otheradds->note = $request->note;
        $otheradds->save();
        Session::flash('message', 'Other Loan Add create Successfully');
        return redirect()->route('othersloans.loanexpense',['id' => $id]);
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
        $others= OtherLoan::findOrFail($id);
        $others_add = OtherLoanExpense::findOrFail($investor_id);
        $banks = Bank::all();
        return view('backend.pages.otherloanexpense.edit',compact(['banks','others_add','others' ]));
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

        $otheradds = OtherLoanExpense::find ($investor_id);
        $otheradds->investor_id = $request->investor_id;
        $otheradds->bank_id = $request->bank_id;
        $otheradds->check_no = $request->check_no;
        $otheradds->date = $request->date;
        $otheradds->amount = $request->amount;
        $otheradds->payment_method = $request->payment_method;
        $otheradds->note = $request->note;
        $otheradds->save();
        Session::flash('message', 'Other Loan Add Updated Successfully');
        return redirect()->route('othersloans.loanexpense',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $investor_id)
    {
        $othersadd =OtherLoanExpense::find($investor_id);
        if(!is_null($othersadd)) {
            $othersadd->delete();
        }
        Session::flash('message', 'Other Loan Deleted Successfully');
        return redirect()->route('othersloans.loanexpense', ['id' => $id]);
    }
}
