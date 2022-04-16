<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\Seller;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class SaleController extends Controller
{
    protected function index()
    {
        return view('sale.index');
    }

    protected function create()
    {
        $data['items'] = StockItem::where('quantity', '!=', 0)->orderBy('stock_item_id', 'DESC')->limit(10)->get();
        return view('sale.create', $data);
    }
    protected function showCustomer($id)
    {
        if ($id == 1) {
            $customer = Customer::all();
            $data = "<option value=''>Select Customer</option>";
            foreach ($customer as $c) {
                $data .= "<option value='" . $c->customer_id . "'>" . $c->pharmacy_name . ' | ' . $c->customer_name . "</option>";
            }
        } else if ($id == 2) {
            $seller = Seller::all();
            $data = "<option value=''>Select Seller</option>";
            foreach ($seller as $s) {
                $data .= "<option value='" . $s->seller_id . "'>" . $s->seller_name . ' | ' . $s->seller_last_name . "</option>";
            }
        }
        return $data;
    }
    protected function filterItems(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = StockItem::where('quantity', '!=', 0)->orderBy('stock_item_id', 'DESC')->limit(10)->get();
            $response = array();
            foreach ($data as $item) {
                $response[] = array(
                    'id' => $item->stock_item_id,
                    'text' => 'Item Name : ' . $item->item_details->item_name . ' ' . $item->item_details->dose . ' ' . $item->item_details->measure_details->unit . ' Quantity (Carton): ' .  $item->quantity . ' Stock ' . $item->stock_details->stock_name
                );
            }
        } else {
            $data = DB::table('stock_items')
                ->join('items', 'stock_items.item_id', '=', 'items.item_id')
                ->join('stocks', 'stocks.stock_id', '=', 'stock_items.stock_id')
                ->join('measure_units', 'items.measure_unit_id', '=', 'measure_units.measure_unit_id')
                ->select(
                    'stock_items.stock_item_id',
                    'items.item_name',
                    'items.dose',
                    'measure_units.unit',
                    'stock_items.quantity',
                    'stocks.stock_name'
                )
                ->where('items.item_name', 'like', '%' . $search . '%')
                ->get();
            $response = array();
            foreach ($data as $item) {
                $response[] = array(
                    'id' => $item->stock_item_id,
                    'text' => 'Item Name : ' . $item->item_name . ' ' . $item->dose . ' ' . $item->unit . ' Quantity (Carton): ' .  $item->quantity . ' Stock ' . $item->stock_name
                );
            }
        }

        return response()->json($response);
    }
    protected function showSelectedItem($stock_item_id, $i)
    {
        $seesion = Session::get('i');
        $i = 1 + $seesion;
        Session::put('i', $i);
        $query = StockItem::findOrFail($stock_item_id);
        $data = "<div class='row field'>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Item Name:</label>";
        $data .= "<input class='form-control' readonly value='" . $query->item_details->item_name . ' ' . $query->item_details->dose . ' ' . $query->item_details->measure_details->unit . "'>";
        $data .= "<input type='hidden' value='" . $query->item_id . "' name='item_id[]'>";
        $data .= "<input type='hidden' value='" . $query->stock_item_id . "' name='stock_item_id[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-6'>";
        $data .= "<div class='row'>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Available pcs:</label>";
        $data .= "<input class='form-control' readonly  id='qty_" . $i . "' value='" . $query->quantity . "'>";
        $data .= "<input type='hidden' value='" . $query->item_details->item_name . "' name='quantity[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Sale Amount (Per):</label>";
        $data .= "<input type='number' max='" . $query->quantity . "' id='sale-amount" . $i . "' sp-id='" . $i . "' class='form-control sale-amount' value='1' name='sale_amount[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Sale Price:</label>";
        $data .= "<input type='number' step='any' class='form-control sale-price' id='sale-price" . $i . "'  value='" .  $query->sale_price . "' name='sale_price[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Discount:</label>";
        $data .= "<input type='number' class='form-control' value='0' name='discount[]'>";
        $data .= "</div>";
        $data .= "</div>";
        $data .= "</div>";
        $data .= "<div classs='col-md-2'>";
        $data .= "<label>Total:</label>";
        $data .= "<input class='form-control' id='total-value" . $i . "' sp-id='" . $i . "' value='" . number_format($query->sale_price, 1) . "' readonly id='total'>";
        $data .= "</div>";
        $data .= "<div class='col-md-1'>";
        $data .= "<a class='btn btn-danger mt-4 remove' style='padding: 7px 1.75rem !important;margin-top:30px !important;font-size:14px !important;'><span class='fa fa-trash-o text-white'></span></a>";
        $data .= "</div>";
        $data .= "</div>";
        return $data;
    }

    protected function store(Request $request)
    {
        $request->validate([
            'sale_type' => 'required',
            'customer_id' => 'required',
        ]);
        $sale = new Sales();
        $sale->sale_type = $request->sale_type;
        $sale->customer_id = $request->customer_id;
        if ($sale->save()) {
            foreach ($request->quantity as $key => $value) {
                $sale_item = new SalesItem();
                $sale_item->item_id = $request->item_id[$key];
                $sale_item->quantity = $request->sale_amount[$key];
                $sale_item->sale_price = $request->sale_price[$key];
                $sale_item->discount = $request->discount[$key];
                $sale_item->sale_id = $sale->sale_id;
                $sale_item->save();
                $update_items = StockItem::findOrFail($request->stock_item_id[$key]);
                $update_items->quantity = $update_items->quantity - $request->sale_amount[$key];
                $update_items->save();
            }
        }
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
