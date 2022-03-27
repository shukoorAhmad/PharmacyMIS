<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Measure_unit;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    protected function index()
    {
        $data['supplier'] = Supplier::all();
        return view('item.create', $data);
    }

    protected function showItemField()
    {
        $measure = Measure_unit::all();
        $data = "<div class='col-md-12 show_items' style='padding:0 !important;'><div class='row'>";
        $data .= "<div class='col-md-4'><label>Item Name</label><input name='item_name[]' class='form-control' required></div>";
        $data .= "<div class='col-md-3'><label>Measure</label><select class='form-control select2' name='measure_id[]' required><option selected disabled>Select Measure Unit</option>";
        foreach ($measure as $m) {
            $data .= "<option value='" . $m->measure_unit_id . "'>" . $m->unit . "</option>";
        }
        $data .= "</select></div>";
        $data .= "<div class='col-md-3'><label>Quantity Per Carton</label><input name='qty_per_carton[]' required class='form-control'></div>";
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, $id)
    {
        //
    }
}
