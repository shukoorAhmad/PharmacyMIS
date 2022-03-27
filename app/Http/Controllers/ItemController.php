<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Measure_unit;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index()
    {
        $data['supplier'] = Supplier::all();
        return view('item.create', $data);
    }
    public function showItemField()
    {
        $measure = Measure_unit::all();
        $data = "<div class='col-md-12 show_items' style='padding:0 !important;'><div class='row'>";
        $data .= "<div class='col-md-4'><label>Item Name</label><input name='item_name[]' class='form-control' required></div>";
        $data .= "<div class='col-md-3'><label>Measure</label><select class='form-control' name='measure_id[]' required><option selected disabled>Select Measure Unit</option>";
        foreach ($measure as $m) {
            $data .= "<option value='" . $m->measure_unit_id . "'>" . $m->unit . "</option>";
        }
        $data .= "</select></div>";
        $data .= "<div class='col-md-3'><label>Quantity Per Carton</label><input name='qty_per_carton[]' required class='form-control'></div>";
        $data .= "<div class='col-md-2'><a class='btn btn-danger w-100 close_btn' style='padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;'><i class='zmdi zmdi-close text-white'></i></a></div>";
        $data .= "</div></div>";
        return $data;
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $counter = $request->item_name;
        foreach ($counter as $count) {
            dd($count);
        }
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
        //
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
        //
    }
}
