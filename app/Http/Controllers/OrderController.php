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
                    // return $data->status == 0 ? '<span class="u-label bg-warning text-white">True</span>' : '<span class="u-label bg-warning text-white">False</span>';
                    return '<span>Ahmad</span>';
                })
                ->addColumn('action', function ($data) {
                    return '<a data-id="" class="edit"><i class="fa fa-eye btn btn-warning btn-circle"></i></a>';
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
}
