<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Customer extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','address','email','phone_number','fax','tax_number'];
    public $incrementing = false;

}
