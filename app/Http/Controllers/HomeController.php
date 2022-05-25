<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function settingUpdate(Request $request)
    {
        $update = User::findOrFail(Auth::user()->id);

        if($request->file('photo') != '')
        {
            $path = Storage::disk('images')->putfile('/', new file($request->file('photo')));
            if($update->photo != ''){
                Storage::disk('images')->delete($update->photo);
            }
            $update->photo = $path;
        }

        if (($request->full_name != '') && ($request->old_password == '') && ($request->new_password == '') && ($request->confirm_password == '')) {
            $update->name = $request->full_name;
        } else if (Hash::check($request->old_password, $update->password) && ($request->new_password == $request->confirm_password)) {
            $update->password = Hash::make($request->new_password);
        }
        
        $update->save();
        return back();
    }
}
