<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Currency extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'currencies';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','country_name'];
    public $incrementing = false;

}
