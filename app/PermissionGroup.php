<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    //
    protected $table = 'permissiongroup';
    protected $primaryKey = 'grp_id';
    protected $fillable = ['type'];
}
