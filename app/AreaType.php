<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaType extends Model
{
    protected $table = 'areatype';
    protected $primaryKey = 'areatype_id';
    protected $fillable = ['descr', 'area_id'];
}
