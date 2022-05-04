<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;

class JournalController extends Controller
{

    protected function index()
    {
        $data['exchange_rate'] = ExchangeRate::first();
        return view('journal.index', $data);
    }
    protected function cashStore(Request $request)
    {
        dd($request->in_out);
    }
}
