<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Event;
use App\User;
use App\Category;
use App\Reservation;
use App\Response;
use Calendar;
use Session;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
	public function viewUser(){
		$users = User::get();
		return view('admin.users.view_users')->with(compact('users'));
	}

	public function deleteUser($id = null){
		User::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_success','User has been deleted Successfully!');
	}

	public function userLoginRegister(){
		
		$categoriesAll = Category::where(['parent_id'=>0])->get();
        
		return view('users.login_register')->with(compact('categoriesAll'));
	}

	public function confirmAccount($email){
		$email = base64_decode($email);
		$usersCount = User::where('email',$email)->count();
		if($usersCount > 0){
			$userDetails = User::where('email',$email)->first();
			if($userDetails->status == 1){
				return redirect('login')->with('flash_message_success','Your account is already activated. You can login now.');
			}else{
				User::where('email',$email)->update(['status'=>1]);
				return redirect('login')->with('flash_message_success','Your account is activated. You can login now.');
			}
		}else{
			abort(404);
		}
	}

	public function login(Request $request){
		if($request->isMethod('post')){
			$validation = $request->validate([
				'email' => 'required|email',
				'password' => 'required'
			]);
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;
			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
				$userStatus = User::where('email',$data['email'])->first();
				if($userStatus->status == 0){
					return redirect()->back()->with('flash_message_error','Your account is not activated! Please verify your email to activate.');
				}
				Session::put('frontSession',$data['email']);
				if(Auth::user()->admin == 2){
					return redirect('/admin/dashboard');
				}if(Auth::user()->admin == 1){
					return redirect('/owner/dashboard');
				}else{
					return redirect('/');
				}
				
			}else{
				return redirect()->back()->with('flash_message_error','Invalid Email or Password');
			}
		}
	}

	public function register(Request $request){
		if($request->isMethod('post')){
			$validation = $request->validate([
				'name' => 'required',
				'email' => 'required|email|unique:users,email',
				'password' => [
		            'required',
		            'string',
		            'min:6',              // must be at least 10 characters in length
		            'regex:/[a-z]/',      // must contain at least one lowercase letter
		            'regex:/[A-Z]/',      // must contain at least one uppercase letter
		            'regex:/[0-9]/',      // must contain at least one digit
		            'regex:/[@$!%*#?&]/', // must contain a special character
		        ],
			]);
			$data = $request->all();
			$usersCount = User::where('email',$data['email'])->count();
			if($usersCount>0){
				return redirect()->back()->with('flash_message_error','Email already exist.');
			}else{
				$user = new User;
				$user->name = $data['name'];
				$user->email = $data['email'];
				$user->password = bcrypt($data['password']);
				$user->save();

				// $email = $data['email'];
				// $messageData = ['email'=>$data['email'],'name'=>$data['name']];
				// Mail::send('emails.register',$messageData,function($message) use($email){
				// 	$message->to($email)->subject('Registration with Edu-Trip Website');
				// });

				$email = $data['email'];
				$messageData = [
						'email'=>$data['email'],
						'name'=>$data['name'],'code'=>base64_encode($data['email'])];

				Mail::send('emails.confirmation',$messageData,function($message) use($email){
					$message->to($email)->subject('Confirm your Edu-Trip account');
				});

				return redirect()->back()->with('flash_message_success','Please confirm your email to activate your account!');
				if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
					Session::put('frontSession',$data['email']);
					return redirect('/');
				}
			}
		}

    	// For compliance
		// $res = [];
		// $data = Reservation::all();
		// if($data->count()){
		// 	foreach ($data as $key => $value) {
		// 		$res[] = Calendar::event(
		// 			$value->title,
		// 			true,
		// 			new \DateTime($value->start_date),
		// 			new \DateTime($value->end_date.' +1 day'),
		// 			null,
  		// Add color and link on event
		// 			[
		// 				'color' => '#f05050',
		// 			]
		// 		);
		// 	}
		// }
		// $calendar = Calendar::addEvents($res);
		// $categoriesAll = Category::where(['parent_id'=>0])->get();
        // End for compliance
        return view('users.register');
	}

	public function checkEmail(Request $request){
		$data = $request->all();
		$usersCount = User::where('email',$data['email'])->count();
		if($usersCount>0){
			echo "false";
		}else{
			echo "true";
		}
	}

	public function account(){
		$users = User::where(['id'=>Auth::user()->id])->get();
		return view('users.account')->with(compact('users'));
	}

	public function editAccount(Request $request){
		if ($request->isMethod('post')) {
			$data = $request->all();
			User::where(['id'=>Auth::user()->id])
			->update(['first_name'=>$data['firstname'],
					  'last_name'=>$data['lastname'],
					  'address'=>$data['address'],
					  'city'=>$data['city'],
					  'province'=>$data['province'],
					  'postal_code'=>$data['postal_code'],
					  'phone'=>$data['phone'],
			]);
			return redirect('account')->with('flash_message_success','Profile updated successfully!');
		}
		$users = User::where(['id'=>Auth::user()->id])->get();
		return view('users.edit_account')->with(compact('users'));
	}

	public function messages(){
		$receiver_id = Auth::user()->id;
		$resp = Response::where('receiver_id',$receiver_id)->orderBy('id','Desc')->paginate(15);
		$categoriesAll = Category::where(['parent_id'=>0])->get();
		return view('users.messages')->with(compact('categoriesAll', 'resp'));
	}

	public function sentMessages(){
		$sender_id = Auth::user()->id;
		$sent_messages = Response::where('sender_id',$sender_id)->orderBy('id','Desc')->paginate(15);
		$categoriesAll = Category::where(['parent_id'=>0])->get();
		return view('users.sent_messages')->with(compact('categoriesAll', 'sent_messages'));
	}

	public function deleteMessage($id){
		Response::where('id',$id)->delete();
		return redirect()->back()->with('flash_message_success','Message deleted successfully!');
	}

	public function logout(){
		Auth::logout();
		Session::forget('frontSession');
		return redirect('/login');
	}
	public function userDetails(Request $request ,$id = null){
        // To view user details
        $userDetails = User::where(['id'=>$id])->first();

        $categoriesAll = Category::where(['parent_id'=>0])->get();
        // Event detail
        $eventDetails = Event::where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo $userDetails->id;
            // echo Auth::user()->name;
            $resp = new Response;
            $resp->sender_id = Auth::user()->id;
            $resp->receiver_id = $userDetails->id;
            $resp->message = $data['message'];
            $resp->save();
            return redirect()->back()->with('flash_message_success', 'Your message has been sent.');
        }
        return view('users.user_details')->with(compact('userDetails','eventDetails','categoriesAll'));
    }

    public function chkUserPassword(Request $request){
    	$data = $request->all();
    	dd($data);
    }
}
