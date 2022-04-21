<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::with('supplier_detials')->orderBy('order_id', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('supplier_name', function ($data) {
                    return $data->supplier_detials->name;
                })
                ->addColumn('status_design', function ($data) {
                    $qty = OrderItem::where('order_id', $data->order_id)->get();
                    $sum = null;
                    foreach ($qty as $quantity) {
                        $sum += $quantity->quantity / $quantity->items_details->quantity_per_carton;
                    }
                    $qty = OrderItem::where('order_id', $data->order_id)->sum('quantity');
                    return number_format($sum, 2) . ' Carton(s) | ' . $qty . ' pcs';
                })
                ->addColumn('purchase', function ($data) {
                    return  $data->status == 0 ? '<a href="' . route('purchase-order', $data->order_id) . '" class="edit btn btn-outline-info btn-sm"> <i class="zmdi zmdi-shopping-cart"></i> Purchase</a>'
                        : '<i class="zmdi zmdi-badge-check text-success" style="font-size:1.4rem !important;"></i>';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('view-order-details', $data->order_id) . '" class="mr-2"><i class="fa fa-eye btn btn-warning btn-circle"></i></a>';
                    if ($data->status == 0) {
                        $btn .= '<a href="' . route('edit-order-details', $data->order_id) . '"><i class="fa fa-edit btn btn-success btn-circle"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['supplier_name'])
                ->rawColumns(['status_design'])
                ->escapeColumns([])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('order.index');
    }

    protected function create()
    {
        $data['supplier'] = Supplier::all();

        return view('order.create', $data);
    }

    protected function addNewItem()
    {
        $data['items'] = Item::all();
        return view('order.item_feild', $data);
    }

    protected function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $order_store = new Order();
            $order_store->supplier_id = $request->supplier;
            $order_store->order_date = $request->order_date;
            foreach ($request->quantity as $key => $value) {
                $order_item_store = new OrderItem();
                $order_item_store->order_id = $order_store->order_id;
                $order_item_store->item_id = $request->item[$key];
                $order_item_store->quantity = $value;
                $order_item_store->save();
            }
            return redirect()->route('order-list')->with('success_insert', 'Order Successfully Added');
            DB::commit();
        } catch (Exception $e) {
            return redirect()->route('order-list')->with('success_insert', 'Order Not Added');
            DB::rollBack();
        }
    }

    protected function view($id)
    {
        $data['order'] = Order::findOrFail($id);
        return view('order.view-order-details', $data);
    }

    protected function edit($id)
    {
        $data['order'] = Order::with('order_items')->findOrFail($id);
        $data['items'] = Item::all();
        $data['supplier'] = Supplier::findOrFail($data['order']->supplier_id);

        return view('order.edit', $data);
    }

    protected function update(Request $request)
    {
        foreach ($request->order_item_id as $key => $value) {
            $order_item_update = OrderItem::findOrFail($value);
            $order_item_update->item_id = $request->old_item[$key];
            $order_item_update->quantity = $request->old_quantity[$key];
            $order_item_update->save();
        }

        if ($request->quantity != '') {
            foreach ($request->quantity as $key => $value) {
                $order_item_store = new OrderItem();
                $order_item_store->order_id = $request->order_id;
                $order_item_store->item_id = $request->item[$key];
                $order_item_store->quantity = $value;
                $order_item_store->save();
            }
        }

        return redirect()->route('order-list')->with('success_update', 'Order Successfully Updated');
    }

    protected function deleteOrderItem($id)
    {
        $delete = OrderItem::findOrFail($id)->delete();
        return redirect()->back()->with('success_update', 'Order Item Successfully Deleted');
    }
}
