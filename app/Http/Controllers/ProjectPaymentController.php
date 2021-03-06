<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Category;
use App\Exports\ProjectPaymentExport;
use App\Item;
use App\Project;
use App\ProjectPayment;
use App\Widraw;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class ProjectPaymentController extends Controller
{
    public function index( $id)
    {
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $project = Project::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $project_payments = ProjectPayment::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('project_id',$project->id)
                ->get();
        }elseif($today=$start_date) {
            $project_payments = ProjectPayment::where('project_id',$project->id)
                ->orderBy('id', 'desc')->get();
        }
        return view('backend.pages.projects-payment.index', ['project'=>$project,'project_payments'=>$project_payments,'start_date'=>$start_date,'end_date'=>$end_date]);
    }

    public function create($id) {
        $this->data['project'] = Project::findOrFail($id);
        $this->data['categories'] = Category::all();
        $this->data['banks'] = Bank::all();
        return view('backend.pages.projects-payment.create', $this->data);
    }
    public function store(Request $request, $id)
    {
        $formData= $request->all();
        $formData['user_id'] = $id;
//        if(ProjectPayment::create($formData)) {
//            Session::flash('message', 'Project Payment Created Successfully');
//        }
        $request->validate([
            'category_id'     => 'required|max:50',
            'date'          => 'required',
            'amount'        => 'required',
            'payment_method'    => 'required',



        ]);
        if($request->hasFile('check_file')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);
            // Users Create

            $projectPayment = new ProjectPayment($formData);
            $projectPayment->project_id = $request->project_id;
            $projectPayment->category_id = $request->category_id;
            $projectPayment->bank_id = $request->bank_id;
            $projectPayment->check_no = $request->check_no;
            $projectPayment->item_name = $request->item_name;
            $projectPayment->date = $request->date;
            $projectPayment->amount = $request->amount;
            $projectPayment->payment_method = $request->payment_method;
            $projectPayment->check_file = $dircetory . $imageName;
            $projectPayment->note = $request->note;
            $projectPayment->save();
        } else {
            $projectPayment = new ProjectPayment($formData);
            $projectPayment->project_id = $request->project_id;
            $projectPayment->category_id = $request->category_id;
            $projectPayment->bank_id = $request->bank_id;
            $projectPayment->item_name = $request->item_name;
            $projectPayment->date = $request->date;
            $projectPayment->amount = $request->amount;
            $projectPayment->payment_method = $request->payment_method;
            $projectPayment->note = $request->note;
            $projectPayment->save();
        }

        Session::flash('message', 'Project payment create Successfully');
        return redirect()->route('projects.payments',['id' => $id]);
    }
    public function edit($id, $payment_id){
        $projects = Project::find($id);
        $categories = Category::all();
        $banks = Bank::all();
        $projectpayments = ProjectPayment::find($payment_id);

        return view('backend.pages.projects-payment.edit', compact(['projects','categories','banks','projectpayments']));
    }
    public function update(Request $request, $id, $paymented_id){
//        $formData= $request->all();
//        $formData['user_id'] = $paymented_id;
//        if(ProjectPayment::create($formData)) {
//            Session::flash('message', 'Project Payment Created Successfully');
//        }
        $projectPayment = ProjectPayment::find($paymented_id);
         $request->validate([
            'category_id'     => 'required|max:50',
            'date'          => 'required',
            'amount'        => 'required',
            'payment_method'    => 'required',



        ]);
        if($request->hasFile('check_file')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);
            // Users Create


            $projectPayment->project_id = $request->project_id;
            $projectPayment->category_id = $request->category_id;
            $projectPayment->bank_id = $request->bank_id;
            $projectPayment->check_no = $request->check_no;
            $projectPayment->item_name = $request->item_name;
            $projectPayment->date = $request->date;
            $projectPayment->amount = $request->amount;
            $projectPayment->payment_method = $request->payment_method;
            $projectPayment->check_file = $dircetory . $imageName;
            $projectPayment->note = $request->note;
            $projectPayment->save();
        } else {

            $projectPayment->project_id = $request->project_id;
            $projectPayment->category_id = $request->category_id;
            $projectPayment->bank_id = $request->bank_id;
            $projectPayment->item_name = $request->item_name;
            $projectPayment->date = $request->date;
            $projectPayment->amount = $request->amount;
            $projectPayment->payment_method = $request->payment_method;
            $projectPayment->note = $request->note;
            $projectPayment->save();
        }
        Session::flash('message', 'Project payment Update Successfully');
        return redirect()->route('projects.payments',['id' => $id, 'paymented_id'=>$paymented_id]);
    }
    public function indivisual_Report($id){

        $statr_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));


        return view('backend.pages.projects.project-wise-report',   [
            'project'           => Project::findOrFail($id),
            'categories_main'   =>Category::all(),
            'categories'        => DB::table('project_payments')
                ->join('categories', 'project_payments.category_id', '=', 'categories.id')
                ->select('project_payments.*', 'categories.category_name')
                ->where('project_payments.project_id', $id)
                ->get()
        , 'start_date' =>$statr_date, 'end_date' =>$end_date]);
    }
    public function GetSubCatAgainstMainCatEdit($cat_id) {
        echo json_encode(DB::table('items')->where('category_id', $cat_id)->get());

    }
    public function destroy($id, $payment_id)
    {
//        if(is_null($this->user) || !$this->user->can('project.delete')) {
//            abort(403, 'Unauthorized Access');
//        }
        $project_payment =ProjectPayment::find($payment_id);
        if(!is_null($project_payment)) {
            $project_payment->delete();
        }
        Session::flash('message', 'Project Expenditure Deleted Successfully');
        return redirect()->route('projects.payments', ['id' => $id]);
    }
    public function exportIntoEXCEL(){
        return Excel::download(new ProjectPaymentExport, 'Project_expenture.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new ProjectPaymentExport(), 'Project_expenture.csv');
    }
    public function createPDF($id, $start_date, $end_date) {
        $project = Project::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $project_payments = ProjectPayment::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('project_id',$project->id)
                ->get();
        }elseif($today=$start_date) {
            $project_payments = ProjectPayment::where('project_id',$project->id)
                ->get();
        }
        $pdf = PDF::loadView('backend.pages.projects-payment.pdf',  ['project'=>$project,'project_payments'=>$project_payments,'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('Project-expenture.pdf');
    }

     public function createPDFWise($id, $start_date, $end_date) {


        $pdf = PDF::loadView('backend.pages.projects.project_wise_pdf',   [
            'project'           => Project::findOrFail($id),
            'categories_main'   =>Category::all(),
            'categories'        => DB::table('project_payments')
                ->join('categories', 'project_payments.category_id', '=', 'categories.id')
                ->select('project_payments.*', 'categories.category_name')
                ->where('project_payments.project_id', $id)
                ->get()
            , 'start_date' =>$start_date, 'end_date' =>$end_date]);
        // download PDF file with download method
        return $pdf->download('Project-expenture-monthly.pdf');
    }
    // public function createPDFWise($id) {
    //     $statr_date  = \request()->get('start_date', date('Y-m-d'));
    //     $end_date  = \request()->get('end_date', date('Y-m-d'));


    //     $pdf = PDF::loadView('backend.pages.projects.project_wise_pdf',   [
    //         'project'           => Project::findOrFail($id),
    //         'categories_main'   =>Category::all(),
    //         'categories'        => DB::table('project_payments')
    //             ->join('categories', 'project_payments.category_id', '=', 'categories.id')
    //             ->select('project_payments.*', 'categories.category_name')
    //             ->where('project_payments.project_id', $id)
    //             ->get()
    //         , 'start_date' =>$statr_date, 'end_date' =>$end_date]);
    //     // download PDF file with download method
    //     return $pdf->download('Project-expenture-monthly.pdf');
    // }
}
