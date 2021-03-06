<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Cash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('cash.view')) {
            abort(403, 'Unauthorized Access');
        }
        $cashs = Cash::all();
        return view('backend.pages.cash.index', compact('cashs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('cash.create')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.cash.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('cash.create')) {
            abort(403, 'Unauthorized Access');
        }
       $cash = new Cash();
       $cash->cash_name     = $request->cash_name;
       $cash->amount        = $request->amount;
       $cash->save();
       Session::flash('message', 'Cashes Name Create Successfully');
        return redirect()->route('cashes.index');
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
        if(is_null($this->user) || !$this->user->can('cash.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $cash = Cash::find($id);
        return view('backend.pages.cash.edit', compact('cash'));
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
        if(is_null($this->user) || !$this->user->can('cash.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $cashes = Cash::find($id);
        $cashes->cash_name     = $request->cash_name;
        $cashes->amount        = $request->amount;
        $cashes->save();
        Session::flash('message', 'Cashes Name Updates Successfully');
        return redirect()->route('cashes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('cash.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $cash = Cash::find($id);
        if(!is_null($cash)) {
            $cash->delete();
        }
        Session::flash('message', 'Cash Deleted Successfully');
        return redirect('admin/cashes');
    }
}
