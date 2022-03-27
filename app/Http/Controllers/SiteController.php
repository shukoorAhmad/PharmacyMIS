<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        $data['province'] = Province::all();
        $data['site'] = site::all();
        return view('Site.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'site_name' => 'required',
                'province' => 'required',
            ]
        );
        $site = new Site();
        $site->site_name = $request->site_name;
        $site->province = $request->province;
        $site->save();
        return redirect()->back()->with('success_insert', 'Site Successfully Added');
    }

    public function edit($id)
    {
        $data['province'] = Province::all();
        $data['site'] = site::findOrFail($id);
        return view('site.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'site_name' => 'required',
                'province' => 'required',
            ]
        );
        $site = Site::findOrFail($request->id);
        $site->site_name = $request->site_name;
        $site->province = $request->province;
        $site->save();
        return redirect()->back()->with('success_update', 'Site Successfully Updated');
    }
}
