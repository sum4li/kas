<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Unit extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'units';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','description'];
    public $incrementing = false;

}
