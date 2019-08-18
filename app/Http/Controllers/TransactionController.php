<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    // halaman utama transaksi
    public function index($transaction_type)
    {
        $data = $this->transaction->where('transaction_type',$transaction_type)->orderBy('transaction_date','desc')->orderBy('created_at','desc')->get();
        return view('backend.transaction.index',compact(['data','transaction_type']));        
    }

    // datatables source transaksi
    public function source(){
        $select = ['id','job_number','eta','etd','voyage','shipper_id','consignee_id','status','invoice_id'];
        $query= $this->transaction->query();
        $query->select($select);
        // $query->where('status',$status);
        $query->with(['shipper','consignee']);
        $query->orderBy('created_at','desc');
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->where('job_number', 'LIKE', '%' . request('search')['value'] . '%');
            }
            })
            ->addColumn('job_number', function ($data) {
                return $data->job_number;
            })
            ->addColumn('eta', function ($data) {
                return Carbon::parse($data->eta)->format('d-M-y');
            })
            ->addColumn('etd', function ($data) {
                return Carbon::parse($data->etd)->format('d-M-y');
            })
            ->addColumn('voyage', function ($data) {
                return str_limit(title_case($data->voyage ?? '-'),15);
            })
            ->addColumn('shipper', function ($data) {
                return title_case(str_limit($data->shipper->name,15));
            })
            ->addColumn('consignee', function ($data) {
                return title_case(str_limit($data->consignee->name,15));
            })
            ->addColumn('status', function ($data) {
                return $data->status == 'paid' ? '<span class="badge badge-success">'.title_case($data->status).'</span>':'<span class="badge badge-secondary">'.title_case($data->status).'</span>';
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.transaction.index-action')
            ->rawColumns(['action','status'])
            ->toJson();
    }

    // halaman buat transaksi
    public function create($transaction_type)
    {
        return view('backend.transaction.create',compact(['transaction_type']));
    }

    // simpan transaksi
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {             
            
            if($request->has('image')){
                $fileName = Str::uuid();
                $extension = $request->image->extension();
                $path = 'public/image/transaction/'.$fileName.'.'.$extension;

                $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                Storage::put($path, (string) $img->encode());
                
                // $file = $request->image->storeAs(
                //     'public/image/transaction',$fileName.'.'.$request->image->extension()
                // );
                $request->merge([
                    'images'=>'storage/image/transaction/'.$fileName.'.'.$request->image->extension()
                ]);
            }
            $request->merge([
                'slug'=> str_slug($request->name)
            ]);
            $this->transaction->create($request->all());
            DB::commit();
            return redirect()->back()->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    // detail transaksi
    public function show($id)
    {
        $data = $this->transaction->find($id);
        $currency = $this->currency->orderBy('name')->get();
        $transactionCharge = $this->transactionCharge->where('transaction_id',$id);
        return view('backend.transaction.show',compact(['data','transactionCharge','currency']));

    }

    // halaman edit transaksi
    public function edit($id)
    {
        $data = $this->transaction->find($id);
        return view('backend.transaction.edit',compact('data'));

    }

    // update transaksi
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try { 
            if($request->has('image')){
                $fileName = Str::uuid();
                $extension = $request->image->extension();
                $path = 'public/image/transaction/'.$fileName.'.'.$extension;

                $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                Storage::put($path, (string) $img->encode());
                
                // $file = $request->image->storeAs(
                //     'public/image/transaction',$fileName.'.'.$request->image->extension()
                // );
                $request->merge([
                    'images'=>'storage/image/transaction/'.$fileName.'.'.$request->image->extension()
                ]);
            }           
            $this->transaction->find($id)->update($request->all());
            
            DB::commit();
            return redirect()->route('transaction.index',$this->transaction->find($id)->transaction_type)->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    // hapus transaksi
    public function destroy($id)
    {
        $this->transaction->destroy($id);
        return redirect()->back()->with('success-message','Data telah dihapus');
    }

    public function print($id){
        $data = $this->transaction->find($id);
        // return view('backend.transaction.cetak',compact(['data']));
        $pdf = PDF::loadView('backend.transaction.cetak',compact(['data']));
        return $pdf->stream($data->invoice_no.'.pdf');
    }

    // print job sheet
    public function printJobSheet($id){
        $data = $this->transaction->find($id);
        $container = $this->transactionContainer->where('transaction_id',$data->id)->get();
        $charge = $this->transactionCharge->where('transaction_id',$data->id)->get();
        // return view('backend.transaction.job-sheet',compact(['data']));
        $pdf = PDF::loadView('backend.transaction.job-sheet',compact(['data','container','charge']));
        return $pdf->stream("JobSheet_".$data->job_number.'.pdf');
    }
    
    //print surat jalan
    public function printDeliveryOrder($id){
        $data = $this->transaction->find($id);
        $container = $this->transactionContainer->where('transaction_id',$data->id)->get();
        // return view('backend.transaction.delivery-order',compact(['data']));
        $pdf = PDF::loadView('backend.transaction.delivery-order',compact(['data','container']));
        return $pdf->stream("Surat Jalan_".$data->spj_number.'.pdf');
    }
    
    //print invoice
    public function printInvoice($id){
        $data = $this->transaction->find($id);
        $container = $this->transactionContainer->where('transaction_id',$data->id)->get();
        $charge = $this->transactionCharge->where('transaction_id',$data->id)->get();
        // return view('backend.transaction.invoice',compact(['data','container','charge']));
        $pdf = PDF::loadView('backend.transaction.invoice',compact(['data','container','charge']));
        return $pdf->stream("Invoice_".$data->spj_number.'.pdf');
    }

    // not yet
    public function complete(Request $request,$id){
        $transaction = $this->transaction->find($id);
        $transaction->update([
            'return_date'=>$request->return_date,
            'status'=>'selesai',
            'penalty'=>Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty,
            'amount'=>Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty + $transaction->amount

        ]);
        $this->car->find($transaction->car_id)->update(['status'=>'tersedia']);
        return redirect()->route('transaction.index')->with('success-message','Data telah disimpan');
    }

    

    // not yet
    public function export(Request $request){
        $transaction = new TransactionExport();
        $transaction->setDate($request->from,$request->to);
        return Excel::download($transaction, 'laporan_trx_'.$request->from.'_'.$request->to.'.xlsx');
    }

    // generate job #
    private function generateJobNumber($type){
        
        // defining types
        if($type == 'il'){
            $code = 'SI';
        }elseif($type == 'el'){
            $code = 'SE';
        }elseif($type == 'iu'){
            $code = 'AI';
        }elseif($type == 'eu'){
            $code = 'AE';
        }
        
        // defiing date
        $date = Carbon::parse(date('Y-m-d'))->format('ym');
        // defining number
        $number = $this->transaction->where('transaction_type',$type)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get()->count()+1;
        return $job_number = $code.$date."-".sprintf('%04s',$number);
    }

    // generate spj #
    private function generateSpjNumber(){                
        // defiing date
        $date = Carbon::parse(date('Y-m-d'))->format('ym');
        // defining number
        $number = $this->transaction->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get()->count()+1;
        return $spj_number = 'TEG-'.$date."-".sprintf('%04s',$number);
    }

    // generate invoice #
    private function generateInvoice(){        
        $bulan = date('m');
        $tahun = date('y');
        $invoice = $this->invoice->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get()->count()+1;
        return 'P-'.$tahun.'-'.$bulan.'-'.sprintf('%05s',$invoice);   
    }

    // get container that transaction had
    public function getContainer($id){
        $data = $this->transactionContainer->where('transaction_id',$id)->get();
        return response()->json($data);
    }

    // store transaction charge
    public function storeCharge(Request $request,$id){
        DB::beginTransaction();
        try {
            // get usd to idr rates
            $rate = $this->exchangeRate->whereDate('created_at',date('Y-m-d')) 
            ->whereHas('exchange_from',function($q){
                $q->where('slug','usd');
            })->get();
            // inserting idr usd value on request variable
            $names = ['selling','buying','debit_note','credit_note'];            
            foreach($names as $name){
                $request->merge($this->getValue($request->currency_id,$request->$name,$name));                
            } 
            // merge some data                       
            $request->merge([
                'slug'=>str_slug($request->name),
                'transaction_id'=>$id,
                'rates'=>$rate->first()->rates
            ]);
            
            // check duplicate charge
            $chargeCek = $this->transactionCharge->where('slug',$request->slug)->orWhere('code',$request->code)->get()->count();

            // if exist
            if($chargeCek > 0){
                return redirect()->back()->with('error-message','Maaf nama :<strong>'.$request->name.'</strong>, atau code :<strong>'.$request->code.'</strong> telah digunakan');
            }else{ // if not exist
                $this->transactionCharge->create($request->all());
                DB::commit();
                return redirect()->back()->with('success-message','Data Tersimpan');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());            
        }
    }

    public function editCharge($id,$charge_id){
        $data = $this->transaction->find($id);
        $currency = $this->currency->orderBy('name')->get();
        $transactionCharge = $this->transactionCharge->where('transaction_id',$id);
        $charge = $this->transactionCharge->where([
            ['transaction_id',$id],
            ['id',$charge_id]
        ])->get()->first();
        return view('backend.transaction.editCharge',compact(['charge','data','transactionCharge','currency']));
    }

    // update transaction charge
    public function updateCharge(Request $request,$id,$charge_id){
        DB::beginTransaction();
        try {
            // get current charge
            $charge = $this->transactionCharge->find($charge_id);
            // get usd to idr rates
            $rate = $this->exchangeRate->whereDate('created_at',date('Y-m-d')) 
            ->whereHas('exchange_from',function($q){
                $q->where('slug','usd');
            })->get();
            // inserting idr usd value on request variable
            $names = ['selling','buying','debit_note','credit_note'];            
            foreach($names as $name){
                $request->merge($this->getValue($request->currency_id,$request->$name,$name));                
            } 
            // merge some data                       
            $request->merge([
                'slug'=>str_slug($request->name),
                'transaction_id'=>$id,
                'rates'=>$rate->first()->rates
            ]);
            // check duplicate charge
            $chargeCek = $this->transactionCharge->where('slug',$request->slug)->orWhere('code',$request->code)->get();
            // if exist
            if($chargeCek->count() > 1){
                if($charge->slug == $request->slug && $charge->code == $request->code){
                    $this->transactionCharge->find($charge_id)->update($request->all());
                    DB::commit();
                    return redirect()->route('transaction.show',$id)->with('success-message','Data Tersimpan');
                }else{
                    return redirect()->back()->with('error-message','Maaf nama :<strong>'.$request->name.'</strong>, atau code :<strong>'.$request->code.'</strong> telah digunakan');
                }
            }else{ // if not exist
                $this->transactionCharge->find($charge_id)->update($request->all());
                DB::commit();
                return redirect()->route('transaction.show',$id)->with('success-message','Data Tersimpan');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }
    }

    // destroy charge
    public function destroyCharge($id,$charge_id){
       $this->transactionCharge->where([
           ['transaction_id',$id],
           ['id',$charge_id]
       ])->delete();
       return redirect()->route('transaction.show',$id)->with('success-message','Data telah dihapus');
    }


    // get value of charge from usd or idr
    private function getValue($id,$value,$name){
        $currency = $this->currency->find($id);
        $rate = $this->exchangeRate->whereDate('created_at',date('Y-m-d')) 
            ->whereHas('exchange_from',function($q){
                $q->where('slug','usd');
            })           
            ->get();
        if($currency->slug == 'usd'){
            $data = [                
                $name.'_idr'=>$value*$rate->first()->rates,
                $name.'_usd'=>$value*1,
            ];
        }else{
            $data = [                
                $name.'_idr'=>$value*1,
                $name.'_usd'=>$value / $rate->first()->rates,
            ];
        }

        return $data;
    }

    // make invoice store some of invoice data
    public function makeInvoice(Request $request){
        DB::beginTransaction();
        try {
            $transaction = $this->transaction->find($request->transaction_id);
            $invoice_to_id = $request->invoice_to == 'consignee' ? $transaction->consignee_id:$transaction->agent_id;
            $request->merge([
                'invoice_to_id'=>$invoice_to_id,
                'invoice_number'=>$this->generateInvoice()
            ]);
            $invoice = $this->invoice->create($request->all());
            $transaction->update([
                'invoice_id'=>$invoice->id
            ]);
            DB::commit();
            return redirect()->route('transaction.index')->with('success-message','Data Tersimpan');
            // return $request->all();
            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }
  
    //untuk route ajax typeahead
    public function typeahead($select,$search){
        $data = $this->transaction->select($select)->where($select, 'LIKE', '%'.$search.'%')->distinct()->get();    
        $transform = [
            'cargo_type'=> new CargoTypeTransformer(),
            'origin'=> new OriginTransformer(),
            'vessel'=> new VesselTransformer(),
            'pol'=> new PolTransformer(),
            'pod'=> new PodTransformer(),
            'commodity'=> new CommodityTransformer(),
            'facility'=> new FacilityTransformer(),
            'location'=> new LocationTransformer(),
            'warehouse'=> new WarehouseTransformer(),
            'trucking'=> new TruckingTransformer(),
            'driver'=> new DriverTransformer(),
            'manager'=> new ManagerTransformer(),
            'staff_operasional'=> new staffOperasionalTransformer(),
            'salesman'=> new SalesmanTransformer()
        ];       

        $data = fractal($data, $transform[$select])->toArray();
        return response()->json($data);
    }


}
