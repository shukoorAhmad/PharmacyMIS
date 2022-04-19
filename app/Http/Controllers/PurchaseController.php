<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\Item;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\PurchaseItem;
use App\Models\StockItem;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Illuminate\Http\Request;
use DataTables;
use Session;

class PurchaseController extends Controller
{

    protected function purchaseItems($id)
    {
        $data['order'] = Order::findOrFail($id);
        $data['stock'] = Stock::all();
        $data['currencies'] = Currency::all();
        $data['ex_rate'] = ExchangeRate::first();
        return view('purchase.purchase-items', $data);
    }
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Purchase::orderBy('order_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('stock_name', function ($data) {
                    return $data->stock_details->stock_name;
                })
                ->addColumn('supplier_name', function ($data) {
                    return $data->supplier_details->name;
                })
                ->addColumn('total_carton', function ($data) {
                    $qty = PurchaseItem::where('purchase_id', $data->order_id)->get();
                    $sum = null;
                    foreach ($qty as $quantity) {
                        $sum += $quantity->quantity / $quantity->items_details->quantity_per_carton;
                    }
                    $qty = PurchaseItem::where('purchase_id', $data->purchase_id)->sum('quantity');
                    return number_format($sum, 2) . ' Carton(s) | ' . $qty . ' pcs';
                })
                ->addColumn('order_no', function ($data) {
                    return $data->order_id == 0 ? '<span class="badge badge-success pr-4 pl-4">Direct Purchase</span>' : '<span class="badge bg-teal"><a class="text-white" href="' . route('view-order-details', $data->order_id) . '">View Order Bill No - ' . $data->order_id . '</span></a>';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('view-purchase-details', $data->purchase_id) . '" class="mr-2"><i class="fa fa-eye btn btn-warning btn-circle"></i></a>';
                    return $btn;
                })
                ->rawColumns(['supplier_name'])
                ->rawColumns(['stock_name'])
                ->rawColumns(['total_carton'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('purchase.index');
    }

    protected function create()
    {
        $data['stock'] = Stock::all();
        $data['supplier'] = Supplier::all();
        $data['currencies'] = Currency::all();
        $data['ex_rate'] = ExchangeRate::first();
        $data['items'] = Item::orderBy('item_id', 'DESC')->limit(10)->get();
        return view('purchase.create', $data);
    }
    protected function filter_items(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Item::orderBy('item_id', 'DESC')->limit(10)->get();
        } else {
            $data = Item::where('item_name', 'LIKE', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $item) {
            $response[] = array(
                'id' => $item->item_id,
                'text' => $item->item_name . ' ' . $item->item_unit . ' ' . $item->item_type_details->type
            );
        }
        return response()->json($response);
    }

    protected function add_new_item($item_id, $i)
    {
        $seesion = Session::get('i');
        $i = 1 + $seesion;
        Session::put('i', $i);
        $item = Item::findOrFail($item_id);
        $data = "<div class='row show_items'>";
        $data .= "<div class='form-group col-md-3'>";
        $data .= "<label>Item Name:</label>";
        $data .= "<input class='form-control' value='" . $item->item_name . " " . $item->item_unit . " " . $item->item_type_details->type . "' readonly>";
        $data .= "</div>";
        $data .= "<div class='form-group col-md-2'>";
        $data .= "<label>Purchase Price:</label>";
        $data .= "<input class='form-control' id='pur-price-" . $i . "' price='" . $item->purchase_price . "' value='" . $item->purchase_price . "' name='sale_price[]'>";
        $data .= "</div>";
        $data .= "<div class='form-group col-md-2'>";
        $data .= "<label>Sale Price:</label>";
        $data .= "<input class='form-control' value='" . $item->sale_price . "' name='purchase_price[]'>";
        $data .= "<input type='hidden' class='form-control total-every-row' id='total-row-" . $i . "'>";
        $data .= "</div>";
        $data .= "<div class='form-group col-md-2'>";
        $data .= "<label>Quantity:</label>";
        $data .= "<input class='form-control quantity' id='quantity-" . $i . "' value='0' i-value='" . $i . "' name='quantity[]'>";
        $data .= "</div>";
        $data .= "<div class='form-group col-md-2'>";
        $data .= "<label>Expiry Date:</label>";
        $data .= "<input type='date' class='form-control' name='expiry_date[]'>";
        $data .= "</div>";
        $data .= "<div class='form-group col-md-1'>";
        $data .= '<a class="btn btn-danger w-100 close_btn" id="' . $i . '" style="padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;"><i class="zmdi zmdi-close text-white"></i></a>';
        $data .= "</div>";
        $data .= "</div>";
        return $data;
    }

    protected function store(Request $request)
    {
        // to update exchange rate
        $ex_rate = ExchangeRate::findOrFail($request->exchange_rate_id);
        $ex_rate->usd_afg = $request->usd_afg;
        $ex_rate->usd_kal = $request->usd_kal;
        $ex_rate->save();
        // to store purchase
        $purchase = new Purchase();
        $purchase->purchase_invoice_no = $request->purchase_invoice_no;
        $request->order_id != "" ? $purchase->order_id = $request->order_id : '';
        $purchase->stock_id = $request->stock_id;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_date = $request->purchase_date;
        // to store purchase item in purchase_item and stock_item table
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
            // to add purchase bill price in supplier account
            $supplier_account = new SupplierAccount();
            $supplier_account->supplier_id = $request->supplier_id;
            $supplier_account->bill_id = $purchase->purchase_id;
            $supplier_account->purchase_currency_id = $request->purchase_currency;
            $supplier_account->money = $request->total;
            // to set paid amount according to currency
            switch ($request->purchase_currency) {
                case 1:
                    $supplier_account->usd = $request->paid_amount;
                    break;
                case 2:
                    $supplier_account->afg = $request->paid_amount;
                    break;
                case 3:
                    $supplier_account->kal = $request->paid_amount;
                    break;
            }
            $supplier_account->usd_afg = $request->usd_afg;
            $supplier_account->usd_kal = $request->usd_kal;
            $supplier_account->in_out = 2;
            $supplier_account->date = $request->purchase_date;
            $supplier_account->save();

            if ($request->order_id != "") {
                $order = Order::findOrFail($request->order_id)->update(['status' => 1]);
                return redirect()->route('purchase-list')->with('success_insert', 'Items Successfully Purchased');
            }
        }
        return redirect()->route('purchase-list')->with('success_insert', 'Items Successfully Purchased');
    }

    protected function show($id)
    {
        $data['purchase'] = Purchase::findOrFail($id);
        return view('purchase.view-purchase-items', $data);
    }
}
