<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionContainer;
use App\TransactionCharge;
use App\ExchangeRate;
use App\Currency;
use App\Invoice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Transformers\CargoTypeTransformer;
use App\Transformers\OriginTransformer;
use App\Transformers\PodTransformer;
use App\Transformers\PolTransformer;
use App\Transformers\VesselTransformer;
use App\Transformers\CommodityTransformer;
use App\Transformers\FacilityTransformer;
use App\Transformers\LocationTransformer;
use App\Transformers\WarehouseTransformer;
use App\Transformers\ManagerTransformer;
use App\Transformers\StaffOperasionalTransformer;
use App\Transformers\SalesmanTransformer;
use App\Transformers\TruckingTransformer;
use App\Transformers\DriverTransformer;

class InvoiceController extends Controller
{

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->transactionContainer = new TransactionContainer();
        $this->transactionCharge = new TransactionCharge();
        $this->exchangeRate = new ExchangeRate();
        $this->currency = new Currency();
        $this->invoice = new Invoice();
    }

    // semua transaksi
    public function index()
    {
        return view('backend.invoice.index');        
    }

    // transaksi invoice terbayar
    public function where($where)
    {
        if($where == 'paid'){
            return view('backend.invoice.paid');        
        }elseif($where == 'unpaid'){
            return view('backend.invoice.unpaid');        
        }elseif($where == 'all'){
            return view('backend.invoice.index');        
        }else{
            return redirect()->route('invoice.index');
        }
    }

    // datatables source transaksi
    public function source($status){
        $select = ['id','job_number','eta','etd','voyage','shipper_id','consignee_id','status','invoice_id'];
        $query= $this->transaction->query();
        $query->select($select);
        if($status == 'paid'){
            $where = [['status','=','paid']];
        }elseif($status == 'unpaid'){
            $where = [['status','=','unpaid']];
        }elseif($status == 'all'){
            $where = [['status','!=',null]];
        }
        $query->where($where);
        $query->where('invoice_id','!=',NULL);
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
                $start = Carbon::parse($data->invoice->issue_date);
                $today = Carbon::now()->format('Y-m-d');
                $date = $start->diffInDays($today);
                if($data->status == 'paid'){
                    return '<span class="badge badge-success">'.title_case($data->status).'</span>';
                }else{                    
                    return $date < 15 ? '<span class="badge badge-success">'.$date.' hari</span>':'<span class="badge badge-danger">'.$date.' hari</span>';
                }
                
                
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.transaction.index-action')
            ->rawColumns(['action','status'])
            ->toJson();
    }
}
