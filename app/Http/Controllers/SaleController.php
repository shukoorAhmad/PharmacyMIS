<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected function index()
    {
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
