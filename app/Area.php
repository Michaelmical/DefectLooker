<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $table = 'area';
    protected $primaryKey = 'area_id';
    protected $fillable = ['descr'];
}
