<?php

namespace App\Http\Controllers;

use App\Bank;
use App\InvestAdd;
use App\InvestMoney;
use App\Project;
use App\ProjectPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvestAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invest = InvestMoney::findOrFail($id);
        $investadds = InvestAdd::all()->where('investor_id',$invest->id);
        return view('backend.pages.investmoneyadd.index',compact(['investadds', 'invest']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $this->data['invest'] = InvestMoney::findOrFail($id);
        $this->data['banks'] = Bank::all();
        return view('backend.pages.investmoneyadd.create',$this->data);

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

        $investadds = new InvestAdd($formData);
        $investadds->investor_id = $request->investor_id;
        $investadds->bank_id = $request->bank_id;
        $investadds->check_no = $request->check_no;
        $investadds->date = $request->date;
        $investadds->amount = $request->amount;
        $investadds->payment_method = $request->payment_method;
        $investadds->note = $request->note;
        $investadds->save();
        Session::flash('message', 'Invest Add create Successfully');
        return redirect()->route('investmoneys.investmoneyadd',['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $invest= InvestMoney::findOrFail($id);

        return view('backend.pages.investmoneyadd.show',compact( 'invest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $investor_id)
    {
        $invest= InvestMoney::findOrFail($id);
        $invest_add = InvestAdd::findOrFail($investor_id);
        $banks = Bank::all();
        return view('backend.pages.investmoneyadd.edit',compact(['banks','invest_add','invest' ]));
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
        $investadd = InvestAdd::find($investor_id);
        $investadd->investor_id = $request->investor_id;
        $investadd->bank_id = $request->bank_id;
        $investadd->check_no = $request->check_no;
        $investadd->date = $request->date;
        $investadd->amount = $request->amount;
        $investadd->payment_method = $request->payment_method;
        $investadd->note = $request->note;
        $investadd->save();
        Session::flash('message', 'Invest Update create Successfully');
        return redirect()->route('investmoneys.investmoneyadd',['id' => $id,'investor_id'=>$investor_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $investor_id)
    {
        $investadd =InvestAdd::find($investor_id);
        if(!is_null($investadd)) {
            $investadd->delete();
        }
        Session::flash('message', 'Investor Deleted Successfully');
        return redirect()->route('investmoneys.investmoneyadd', ['id' => $id]);
    }
}
