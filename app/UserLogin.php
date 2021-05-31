<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    //
    protected $table = "user_login";
    public $timestamps = false;
    protected $primaryKey = 'USER_LOGIN_ID';
    protected $fillable = [
        'USER_LOGIN_ID', 'USER_ID', 'USERNAME', 'USERNAME_HOST', 'USER_STATUS_CODE', 'LOGIN_TIMESTAMP', 'LOGIN_DEVICE_IP', 'LOGIN_DEVICE_IMEI', 'LOGIN_DEVICE_OS', 'LOGIN_DEVICE_BROWSER', 'LOGIN_DEVICE_BROWSER_VRSN', 'LOGIN_LOCATION', 'LOGIN_LOCATION_GEO_COORD', 'LOGIN_FAILURE_DATE', 'LOGOUT_TIMESTAMP', 'FAILCOUNT', 'LOCKOUTTIME', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT'
    ];
}
