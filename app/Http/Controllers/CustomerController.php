<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CustomerController extends Controller
{

    public function __construct()
    {
        $this->customer = new Customer();
        
    }
    
    public function index()
    {        
        return view('backend.customer.index');
    }

    public function source(){
        $query= Customer::query();
        return DataTables::eloquent($query)
            ->filter(function ($query) {
                if (request()->has('search')) {
                    $query->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                }
            })
            ->addColumn('name', function ($data) {
                return str_limit(title_case($data->name),35);
            })
            ->addColumn('address', function ($data) {
                return str_limit(title_case($data->address),70);
            })
            ->addColumn('email', function ($data) {
                return title_case($data->email);
            })
            ->addColumn('phone_number', function ($data) {
                return title_case($data->phone_number);
            })
            ->addColumn('fax', function ($data) {
                return title_case($data->fax);
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.customer.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $cek_slug = $this->customer->whereSlug(str_slug($request->name));
            if($cek_slug->get()->count() == 0){
                $this->customer->create($request->all());
                DB::commit();
                return redirect()->route('customer.index')->with('success-message','Data telah disimpan');
            }else{
                return redirect()->back()->with('error-message','Maaf Customer <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Customer Lain');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->customer->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->customer->find($id);
        return view('backend.customer.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $customer = $this->customer->find($id); //find customer
            $cek_slug = $this->customer->whereSlug(str_slug($request->name));//cek customer by slug name
            $request->merge(['slug'=>str_slug($request->name)]);            //merging slug request           
            if($cek_slug->get()->count() > 0){
                if($customer->slug == $request->slug){
                    $this->customer->find($id)->update($request->all());
                    DB::commit();
                    return redirect()->route('customer.index')->with('success-message','Data telah dirubah');
                }else{
                    return redirect()->back()->with('error-message','Maaf Customer <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Customer Lain');    
                }                    
            }else{
                $this->customer->find($id)->update($request->all());
                DB::commit();
                return redirect()->route('customer.index')->with('success-message','Data telah dirubah');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->customer->destroy($id);
        return redirect()->route('customer.index')->with('success-message','Data telah dihapus');
    }

    public function get($id){
        $data = $this->customer->find($id);
        return response()->json($data);
    }

    public function getCustomer(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->customer->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }


}
