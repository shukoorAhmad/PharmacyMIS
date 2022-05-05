<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\ExchangeRate;
use App\Models\Journal;
use Illuminate\Http\Request;
use DB;

class JournalController extends Controller
{

    protected function index()
    {
        $data['exchange_rate'] = ExchangeRate::first();
        return view('journal.index', $data);
    }

    protected function checkMoney($money, $currnecy)
    {
        $check = Cash::where('in_out', 0)->sum($currnecy);
        return $check > $money ? true : $check;
    }
    protected function cashStore(Request $request)
    {
        $request->validate([
            'usd' => 'numeric',
            'afg' => 'numeric',
            'kal' => 'numeric',
            'usd_afg' => 'numeric',
            'usd_kal' => 'numeric',
        ]);

        $exchange_rate = ExchangeRate::findOrFail($request->exchange_rate_id);
        $exchange_rate->usd_afg = $request->usd_afg;
        $exchange_rate->usd_kal = $request->usd_kal;
        $exchange_rate->save();

        $cash = new Cash();
        $cash->usd = $request->usd;
        $cash->afg = $request->afg;
        $cash->kal = $request->kal;
        $cash->usd_afg = $request->usd_afg;
        $cash->usd_kal = $request->usd_kal;
        $cash->in_out = $request->in_out;
        $cash->save();
        $journal = new Journal();
        $journal->source = 1;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = $request->in_out;
        $journal->comment = $request->comment;
        $journal->save();
        $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        return redirect()->back()->with('success_insert', $msg);
    }
}
