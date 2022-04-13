<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Seller;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class SaleController extends Controller
{
    protected function index()
    {
        return view('sale.index');
    }

    protected function create()
    {
<<<<<<< HEAD
        $data['items'] = StockItem::where('quantity', '!=', 0)->orderBy('stock_item_id', 'DESC')->limit(10)->get();
=======
        $data['items'] = StockItem::with('item_details')->where('quantity', '!=', 0)->get();
        
>>>>>>> bd4ccdfcebef50383511ba2f49450df58f4becb9
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
    protected function showSelectedItem($stock_item_id)
    {
        $query = StockItem::findOrFail($stock_item_id);
        $data = "<div class='row field'>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Item Name:</label>";
        $data .= "<input class='form-control' readonly value='" . $query->item_details->item_name . ' ' . $query->item_details->dose . ' ' . $query->item_details->measure_details->unit . "'>";
        $data .= "</div>";
        $data .= "<div class='col-md-2 form-group'>";
        $data .= "<label>Available (Carton):</label>";
        $data .= "<input class='form-control' readonly value='" . $query->quantity . "'>";
        $data .= "</div>";
        $data .= "<div class='col-md-2 form-group'>";
        $data .= "<label>Sale Price:</label>";
        $data .= "<input class='form-control' value='" . $query->sale_price . "'>";
        $data .= "</div>";
        $data .= "<div class='col-md-2 form-group'>";
        $data .= "<label>Sale Amount (Per):</label>";
        $data .= "<input class='form-control' value='1'>";
        $data .= "</div>";
        $data .= "<div class='col-md-2 form-group'>";
        $data .= "<label>Discount:</label>";
        $data .= "<input type='number' class='form-control' value='0'>";
        $data .= "</div>";
        $data .= "<div class='col-md-1'>";
        $data .= "<a class='btn btn-danger mt-4 remove' style='padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;'><span class='fa fa-trash-o text-white'></span></a>";
        $data .= "</div>";
        $data .= "</div>";
        return $data;
    }

    protected function store(Request $request)
    {
        //
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
