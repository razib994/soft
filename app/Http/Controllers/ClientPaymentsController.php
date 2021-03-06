<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Category;
use App\Client;
use App\ClientPayment;
use App\Exports\CategoryExport;
use App\Exports\ClientPaymentsExport;
use App\Project;
use App\ProjectPayment;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ClientPaymentsController extends Controller
{
    public function index($id)
    {
        $start_date  = \request()->get('start_date', date('Y-m-d'));
        $end_date  = \request()->get('end_date', date('Y-m-d'));
        $client = Client::findOrFail($id);
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $client_payments = ClientPayment::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('client_id',$client->id)
                ->get();
        }elseif($today=$start_date) {
            $client_payments = ClientPayment::where('client_id',$client->id)
                ->get();
        }
        return view('backend.pages.clients-payment.index', ['client'=>$client,'client_payments'=>$client_payments,'start_date'=>$start_date,'end_date'=>$end_date]);
    }

    public function create($id) {
        $this->data['client'] = Client::findOrFail($id);
        $this->data['banks'] = Bank::all();
        return view('backend.pages.clients-payment.create', $this->data);
    }

    public function store(Request $request, $id)
    {
         $request->validate([
            'date' => 'required|max:20',
            'payment_method'    => 'required',
        ]);
        $formData= $request->all();
         $formData['user_id'] = $id;
        if(ClientPayment::create($formData)) {
            Session::flash('message', 'Client Payment Created Successfully');
        }
        return redirect()->route('clients.payments',['id' => $id]);
    }
    public function edit($id, $cliented_id){
        $clients = Client::find($id);
        $categories = Category::all();
        $banks = Bank::all();
        $clientspayments = ClientPayment::find($cliented_id);

        return view('backend.pages.clients-payment.edit', compact(['clients','categories','banks','clientspayments']));
    }
    public function update(Request $request, $id, $client_id){
//        $formData= $request->all();
//        $formData['user_id'] = $paymented_id;
//        if(ProjectPayment::create($formData)) {
//            Session::flash('message', 'Project Payment Created Successfully');
//        }
 $request->validate([
            'date' => 'required|max:20',
            'payment_method'    => 'required',
        ]);
        $clientpayments = ClientPayment::find($client_id);

        if($request->hasFile('check_file')){
            $image = $request->file('check_file');
            $imageName = $image->getClientOriginalName();
            $dircetory = 'images/';
            $image->move($dircetory, $imageName);
            // Users Create


            $clientpayments->client_id          = $request->client_id;
            $clientpayments->bank_id            = $request->bank_id;
            $clientpayments->check_no            = $request->check_no;
            $clientpayments->date               = $request->date;
            $clientpayments->amount             = $request->amount;
            $clientpayments->payment_method     = $request->payment_method;
            $clientpayments->check_file         = $dircetory . $imageName;
            $clientpayments->note               = $request->note;
            $clientpayments->save();
        } else {

            $clientpayments->client_id          = $request->client_id;
            $clientpayments->bank_id            = $request->bank_id;
            $clientpayments->date               = $request->date;
            $clientpayments->amount             = $request->amount;
            $clientpayments->payment_method     = $request->payment_method;
            $clientpayments->note               = $request->note;
            $clientpayments->save();
        }
        Session::flash('message', 'Client Collection Update Successfully');
        return redirect()->route('clients.payments',['id' => $id, 'client_id'=>$client_id]);
    }
    public function destroy($id, $clients_id)
    {
//        if(is_null($this->user) || !$this->user->can('withdraw.delete')) {
//            abort(403, 'Unauthorized Access');
//        }
        $clientpayments= ClientPayment::find($clients_id);
        if(!is_null($clientpayments)) {
            $clientpayments->delete();
        }
        Session::flash('message', 'Client Collection Deleted Successfully');
        return redirect()->route('clients.payments', ['id' => $id]);
    }

    public function exportIntoEXCEL(){
        return Excel::download(new ClientPaymentsExport(), 'ClientPayments.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new ClientPaymentsExport(), 'ClientPayments.csv');
    }

    public function createPDF($id, $start_date, $end_date) {
        $client = Client::findOrFail($id);
        $project = Project::where('id',$client->project_id)->get();
        $today =  date("Y-m-d");
        if($today != $start_date ) {
            $client_payments = ClientPayment::where('date', '>=', $start_date)
                ->where('date', '<=', $end_date)
                ->where('client_id',$client->id)
                ->get();
        }elseif($today=$start_date) {
            $client_payments = ClientPayment::where('client_id',$client->id)
                ->get();
        }
        $pdf = PDF::loadView('backend.pages.clients-payment.pdf_client_payments', ['client'=>$client,'projects'=>$project,'client_payments'=>$client_payments,'start_date'=>$start_date,'end_date'=>$end_date]);
        // download PDF file with download method
        return $pdf->download('ClientPayments.pdf');
    }
}
