<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class AdminLoginController extends Controller
{
    public function adminLogin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
            $customMessage = [
                'email.required' => 'Email Address is required',
                'email.email' => 'Email Address is not a valid Email Address',
                'email.max' => 'You are not allowed to enter more than 255 characters',
                'password.required' => 'Password is required'
            ];
            $this->validate($request,$rules,$customMessage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect()->route('adminDashboard');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->route('adminLogin');
            }

        }
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminDashboard');
        }else{
            return view('admin.login');
        }
    }

    public function forgetPassword(){
        return view('admin.forgetPassword');
    }

    public function adminDashboard(){
        Session::put('admin_page','dashboard');
        return view('admin.dashboard');
    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        Session::flash('success_message','Logout Successfully');
        return redirect()->route('adminLogin');
    }

    public function profile(){
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function profileUpdate(Request $request, $id){
        $data = $request->all();
        $validateData = $request->validate([
            'name' => 'required|max:255'
        ]);
        $admin_id = Auth::guard('admin')->user()->id;
        $admin = Admin::findOrFail($id);
        $admin->name = $data['name'];
        $admin->address = $data['address'];
        $admin->phone_number = $data['phone_number'];

        $random = Str::random(10);
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random.'.'.$extension;
                $image_path = 'public/uploads/'.$filename;
                Image::make($image_tmp)->save($image_path);
                $admin->image = $filename;
            }
        }

        $admin->save();
        Session::flash('success_message','Record Updated Successfully');
        return redirect()->back();
    }

    public function changePassword(){
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.changePassword', compact('admin'));
    }

    public function checkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_id = Auth::guard('admin')->user()->id;
        $check_password = Admin::where('id', $user_id)->first();
        if(Hash::check($current_password, $check_password->password)){
            return "true"; die;
        }else{
            return "false"; die;
        }
    }

    public function updatePassword(Request $request, $id){
        $validateData = $request->validate([
            'current_password' => 'required|max:255',
            'password' => 'min:6',
            'pass_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        $data = $request->all();
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        $current_admin_password = $admin->password;
        if(Hash::check($data['current_password'], $current_admin_password)){
            $admin->password = bcrypt($data['password']);
            $admin->save();
            Session::flash('success_message', 'Admin Password has been Updated Successfully');
            return redirect()->back();
        }else{
            Session::flash('error_message','Your password doesnot match with our database');
            return redirect()->back();
        }
    }
}
