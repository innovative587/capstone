<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','IndexController@index');

Route::match(['get','post'], '/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/events/{url}','EventController@events');

Route::get('event/{id}','EventController@event');

Route::get('/login','UsersController@userLoginRegister');

Route::match(['get','post'],'/user-register','UsersController@register');

Route::get('/confirm/{code}','UsersController@confirmAccount');

Route::post('user-login','UsersController@login');

Route::get('/user-logout','UsersController@logout');

Route::get('search', 'IndexController@search');

Route::match(['get','post'],'/contact-us','IndexController@contact');

Route::group(['middleware'=>['frontlogin']],function(){
	Route::match(['get','post'],'account','UsersController@account');
	Route::match(['get','post'],'account/edit-profile','UsersController@editAccount');
	Route::match(['get','post'],'user-details/{user_id}','UsersController@userDetails');
	Route::get('/messages','UsersController@messages');
	Route::get('/messages/sent-messages','UsersController@sentMessages');
	Route::get('/messages/delete-message/{id}','UsersController@deleteMessage');
	Route::get('/my-reservations','ReservationController@myReservation');
	Route::match(['get','post'],'schedule-a-trip/{id}','ReservationController@schedATrip');
	Route::match(['get','post'],'/tripping','ReservationController@sched');
	Route::post('/check-user-pwd','UsersController@chkUserPassword');
	// Itinerary
	Route::get('/itinerary','ItineraryController@userViewItinerary');
	Route::match(['get','post'],'/add-people','ItineraryController@addPeople');
	Route::match(['get','post'],'/group-itinerary/{start_date}','ItineraryController@groupItinerary');
	Route::match(['get','post'],'/itinerary/{session_id}','ItineraryController@userViewItineraryDetails');
	Route::match(['get','post'],'/cancel-reservation/{session_id}','ItineraryController@cancelRes');
	// Cart
	Route::match(['get','post'],'/trip','ItineraryController@cart');
	Route::get('/trip/delete-trip/{id}','ItineraryController@deleteUserTrip');
	Route::match(['get','post'],'/add-trip','ItineraryController@addtocart');
	Route::match(['get','post'],'/payment','ItineraryController@payment');
});	

 Route::match(['GET','POST'],'/login-register','UsersController@register');

Route::match(['GET','POST'],'/check-email','UsersController@checkEmail');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'], '/admin/update-pwd','AdminController@updatePassword');
	Route::match(['get','post'],'/make-owner/{id}','AdminController@makeOwner');
	//Categories Routes (Admin)
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
	Route::get('/admin/view-categories','CategoryController@viewCategories');
	// Events Routes (Admin)
	Route::match(['get','post'],'/admin/add-event','EventController@addEvent');
	Route::match(['get','post'],'/admin/edit-event/{id}','EventController@editEvent');	
	Route::get('/admin/view-event','EventController@viewEvent');
	Route::get('/admin/delete-event/{id}','EventController@deleteEvent');
	Route::get('/admin/delete-event-image/{id}','EventController@deleteEventImage');
	// Reservations Routes (Admin)
	Route::get('/admin/view-reservation','ReservationController@viewReservation');
	Route::match(['get','post'],'/admin/approve-event/{id}','EventController@approveApproved');
	Route::match(['get','post'],'/admin/approve-reservation/{id}','ReservationController@approveRes');
	Route::get('/admin/delete-reservation/{id}','ReservationController@deleteReservation');
	// Manage Users Toutes (Admin)
	Route::get('/admin/view-user','UsersController@viewUser');
	Route::get('/admin/delete-user/{id}','UsersController@deleteUser');
	// Itinerary
	Route::match(['get','post'],'/admin/create-itinerary','ItineraryController@createItinerary');
	route::get('/admin/view-itinerary','ItineraryController@viewItinerary');
	// PDF
	Route::get('/admin/itinerary-review/{reservation_id}','ItineraryController@itineraryReview');
});

Route::group(['middleware'=>['auth','ownerlogin']],function(){
	// Owner
	Route::get('/owner/dashboard','AdminController@dashboard');
	Route::get('owner/settings','AdminController@settings');
	Route::get('/owner/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'], '/owner/update-pwd','AdminController@updatePassword');
	// Events Routes (Owner)
	Route::match(['get','post'],'/owner/add-event','EventController@addEvent');
	Route::match(['get','post'],'/owner/edit-event/{id}','EventController@editEvent');	
	Route::get('/owner/view-event','EventController@viewEvent');
	Route::get('/owner/delete-event/{id}','EventController@deleteEvent');
	Route::get('/owner/delete-event-image/{id}','EventController@deleteEventImage');
	// Reservations Routes (Owner)
	Route::get('/owner/view-reservation','ReservationController@viewReservation');
	Route::match(['get','post'],'/owner/approve-reservation/{id}','ReservationController@approveApproved');
});

Route::get('/logout','AdminController@logout');


