<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    protected function purchaseItems($id)
    {
        $data['order'] = Order::findOrFail($id);
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
