<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class TransactionCharge extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'transaction_charges';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'transaction_id',
        'code',
        'name',
        'slug',
        'rates',
        'tax_status',
        'currency_id',
        'selling_idr',
        'selling_usd',
        'buying_idr',
        'buying_usd',
        'debit_note_idr',
        'debit_note_usd',
        'credit_note_idr',
        'credit_note_usd'
    ];
    public $incrementing = false;

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
