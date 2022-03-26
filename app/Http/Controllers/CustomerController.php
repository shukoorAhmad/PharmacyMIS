<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected function index()
    {
        return view('dashboard');
    }

    protected function showCustomerPage()
    {
        return view('customer/index');
    }
}
