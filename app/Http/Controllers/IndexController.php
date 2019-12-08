<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\Reservation;
use App\User;
use Auth;
use Calendar;
use Illuminate\support\Facades\Mail;

class IndexController extends Controller
{
    public function index(){
    	//$categoriesAll = Category::get();
    	$categoriesAll = Category::where(['parent_id'=>0])->get();

    	// for all events	
    	$eventsAll = Event::where(['status'=>1])->orderBy('created_at','DESC')->get();
    	return view('index')->with(compact('eventsAll','categoriesAll'));
    }

    public function search(Request $request){
    	$query = $request->input('query');
    	$search_results = Event::where('event_name', 'like', "%$query%")->paginate(10);

    	//$categoriesAll = Category::get();
    	$categoriesAll = Category::where(['parent_id'=>0])->get();

    	// for all events
    	$eventsAll = Event::orderBy('id','DESC')->get();
    	return view('events.search_result')->with(compact('eventsAll','categoriesAll','search_results'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $email = "jeffsaid37@gmail.com";
            $messageData = [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'phone'=>$data['phone'],
                'comment'=>$data['message']
            ];
            Mail::send('emails.enquiry',$messageData,function($message)use($email){
                $message->to($email)->subject('Enquiry from Edu-Trip Website');
            });

            return redirect()->back()->with('flash_message_success','Thanks for your inquiry. We will get back to you soon.');
        }
        return view('contact');
    }
}
