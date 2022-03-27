<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected function index()
    {
        return view('order.index');
    }

    protected function create()
    {
        $data['supplier'] = Supplier::all();

        return view('order.create', $data);
    }
}
