<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCriteria extends Model
{
    protected $table = 'itemcriteria';
    protected $primaryKey = 'itemcriteria_id';
    protected $fillable = ['complex_id'];
}
