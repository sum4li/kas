<?php

namespace App\Http\Controllers;

use App\ExchangeRate;
use App\Currency;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ExchangeRateController extends Controller
{


    public function __construct()
    {
        $this->exchangeRate = new ExchangeRate();
        $this->currency = new Currency();
    }

    public function index()
    {
        $usd = $this->currency->where('slug','usd')->get()->first();
        $idr = $this->currency->where('slug','idr')->get()->first();
        // rate dari usd to idr
        $rates = $this->exchangeRate
        ->whereDate('created_at',date('Y-m-d'))
        ->where('exchange_from_id',$usd->id)
        ->get();

        $rates = $rates->count() > 0 ? $rates->first()->rates : 0;        
        return view('backend.exchangeRate.index',compact(['usd','idr','rates']));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $cek = $this->exchangeRate->whereDate('created_at',date('Y-m-d'))->get()->count();
            if($cek > 0){
                // change usd to idr rates
                $this->exchangeRate->whereDate('created_at',date('Y-m-d'))
                ->where('exchange_from_id',$request->exchange_from_id)
                ->update([
                    'exchange_from_id'=>$request->exchange_from_id,
                    'exchange_to_id'=> $request->exchange_to_id,
                    'rates'=>$request->idr                    
                ]);
                
            }else{
                // create usd to idr
                $this->exchangeRate->create([
                    'exchange_from_id'=>$request->exchange_from_id,
                    'exchange_to_id'=> $request->exchange_to_id,
                    'rates'=>$request->idr
                ]);                
            }            
            DB::commit();
            return redirect()->back()->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->exchangeRate->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->exchangeRate->find($id);
        return view('backend.exchangeRate.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=>$request->name]);
            $this->exchangeRate->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('exchangeRate.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->exchangeRate->destroy($id);
        return redirect()->route('exchangeRate.index')->with('success-message','Data telah dihapus');
    }

    public function getExchangeRate(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->exchangeRate->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }

    private function checkRate($date){
        $check = $this->exchangeRate->whereDate('created_at',$date)->get();
        
    }

}
