@extends('backend.layouts')
@section('title','Tambah Data')
@section('content')
<div class="col-lg-12">
    {{-- <div class="card border-left-primary"> --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="name" id="" class="form-control form-control-sm" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <label>Tax # / NPWP</label>
                          <input type="text" name="tax_number" id="" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                          <label>Alamat</label>
                          <textarea type="text" name="address" id="" class="form-control form-control-sm" required=""></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" id="" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>Telp</label>
                          <input type="text" name="phone_number" id="" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>Fax</label>
                          <input type="text" name="fax" id="" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                            <a class="btn btn-light btn-sm shadow-sm" href="{{route('customer.index')}}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
