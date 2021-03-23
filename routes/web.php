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


Auth::routes(['verify' => true]);
Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::post('/user-reset-password', 'Auth\ResetMyPassController@resetPass')->name('reset_pass');
Route::post('/update-reset-password', 'Auth\ResetMyPassController@updatePass')->name('set_pass');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','HomeController@index')->name('admin.home');
	// Users Routes
	Route::resource('admin/operator','OperatorController');
	Route::resource('admin/user','UserController');
	Route::resource('admin/route','RouteController');
	Route::resource('admin/amenitie','AmenitieController');
	Route::resource('admin/fleet','FleetController');

	Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');
	Route::post('admin-login', 'Auth\LoginController@login');
	Route::post('admin/operatorData', 'OperatorController@OperatorLists')->name('operatorData');
	Route::post('admin/userData', 'UserController@userLists')->name('userData');
	Route::post('admin/routesData', 'RouteController@RouteLists')->name('routesData');
	Route::post('admin/add-route', 'AjaxController@addRoute')->name('addRoute');
	Route::post('admin/add-amenitie', 'AjaxController@addAmenitie')->name('addAmenitie');
	Route::post('admin/city-json', 'AjaxController@getCityJson')->name('getCityJson');
	
	Route::post('admin/edit-route', 'AjaxController@editRoute')->name('editRoute');
	Route::post('admin/edit-amenitie', 'AjaxController@editAmenitie')->name('editAmenitie');

	Route::post('admin/add-route-point', 'RouteController@addRoutePoint')->name('addRoutePoint');

	Route::get('admin/routepoint/{id}', 'RouteController@routePoint')->name('routepoint');
	Route::get('admin/routedetail/{id}', 'RouteController@routeDetail')->name('routedata');
	//fleet
	
	Route::get('admin/fleet-parent-type','FleetController@parentType')->name('parentType');

	Route::get('admin/faq','FleetController@FAQ')->name('admin.faq');
	Route::get('admin/faq-edit/{id}','FleetController@editFaq')->name('editfaq');
	Route::put('admin/faq-edit/{id}','FleetController@updateFaq')->name('updatefaq');
	Route::get('admin/faq-add','FleetController@addfaq')->name('addfaq');
	Route::post('admin/faq-add','FleetController@insertfaq')->name('insertfaq');
	Route::delete('admin/faq-delete/{id}','FleetController@faqDelete')->name('faqdelete');

	Route::delete('admin/deleteparent/{id}','FleetController@parentTypeDelete')->name('fleetparent.destroy');

	Route::post('admin/deletePoint/','RouteController@deletePoint')->name('deletePoint');
	Route::delete('admin/deleteftype/{id}','FleetController@fleetTypeDelete')->name('fleetType.destroy');
	Route::get('admin/fleet-type','FleetController@fleetType')->name('fleetType');
	Route::get('admin/fleet-type/edit/{id}','FleetController@editFleetType')->name('editFleetType');

Route::put('admin/fleet-type/edit/{id}','FleetController@updateFleetType')->name('updateFleetType');

	Route::get('admin/fleet-type/create','FleetController@addFleetType')->name('createFleetType');

	Route::post('admin/fleet-type/create','FleetController@createFleetType')->name('addFleetType');
	Route::post('admin/fleet-data','FleetController@fleetsLists')->name('fleetsData');

	Route::post('admin/add-fleet-parent', 'AjaxController@addFleetParent')->name('addFleetParent');
	Route::post('admin/edit-fleet-parent', 'AjaxController@editFleetParent')->name('editFleetParent');

	Route::resource('admin/seat','SeatController');
	Route::post('admin/seatData', 'SeatController@seatLists')->name('seatData');
	Route::get('admin/seatMap/{id}', 'SeatController@addseatMap')->name('addseatMap');

	Route::resource('admin/trip','TripController');

	Route::get('admin/trip-fare/edit/{id}','TripController@editTripFare')->name('editTripFare');
	Route::put('admin/trip-fare/edit/{id}','TripController@updateTripFare')->name('updateTripFare');


	Route::get('admin/trip-time/edit/{id}','TripController@editTripTime')->name('editTripTime');
	Route::put('admin/trip-time/edit/{id}','TripController@updateTripTime')->name('updateTripTime');
	
	Route::get('admin/trip-schedule/edit/{id}','TripController@editTripschedule')->name('editTripschedule');
	Route::put('admin/trip-schedule/edit/{id}','TripController@updateTripschedule')->name('updateTripschedule');


	Route::resource('admin/city','CityController');
	Route::post('admin/tripData', 'TripController@tripLists')->name('tripData');
	Route::post('admin/cityData', 'CityController@cityLists')->name('cityData');

	Route::post('admin/ticket-price', 'TicketController@getTicketPoint')->name('getPoints');

	Route::resource('admin/assigntrip','AssigntripController');
	Route::post('admin/assigntripData', 'AssigntripController@assignLists')->name('assigntripData');

	Route::get('admin/start-trip/{id}', 'AssigntripController@startTrip')->name('startTrip');
	Route::get('admin/end-trip/{id}', 'AssigntripController@endTrip')->name('endTrip');
	
	Route::put('admin/start-trip/{id}', 'AssigntripController@editstartTrip')->name('editstartTrip');
	Route::put('admin/end-trip/{id}', 'AssigntripController@editendTrip')->name('editendTrip');

	Route::post('admin/getState', 'AjaxController@getState')->name('getState');
	Route::post('admin/getlga', 'AjaxController@getLGA')->name('getlga');
	Route::post('admin/getcity', 'AjaxController@getCity')->name('getCity');
	Route::post('admin/getseat', 'AjaxController@getSeat')->name('getSeat');
	Route::post('admin/getroute', 'AjaxController@getRoute')->name('getRoute');
	
	Route::resource('admin/booking','BookingController');
	Route::post('get-booking','BookingController@Lists')->name('getbooking');
	Route::post('update-booking','BookingController@updateMultiBooking')->name('updatemultistatus');
});


// operator
Route::group(['namespace' => 'Operator','prefix'=>'operator'],function(){
	Route::get('home','HomeController@index')->name('operator.home');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('operator.login');
	Route::post('logout', 'Auth\LoginController@logout')->name('operator.logout');
	Route::post('login', 'Auth\LoginController@login');

	//routes
	Route::resource('route','RouteController',[
    'as' => 'operator']);
	Route::post('routesData', 'RouteController@RouteLists')->name('oproutesData');
	Route::post('add-route', 'AjaxController@addRoute')->name('opaddRoute');
	Route::post('edit-route', 'AjaxController@editRoute')->name('opeditRoute');
	Route::get('routedetail/{id}', 'RouteController@routeDetail')->name('oproutedata');
	Route::get('routepoint/{id}', 'RouteController@routePoint')->name('oproutepoint');
	Route::post('add-route-point', 'RouteController@addRoutePoint')->name('opaddRoutePoint');
	Route::post('city-json', 'AjaxController@getCityJson')->name('opgetCityJson');
	Route::post('deletePoint/','RouteController@deletePoint')->name('opdeletePoint');

	//fleets
	Route::get('fleet-type','FleetController@fleetType')->name('opfleetType');
	Route::get('fleet-type/edit/{id}','FleetController@editFleetType')->name('opeditFleetType');
	Route::put('fleet-type/edit/{id}','FleetController@updateFleetType')->name('opupdateFleetType');
	Route::get('fleet-type/create','FleetController@addFleetType')->name('opcreateFleetType');
	Route::post('fleet-type/create','FleetController@createFleetType')->name('opaddFleetType');
	Route::delete('deleteftype/{id}','FleetController@fleetTypeDelete')->name('opfleetType.destroy');
	Route::get('seatMap/{id}', 'SeatController@addseatMap')->name('opaddseatMap');

	Route::resource('seat','SeatController',[
    'as' => 'operator']);
    Route::resource('fleet','FleetController',[
    'as' => 'operator']);

	Route::post('seatData', 'SeatController@seatLists')->name('opseatData');
	Route::post('fleet-data','FleetController@fleetsLists')->name('opfleetsData');

	//trip

	Route::resource('trip','TripController',[
    'as' => 'operator']);

	Route::get('trip-fare/edit/{id}','TripController@editTripFare')->name('opeditTripFare');
	Route::put('trip-fare/edit/{id}','TripController@updateTripFare')->name('opupdateTripFare');


	Route::get('trip-time/edit/{id}','TripController@editTripTime')->name('opeditTripTime');
	Route::put('trip-time/edit/{id}','TripController@updateTripTime')->name('opupdateTripTime');
	
	Route::get('trip-schedule/edit/{id}','TripController@editTripschedule')->name('opeditTripschedule');
	Route::put('trip-schedule/edit/{id}','TripController@updateTripschedule')->name('opupdateTripschedule');
	Route::post('tripData', 'TripController@tripLists')->name('optripData');
	Route::post('getseat', 'AjaxController@getSeat')->name('opgetSeat');

	Route::resource('assigntrip','AssigntripController',[
    'as' => 'operator']);
		Route::get('start-trip/{id}', 'AssigntripController@startTrip')->name('opstartTrip');
	Route::get('end-trip/{id}', 'AssigntripController@endTrip')->name('opendTrip');
	
	Route::put('start-trip/{id}', 'AssigntripController@editstartTrip')->name('opeditstartTrip');
	Route::put('end-trip/{id}', 'AssigntripController@editendTrip')->name('opeditendTrip');

	Route::resource('operator/booking','BookingController',[
    'as' => 'operator']);
	Route::post('operator-get-booking','BookingController@Lists')->name('opgetbooking');
	Route::post('operator-update-booking','BookingController@updateMultiBooking')->name('opupdatemultistatus');
});

	

	 //front route
 Route::post('get-city', 'AjaxController@getCities')->name('getCities');

 Route::get('contact-us', function () {
    return view('front.contact-us');
}); 
 Route::get('bus-etiquette', function () {
    return view('front.BusEtiquette');
}); 
 Route::get('about', function () {
    return view('front.about');
});
 Route::get('maintenance', function () {
    return view('front.maintenance');
});
 Route::get('reset-password', function () {
    return view('front.resetpassword');
});

 Route::get('reset-operator-password', function () {
    return view('front.resetoppassword');
});

 Route::post('contact-us-req', 'AjaxController@sendContactMail')->name('sendContact');
 
 Route::get('bank-transfer', function () {
    return view('front.bank-transfer');
});

 Route::get('search-result', 'HomeController@searchResult')->name('searchResult');
 Route::post('search-res', 'HomeController@searchRes')->name('searchRes');

 Route::post('login_response', 'Auth\LoginController@login')->name('login_response');
 Route::post('op_login_response', 'Operator\Auth\LoginController@opAjaxLogin')->name('op_login_response');
 Route::post('reg_response', 'Auth\RegisterController@signupUser')->name('reg_response');
 Route::post('op-register', 'Auth\OperatorRegisterController@signupUser')->name('op_reg_response');

 // login
 Route::get('user-login', 'Auth\LoginController@showLoginForm')->name('user.login');
 Route::post('user-logout', 'Auth\LoginController@logout')->name('user.logout');

 Route::get('user-register', 'Auth\RegisterController@showRegistrationForm')->name('user.reg');
 Route::get('operator-register', 'Auth\OperatorRegisterController@showOperatorRegistrationForm')->name('operator.reg');
 Route::post('seat-map', 'HomeController@seatMap')->name('seatmap');
 Route::post('route-detail', 'HomeController@routeDetail')->name('routeDetail');
 Route::match(['get', 'post'],'bus-booking', 'HomeController@busBooking')->name('busBooking');


 Route::post('booking-payment', 'AjaxController@bookingPayment')->name('bookingPayment');
 Route::post('refresh-token', 'AjaxController@refreshToken');
 Route::get('faq', 'HomeController@faq')->name('user.faq');
 Route::view('unsuccess-payment', 'front.unsuccess-payment')->name('unsuccesspay');
 Route::view('success-payment', 'front.success-payment')->name('successpay');


// for front
Route::group([ 'middleware' => 'auth:web'], function()
{
 Route::get('booking-history', 'UserBookingController@index')->name('bookinghistory');
 Route::get('booking-detail/{id}', 'UserBookingController@show')->name('showubooking');
 Route::get('profile-setting', 'HomeController@profileSetting')->name('profileSetting');
 Route::post('profile-setting', 'AjaxController@userprofile')->name('userprofile');
 Route::get('change-password', 'HomeController@changePassword')->name('changePassword');
 Route::post('change-password', 'AjaxController@updatePassword')->name('updatePassword');

Route::post('user-profile-booking-history', 'UserBookingController@Lists')->name('bookingData');

//Route::post('admin/user-profile-booking-history', 'HomeController@bookingLists')->name('bookingData');


});

	Route::post('getState', 'AjaxController@getState')->name('front.getState');
	Route::post('getlga', 'AjaxController@getLGA')->name('front.getlga');
	Route::post('getcity', 'AjaxController@getCity')->name('front.getCity');

	//payment
	Route::post('/pay', 'RaveController@initialize')->name('pay');
	Route::get('/rave/callback', 'RaveController@callback')->name('callback');