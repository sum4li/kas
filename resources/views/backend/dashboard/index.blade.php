@extends('backend.layouts')
@section('title','Dashboard')
@section('content')
{{-- <div class="col-xl-3 col-md-6 mb-4">
    <a href="{{route('car.index')}}" style="text-decoration:none;">
    <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mobil Tersedia</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$car->where('status','tersedia')->get()->count()}} / {{$car->get()->count()}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-car fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div> --}}
<div class="col-xl-3 col-md-6 mb-4">
    <a href="{{route('customer.index')}}" style="text-decoration:none;">
    <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Customer</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$customer->get()->count()}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
{{-- <div class="col-xl-3 col-md-6 mb-4">
    <a href="{{route('transaction.history')}}" style="text-decoration:none;">
    <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaksi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaction->where('status','selesai')->get()->count()}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div> --}}
<div class="col-3 mb-4">
    <a href="{{route('transaction.index')}}" style="text-decoration:none;">
    <div class="card border-left-primary shadow-sm h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaksi Belum Terbayar</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transaction->where('status','unpaid')->get()->count()}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-book fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-12"></div>
<div class="col-lg-6">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi Tahun {{date('Y')}}</h6>
        </div>
        <div class="card-body">
                {!! $chartjs->render() !!}
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" type="text/javascript"></script>
@endpush
