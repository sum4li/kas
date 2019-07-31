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
    protected $fillable = ['shipper_id','consignee_id','notify_id','agent_id','job_number','billing_number','transaction_type','cargo_type','etd','eta','origin','mbl','hbl','bc11','bc23','pos','sub_pos','location','delivery','warehouse','pol','pod','vessel','voyage','spj_number','trucking','driver','car_number','manager','staff_operasional','salesman','status','invoice_id'];
    public $incrementing = false;

    public function shipper()
    {
        return $this->belongsTo('App\Customer');
    }

    public function consignee()
    {
        return $this->belongsTo('App\Customer');
    }

    public function notify()
    {
        return $this->belongsTo('App\Customer');
    }

    public function agent()
    {
        return $this->belongsTo('App\Customer');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
