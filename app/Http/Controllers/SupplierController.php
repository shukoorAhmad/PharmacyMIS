<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected function index()
    {
        $data['supplier'] = Supplier::all();
        return view('supplier.create', $data);
    }

    protected function store(Request $request)
    {
        $request->validate(
            [
                'supplier_name' => 'required',
            ]
        );
        $site = new Supplier();
        $site->name = $request->supplier_name;
        $site->email = $request->email;
        $site->contact_no = $request->contact_no;
        $site->save();
        return redirect()->back()->with('success_insert', 'Supplier Successfully Added');
    }

    protected function edit($id)
    {
        $data['supplier'] = Supplier::findOrFail($id);
        return view('supplier.edit', $data);
    }

    protected function update(Request $request)
    {
        $request->validate(
            [
                'supplier_name' => 'required',
            ]
        );
        $supplier = Supplier::findOrFail($request->id);
        $supplier->name = $request->supplier_name;
        $supplier->email = $request->email;
        $supplier->contact_no = $request->contact_no;
        $supplier->save();
        return redirect()->back()->with('success_update', 'Supplier Successfully Updated');
    }
}
