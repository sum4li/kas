@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control form-control-sm" autocomplete="off" autofocus="" required="">
                            <input type="hidden" name="transaction_type" value="{{$transaction_type}}" readonly="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="transaction_date" class="form-control form-control-sm" autocomplete="off" required="">
                        </div>
                    </div>                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control form-control-sm" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="amount" class="form-control form-control-sm" require="">
                        </div>
                    </div>                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gambar</label>
                            <div id="uploads"></div>
                        </div>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                            <a class="btn btn-light btn-sm shadow-sm" href="{{route('dashboard')}}">Batal</a>
                            {{-- <a class="btn btn-light btn-sm shadow-sm" href="{{route('transaction.index')}}">Batal</a> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
$(document).ready(function () {

    function bootstrap_select2(selector){
        $(selector).select2({
            theme: 'bootstrap'
        });
    }

    bootstrap_select2('.select2');

    function bootstrap_select2_destroy(selector){
        $(selector).select2('destroy');
    }


    

    //tooltip initialize
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    uploadHBR.init({
        "target": "#uploads",
        "textNew": "Add Photo",
        // "textNew": "<i class='fa fa-plus'></i>",
        "max":1
    });

});
</script>
@endpush
