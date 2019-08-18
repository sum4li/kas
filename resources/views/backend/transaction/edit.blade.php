@extends('backend.layouts')
@section('title','Ubah Data')
@section('content')
<div class="col-lg-12">
    {{-- <div class="card border-left-primary"> --}}
    <div class="card mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('transaction.update',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{$data->name}}" autocomplete="off" autofocus="" required="">
                            <input type="hidden" name="transaction_type" value="{{$data->transaction_type}}" readonly="">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="transaction_date" class="form-control form-control-sm" value="{{$data->transaction_date}}" autocomplete="off" required="">
                        </div>
                    </div>                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control form-control-sm" rows="5">{{$data->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="amount" class="form-control form-control-sm" require="" value="{{$data->amount}}">
                        </div>
                    </div>                    
                    <div class="col-12">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image" id="">
                        </div>
                    </div>                    
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                            <a class="btn btn-light btn-sm shadow-sm" href="{{route('transaction.index',$data->transaction_type)}}">Batal</a>
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
    $(document).ready(function(){
        uploadHBR.init({
        "target": "#uploads",
        "textNew": "Add Photo",
        // "textNew": "<i class='fa fa-plus'></i>",
        "max":1
    });
    });
</script>
@endpush