@extends('backend.layouts')
@section('title','Nilai Tukar')
@section('content')
<div class="col-lg-6">
    
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('exchangeRate.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                          <label>USD</label>
                          <input type="hidden" name="exchange_from_id" value="{{$usd->id}}" class="form-control form-control-sm" readonly="">
                          <input type="hidden" name="exchange_to_id" value="{{$idr->id}}" class="form-control form-control-sm" readonly="">                          
                          <input type="text" name="usd" value="1" class="form-control form-control-sm" disabled="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <label>IDR</label>
                          <input type="text" name="idr" value="{{$rates}}" class="form-control form-control-sm" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-sm shadow-sm btn-primary">Simpan</button>
                            <a class="btn btn-sm shadow-sm btn-light" href="{{route('dashboard')}}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
