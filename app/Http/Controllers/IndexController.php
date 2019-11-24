<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Transaction;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function index(){
        $transaction  = $this->transaction;  
        $income_transaction =$this->transaction->where('transaction_type','income')->get();
        $expense_transaction =$this->transaction->where('transaction_type','expense')->get();
        $saldo = $income_transaction->sum('amount') - $expense_transaction->sum('amount');
        return view('backend.component.index',compact(['transaction','income_transaction','expense_transaction','saldo']));
    }

    


}
