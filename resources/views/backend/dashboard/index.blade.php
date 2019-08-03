@extends('backend.layouts')
@section('title','Dashboard')
@section('content')
<div class="col-md-3 col-lg-3 col-xl-3 col-xs-12 col-sm-12 mb-4" data-aos="fade-up" data-aos-duration="500">
    <a href="{{route('transaction.index',['income'])}}" style="text-decoration:none;">
    <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$income_transaction->count()}} - {{number_format($income_transaction->sum('amount'),2,'.',',')}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-download fa-2x text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-md-3 col-lg-3 col-xl-3 col-xs-12 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="200" data-aos-duration="500">
    <a href="{{route('transaction.index',['expense'])}}" style="text-decoration:none;">
    <div class="card border-left-danger shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{$expense_transaction->count()}} - {{number_format($expense_transaction->sum('amount'),2,'.',',')}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-upload fa-2x text-danger"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-md-3 col-lg-3 col-xl-3 col-xs-12 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="300" data-aos-duration="500">
    <a href="#" style="text-decoration:none;">
    <div class="card border-left-success shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saldo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        Rp. {{number_format($saldo,2,'.',',')}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-12"></div>

@endsection
@push('scripts')
<script>
    AOS.init();
</script>
@endpush

