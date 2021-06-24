<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'tkt_booking';

    const CREATED_AT = 'CREATE_DT';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'BOOKING_ID';
    protected $fillable = ['BOOKING_ID', 'USER_ID', 'BUS_ID', 'TRIP_ID', 'ROUTE_ID', 'BOARDING_POINT', 'DROPOFF_POINT', 'PROCESSED_DATE','OPERATOR_CODE', 'EMAIL', 'PHONE_NUMBER', 'FLW_REF', 'TX_REF', 'TRANSACTION_ID', 'PRICE', 'DISCOUNT', 'ADULT', 'CHILD', 'SPECIAL', 'TOTAL_SEAT_BOOKED', 'SEAT_NUMBERS', 'OFFER_CODE', 'SUB_TOTAL', 'TAX', 'TOTAL', 'BOOKING_METHOD', 'PAYMENT_METHOD', 'STATUS', 'PAYMENT_STATUS', 'AGENT_ID', 'CCARD_TYPE', 'CCARD_NUM', 'CCARD_EXP', 'CCARD_CODE', 'TRAVEL_INS_FLAG', 'TRAVEL_INS_OPTION', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];


    public function user()
    {
        return $this->belongsTo('App\User','USER_ID');
    }

    public function bus()
    {
        return $this->belongsTo(Fleet::class,'BUS_ID');
    }
  	
  	public function trip()
    {
        return $this->belongsTo(Trip::class,'TRIP_ID');
    }
	
  	public function route()
    {
        return $this->belongsTo(Route::class,'ROUTE_ID');
    }

    public function bookingDetails()
    {
        return $this->hasMany(Bookingdetail::class,'BOOKING_ID');
    }


}
