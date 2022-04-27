<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\ExchangeRate;
use App\Models\Sales;
use App\Models\SalesItem;
use App\Models\Seller;
use App\Models\SellerAccount;
use App\Models\StockItem;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use DataTables;

class SaleController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales::orderBy('sale_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($data) {
                    if ($data->sale_type == 1) {
                        $val = $data->customer_details->phamarcy_name . ' ' . $data->customer_details->customer_name;
                    } elseif ($data->sale_type == 2) {
                        $val = $data->seller_details->seller_name . ' ' . $data->seller_details->seller_last_name;
                    }
                    return $val;
                })
                ->addColumn('customer_type', function ($data) {
                    return $data->sale_type == 1 ? '<span class="badge badge-success pr-4 pl-4">Customer</span>' : '<span class="badge bg-teal pr-4 pl-4">Seller</span>';
                })
                ->addColumn('total_carton', function ($data) {
                    $qty = SalesItem::where('sale_id', $data->sale_id)->get();
                    $sum = null;
                    foreach ($qty as $quantity) {
                        $sum += $quantity->quantity / $quantity->items_details->quantity_per_carton;
                    }
                    $qty = SalesItem::where('sale_id', $data->sale_id)->sum('quantity');
                    return $sum >= 1 ? number_format($sum, 2) . ' Carton(s) | ' . $qty . ' pcs' : $qty . ' pcs';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('show-sale-bill', $data->sale_id) . '" class="mr-2"><i class="fa fa-eye btn btn-warning btn-circle"></i></a>';
                    $btn .= '<a style="cursor:pointer;" title="Return Sale" class="mr-2 return_sale" data-id="' . $data->sale_id . '"><i class="fa fa-undo btn btn-danger btn-circle"></i></a>';
                    return $btn;
                })
                ->rawColumns(['customer_name'])
                ->rawColumns(['customer_type'])
                ->rawColumns(['total_carton'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('sale.index');
    }

    protected function create()
    {
        return view('sale.create');
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
                    'text' => $item->item_details->item_name . ' ' . $item->item_details->item_unit . ' ' . $item->item_details->item_type_details->type  . ' Quantity: ' .  $item->quantity . ' ' . $item->item_details->measure_details->unit . ' Stock: ' . $item->stock_details->stock_name
                );
            }
        } else {
            $data = DB::table('stock_items')
                ->join('items', 'stock_items.item_id', '=', 'items.item_id')
                ->join('stocks', 'stocks.stock_id', '=', 'stock_items.stock_id')
                ->join('measure_units', 'items.measure_unit_id', '=', 'measure_units.measure_unit_id')
                ->join('item_types', 'items.item_type', '=', 'item_types.id')
                ->select(
                    'stock_items.stock_item_id',
                    'items.item_name',
                    'items.item_unit',
                    'measure_units.unit',
                    'item_types.type',
                    'stock_items.quantity',
                    'stocks.stock_name'
                )
                ->where('items.item_name', 'like', '%' . $search . '%')
                ->get();
            $response = array();
            foreach ($data as $item) {
                $response[] = array(
                    'id' => $item->stock_item_id,
                    'text' => $item->item_name . ' ' . $item->item_unit . ' ' . $item->type . ' Quantity: ' .  $item->quantity . ' ' . $item->unit . ' Stock: ' . $item->stock_name
                );
            }
        }

        return response()->json($response);
    }
    protected function showSelectedItem($stock_item_id, $i)
    {
        $ex_rate = ExchangeRate::first();
        $seesion = Session::get('i');
        $i = 1 + $seesion;
        Session::put('i', $i);
        $query = StockItem::findOrFail($stock_item_id);
        $data = "<div class='row field p-0'>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Item Name:</label>";
        $data .= "<input class='form-control' readonly value='" . $query->item_details->item_name . ' ' . $query->item_details->item_unit . ' ' . $query->item_details->item_type_details->type . "'>";
        $data .= "<input type='hidden' value='" . $query->item_id . "' name='item_id[]'>";
        $data .= "<input type='hidden' value='" . $query->stock_item_id . "' name='stock_item_id[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-6 form-group'>";
        $data .= "<div class='row p-0'>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Available pcs:</label>";
        $data .= "<input class='form-control' readonly  id='qty_" . $i . "' value='" . number_format($query->quantity - 1) . "'>";
        $data .= "<input type='hidden' id='qty_const" . $i . "' value='" . $query->quantity . "'>";
        $data .= "<input type='hidden' value='" . $query->item_details->item_name . "' name='quantity[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Sale Amount:</label>";
        $data .= "<input type='number' max='" . $query->quantity . "' id='sale-amount" . $i . "' sp-id='" . $i . "' class='form-control sale-amount' value='1' min='1' name='sale_amount[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Sale Price:</label>";
        $data .= "<input type='number' step='any' class='form-control sale-price' id='sale-price" . $i . "'  value='" .  $query->sale_price * $ex_rate->usd_afg . "' name='sale_price[]'>";
        $data .= "</div>";
        $data .= "<div class='col-md-3 form-group'>";
        $data .= "<label>Discount:</label>";
        $data .= "<input type='number' class='form-control' value='0' name='discount[]'>";
        $data .= "</div>";
        $data .= "</div>";
        $data .= "</div>";
        $data .= "<div classs='col-md-2 form-group'>";
        $data .= "<label>Total:</label>";
        $data .= "<input class='form-control total-every-row' id='total-value" . $i . "' sp-id='" . $i . "' value='" . $query->sale_price * $ex_rate->usd_afg . "' readonly id='total'>";
        $data .= "</div>";
        $data .= "<div class='col-md-1'>";
        $data .= "<a class='btn btn-danger mt-4 remove' id='" . $i . "' style='padding: 7px 1.75rem !important;margin-top:30px !important;font-size:14px !important;'><span class='fa fa-trash-o text-white'></span></a>";
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
        DB::beginTransaction();
        try {
            $sale = new Sales();
            $sale->sale_type = $request->sale_type;
            $sale->customer_id = $request->customer_id;
            $sale->sale_date = $request->sale_date;
            $sale->save();
            $ex_rate = ExchangeRate::first();
            if ($request->sale_type == 1) {
                $customer = new CustomerAccount();
                $customer->customer_id = $request->customer_id;
                $customer->bill_id = $sale->sale_id;
                $customer->money = $request->total;
                $customer->afg = $request->paid_amount;
                $customer->usd_afg = $ex_rate->usd_afg;
                $customer->usd_kal = $ex_rate->usd_kal;
                $customer->in_out = 2;
                $customer->comment = $request->comment;
                $customer->date = $request->sale_date;
                $customer->save();
            } elseif ($request->sale_type == 2) {
                $customer = new SellerAccount();
                $customer->seller_id = $request->customer_id;
                $customer->bill_id = $sale->sale_id;
                $customer->money = $request->total;
                $customer->afg = $request->paid_amount;
                $customer->usd_afg = $ex_rate->usd_afg;
                $customer->usd_kal = $ex_rate->usd_kal;
                $customer->percentage = $request->percentage;
                $customer->in_out = 2;
                $customer->comment = $request->comment;
                $customer->date = $request->sale_date;
                $customer->save();
            }
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
            DB::commit();
            return redirect()->route('show-sale-bill', $sale->sale_id);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('purchase-list')->with('err_delete', 'Purchase Not Returned');
        }
    }

    protected function show($id)
    {
        $loan = 0;
        $paid = 0;
        $current_paid_bill = 0;
        $data['sale'] = Sales::findOrFail($id);
        if ($data['sale']->sale_type == 1) {
            $ca = CustomerAccount::where('customer_id', $data['sale']->customer_id)->where('bill_id', '!=', $id)->get();
            foreach ($ca as $row) {
                $loan += $row->money;
                if ($row->in_out == 0 || $row->in_out == 2) {
                    $paid += $row->afg;
                    $paid += $row->usd / $row->usd_afg;
                    $paid += $row->kal / 2;
                }
                if ($row->in_out == 1) {
                    $loan += $row->afg;
                    $loan += $row->usd / $row->usd_afg;
                    $loan += $row->kal / 2;
                }
            }
            $current_pay = CustomerAccount::where('bill_id', $id)->first();
            $current_paid_bill += $current_pay->afg;
            $current_paid_bill += $current_pay->usd * $current_pay->usd_afg;
            $current_paid_bill += $current_pay->kal / 2;
            $data['current_paid_bill'] = $current_paid_bill;
        } elseif ($data['sale']->sale_type == 1) {
            $ca = SellerAccount::where('customer_id', $data['sale']->customer_id)->where('bill_id', '!=', $id)->get();
            foreach ($ca as $row) {
                $loan += $row->money;
                if ($row->in_out == 0 || $row->in_out == 2) {
                    $paid += $row->afg;
                    $paid += $row->usd / $row->usd_afg;
                    $paid += $row->kal / 2;
                }
                if ($row->in_out == 1) {
                    $loan += $row->afg;
                    $loan += $row->usd / $row->usd_afg;
                    $loan += $row->kal / 2;
                }
            }
        }
        $data['loan'] = $loan - $paid;
        return view('sale.sale-bill', $data);
    }

    protected function returnSale($id)
    {
        DB::beginTransaction();
        try {
            $sale = Sales::find($id)->first();
            $sale->sale_type == 1 ? CustomerAccount::where('bill_id', $id)->delete() : SellerAccount::where('bill_id', $id)->delete();

            $saleItem = SalesItem::where('sale_id', $id)->get();
            foreach ($saleItem as $value) {
                $stockItem = StockItem::where('item_id', $value->item_id)->first();
                $stockItem->quantity = $stockItem->quantity + $value->quantity;
                $stockItem->save();
            }
            $saleItem = SalesItem::where('sale_id', $id)->delete();
            $sale->delete();
            DB::commit();
            return redirect()->route('sale-list')->with('suc_delete', 'Sale Successfully Returned');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('sale-list')->with('err_delete', 'Sale Not Returned');
        }
    }
}
