<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;
use App\Event;
use App\Category;
use App\Reservation;
use Calendar;
use Carbon\Carbon;
use Stripe;
Use DB;

class ReservationController extends Controller
{
  public function schedATrip(Request $request, $id = null){
    // if(!Auth::check()) 
    // {
    //   return redirect('/login-register')->with('flash_message_error','You need to login first!');
    // }
    $eventDetails = Event::where(['id'=>$id])->first();
    $nearby = Event::select(DB::raw('*, ( 6367 * acos( cos( radians('.$eventDetails->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$eventDetails->longitude.') ) + sin( radians('.$eventDetails->latitude.') ) * sin( radians( latitude ) ) ) ) AS distance'))
    ->having('distance', '<', 25)
    ->orderBy('distance')
    ->get();

    $categoriesAll = Category::where(['parent_id'=>0])->get();
    // Event detail
    $eventSched = Event::where(['id'=>$id])->first();
    $recent = Event::where(['status'=>1])->orderBy('created_at','DESC')->get();

    if($request->isMethod('post')){
      $user = Auth::user();
      $data = $request->all();
      try {
        // $pips = $data['nop'];
        // $total = $data['res_fee'] * $pips;
        // $charge = Stripe::charges()->create([
        //   'amount' => $total,
        //   'currency' => 'PHP',
        //   'source' => $request->stripeToken,
        //   'description' => 'Reservation Fee',
        //   'receipt_email' => $user->email,
        //   'metadata' => [],
        // ]);
        $res = new Reservation;
        $res->current_id = $user->id;
        $res->current_name = $user->name;
        $res->owner_id = $data['owner_id'];
        $res->event_id = $data['event_id'];
        $res->event_name = $data['event_name'];
        $res->title = $data['title'];
        $res->start_time = $data['start_time'];
        $res->end_time = $data['end_time'];
        $res->start_date = $data['date'];
        $res->end_date = $data['end_date'];
        $res->nop = $data['nop'];
        $res->save();
        return redirect()->back()->with('flash_message_success','Reservation created successfully wait for approval!');
      } catch (Exception $e) {

      }
    }
    return view('events.reservation')->with(compact('eventSched','categoriesAll','nearby','recent'));
  }

  public function sched(Request $request){
    if($request->isMethod('post')){
      $user = Auth::user();
      $data = $request->all();
      try {
        $total = $data['total'];
        $charge = Stripe::charges()->create([
          'amount' => $total,
          'currency' => 'PHP',
          'source' => $request->stripeToken,
          'description' => 'Reservation Fee',
          'receipt_email' => $user->email,
          'metadata' => [],
        ]);
        $res = new Reservation;
        $res->current_id = $user->id;
        $res->current_name = $user->name;
        $res->owner_id = 1;
        $res->session_id = $data['session_id'];
        $res->title = $data['title'];
        $res->start_time = $data['start_time'];
        $res->end_time = $data['end_time'];
        $res->start_date = $data['date'];
        $res->end_date = $data['end_date'];
        $res->nop = $data['nop'];
        $res->save();
        return redirect()->back()->with('flash_message_success','Reservation created successfully wait for approval!');
      } catch (Exception $e) {
        
      }
        
    }
    return view('events.reservation');
  }

  public function viewReservation(Request $request){
    if(Auth::user()->admin == 2){
      $reservations = Reservation::get();
      return view('admin.reservations.view_reservations')->with(compact('reservations'));
    }if(Auth::user()->admin == 1){
      $reservations = Reservation::where(['owner_id'=>Auth::user()->id])->get();
      return view('owner.reservations.view_reservations')->with(compact('reservations'));
    }
  }

  public function myReservation(){
    // if(!Auth::check()) 
    // {
    //   return redirect('/login-register')->with('flash_message_error','You need to login first!');
    // }
    $res = [];
    $user = Auth::user();
    $data = Reservation::where(['current_id'=>$user->id])->orderBy('status','DESC')->orderBy('start_date','ASC')->get();
    if($data->count()){
      foreach ($data as $key => $value) {
        $res[] = Calendar::event(
          $value->title,
          true,
          new \DateTime($value->start_date),
          new \DateTime($value->end_date.' +1 day'),
          null,
                    // Add color and link on event
          [
            'color' => '#f05050',
          ]
        );
      }
    }
    $calendar = Calendar::addEvents($res);
    $categoriesAll = Category::where(['parent_id'=>0])->get();
    return view('events.my_reservations')->with(compact('categoriesAll','calendar','data','cancel'));
  }

  public function approveApproved($id = null){
    Reservation::where(['id'=>$id])->update(['status'=>'1']);
    return redirect()->back()->with('flash_message_success','Approved');
  }

  public function approveRes($id = null){
    Reservation::where(['id'=>$id])->update(['status'=>'1']);
    return redirect()->back()->with('flash_message_success','Approved');
  }

  public function deleteReservation($id = null){
    Reservation::where(['id'=>$id])->delete();
    return redirect()->back()->with('flash_message_success','Reservation has been deleted Successfully!');
  }
}
