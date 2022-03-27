<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected function index()
    {
        $data['stocks'] = Stock::all();

        return view('stock/create', $data);
    }

    protected function store(Request $request)
    {
        $validate = $request->validate([
            'stock_name' => ['required', 'string'],
            'stock_address' => ['required', 'string']
        ]);

        $store = new Stock();
        $store->stock_name = $request->stock_name;
        $store->stock_address = $request->stock_address;
        $store->incharge = $request->incharge_name;
        $store->contact_no = $request->contact_no;
        $store->save();
        return redirect()->back()->with('success_insert', 'Stock Successfully Added');
    }

    protected function edit($id)
    {
        $data['stock'] = Stock::findOrFail($id);

        return view('stock/edit', $data);
    }

    protected function update(Request $request)
    {
        $validate = $request->validate([
            'stock_name' => ['required', 'string'],
            'stock_address' => ['required', 'string']
        ]);

        $update = Stock::findOrFail($request->id);
        $update->stock_name = $request->stock_name;
        $update->stock_address = $request->stock_address;
        $update->incharge = $request->incharge_name;
        $update->contact_no = $request->contact_no;
        $update->save();
        return redirect()->back()->with('success_update', 'Stock Successfully Updated');
    }
}
