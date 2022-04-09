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

    protected function index()
    {
        return view('transfer.index');
    }
    protected function showTransferBill(Request $request)
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
                    $dat = TransferItem::where('transfer_id', $data->transfer_id)->sum('quantity');
                    return $dat;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('show-transfer-details', $data->transfer_id)  . '" ><i class="zmdi zmdi-eye btn btn-info btn-circle"></i></a>';
                })
                ->rawColumns(['source_stock'])
                ->rawColumns(['destination_stock'])
                ->rawColumns(['total_carton'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
    }
    protected function create()
    {
        $data['src_stock'] = Stock::all();
        return view('transfer.create', $data);
    }
    protected function showDestStock($id)
    {
        $dest_stock = Stock::where('stock_id', '!=', $id)->get();
        $data = '<option value="" selected disabled>Select Destination stock</option>';
        foreach ($dest_stock as $stk) {
            $data .= '<option value="' . $stk->stock_id . '">' . $stk->stock_name . '</option>';
        }
        return $data;
    }
    protected function showStockItems($id)
    {
        $data['items'] = StockItem::where('stock_id', $id)->where('quantity', '!=', 0)->get();
        return view('transfer.show-stock-items', $data);
    }
    protected function store(Request $request)
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
        }
    }

    protected function show($id)
    {
        $data['transfer'] = transfer::findOrFail($id);
        return view('transfer.show-transfer-details', $data);
    }

    protected function update(Request $request, $id)
    {
        //
    }
}
