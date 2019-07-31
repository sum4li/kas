@extends('backend.layouts')
@section('title','Customer')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-bordered" id="customer-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        {{-- <th>Email</th>
                        <th>Telp</th>
                        <th>Fax</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.customer.modal-show')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#customer-table').DataTable({
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
        ajax: {
            url : '{!! route('customer.source') !!}',
            dataSrc: 'data'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"1%", orderable : false},
            {data: 'name', name: 'name',width:"30%", orderable : true},
            {data: 'address', name: 'address',width:"60%", orderable : true},
            // {data: 'email', name: 'email',width:"5%", orderable : false},
            // {data: 'phone_number', name: 'phone_number',width:"5%", orderable : false},
            // {data: 'fax', name: 'fax',width:"5%", orderable : false},
            {data: 'action', name: 'action',width:"1%", orderable : false, className: 'text-center'}
        ]
    });

    $('#customer-table_wrapper > div.toolbar').html('<div class="row">' +
        '<div class="col-lg-10">'+
            '<div class="input-group mb-3"> ' +
                '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci lalu tekan enter"> ' +
                '<div class="input-group-append">' +
                '<span class="btn btn-sm btn-primary"><i class="fas fa-search"></i></span>' +
                '</div>' +
            '</div>' +
        '</div>'+
        '<div class="col-lg-2">'+
            '<a href="{{ route("customer.create") }}" class="btn btn-sm btn-primary shadow-sm float-right" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i></a>'+
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
    $('#customer-table').on('click','a.delete-data',function(e) {
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
    //tooltip
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    //detail data
    $('#show').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var url = "{!! route('customer.get',':id') !!}";
        url = url.replace(':id',button.data('id'));
        $.get(url,function(data){
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#phone_number').val(data.phone_number);
            $('#email').val(data.email);
            $('#fax').val(data.fax);
        })

    });
});
</script>
@endpush
