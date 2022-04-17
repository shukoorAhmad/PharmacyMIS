<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SupplierController extends Controller
{
    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->supplier_id . "' data-name='" . $data->name . "' data-email='" . $data->email . "' data-cno='" . $data->contact_no . "' ><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('supplier.index');
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_name' => 'required',
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        if ($request->id == '0') {
            $site = new Supplier();
            $site->name = $request->supplier_name;
            $site->email = $request->email;
            $site->contact_no = $request->contact_no;
            $site->save();
        } else {
            $site = Supplier::findOrFail($request->id);
            $site->name = $request->supplier_name;
            $site->email = $request->email;
            $site->contact_no = $request->contact_no;
            $site->save();
        }
        return true;
    }
}
