<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemType;
use App\Models\Measure_unit;
use App\Models\MeasureUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class ItemController extends Controller
{
    protected function index(Request $request)
    {
        $value['type'] = ItemType::all();
        $value['measure'] = Measure_unit::all();
        if ($request->ajax()) {
            $data = Item::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('it_name', function ($data) {
                    return $data->item_name . ' ' . $data->item_unit . ' ' . $data->item_type_details->type;
                })
                ->addColumn('measure_name', function ($data) {
                    return $data->measure_details->unit;
                })
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->item_id . "' data-name='" . $data->item_name . "' data-type='" . $data->item_type . "' data-unit='" . $data->item_unit . "' data-measure='" . $data->measure_unit_id . "' data-qty='" . $data->quantity_per_carton . "' data-purchase='" . $data->purchase_price . "' data-sale='" . $data->sale_price . "' ><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['it_name'])
                ->rawColumns(['measure_name'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('item.index', $value);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_name' => 'required',
            'item_type' => 'required',
            'measure_unit_id' => 'required',
            'quantity_per_carton' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        if ($request->id == '0') {
            $store = new Item();
            $store->item_name =  $request->item_name;
            $store->item_unit =  $request->item_unit;
            $store->item_type =  $request->item_type;
            $store->measure_unit_id = $request->measure_unit_id;
            $store->quantity_per_carton = $request->quantity_per_carton;
            $store->purchase_price = $request->purchase_price;
            $store->sale_price = $request->sale_price;
            $store->save();
        } else {
            $store = Item::findOrFail($request->id);
            $store->item_name =  $request->item_name;
            $store->item_unit =  $request->item_unit;
            $store->item_type =  $request->item_type;
            $store->measure_unit_id = $request->measure_unit_id;
            $store->quantity_per_carton = $request->quantity_per_carton;
            $store->purchase_price = $request->purchase_price;
            $store->sale_price = $request->sale_price;
            $store->save();
        }
        return true;
    }
}
