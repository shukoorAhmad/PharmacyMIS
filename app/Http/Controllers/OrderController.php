<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DataTables;

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
                    return  OrderItem::where('order_id', $data->order_id)->sum('quantity');
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="' . route('view-order-details', $data->order_id) . '" class="mr-2"><i class="fa fa-eye btn btn-warning btn-circle"></i></a>';
                    $btn .= '<a href="' . route('edit-order-details', $data->order_id) . '"><i class="fa fa-edit btn btn-success btn-circle"></i></a>';
                    return $btn;
                })
                ->rawColumns(['supplier_name'])
                ->rawColumns(['status_design'])
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

    protected function addNewItem($id)
    {
        $data['items'] = Item::where('supplier_id', $id)->get();
        return view('order.item_feild', $data);
    }

    protected function store(Request $request)
    {
        $order_store = new Order();
        $order_store->supplier_id = $request->supplier;
        $order_store->order_date = Carbon::parse($request->order_date)->format('Y-m-d');

        if ($order_store->save()) {
            foreach ($request->quantity as $key => $value) {
                $order_item_store = new OrderItem();
                $order_item_store->order_id = $order_store->order_id;
                $order_item_store->item_id = $request->item[$key];
                $order_item_store->quantity = $value;
                $order_item_store->save();
            }
        }

        return redirect()->back()->with('success_insert', 'Order Successfully Added');
    }

    protected function view($id)
    {
        $data['order'] = Order::findOrFail($id);
        return view('order.view-order-details', $data);
    }

    protected function edit($id)
    {
        $data['order'] = Order::with('order_items')->findOrFail($id);
        $data['items'] = Item::where('supplier_id', $data['order']->supplier_id)->get();
        $data['supplier'] = Supplier::findOrFail($data['order']->supplier_id);
       
        return view('order.edit', $data);
    }

    protected function update(Request $request)
    {
        $order_update = Order::findOrFail($request->order_id);
        $order_update->order_date = Carbon::parse($request->order_date)->format('Y-m-d');
        $order_update->save();

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

        return redirect()->back()->with('success_update', 'Order & Order Item Successfully Updated');
    }

    protected function deleteOrderItem($id)
    {
        $delete = OrderItem::findOrFail($id)->delete();

        return redirect()->back()->with('success_update', 'Order Item Successfully Deleted');
    }
}
