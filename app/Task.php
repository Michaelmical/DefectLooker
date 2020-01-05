<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'task';

    protected $primaryKey = 'task_id';

    protected $fillable = ['task_id', 'name', 'inc_type', 'severity', 'started_at', 'completed_at', 'emp_id', 'build_id'];
}
