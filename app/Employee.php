<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employee';
    protected $primaryKey = 'emp_id';
    public  function user()
    {
        return $this->hasOne(User::class);
    }
}
