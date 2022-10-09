<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SiteController extends Controller
{

    protected function index(Request $request)
    {
        $data['province'] = Province::all();
        if ($request->ajax()) {
            $data = Site::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('province_name', function ($data) {
                    return $data->province_details->name_en;
                })
                ->addColumn('action', function ($data) {
                    return  "<a class='edit_btn ml-1' style='cursor: pointer;' data-id='" . $data->site_id . "' data-site='" . $data->site_name . "' data-province='" . $data->province . "' ><i class='btn btn-outline-primary btn-circle fa fa-edit'></i></a>";
                })
                ->rawColumns(['province_name'])
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('site.index', $data);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required',
            'province' => 'required',
        ]);
        if ($validator->fails()) {
            return json_encode($validator->errors()->toArray());
        }
        $request->id == '0' ?  $site = new Site() : $site = Site::findOrFail($request->id);

        $site->site_name = $request->site_name;
        $site->province = $request->province;
        $site->save();

        return true;
    }
}
