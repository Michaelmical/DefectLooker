<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defects extends Model
{
    //
    protected $table = 'defects';
    protected $primaryKey = 'defects_id';
    protected $fillable = ['orig_ref_id', 'task_id', 'defect_type_id', 'defect_cause_id', 'area_category', 'remarks'];
}
