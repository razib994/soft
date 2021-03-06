<?php

namespace App\Http\Controllers;

use App\Other;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OthersController extends Controller
{
    public function others_collection(){

        return view('backend.pages.others_collections.create');
    }
    public function others_collection_index(){

        $others = Other::all();
        return view('backend.pages.others_collections.index', compact('others'));
    }
    public function insert_data(Request $request){
        $others = new Other();
        $others->purpose_name =  $request->purpose_name;
        $others->date =  $request->date;
        $others->amount = $request->amount;
        $others->save();
        Session::flash('message', 'Others Amount Created Successfully');
        return redirect('admin/others_collection_index');
    }
    public function edit($id) {
        $others = Other::find($id);
        return view('backend.pages.others_collections.edit', compact('others'));
    }
    public function update(Request $request, $id) {
        $others = Other::find($id);
        $others->purpose_name =  $request->purpose_name;
        $others->date =  $request->date;
        $others->amount = $request->amount;
        $others->save();
        Session::flash('message', 'Others Amount Updated Successfully');
        return redirect('admin/others_collection_index');

    }
    public function destory($id) {
        $others = Other::find($id);
        if(!is_null($others)) {
            $others->delete();
        }
        Session::flash('message', 'Others Amount Deleted Successfully');
        return redirect('admin/others_collection_index');
    }
}
