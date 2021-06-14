<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    //
    protected $table = "PAGE_NOTES";
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'title', 'description'];
}
