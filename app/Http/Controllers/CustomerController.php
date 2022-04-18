<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class CustomerController extends Controller
{
    protected function index(Request $request)
    {
        $data['site'] = Site::all();
        if ($request->ajax()) {
            $data = Customer::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return $data->customer_name . " " . $data->customer_last_name;
                })
                ->addColumn('site', function ($data) {
                    return $data->site->site_name . ' | ' . $data->site->province_details->name_en;
                })
                ->addColumn('contact_no', function ($data) {
                    return $data->contact_no . ' | ' . $data->contact_no_2;
                })
                ->addColumn('loan', function ($data) {
                    return 1000;
                })
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->customer_id . "' data-pharmacy-name='" . $data->pharmacy_name . "' data-name='" . $data->customer_name . "' data-last-name='" . $data->customer_last_name . "' data-site='" . $data->site_id . "' data-cno='" . $data->contact_no . "' data-cno-2='" . $data->contact_no . "' ><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['full_name'])
                ->rawColumns(['site'])
                ->rawColumns(['contact_no'])
                ->rawColumns(['loan'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customer.index', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pharmacy_name' => 'required',
            'contact_no' => 'required',
            'site_id' => 'required'
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        if ($request->id == '0') {
            $customer = new Customer();
            $customer->pharmacy_name = $request->pharmacy_name;
            $customer->customer_name = $request->customer_name;
            $customer->customer_last_name = $request->customer_last_name;
            $customer->site_id = $request->site_id;
            $customer->contact_no = $request->contact_no;
            $customer->contact_no_2 = $request->contact_no_2;
            $customer->save();
        } else {
            $customer = Customer::findOrFail($request->id);
            $customer->pharmacy_name = $request->pharmacy_name;
            $customer->customer_name = $request->customer_name;
            $customer->customer_last_name = $request->customer_last_name;
            $customer->site_id = $request->site_id;
            $customer->contact_no = $request->contact_no;
            $customer->contact_no_2 = $request->contact_no_2;
            $customer->save();
        }
        return true;
    }
}
