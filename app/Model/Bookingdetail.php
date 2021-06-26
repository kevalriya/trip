<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bookingdetail extends Model
{
     protected $table = 'tkt_booking_details';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'BOOKING_DETAILS_ID';
    protected $fillable = ['BOOKING_DETAILS_ID', 'BOOKING_ID', 'PASSENGER_SEATNO', 'PASSENGER_FIRSTNAME', 'PASSENGER_LASTNAME', 'PASSENGER_AGE', 'PASSENGER_GENDER', 'PROCESSED_DATE', 'TICKETNO_PRICE', 'INSURANCE', 'BARCODE', 'INSURANCE_PRICE', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'];



}
