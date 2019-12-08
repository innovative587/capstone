<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Reservation;
use App\Itinerary;
use App\Category;
use App\Tag;
use App\Event;
use PDF;
use Auth;
use DB;

class ItineraryController extends Controller
{
	public function viewItinerary(){
		$itinerary = Itinerary::all()->unique('reservation_id');
		return view('admin.itinerary.view_itinerary')->with(compact('itinerary'));
	}

  public function addPeople(Request $request){
    if($request->isMethod('post')){
      $data = $request->input('useryawa');
      $tagsCount = Tag::where(['start_date'=>$request->input('start_date'), 'user_id'=>$request->input('useryawa')])->count();
      if($tagsCount > 0){
        return redirect()->back()->with('flash_message_error','User already added.');
      }
      else{
        foreach ($data as $value) {
          $tag = new Tag;
          $tag->start_date = $request->input('start_date');
          $tag->user_id = $value;
          $tag->save();
        }
        return redirect()->back()->with('flash_message_success','People Added Successfully!');
      }
    }

    $categoriesAll = Category::where(['parent_id'=>0])->get();
    $users = User::where(['admin'=>0])->get();
    return view('users.add_people')->with(compact('users','categoriesAll'));
  }

  public function createItinerary(Request $request){
   $users = User::all();
   $reservation = Reservation::all();

    if($request->isMethod('post')){
    $data = $request->all();
    $itineraryCount = Itinerary::where('reservation_id',$data['res_id'])->count();
    if($itineraryCount>0){
      return redirect()->back()->with('flash_message_error','Itinerary already exist.');
    }else{
          foreach ($data['time'] as $key => $val) {
           if(!empty($val)){
            $itinerary = new Itinerary;
            $itinerary->time = $val;
            $itinerary->title = $data['title'];
            $itinerary->reservation_id = $data['res_id'];
            $itinerary->reserved_by = $data['user_id'];
            $itinerary->description = $data['description'][$key];
            $itinerary->save();
            }
          }
        }
      return redirect()->back()->with('flash_message_success','Itinerary created Successfully!');
      }
    return view('admin.itinerary.create_itinerary')->with(compact('users','reservation'));
    }

  public function userViewItineraryDetails($session_id){
    $users = User::where(['admin'=>0])->get();
    $categoriesAll = Category::where(['parent_id'=>0])->get();
    $date = Reservation::where(['session_id'=>$session_id])->get();
    // $details = DB::table('cart')
    // ->where('session_id',$session_id)
    // ->get();

    $members = DB::table('users')
    ->join('tags','users.id', '=', 'tags.user_id')
    ->select('users.*','tags.*')
    ->get();

    $eventDetails = DB::table('cart')->where(['session_id'=>$session_id])->first();
    $details = DB::table('cart')->select(DB::raw('*, ( 6367 * acos( cos( radians('.$eventDetails->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$eventDetails->longitude.') ) + sin( radians('.$eventDetails->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
    ->where('session_id',$session_id)
    ->having('distance', '<', 25)
    ->orderBy('distance')
    ->get();
    Reservation::where(['session_id'=>$session_id])->update(['seen'=>'1']);
    return view('users.itinerary_details')->with(compact('details','categoriesAll','date','users','members'));
  }

  public function groupItinerary($start_date){
    $categoriesAll = Category::where(['parent_id'=>0])->get();
    $date = $start_date;
    $details = Reservation::where(['start_date'=>$start_date])->orderBy('start_time','ASC')->get();
    Tag::where(['user_id'=>Auth::user()->id])->update(['seen'=>'1']);
    return view('users.group_itinerary')->with(compact('categoriesAll','date','details'));
  }

  public function pdfReview(Request $request){
    if($request->isMethod('post')){
    $data = $request->all();
    $reservation_id = $data['res_id'];
    $itinerary = Itinerary::where(['reservation_id'=>$reservation_id])->first();
    $pdf = PDF::LoadView('admin.itinerary.pdf_review', compact('itinerary'))->setPaper('a4','portrait');
    $filename = $itinerary->reservation_id;
    return $pdf->stream($filename.'.pdf');
    }   	
  } 

  public function itineraryReview($reservation_id){
   $itinerary = Itinerary::where(['reservation_id'=>$reservation_id])->get();
   return view('admin.itinerary.itinerary_review')->with(compact('itinerary'));
  }

  public function userViewItinerary(){
    $tag = Tag::where(['user_id'=>Auth::user()->id])->get();
    // $itinerary = Reservation::where(['status'=>1])
    // ->groupBy('start_date')
    // ->get();
    $itinerary = Reservation::all()->unique('session_id');
    return view('users.view_itinerary')->with(compact('itinerary','tag'));
  }

  public function addtocart(Request $request){
    $data = $request->all();
    if(empty($data['user_email'])){
      $data['user_email'] = '';
    }
    $session_id = Session::get('session_id');
    if(empty($session_id)){
      $session_id = str_random(30);
      Session::put('session_id',$session_id);
    }

    DB::table('cart')->insert([
      'event_id'=>$data['event_id'],
      'event_name'=>$data['event_name'],
      'price'=>$data['event_fee'],
      'event_capacity'=>$data['event_capacity'],
      'user_email'=>$data['user_email'],
      'latitude'=>$data['latitude'],
      'longitude'=>$data['longitude'],
      'session_id'=>$session_id
    ]);
    return redirect('trip');
  }

  public function cart(){
    $session_id = Session::get('session_id');
    $userCart = DB::table('cart')
    ->where('session_id',$session_id)
    ->get();
    return view('events.Trip')->with(compact('userCart'));
  }

  public function deleteUserTrip($id = null){
    DB::table('cart')->where(['id'=>$id])->delete();
    return redirect('trip');
  }

  public function payment(){
    return view('events.payment');
  }

  public function cancelRes($session_id){
    Reservation::where('session_id',$session_id)->update(['status'=>2]);
    return redirect()->back()->with('flash_message_success','Cancelled Successfully!');
  }
}
