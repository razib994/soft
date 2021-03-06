<?php

namespace App\Http\Controllers;

use App\Client;
use App\Exports\ClientExport;
use App\Exports\ItemExport;
use App\Project;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
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
        if(is_null($this->user) || !$this->user->can('client.view')) {
            abort(403, 'Unauthorized Access');
        }
         $clients = Client::all();
        return view('backend.pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('client.create')) {
            abort(403, 'Unauthorized Access');
        }
        $projects = Project::all();
        return view('backend.pages.clients.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('client.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'project_id'        => 'required|max:50',
            'client_name'       => 'required',
            'phone'             => 'required',
            'address'           => 'required',
            'floor'             => 'required',
            'apartment'         => 'required|max:50',
            'amount'            => 'required|max:50',

        ]);
        // Users Create
        $client = new Client();
        $client->project_id      = $request->project_id;
        $client->client_name     = $request->client_name;
        $client->phone           = $request->phone;
        $client->address         = $request->address;
        $client->floor           = $request->floor;
        $client->apartment       = $request->apartment;
        $client->amount          = $request->amount;
        $client->save();


        Session::flash('message', 'Client Created Successfully');
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.pages.clients.show', ['client' => Client::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(is_null($this->user) || !$this->user->can('client.edit')) {
            abort(403, 'Unauthorized Access');
        }

        $clients = Client::find($id);
        $projects = Project::all();
        return view('backend.pages.clients.edit', compact(['clients','projects']));
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
        if(is_null($this->user) || !$this->user->can('client.edit')) {
            abort(403, 'Unauthorized Access');
        }

        $client = Client::find($id);
        $request->validate([
            'project_id'        => 'required|max:50',
            'client_name'       => 'required',
            'phone'             => 'required',
            'address'           => 'required',
            'floor'             => 'required',
            'apartment'         => 'required|max:50',
            'amount'            => 'required|max:50',

        ]);
        // Users Create
        $client->project_id      = $request->project_id;
        $client->client_name     = $request->client_name;
        $client->phone           = $request->phone;
        $client->address         = $request->address;
        $client->floor           = $request->floor;
        $client->apartment       = $request->apartment;
        $client->amount          = $request->amount;
        $client->save();


        Session::flash('message', 'Client Created Successfully');
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('client.delete')) {
            abort(403, 'Unauthorized Access');
        }
        $client = Client::find($id);
        if(!is_null($client)) {
            $client->delete();
        }
        Session::flash('message', 'Client Deleted Successfully');
        return redirect('admin/clients');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new ClientExport(), 'client_data.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new ClientExport(), 'client_data.csv');
    }
    public function createPDF() {
        $clients = Client::all();
        $pdf = PDF::loadView('backend.pages.clients.pdf', compact('clients'));
        // download PDF file with download method
        return $pdf->download('clients.pdf');
    }
}
