<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Exports\BankExport;
use App\Openbank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class OpenBankController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index(){
        if(is_null($this->user) || !$this->user->can('bank.view')) {
            abort(403, 'Unauthorized Access');
        }
        $openbanks = Openbank::all();
        return view('backend.pages.open-bank.index', compact('openbanks'));
    }


    public function create(){
        if(is_null($this->user) || !$this->user->can('bank.create')) {
            abort(403, 'Unauthorized Access');
        }
        $banks = Bank::all();
        return view('backend.pages.open-bank.create', compact('banks'));
    }


    public function store(Request $request){
        if(is_null($this->user) || !$this->user->can('bank.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'bank_id' => 'required|max:20',
            'amount'    => 'required',
        ]);
        $openbanks = new Openbank();
        $openbanks->bank_id       = $request->bank_id;
        $openbanks->ac_no           = $request->ac_no;
        $openbanks->branch_name     = $request->branch_name;
        $openbanks->amount          = $request->amount;
        $openbanks->save();
        Session::flash('message', 'Open Bank Amount Created Successfully');
        return redirect()->route('open_bank_amounts.index');
    }


    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('bank.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $open_bank = Openbank::find($id);
        $banks = Bank::all();
        return view('backend.pages.open-bank.edit', compact(['open_bank','banks']));
    }



    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('bank.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $openbanks = Openbank::find($id);
        $request->validate([
            'bank_id' => 'required',
            'amount'    => 'required',
        ]);
        $openbanks->bank_id   = $request->bank_id;
        $openbanks->ac_no       = $request->ac_no;
        $openbanks->branch_name = $request->branch_name;
        $openbanks->amount      = $request->amount;
        $openbanks->save();
        Session::flash('message', 'Open Bank Amount Updates Successfully');
        return redirect()->route('open_bank_amounts.index');
    }


    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('bank.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $openbank= Openbank::find($id);
        if(!is_null($openbank)) {
            $openbank->delete();
        }
        Session::flash('message', 'Open Bank Amount Deleted Successfully');
        return redirect('admin/open_bank_amounts');
    }



}
