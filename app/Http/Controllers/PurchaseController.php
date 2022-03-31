<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\PurchaseItem;
use App\Models\StockItem;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    protected function purchaseItems($id)
    {
        $data['order'] = Order::findOrFail($id);
        $data['stock'] = Stock::all();
        return view('purchase.purchase-items', $data);
    }
    protected function index()
    {
        //
    }

    protected function create()
    {
        //
    }

    protected function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->purchase_invoice_no = $request->purchase_invoice_no;
        $purchase->order_id = $request->order_id;
        $purchase->stock_id = $request->stock_id;
        $purchase->purchase_date = $request->purchase_date;
        if ($purchase->save()) {
            foreach ($request->item_id as $key => $value) {
                $purchase_item = new PurchaseItem();
                $purchase_item->purchase_id = $purchase->purchase_id;
                $purchase_item->item_id = $request->item_id[$key];
                $purchase_item->quantity = $request->quantity[$key];
                $purchase_item->purchase_price = $request->purchase_price[$key];
                $purchase_item->expiry_date = $request->expiry_date[$key];
                $purchase_item->save();
            }
            foreach ($request->item_id as $key => $value) {
                $old = StockItem::where(['item_id' => $request->item_id[$key], 'expiry_date' => $request->expiry_date[$key], 'stock_id' => $request->stock_id])->first();
                if ($old != "") {
                    $update_items = StockItem::findOrFail($old->stock_item_id);
                    $update_items->quantity = $old->quantity + $request->quantity[$key];
                    $update_items->purchase_price = $request->purchase_price[$key];
                    $update_items->sale_price = $request->sale_price[$key];
                    $update_items->save();
                } else {
                    $stock_items = new StockItem();
                    $stock_items->item_id = $request->item_id[$key];
                    $stock_items->quantity = $request->quantity[$key];
                    $stock_items->purchase_price = $request->purchase_price[$key];
                    $stock_items->sale_price = $request->sale_price[$key];
                    $stock_items->expiry_date = $request->expiry_date[$key];
                    $stock_items->stock_id = $request->stock_id;
                    $stock_items->save();
                }
            }
            $order = Order::findOrFail($request->order_id)->update(['status' => 1]);
        }
        return redirect()->route('order-list')->with('success_insert', 'Items Successfully Purchased');
    }

    protected function show($id)
    {
        //
    }

    protected function edit($id)
    {
        //
    }

    protected function update(Request $request, $id)
    {
        //
    }

    protected function destroy($id)
    {
        //
    }
}
