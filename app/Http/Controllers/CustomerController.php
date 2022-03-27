<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Site;
use Illuminate\Http\Request;
use DataTables;

class CustomerController extends Controller
{
    protected function index()
    {
        return view('customer.index');
    }
    protected function create()
    {
        $data['site'] = Site::all();
        return view('customer.create', $data);
    }
    protected function store(Request $request)
    {
        $request->validate([
            'pharmacy_name' => 'required',
            'contact_no' => 'required',
            'site_id' => 'required'
        ]);
        $customer = new Customer();
        $customer->pharmacy_name = $request->pharmacy_name;
        $customer->customer_name = $request->customer_name;
        $customer->customer_last_name = $request->customer_last_name;
        $customer->site_id = $request->site_id;
        $customer->contact_no = $request->contact_no;
        $customer->contact_no_2 = $request->contact_no_2;
        $customer->save();
        return redirect()->back()->with('success_insert', 'Customer Successfully Added');
    }
    protected function showCustomers(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return $data->customer_name . " " . $data->customer_last_name;
                })
                ->addColumn('site', function ($data) {
                    return $data->site->site_name . ' ' . $data->site->prov_id->en_province;
                })
                ->addColumn('action', function ($data) {
                    return '<a data-id="' . $data->customer_id . '" class="edit"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i></a>';
                })
                ->rawColumns(['full_name'])
                ->rawColumns(['site'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index');
    }
    protected function edit($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        $data['site'] = Site::all();
        return view('customer.edit', $data);
    }
    protected function update(Request $request)
    {
        $request->validate([
            'pharmacy_name' => 'required',
            'contact_no' => 'required',
            'site_id' => 'required'
        ]);
        $customer = Customer::findOrFail($request->id);
        $customer->pharmacy_name = $request->pharmacy_name;
        $customer->customer_name = $request->customer_name;
        $customer->customer_last_name = $request->customer_last_name;
        $customer->site_id = $request->site_id;
        $customer->contact_no = $request->contact_no;
        $customer->contact_no_2 = $request->contact_no_2;
        $customer->save();
        return redirect()->back()->with('success_update', 'Customer Successfully Updated');
    }
}
