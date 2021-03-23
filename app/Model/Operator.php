<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Operator extends Authenticatable
{
   

    protected $table = 'operator';

    const CREATED_AT = 'MOD_BY';
    const UPDATED_AT = 'MOD_DT';
    protected $primaryKey = 'OPERATOR_CODE';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'OPERATOR_LEGAL_NAME', 'OPERATOR_SHORT_NAME', 'OPERATOR_WEBSITE', 'MAIN_CONTACT_TITLE', 'MAIN_CONTACT_FIRSTNAME', 'MAIN_CONTACT_LASTNAME', 'MAIN_CONTACT_ADDRESS', 'MAIN_CONTACT_CITY', 'MAIN_CONTACT_LGA', 'MAIN_CONTACT_STATE', 'MAIN_CONTACT_COUNTRY', 'MAIN_CONTACT_PHONE1', 'MAIN_CONTACT_PHONE2', 'MAIN_CONTACT_EMAIL', 'OPERATOR_SIGNUP_DATE', 'PASSWORD', 'FLEET_PHOTO', 'FLEET_SIZE', 'PREFERRED_ROUTES', 'ACTIVE_INDICATOR', 'CREATE_BY', 'CREATE_DT', 'MOD_BY', 'MOD_DT','REMEMBER_TOKEN'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'PASSWORD'
    ];

     public function route()
    {
      
        return $this->hasOne('App\Model\Route');
    }

    public function Fleet()
    {
      
        return $this->hasOne('App\Model\Fleet');
    }
}
