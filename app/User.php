<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //const CREATED_AT = 'MOD_BY';
   // const UPDATED_AT = 'MOD_DT';
    public $timestamps = false;

    protected $primaryKey = 'USER_ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'USER_ID','USER_TYPE_CODE', 'SALUTATION_ID', 'FIRSTNAME', 'MIDDLENAME', 'SURNAME', 'IMAGE', 'ADDRESS_LINE_1', 'ADDRESS_LINE_2', 'CITY', 'LGA_HASC', 'STATE_CODE', 'COUNTRY_ID', 'PHONE_NUMBER1', 'PHONE_NUMBER_COUNTRY','password', 'PASSWORD_RESET_TOKEN','MOBILE_PHONE', 'SMS_SUBSCRIBE', 'EMAIL_ADDRESS', 'EMAIL_SUBSCRIBE','EMAIL_VALID_FLAG', 'USER_SIGNUP_DATE',  'GENDER_FLAG', 'MARITAL_STATUS', 'DATE_OF_BIRTH', 'EDUCATIONAL_LEVEL', 'NEXT_OF_KIN', 'NEXT_OF_KIN_PHONE', 'ACTIVE_INDICATOR','REMEMBER_TOKEN', 'CREATE_BY', 'CREATE_DT'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'PASSWORD_RESET_TOKEN',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

        public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->CREATE_DT = $model->freshTimestamp();
        });
    }
}
