<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockItem;
use App\Models\Transfer;
use App\Models\TransferItem;
use Illuminate\Http\Request;
use DataTables;

class TransferController extends Controller
{

    public function index()
    {
        return view('transfer.index');
    }
    public function showTransferBill(Request $request)
    {
        if ($request->ajax()) {
            $data = Transfer::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('source_stock', function ($data) {
                    return $data->src_stock_details->stock_name;
                })
                ->addColumn('destination_stock', function ($data) {
                    return $data->dest_stock_details->stock_name;
                })
                ->addColumn('total_carton', function ($data) {
                    $dat = StockItem::where('transfer_id', $data->transfer_id)->sum('quantity');
                    return $dat;
                })
                ->addColumn('action', function ($data) {
                    return '<a data-id="' . $data->customer_id . '" class="edit"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i></a>';
                })
                ->rawColumns(['source_stock'])
                ->rawColumns(['destination_stock'])
                ->rawColumns(['total_carton'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
    }
    public function create()
    {
        $data['src_stock'] = Stock::all();
        return view('transfer.create', $data);
    }
    public function showDestStock($id)
    {
        $dest_stock = Stock::where('stock_id', '!=', $id)->get();
        $data = '<option value="" selected disabled>Select Destination stock</option>';
        foreach ($dest_stock as $stk) {
            $data .= '<option value="' . $stk->stock_id . '">' . $stk->stock_name . '</option>';
        }
        return $data;
    }
    public function showStockItems($id)
    {
        $data['items'] = StockItem::where('stock_id', $id)->where('quantity', '!=', 0)->get();
        return view('transfer.show-stock-items', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'source_stock_id' => 'required',
            'destination_stock_id' => 'required',
            'transfer_date' => 'required'
        ]);
        $transfer = new Transfer;
        $transfer->source_stock_id = $request->source_stock_id;
        $transfer->destination_stock_id = $request->destination_stock_id;
        $transfer->transfer_date = $request->transfer_date;
        $transfer->comment = $request->comment;
        
        if ($transfer->save()) {
            foreach ($request->item_id as $key => $value) {
                if ($request->transfer_qty[$key] != 0) {
                    $trans_itms = new TransferItem();
                    $trans_itms->item_id = $request->item_id[$key];
                    $trans_itms->quantity = $request->transfer_qty[$key];
                    $trans_itms->transfer_id = $transfer->transfer_id;
                    $trans_itms->save();
                }
            }
        } else {
            echo "not saved";
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
