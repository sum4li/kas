<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class TransactionContainer extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'transaction_containers';
    protected $dates = ['deleted_at'];
    protected $fillable = ['container_number','seal_number','size','qty','weight','measurement','unit_id','transaction_id','commodity','facility'];
    public $incrementing = false;

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

}
