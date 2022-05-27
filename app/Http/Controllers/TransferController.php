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

    public function checkArray($data)
    {
        foreach ($data as $key => $value) {
            if ($value != 0) {
                return true;
            }
        }
        return false;
    }

    protected function store(Request $request)
    {
        $request->validate([
            'source_stock_id' => 'required',
            'destination_stock_id' => 'required',
            'transfer_date' => 'required'
        ]);
        if ($this->checkArray($request->transfer_qty)) {
            $transfer = new Transfer();
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
                        $src_stock = StockItem::findOrFail($request->stock_item_id[$key]);
                        $src_stock->quantity = $src_stock->quantity - $request->transfer_qty[$key];
                        $src_stock->save();
                        $old = StockItem::where(['item_id' => $request->item_id[$key], 'stock_id' => $request->destination_stock_id])->first();
                        if ($old != "") {
                            $update_items = StockItem::findOrFail($old->stock_item_id);
                            $update_items->quantity = $old->quantity + $request->transfer_qty[$key];
                            $update_items->purchase_price = $request->purchase_price[$key];
                            $update_items->sale_price = $request->sale_price[$key];
                            $update_items->save();
                        } else {
                            $stock_items = new StockItem();
                            $stock_items->item_id = $request->item_id[$key];
                            $stock_items->quantity = $request->transfer_qty[$key];
                            $stock_items->purchase_price = $request->purchase_price[$key];
                            $stock_items->sale_price = $request->sale_price[$key];
                            $stock_items->expiry_date = $request->expiry_date[$key];
                            $stock_items->purchase_id = $request->purchase_id[$key];
                            $stock_items->stock_id = $request->destination_stock_id;
                            $stock_items->save();
                        }
                    }
                }
                if (Session::get('locale') == 'en')
                    $msg = 'Items Successfully Transfered';
                if (Session::get('locale') == 'fa')
                    $msg = 'اجناس موفقانه انتقال یافت';
                if (Session::get('locale') == 'ps')
                    $msg = 'Money Successfully Transfered To Cash';
                return redirect()->route('show-transfer-bill', $transfer->transfer_id)->with('success_transfer', $msg);
            }
        } else {
            if (Session::get('locale') == 'en')
                $msg = 'Please Specify Amount Transfer';
            if (Session::get('locale') == 'fa')
                $msg = 'لطفا مقدار انتقال را بنوسید';
            if (Session::get('locale') == 'ps')
                $msg = 'Money Successfully Transfered To Cash';
            return redirect()->back()->with('error_message', $msg);
        }
    }

    protected function show($id)
    {
        $data['transfer'] = transfer::findOrFail($id);
        return view('transfer.show-transfer-details', $data);
    }
    protected function showBill($id)
    {
        $data['transfer'] = transfer::findOrFail($id);
        return view('transfer.show-transfer-bill', $data);
    }

    protected function update(Request $request, $id)
    {
        //
    }
}
