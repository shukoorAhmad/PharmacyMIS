<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class StockController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Stock::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->stock_id . "' data-name='" . $data->stock_name . "' data-address='" . $data->stock_address . "' data-incharge='" . $data->incharge . "' data-cno='" . $data->contact_no . "' ><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('stock.index');
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stock_name' => 'required',
            'stock_address' => 'required'
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        if ($request->id == '0') {
            $store = new Stock();
            $store->stock_name = $request->stock_name;
            $store->stock_address = $request->stock_address;
            $store->incharge = $request->incharge;
            $store->contact_no = $request->contact_no;
            $store->save();
        } else {
            $store = Stock::findOrFail($request->id);
            $store->stock_name = $request->stock_name;
            $store->stock_address = $request->stock_address;
            $store->incharge = $request->incharge;
            $store->contact_no = $request->contact_no;
            $store->save();
        }
        return true;
    }
}
