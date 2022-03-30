<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Measure_unit;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables;

class ItemController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Item::with('measure_details', 'supplier_details')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('measure_name', function ($data) {
                    return $data->measure_details->unit;
                })
                ->addColumn('supplier_name', function ($data) {
                    return $data->supplier_details->name;
                })
                ->addColumn('action', function ($data) {
                    return '<a data-id="' . $data->item_id . '" class="edit"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i></a>';
                })
                ->rawColumns(['measure_name'])
                ->rawColumns(['supplier_name'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('item.index');
    }

    protected function create()
    {
        $data['supplier'] = Supplier::all();
        return view('item.create', $data);
    }

    protected function showItemField()
    {
        $measure = Measure_unit::all();
        $data = "<div class='col-md-12 show_items' style='padding:0 !important;'><div class='row'>";
        $data .= "<div class='col-md-4'><label>Item Name</label><input name='item_name[]' class='form-control' required></div>";
        $data .= "<div class='col-md-2'><label>Measure</label><select class='form-control select2' name='measure_id[]' required><option selected disabled>Select Measure Unit</option>";
        foreach ($measure as $m) {
            $data .= "<option value='" . $m->measure_unit_id . "'>" . $m->unit . "</option>";
        }
        $data .= "</select></div>";
        $data .= "<div class='col-md-2'><label>Dose</label><input name='dose[]' required class='form-control'></div>";
        $data .= "<div class='col-md-2'><label>Quantity Per Carton</label><input name='qty_per_carton[]' required class='form-control'></div>";
        $data .= "<div class='col-md-2'><a class='btn btn-danger w-100 close_btn' style='padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;'><i class='zmdi zmdi-close text-white'></i></a></div>";
        $data .= "</div></div>";
        return $data;
    }

    protected function store(Request $request)
    {
        foreach ($request->qty_per_carton as $key => $x) {
            $store = new Item();
            $store->item_name =  $request->item_name[$key];
            $store->measure_unit_id = $request->measure_id[$key];
            $store->dose = $request->dose[$key];
            $store->quantity_per_carton = $request->qty_per_carton[$key];
            $store->supplier_id = $request->supplier;
            $store->save();
        }
        return redirect()->back()->with('success_insert', 'Items Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function edit($id)
    {
        $data['measure_units'] = Measure_unit::all();
        $data['supplier'] = Supplier::all();
        $data['item'] = Item::findOrfail($id);

        return view('item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request)
    {
        $update = Item::findOrFail($request->id);
        $update->item_name =  $request->item_name;
        $update->measure_unit_id = $request->measure_id;
        $update->dose = $request->dose;
        $update->quantity_per_carton = $request->qty_per_carton;
        $update->supplier_id = $request->supplier;
        $update->save();
        return redirect()->back()->with('success_update', 'Item Successfully Updated');
    }
}
