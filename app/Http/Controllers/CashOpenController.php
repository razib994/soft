<?php

namespace App\Http\Controllers;

use App\Cashopen;
use App\Openbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CashOpenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opencashs = Cashopen::all();
        return view('backend.pages.open-cash.index', compact('opencashs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.pages.open-cash.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'bank_id' => 'required|max:20',
//            'amount'    => 'required',
//        ]);
        $opencash= new Cashopen();
        $opencash->purpose_name       = $request->purpose_name;
        $opencash->amount             = $request->amount;
        $opencash->save();
        Session::flash('message', 'Open Cash Amount Created Successfully');
        return redirect()->route('open_cash_amounts.index');
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
        $open_cash = Cashopen::find($id);
        return view('backend.pages.open-cash.edit', compact('open_cash'));
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
        $opencash = Cashopen::find($id);
        $opencash->purpose_name       = $request->purpose_name;
        $opencash->amount             = $request->amount;
        $opencash->save();
        Session::flash('message', 'Open Cash Amount Updated Successfully');
        return redirect()->route('open_cash_amounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opencash = Cashopen::find($id);
        if(!is_null($opencash)) {
            $opencash->delete();
        }
        Session::flash('message', 'Open Cash Amount Deleted Successfully');
        return redirect('admin/open_cash_amounts');
    }
}
