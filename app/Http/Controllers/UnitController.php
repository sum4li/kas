<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UnitController extends Controller
{

    public function __construct()
    {
        $this->unit = new Unit();
        
    }
    
    public function index()
    {        
        return view('backend.unit.index');
    }

    public function source(){
        $query= Unit::query();
        return DataTables::eloquent($query)
            ->filter(function ($query) {
                if (request()->has('search')) {
                    $query->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                }
            })
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('description', function ($data) {
                return str_limit($data->description,80);
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.unit.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.unit.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $cek_slug = $this->unit->whereSlug(str_slug($request->name));
            if($cek_slug->get()->count() == 0){
                $this->unit->create($request->all());
                DB::commit();
                return redirect()->route('unit.index')->with('success-message','Data telah disimpan');
            }else{
                return redirect()->back()->with('error-message','Maaf Unit <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Unit Lain');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->unit->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->unit->find($id);
        return view('backend.unit.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
            $unit = $this->unit->find($id); //find unit
            $cek_slug = $this->unit->whereSlug(str_slug($request->name));//cek unit by slug name
            $request->merge(['slug'=>str_slug($request->name)]);            //merging slug request           
            if($cek_slug->get()->count() > 0){
                if($unit->slug == $request->slug){
                    $this->unit->find($id)->update($request->all());
                    DB::commit();
                    return redirect()->route('unit.index')->with('success-message','Data telah dirubah');
                }else{
                    return redirect()->back()->with('error-message','Maaf Unit <strong>'.title_case($request->name).'</strong> Sudah Ada. Silahkan Masukkan Unit Lain');    
                }                    
            }else{
                $this->unit->find($id)->update($request->all());
                DB::commit();
                return redirect()->route('unit.index')->with('success-message','Data telah dirubah');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->unit->destroy($id);
        return redirect()->route('unit.index')->with('success-message','Data telah dihapus');
    }

    public function get($id){
        $data = $this->unit->find($id);
        return response()->json($data);
    }

    public function getUnit(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->unit->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }


}
