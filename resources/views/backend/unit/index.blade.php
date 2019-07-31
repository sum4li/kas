@extends('backend.layouts')
@section('title','Unit')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-bordered" id="unit-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#unit-table').DataTable({
         processing: true,
         serverSide: true,
         responsive: true,
         stateSave: true,
         language: {
            paginate: {
                next: '<i class="fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i>'
            },
            processing: 'Loading . . .',
            emptyTable: 'Tidak Ada Data',
            zeroRecords: 'Tidak Ada Data'
         },
         dom: '<"toolbar">rtp',
         ajax: '{!! route('unit.source') !!}',
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false, className:'text-center'},
            // {data: 'code', name: 'code',width:"5%", orderable : false},
            {data: 'name', name: 'name',width:"5%", orderable : false},
            {data: 'description', name: 'description',width:"70%", orderable : false},
            {data: 'action', name: 'action',width:"2%", orderable : false, className: 'text-center'}
         ]
     });

     $('#unit-table_wrapper > div.toolbar').html('<div class="row">' +
        '<div class="col-lg-10">'+
            '<div class="input-group mb-3"> ' +
                '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci lalu tekan enter"> ' +
                '<div class="input-group-append">' +
                '<span class="btn btn-sm btn-primary"><i class="fas fa-search"></i></span>' +
                '</div>' +
            '</div>' +
        '</div>'+
        '<div class="col-lg-2">'+
            '<a href="{{ route("unit.create") }}" class="btn btn-sm btn-primary shadow-sm float-right" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i></a>'+
        '</div>' +
    '</div>');

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    $(document).on('keyup','#search-box',delay(function(e){
        e.preventDefault();
        $table.search($(this).val()).draw();
    },500));

    //delete date
    $('#unit-table').on('click','a.delete-data',function(e) {
        e.preventDefault();
        var delete_link = $(this).attr('href');
        swal({
            title: "Hapus Data ini?",
            text: "",
            icon: "error",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal({
                        title:"Data anda terhapus",
                        icon: "success"
                    })
                    .then(()=>{
                        fetch(delete_link);
                    })
                    .then(()=>{
                        $table.ajax.reload(null,false);
                    });
                } else {
                    swal({
                        title: "Data anda aman",
                        icon: "info"
                    });
                }
            });
    });

    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
});
</script>
@endpush
