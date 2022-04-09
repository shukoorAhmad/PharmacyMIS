<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use DataTables;

class SellerController extends Controller
{

    public function index()
    {
        return view('seller.index');
    }

    public function create()
    {
        return view('seller.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seller_name' => 'required',
            'contact_no' => 'required',
        ]);
        $seller = new Seller();
        $seller->seller_name = $request->seller_name;
        $seller->seller_last_name = $request->seller_last_name;
        $seller->address = $request->address;
        $seller->contact_no = $request->contact_no;
        $seller->contact_no_2 = $request->contact_no_2;
        $seller->save();
        return redirect()->back()->with('success_insert', 'Seller Successfully Added');
    }
    protected function showSellers(Request $request)
    {
        if ($request->ajax()) {
            $data = Seller::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a data-id="' . $data->seller_id . '" class="edit"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('seller.index');
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['seller'] = Seller::findOrFail($id);
        return view('seller.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'seller_name' => 'required',
            'contact_no' => 'required',
        ]);
        $seller = Seller::findOrFail($request->id);
        $seller->seller_name = $request->seller_name;
        $seller->seller_last_name = $request->seller_last_name;
        $seller->address = $request->address;
        $seller->contact_no = $request->contact_no;
        $seller->contact_no_2 = $request->contact_no_2;
        $seller->save();
        return redirect()->back()->with('success_update', 'Seller Successfully Updated');
    }

    public function destroy($id)
    {
        //
    }
}
