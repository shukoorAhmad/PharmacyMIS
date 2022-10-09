<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SellerController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Seller::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', function ($data) {
                    return $data->seller_name . '  | ' . $data->seller_last_name;
                })
                ->addColumn('cno', function ($data) {
                    return $data->contact_no . '  | ' . $data->contact_no_2;
                })
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->seller_id . "' data-name='" . $data->seller_name . "' data-last-name='" . $data->seller_last_name . "' data-address='" . $data->address . "' data-cno='" . $data->contact_no . "' data-cno-2='" . $data->contact_no_2 . "'><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['cno'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('seller.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'seller_name' => 'required',
            'contact_no' => 'required',
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }

        $request->id == '0' ?  $seller = new Seller()   :  $seller = Seller::findOrFail($request->id);

        $seller->seller_name = $request->seller_name;
        $seller->seller_last_name = $request->seller_last_name;
        $seller->address = $request->address;
        $seller->contact_no = $request->contact_no;
        $seller->contact_no_2 = $request->contact_no_2;
        $seller->save();

        return true;
    }
}
