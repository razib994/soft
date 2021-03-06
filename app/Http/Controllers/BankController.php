<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Category;
use App\Exports\BankExport;
use App\Exports\CategoryExport;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class BankController extends Controller
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
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        return view('backend.pages.bank.index', ['banks'=>Bank::all(), 'start_date'=>$start_date,'end_date'=>$end_date]);
    }


    public function create(){
        if(is_null($this->user) || !$this->user->can('bank.create')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.bank.create');
    }


    public function store(Request $request){
        if(is_null($this->user) || !$this->user->can('bank.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'bank_name' => 'required|max:20',
            'amount'    => 'required',
        ]);
        $banks = new Bank();
        $banks->bank_name       = $request->bank_name;
        $banks->ac_no           = $request->ac_no;
        $banks->branch_name     = $request->branch_name;
        $banks->amount          = $request->amount;
        $banks->save();
        Session::flash('message', 'Bank Name Created Successfully');
        return redirect()->route('banks.index');
    }


    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('bank.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $bank = Bank::find($id);
        return view('backend.pages.bank.edit', compact('bank'));
    }



    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('bank.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $banks = Bank::find($id);
        $request->validate([
            'bank_name' => 'required',
            'amount'    => 'required',
        ]);
        $banks->bank_name   = $request->bank_name;
        $banks->ac_no       = $request->ac_no;
        $banks->branch_name = $request->branch_name;
        $banks->amount      = $request->amount;
        $banks->save();
        Session::flash('message', 'Banks Name Updates Successfully');
        return redirect()->route('banks.index');
    }


    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('bank.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $bank = Bank::find($id);
        if(!is_null($bank)) {
            $bank->delete();
        }
        Session::flash('message', 'Bank Deleted Successfully');
        return redirect('admin/banks');
    }

    public function exportIntoEXCEL(){
        return Excel::download(new BankExport(), 'bank_data_sheet.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new BankExport(), 'bank_data_sheet.csv');
    }
    public function createPDF() {
        $categories = Category::all();
        $pdf = PDF::loadView('backend.pages.categories.pdf', compact('categories'));
        // download PDF file with download method
        return $pdf->download('category.pdf');
    }

    public function createPDFBanked($start_date, $end_date) {

        $pdf = PDF::loadView('backend.pages.bank.pdf', ['banks'=>Bank::all(), 'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('bank-info.pdf');
    }


}
