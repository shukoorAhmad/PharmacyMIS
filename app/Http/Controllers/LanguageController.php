<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{

    protected function en()
    {
        Session()->put('locale', 'en');
        App()->setlocale('en');
        return back();
    }
    protected function fa()
    {
        Session()->put('locale', 'fa');
        App()->setlocale('fa');
        return back();
    }
    protected function ps()
    {
        Session()->put('locale', 'ps');
        App()->setlocale('ps');
        return back();
    }
}
