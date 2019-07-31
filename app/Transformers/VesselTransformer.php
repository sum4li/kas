<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transaction;

class VesselTransformer extends TransformerAbstract
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
            'name'=>$transaction->vessel
        ];
    }
}
