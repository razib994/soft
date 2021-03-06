<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OthersExpenditure extends Controller
{
    public function index(){
        $other_expenditures = \App\OthersExpenditure::all();
    return view('backend.pages.others_expenditure.index', compact('other_expenditures'));
    }
    public function create(){
        return view('backend.pages.others_expenditure.create');
    }
    public function store(Request $request) {
        $others_expenditure = new \App\OthersExpenditure();
        $others_expenditure->purpose_name = $request->purpose_name;
        $others_expenditure->date = $request->date;
        $others_expenditure->amount = $request->amount;
        $others_expenditure->save();
        Session::flash('message', 'Others Amount Created Successfully');
        return redirect()->route('otherof.index');
    }
    public function edit($id){
        $other_expenditures = \App\OthersExpenditure::find($id);
         return view('backend.pages.others_expenditure.index', compact('other_expenditures'));
        
    }
    public function update(Request $request, $id){
        
    }
    public function destroy($id){
        $ext = \App\OthersExpenditure::find($id);
        if(!is_null($ext)) {
            $ext->delete();
        }
        Session::flash('message', 'OthersExpenditure Deleted Successfully');
        return redirect()->route('otherof.index');
        
    }
}
