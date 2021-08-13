<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SocialController extends Controller
{
    public function social(){
        Session::put('admin_page', 'social');
        $social = Social::first();
        return view('admin.theme.social', compact('social'));
    }

    // Scial Settings update
    public function socialUpdate(Request $request, $id){
        $social = Social::findOrFail($id);
        $data = $request->all();
        $social->facebook = $data['facebook'];
        $social->google = $data['google'];
        $social->linkedin = $data['linkedin'];
        $social->twitter = $data['twitter'];
        $social->pinterest = $data['pinterest'];

        $social->save();
        Session::flash('sucess_message','Social Settings Has Been Updated Successfully');
        return redirect()->back();
    }
}
