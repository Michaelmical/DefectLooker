<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointsItem extends Model
{
    //
    protected $table = 'pointsitem';
    protected $primaryKey = 'pointsitem_id';
    protected $fillable = ['name', 'task_id', 'itemcriteria_id'];
}
