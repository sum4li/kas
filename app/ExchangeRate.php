<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class ExchangeRate extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'exchange_rates';
    protected $dates = ['deleted_at'];
    protected $fillable = ['exchange_from_id','exchange_to_id','rates'];
    public $incrementing = false;

    public function exchange_from()
    {
        return $this->belongsTo('App\Currency');
    }

    public function exchange_to()
    {
        return $this->belongsTo('App\Currency');
    }

}
