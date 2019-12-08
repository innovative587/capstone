<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
    		if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'],'admin'=>'2'])){
    			//echo "Success"; die;
                //Session::put('adminSession',$data['email']);
                return redirect('admin/dashboard');
    		}else{
    			//echo "Failed"; die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
    		}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard(){
        // if(Session::has('adminSession')){
            
        // }else{
        //     return redirect('/admin')->with('flash_message_error','Please login to access');
        // }
        $users = User::all();
        if(Auth::user()->admin == 2){
            return view('admin.dashboard')->with(compact('users'));
        }if(Auth::user()->admin == 1){
            return view('owner.dashboard');
        }
    }

    public function settings(){
        if(Auth::user()->admin == 2){
            return view('admin.settings');
        }if(Auth::user()->admin == 1){
            return view('owner.settings');
        }
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $check_password = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['current_pwd'];
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where('email',Auth::user()->email)->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully');
            }else{
                return redirect('/admin/settings')->with('flash_message_error','Current Password is Incorrect!');
            }
        }
    }

    public function makeOwner($id = null){
        User::where('id',$id)->update(['admin'=>1]);
        return redirect()->back();
    }

    public function logout(){
        Session::flush();
        return redirect('/login')->with('flash_message_success','Logged out Successfully');
    }
}
