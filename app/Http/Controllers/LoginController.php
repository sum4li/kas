<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Transaction;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('backend.component.login');
    }

    public function dashboard(){
        
        
        $transaction  = $this->transaction;  
        $income_transaction =$this->transaction->where('transaction_type','income')->get();
        $expense_transaction =$this->transaction->where('transaction_type','expense')->get();
        $saldo = $income_transaction->sum('amount') - $expense_transaction->sum('amount');

        return view('backend.dashboard.index',compact(['transaction','income_transaction','expense_transaction','saldo']));
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
    //         $request->session()->flash('success-message', 'Maaf Username atau Password anda salah');
    //     }else{
    //         $request->session()->flash('error-message', 'Maaf Username atau Password anda salah');
    //     }
    // }

}
