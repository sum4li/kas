<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;

class DriverTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        // $data = $transaction->
        return [
            'name'=>$transaction->driver
        ];
    }
}
