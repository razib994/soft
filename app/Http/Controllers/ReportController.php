<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Cash;
use App\Client;
use App\Project;
use App\Visitor;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function projectReport()
    {
        if(is_null($this->user) || !$this->user->can('project-wise-client-report.view')) {
            abort(403, 'Unauthorized Access');
        }
        return view('backend.pages.report.project-report');
    }

    public function clientReport()
    {

        $projects = Project::all();
        return view('backend.pages.report.client-report', compact('projects'));
    }
    public function client_report_pdf() {
        $pdf = PDF::loadView('backend.pages.report.client-pdf',['projects'=>Project::all()]);
        return $pdf->download('client-Project-Collection.pdf');
    }
    public function pdfs($id) {
        $pdf = PDF::loadView('backend.pages.report.client-list-pdf',['project' => Project::findOrFail($id),  'clients' =>DB::table('clients')->where('project_id', $id)->get()]);
        return $pdf->download('client-Project-Amount-list.pdf');
    }

    public function visitorReport()
    {
        if(is_null($this->user) || !$this->user->can('visistor-report.view')) {
            abort(403, 'Unauthorized Access');
        }
        $visitors = Visitor::all();
        return view('backend.pages.report.visitor-report', compact('visitors'));

    }
    public function collectionStatement()
    {
        if(is_null($this->user) || !$this->user->can('monthly-collection-statement.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
//        $projects = Project::all();
        return view('backend.pages.report.collection-statement-report', ['projects'=>Project::all(), 'start_date' =>$start_date, 'end_date'=>$end_date]);
    }

    public function projectBalanceSheet(){
        if(is_null($this->user) || !$this->user->can('project-balance-sheet.view')) {
            abort(403, 'Unauthorized Access');
        }
           $start_date  = \request()->get('start_date', date('Y-m-d'));
            $end_date  = \request()->get('end_date', date('Y-m-d'));
        return view('backend.pages.report.project-balance-sheet', ['projects'=>Project::all(), 'start_date' =>$start_date, 'end_date'=>$end_date]);
    }

    public function paymentReport()
    {


        return view('backend.pages.report.payment-report');
    }

    public function profitLoss(){
        if(is_null($this->user) || !$this->user->can('profit-loss-report.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $projects = Project::all();
        $banks = Bank::all();
        $cashes = Cash::all();
        return view('backend.pages.report.blance_sheet', compact(['projects', 'banks','cashes','start_date', 'end_date']));
    }

    public function balance_report($start_date, $end_date) {
         $pdf = PDF::loadView('backend.pages.report.blance_sheet_pdf',['projects'=>Project::all(), 'banks'=>Bank::all(),'cashes'=>Cash::all(),'start_date'=>$start_date,'end_date'=>$end_date]);
        return $pdf->download('Balance-Sheet.pdf');
    }

    public function clients_Report($id){

        return view('backend.pages.report.client-report-list',   ['project' => Project::findOrFail($id),  'clients' =>DB::table('clients')->where('project_id', $id)->get()]);
    }
    public function expenditure_summery(){
        if(is_null($this->user) || !$this->user->can('expenditure-summery-sheet.view')) {
            abort(403, 'Unauthorized Access');
        }
        $statr_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));

        return view('backend.pages.report.experniture_summery_sheet', ['projects'=>Project::all(),'start_date'=>$statr_date, 'end_date'=>$end_date]);
    }
    public function cashReport(Request $request){
        if(is_null($this->user) || !$this->user->can('cash-report.view')) {
            abort(403, 'Unauthorized Access');
        }
        $this->data['start_date'] 	= $request->get('start_date', date('Y-m-d'));
        $this->data['end_date'] 	= $request->get('end_date', date('Y-m-d'));
        return view('backend.pages.report.cash-report',$this->data);
    }

    public function createPDFcash($start_date, $end_date){
        $pdf = PDF::loadView('backend.pages.report.cash-pdf', (['start_date'=>$start_date,'end_date'=>$end_date]));
        return $pdf->download('Cash-sheet.pdf');
    }
    public function createPDFcollection($start_date, $end_date){
        $pdf = PDF::loadView('backend.pages.report.collection_pdf', ['projects'=>Project::all(), 'start_date' =>$start_date, 'end_date'=>$end_date]);
        return $pdf->download('collection-sheet.pdf');
    }

    public function finalBlanceSheetReport(){
        if(is_null($this->user) || !$this->user->can('final-balance-sheet.view')) {
            abort(403, 'Unauthorized Access');
        }
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $cashs = Cash::all();
        $banks = Bank::all();
        return view('backend.pages.report.final-balance-sheet-report', compact(['cashs','banks', 'start_date','end_date']));
    }
    public function mains(){
        $start_date  = date('Y-m-d', strtotime('today - 30 days'));

          $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
           $end_date = $dt->format('Y-m-d');
           DB::table('client_payments')->whereBetween('date',[$start_date,$end_date])->where('payment_method','check')->sum('amount') ;

    }
    public function bankReport($id){
        $statr_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        return view('backend.pages.report.bank-report', ['banks'=>Bank::find($id),'start_date'=>$statr_date,'end_date'=>$end_date]);
    }
    public function createPDFbanks($id, $start_date, $end_date){
        $pdf = PDF::loadView('backend.pages.report.bank-report-pdf', ['banks'=>Bank::find($id),'start_date'=>$start_date,'end_date'=>$end_date]);
        return $pdf->download('bank-Data.pdf');
    }
    public function expenditureBankReport($id){
        $banks = Bank::find($id);
        return view('backend.pages.report.expenditure-cheque-report', compact('banks'));

    }
    public function collectionBankReport($id) {
        $banks = Bank::find($id);
        return view('backend.pages.report.collection-cheque-report', compact('banks'));

    }
    public function collectionCashReport(){
        $statr_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        return view('backend.pages.report.cash-report-collection-expenditure',['start_date'=>$statr_date,'end_date'=>$end_date]);
    }
    public function createPDF() {
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $pdf = PDF::loadView('backend.pages.report.collection_pdf', ['projects'=>Project::all(), 'start_date' =>$start_date, 'end_date'=>$end_date]);
        ;
        return $pdf->download('Collection-Statement.pdf');
    }

    public function createPDFfinal($start_date, $end_date) {
        $pdf = PDF::loadView('backend.pages.report.final_pdf', (['cashs'=>Cash::all(),'banks'=>Bank::all(),'start_date'=>$start_date,'end_date'=>$end_date]));
        return $pdf->download('Final-Balance-sheet.pdf');
    }
    public function createPDFexpenditure($start_date, $end_date) {
        $pdf = PDF::loadView('backend.pages.report.expenditure-pdf', ['projects'=>Project::all(),'start_date'=>$start_date, 'end_date'=>$end_date]);
        return $pdf->download('expenditure-Report.pdf');
    }
    public function createPDFprojectBlance($start_date, $end_date) {

        $pdf = PDF::loadView('backend.pages.report.project-balance-sheet-pdf', ['projects'=>Project::all(), 'start_date' =>$start_date, 'end_date'=>$end_date]);
        return $pdf->download('Project-Report.pdf');
    }

}
