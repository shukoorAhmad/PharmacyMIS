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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
