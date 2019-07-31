@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-hover table-bordered" id="invoice-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job #</th>
                        <th>ETA</th>
                        <th>ETD</th>
                        <th>Carrier</th>
                        <th>Shipper</th>
                        <th>Consignee</th>
                        <th>Status</th>
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
    const $table = $('#invoice-table').DataTable({
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
             url : '{!! route("invoice.source","paid") !!}',
             dataSrc: 'data'
         },
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false, className: 'text-center'},
            {data: 'job_number', name: 'job_number',width:"5%", orderable : false},
            {data: 'eta', name: 'eta',width:"5%", orderable : false},
            {data: 'etd', name: 'etd',width:"5%", orderable : false},
            {data: 'voyage', name: 'voyage',width:"10%", orderable : false},
            {data: 'shipper', name: 'shipper',width:"10%", orderable : false},
            {data: 'consignee', name: 'consignee',width:"10%", orderable : false},
            {data: 'status', name: 'status',width:"2%", orderable : false},
            {data: 'action', name: 'action',width:"2%", orderable : false, className: 'text-center'}
         ]
     });

      $('#invoice-table_wrapper > div.toolbar').html('<div class="row">' +
                '<div class="col-lg-10">'+
                    '<div class="input-group mb-3"> ' +
                        '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci"> ' +
                        '<div class="input-group-append">' +
                        '<span class="btn btn-sm btn-primary"><i class="fas fa-search"></i></span>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
                '<div class="col-lg-2">'+
                    
                    
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


    $('#invoice-table').on('click','a.delete-data',function(e) {
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

    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight:true
    });

    $('#complete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal

        var invoice_no = button.data('invoice_no'); // Extract info from data-* attributes
        var form = button.data('form'); // Extract info from data-* attributes

        var modal = $(this)
        console.log(invoice_no);

        modal.find('input[name="invoice_no"]').val(invoice_no);
        modal.find('#form').attr('action',form);
    });

    $('#invoice').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal

        var invoice_id = button.data('invoice_id'); // Extract info from data-* attributes        
        var modal = $(this)

        modal.find('input[name="invoice_id"]').val(invoice_id);
    });
});
</script>
@endpush
