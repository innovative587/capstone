<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;
use Session;
use App\Event;
use App\Category;
use App\Reservation;
use Calendar;

class EventController extends Controller
{
	public function addEvent(Request $request){
		if($request->isMethod('post')){
			$user = Auth::user();
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;
			$event = new Event;
			$event->category_id = 		$data['category_id'];
			$event->user_id = 			$user->id;
			$event->event_name = 		$data['event_name'];
			$event->event_address = 	$data['event_address'];
			$event->event_schedule = 	$data['event_sched'];
			$event->description = 		$data['description'];
			$event->price = 			$data['event_fee'];
			$event->event_capacity = 	$data['event_capacity'];
			$event->latitude = 			$data['latitude'];
			$event->longitude = 		$data['longitude'];
			if($request->hasFile('image')){
				$image_tmp = Input::file('image');
				if($image_tmp->isValid()){
					$extension = $image_tmp->getClientOriginalExtension();
					$filename = rand(111,99999).'.'.$extension;
					$large_image_path = 'images/backend_images/events/large/'.$filename;
					$medium_image_path = 'images/backend_images/events/medium/'.$filename;
					$small_image_path = 'images/backend_images/events/small/'.$filename;

					Image::make($image_tmp)->save($large_image_path);
					Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
					Image::make($image_tmp)->resize(300,300)->save($small_image_path);

					$event->image = $filename;
				}
			}

			$event->save();
			// return redirect()->back()->with('flash_message_success','Event added Successfully!');
			if(Auth::user()->admin == 2){
				return redirect('/admin/view-event')->with('flash_message_success','Event added Successfully!');
			}if(Auth::user()->admin == 1){
				return redirect('/owner/view-event')->with('flash_message_success','Event added Successfully!');
			}
		}
		$categories = Category::where(['parent_id'=>0])->get();
		$categoriesdd = "<option selected disabled>Select</option>";
		foreach ($categories as $cat) {
			$categoriesdd .= "<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_category = Category::where(['parent_id'=>$cat->id])->get();
			foreach ($sub_category as $sub_cat) {
				$categoriesdd .= "<option value ='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
		if(Auth::user()->admin == 2){
			return view('admin.events.add_event')->with(compact('categoriesdd'));
		}if(Auth::user()->admin == 1){
			return view('owner.events.add_event')->with(compact('categoriesdd'));
		}
	}

	public function approveApproved($id = null){
		Event::where(['id'=>$id])->update(['status'=>'1']);
		return redirect()->back()->with('flash_message_success','Approved');
	}

	public function editEvent(Request $request, $id = null){
		if($request->isMethod('post')){
			$data = $request->all();
    		// echo "<pre>"; print_r($data); die;

			if($request->hasFile('image')){
				$image_tmp = Input::file('image');
				if($image_tmp->isValid()){
					$extension = $image_tmp->getClientOriginalExtension();
					$filename = rand(111,99999).'.'.$extension;
					$large_image_path = 'images/backend_images/events/large/'.$filename;
					$medium_image_path = 'images/backend_images/events/medium/'.$filename;
					$small_image_path = 'images/backend_images/events/small/'.$filename;

					Image::make($image_tmp)->save($large_image_path);
					Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
					Image::make($image_tmp)->resize(300,300)->save($small_image_path);
				}
			}else{
				$filename = $data['current_image'];
			}


			Event::where(['id'=>$id])->update([
				'category_id'=>		$data['category_id'],
				'event_name'=>	$data['event_name'],
				'event_address'=>	$data['event_address'],
				'event_schedule'=>	$data['event_sched'],
				'description'=>		$data['description'],
				'price'=>			$data['event_fee'],
				'event_capacity'=>	$data['event_capacity'],
				'image'=> 			$filename,
				'status'=> 			$data['status'],
			]);
			if(Auth::user()->admin == 2){
				return redirect('/admin/view-event')->with('flash_message_success','Event updated Successfully!');
			}if(Auth::user()->admin == 1){
				return redirect('/owner/view-event')->with('flash_message_success','Event updated Successfully!');
			}
		}

		$EventDetails = Event::where(['id'=>$id])->first();

		$categories = Category::where(['parent_id'=>0])->get();
		$categoriesdd = "<option selected disabled>Select</option>";
		foreach ($categories as $cat) {
			if($cat->id == $EventDetails->category_id){
				$selected = "selected";
			}else{
				$selected = "";
			}

			$categoriesdd .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
			$sub_category = Category::where(['parent_id'=>$cat->id])->get();
			foreach ($sub_category as $sub_cat) {
				if($sub_cat->id == $EventDetails->category_id){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$categoriesdd .= "<option value ='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
		return view('admin.events.edit_event')->with(compact('EventDetails','categoriesdd'));
	}

	public function viewEvent(Request $request){
		$events = Event::get();
		foreach ($events as $key => $val) {
			$category_name = Category::where(['id'=>$val->category_id])->first();
			$events[$key]->category_name = $category_name->name;
		}
		if(Auth::user()->admin == 2){
			return view('admin.events.view_events')->with(compact('events'));
		}if(Auth::user()->admin == 1){
			return view('owner.events.view_events')->with(compact('events'));
		}

	}

	public function deleteEvent($id = null){
		Event::where(['id'=>$id])->delete();
		return redirect()->back()->with('flash_message_success','Event has been deleted Successfully!');
	}

	public function deleteEventImage($id = null){
		Event::where(['id'=>$id])->update(['image'=>'']);
		return redirect()->back()->with('flash_message_success','Event image has been deleted Successfully!');
	}

	public function events($url = null){

		$categoryDetails = Category::where(['url' => $url])->first();
		$categoriesAll = Category::where(['parent_id'=>0])->get();
		$eventsAll = Event::where(['category_id' => $categoryDetails->id])->get();
		return view('events.listing')->with(compact('categoryDetails','categoriesAll','eventsAll'));
	}

	public function event($id = null){
		$categoriesAll = Category::where(['parent_id'=>0])->get();
        // Event detail
		$eventDetails = Event::where(['id'=>$id])->first();
        // dd($eventDetails); exit;
		return view('events.detail')->with(compact('eventDetails','categoriesAll'));
	}
}
