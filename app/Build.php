<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $table = 'build';
    protected $primaryKey = 'build_id';
    protected $fillable = ['proj_id', 'sp_id', 'version_id', 'drop_id', 'descr'];
}
