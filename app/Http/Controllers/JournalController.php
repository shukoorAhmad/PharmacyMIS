<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\Customer;
use App\Models\CustomerAccount;
use App\Models\ExchangeRate;
use App\Models\Expense;
use App\Models\Journal;
use App\Models\Seller;
use App\Models\SellerAccount;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Illuminate\Http\Request;
use Session;

class JournalController extends Controller
{

    protected function index()
    {
        $data['journals'] = Journal::whereDate('created_at', '=', date('Y-m-d'))->get();
        $data['exchange_rate'] = ExchangeRate::first();

        return view('journal.index', $data);
    }

    protected function filterJournalByDate($date)
    {
        $data['journals'] = Journal::whereDate('created_at', '=', $date)->get();
        $data['date'] = $date;
        $data['exchange_rate'] = ExchangeRate::first();
        
        return view('journal.show_data', $data);
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
        $cash->comment = $request->comment;
        $cash->save();
        $journal = new Journal();
        $journal->source = 1;
        $journal->source_id = $cash->id;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = $request->in_out;
        $journal->comment = $request->comment;
        $journal->save();
        if (Session::get('locale') == 'en')
            $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        if (Session::get('locale') == 'fa')
            $msg = $request->in_out == 0 ? 'پول موفقانه به سیف انتقال یافت' : 'پول موفقانه از سیف برداشت گردید';
        if (Session::get('locale') == 'ps')
            $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        return redirect()->back()->with('success_insert', $msg);
    }

    protected function expenseStore(Request $request)
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

        $expense = new Expense();
        $expense->usd = $request->usd;
        $expense->afg = $request->afg;
        $expense->kal = $request->kal;
        $expense->usd_afg = $request->usd_afg;
        $expense->usd_kal = $request->usd_kal;
        $expense->comment = $request->comment;
        $expense->save();
        $journal = new Journal();
        $journal->source = 2;
        $journal->source_id = $expense->expense_id;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = 1;
        $journal->comment = $request->comment;
        $journal->save();
        if (Session::get('locale') == 'en')
            $msg = 'Expense Successfully Save';
        if (Session::get('locale') == 'fa')
            $msg = '';
        if (Session::get('locale') == 'ps')
            $msg = 'Money Successfully Transfered To Cash';
        return redirect()->back()->with('success_insert', $msg);
    }

    protected function filterCustomer(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Customer::orderBy('customer_id', 'DESC')->limit(10)->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->customer_id,
                    'text' => $customer->pharmacy_name . ' ' . $customer->customer_name . ' ' . $customer->customer_last_name  . ' ' .  $customer->site->site_name
                );
            }
        } else {
            $data = Customer::where('pharmacy_name', 'like', '%' . $search . '%')->orWhere('customer_name', 'like', '%' . $search . '%')->orWhere('customer_last_name', 'like', '%' . $search . '%')->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->customer_id,
                    'text' => $customer->pharmacy_name . ' ' . $customer->customer_name . ' ' . $customer->customer_last_name  . ' ' .  $customer->site->site_name
                );
            }
        }
        return response()->json($response);
    }

    protected function customerStore(Request $request)
    {
        $request->validate([
            'usd' => 'numeric',
            'afg' => 'numeric',
            'kal' => 'numeric',
            'usd_afg' => 'numeric',
            'usd_kal' => 'numeric',
            'customer' => 'required'
        ]);

        $exchange_rate = ExchangeRate::findOrFail($request->exchange_rate_id);
        $exchange_rate->usd_afg = $request->usd_afg;
        $exchange_rate->usd_kal = $request->usd_kal;
        $exchange_rate->save();

        $customer_account = new CustomerAccount();
        $customer_account->customer_id = $request->customer;
        $customer_account->usd = $request->usd;
        $customer_account->afg = $request->afg;
        $customer_account->kal = $request->kal;
        $customer_account->usd_afg = $request->usd_afg;
        $customer_account->usd_kal = $request->usd_kal;
        $customer_account->in_out = $request->in_out;
        $customer_account->comment = $request->comment;
        $customer_account->save();

        $journal = new Journal();
        $journal->source = 3;
        $journal->source_id = $customer_account->customer_account_id;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = $request->in_out;
        $journal->comment = $request->comment;
        $journal->save();
        if (Session::get('locale') == 'en')
            $msg = $request->in_out == 0 ? 'Money Successfully Received From Customer' : 'Money Successfully Send to Customer';
        if (Session::get('locale') == 'fa')
            $msg = $request->in_out == 0 ? 'پول موفقانه از مشتری دریافت گردید' : 'پول موفقانه به مشتری پرداخت گردید';
        if (Session::get('locale') == 'ps')
            $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        return redirect()->back()->with('success_insert', $msg);
    }
    protected function filterSeller(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Seller::orderBy('seller_id', 'DESC')->limit(10)->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->seller_id,
                    'text' => $customer->seller_name . ' ' . $customer->seller_last_name . ' ' . $customer->address
                );
            }
        } else {
            $data = Seller::where('seller_name', 'like', '%' . $search . '%')->orWhere('seller_last_name', 'like', '%' . $search . '%')->orWhere('address', 'like', '%' . $search . '%')->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->seller_id,
                    'text' => $customer->seller_name . ' ' . $customer->seller_last_name . ' ' . $customer->address
                );
            }
        }
        return response()->json($response);
    }

    protected function sellerStore(Request $request)
    {
        $request->validate([
            'usd' => 'numeric',
            'afg' => 'numeric',
            'kal' => 'numeric',
            'usd_afg' => 'numeric',
            'usd_kal' => 'numeric',
            'seller' => 'required'
        ]);

        $exchange_rate = ExchangeRate::findOrFail($request->exchange_rate_id);
        $exchange_rate->usd_afg = $request->usd_afg;
        $exchange_rate->usd_kal = $request->usd_kal;
        $exchange_rate->save();

        $seller_account = new SellerAccount();
        $seller_account->seller_id = $request->seller;
        $seller_account->usd = $request->usd;
        $seller_account->afg = $request->afg;
        $seller_account->kal = $request->kal;
        $seller_account->usd_afg = $request->usd_afg;
        $seller_account->usd_kal = $request->usd_kal;
        $seller_account->in_out = $request->in_out;
        $seller_account->comment = $request->comment;
        $seller_account->save();

        $journal = new Journal();
        $journal->source = 4;
        $journal->source_id = $seller_account->seller_account_id;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = $request->in_out;
        $journal->comment = $request->comment;
        $journal->save();
        if (Session::get('locale') == 'en')
            $msg = $request->in_out == 0 ? 'Money Successfully Received From Seller' : 'Money Successfully Send to Seller';
        if (Session::get('locale') == 'fa')
            $msg = $request->in_out == 0 ? 'پول موفقانه از فروشنده دریافت گردید' : 'پول موفقانه به فروشنده پرداخت گردید';
        if (Session::get('locale') == 'ps')
            $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        return redirect()->back()->with('success_insert', $msg);
    }
    protected function filterSupplier(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Supplier::orderBy('supplier_id', 'DESC')->limit(10)->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->supplier_id,
                    'text' => $customer->name . ' ' . $customer->email . ' ' . $customer->contact_no
                );
            }
        } else {
            $data = Supplier::where('name', 'like', '%' . $search . '%')->orWhere('email', 'like', '%' . $search . '%')->orWhere('contact_no', 'like', '%' . $search . '%')->get();
            $response = array();
            foreach ($data as $customer) {
                $response[] = array(
                    'id' => $customer->supplier_id,
                    'text' => $customer->name . ' ' . $customer->email . ' ' . $customer->contact_no
                );
            }
        }
        return response()->json($response);
    }

    protected function supplierStore(Request $request)
    {
        $request->validate([
            'usd' => 'numeric',
            'afg' => 'numeric',
            'kal' => 'numeric',
            'usd_afg' => 'numeric',
            'usd_kal' => 'numeric',
            'supplier' => 'required'
        ]);

        $exchange_rate = ExchangeRate::findOrFail($request->exchange_rate_id);
        $exchange_rate->usd_afg = $request->usd_afg;
        $exchange_rate->usd_kal = $request->usd_kal;
        $exchange_rate->save();

        $seller_account = new SupplierAccount();
        $seller_account->supplier_id = $request->supplier;
        $seller_account->usd = $request->usd;
        $seller_account->afg = $request->afg;
        $seller_account->kal = $request->kal;
        $seller_account->usd_afg = $request->usd_afg;
        $seller_account->usd_kal = $request->usd_kal;
        $seller_account->in_out = $request->in_out;
        $seller_account->comment = $request->comment;
        $seller_account->save();

        $journal = new Journal();
        $journal->source = 5;
        $journal->source_id = $request->supplier;
        $journal->usd = $request->usd;
        $journal->afg = $request->afg;
        $journal->kal = $request->kal;
        $journal->usd_afg = $request->usd_afg;
        $journal->usd_kal = $request->usd_kal;
        $journal->in_out = $request->in_out;
        $journal->comment = $request->comment;
        $journal->save();
        if (Session::get('locale') == 'en')
            $msg = $request->in_out == 0 ? 'Money Successfully Received From Supplier' : 'Money Successfully Send to Supplier';
        if (Session::get('locale') == 'fa')
            $msg = $request->in_out == 0 ? 'پول موفقانه از کمپنی دریافت گردید' : 'پول موفقانه به کمپنی پرداخت گردید';
        if (Session::get('locale') == 'ps')
            $msg = $request->in_out == 0 ? 'Money Successfully Transfered To Cash' : 'Money Successfully Out From Cash';
        $msg = $request->in_out == 0 ? 'Money Successfully Received From Supplier' : 'Money Successfully Send to Supplier';
        return redirect()->back()->with('success_insert', $msg);
    }

    protected function showStatment($source)
    {
        if ($source == 1) {
            $data = Cash::all();
            $title = 'Cashe';
        } else if ($source == 2) {
            $data = Expense::all();
            $title = 'Expense';
        } else if ($source == 3) {
            $data = CustomerAccount::all();
            $title = 'Customer';
        } else if ($source == 4) {
            $data = SellerAccount::all();
            $title = 'Seller';
        } else if ($source == 5) {
            $data = SupplierAccount::all();
            $title = 'Supplier';
        }

        return view('journal.show_statment', compact('data', 'title'));
    }
}
