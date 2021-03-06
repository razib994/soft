<?php

namespace App\Http\Controllers;

use App\InvestMoney;
use App\OtherLoan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvestMoneyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invests = InvestMoney::all();
        return view('backend.pages.investmoney.index', compact('invests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.investmoney.create');
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
        $invest = new InvestMoney();
        $invest->purpose_name  = $request->purpose_name;
        $invest->date  = $request->date;
        $invest->amount  = $request->amount;
        $invest->save();
        Session::flash('message', 'Invest Money Created Successfully');
        return redirect()->route('investmoneys.index');
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

        return view('backend.pages.investmoney.show',compact( 'invest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invests = InvestMoney::find($id);
        return view('backend.pages.investmoney.edit',compact('invests'));
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
        $invest = InvestMoney::find($id);
        $invest->purpose_name  = $request->purpose_name;
        $invest->date  = $request->date;
        $invest->amount  = $request->amount;
        $invest->save();
        Session::flash('message', 'Invest Money Updated Successfully');
        return redirect()->route('investmoneys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invest = InvestMoney::find($id);
        if(!is_null($invest)) {
            $invest->delete();
        }
        Session::flash('message', 'Invest Money Deleted Successfully');
        return redirect()->route('investmoneys.index');
    }
}
