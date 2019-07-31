<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CurrencyController extends Controller
{

    public function __construct()
    {
        $this->currency = new Currency();
        
    }
    
    public function index()
    {        
        return view('backend.currency.index');
    }

    public function source(){
        $query= Currency::query();
        return DataTables::eloquent($query)
            ->filter(function ($query) {
                if (request()->has('search')) {
                    $query->where('name', 'LIKE', '%' . request('search')['value'] . '%')
                    ->orWhere('country_name', 'LIKE', '%' . request('search')['value'] . '%');
                }
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('country_name', function ($data) {
                return str_limit($data->country_name,80);
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.currency.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.currency.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $cek_slug = $this->currency->whereSlug(str_slug($request->name));
            if($cek_slug->get()->count() == 0){
                $this->currency->create($request->all());
                DB::commit();
                return redirect()->route('currency.index')->with('success-message','Data telah disimpan');
            }else{
                return redirect()->back()->with('error-message','Maaf Currency <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Currency Lain');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->currency->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->currency->find($id);
        return view('backend.currency.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $currency = $this->currency->find($id); //find currency
            $cek_slug = $this->currency->whereSlug(str_slug($request->name));//cek currency by slug name
            $request->merge(['slug'=>str_slug($request->name)]);            //merging slug request           
            if($cek_slug->get()->count() > 0){
                if($currency->slug == $request->slug){
                    $this->currency->find($id)->update($request->all());
                    DB::commit();
                    return redirect()->route('currency.index')->with('success-message','Data telah dirubah');
                }else{
                    return redirect()->back()->with('error-message','Maaf Currency <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Currency Lain');    
                }                    
            }else{
                $this->currency->find($id)->update($request->all());
                DB::commit();
                return redirect()->route('currency.index')->with('success-message','Data telah dirubah');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->currency->destroy($id);
        return redirect()->route('currency.index')->with('success-message','Data telah dihapus');
    }

    public function get($id){
        $data = $this->currency->find($id);
        return response()->json($data);
    }

    public function getUnit(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->currency->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }


}
