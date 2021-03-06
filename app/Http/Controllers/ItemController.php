<?php

namespace App\Http\Controllers;

use App\Category;
use App\Exports\CategoryExport;
use App\Exports\ItemExport;
use App\Item;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if(is_null($this->user) || !$this->user->can('item-particular.view')) {
            abort(403, 'Unauthorized Access');
        }
        $items = Item::orderBy('category_id')->get();
        return view('backend.pages.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('item-particular.create')) {
            abort(403, 'Unauthorized Access');
        }
        $items= Item::all();
        $categories = Category::all();
        return view('backend.pages.items.create', compact('items','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('item-particular.create')) {
            abort(403, 'Unauthorized Access');
        }
        $request->validate([
            'category_id'        => 'required|max:50',
            'items_name'       => 'required',

        ]);

        // Users Create
        $item = new Item();
        $item->category_id      = $request->category_id;
        $item->items_name       = $request->items_name;
        $item->save();

        Session::flash('message', 'Item Created Successfully');
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        return view('backend.pages.clients.show', ['client' => Client::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('item-particular.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $items = Item::find($id);
        $categories = Category::all();
        return view('backend.pages.items.edit', compact(['items','categories']));
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
        if(is_null($this->user) || !$this->user->can('item-particular.edit')) {
            abort(403, 'Unauthorized Access');
        }
        $item = Item::find($id);
        $request->validate([
            'category_id'        => 'required|max:50',
            'items_name'       => 'required',

        ]);

        // Users Create

        $item->category_id      = $request->category_id;
        $item->items_name       = $request->items_name;
        $item->save();

        Session::flash('message', 'Item Updated Successfully');
        return redirect()->route('items.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('item-particular.delete')) {
            abort(403, 'Unauthorized Access');
        }

        $item = Item::find($id);
        if(!is_null($item)) {
            $item->delete();
        }
        Session::flash('message', 'Items Deleted Successfully');
        return redirect('admin/items');
    }
    public function exportIntoEXCEL(){
        return Excel::download(new ItemExport(), 'item_particular.xlsx');
    }
    public function exportIntoCSV(){
        return Excel::download(new ItemExport(), 'item_particular.csv');
    }
    public function createPDF() {
        $items = Item::all();
        $pdf = PDF::loadView('backend.pages.items.pdf', compact('items'));
        // download PDF file with download method
        return $pdf->download('item.pdf');
    }
}
