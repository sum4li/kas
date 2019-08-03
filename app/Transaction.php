<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Transaction extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'transactions';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug','description','transaction_type','transaction_date','images','amount'];
    public $incrementing = false;
    
    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
