<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Invoice extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'invoices';
    protected $dates = ['deleted_at'];
    protected $fillable = ['invoice_number','invoice_to_id','issue_date','due_date','status'];
    public $incrementing = false;

    public function invoice_to()
    {
        return $this->belongsTo('App\Customer');
    }

}
