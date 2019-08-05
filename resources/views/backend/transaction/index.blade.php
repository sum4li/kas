@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-12 p-0">
    <h4 class="mb-3">{{$transaction_type == "income" ? 'Pendapatan':'Pengeluaran'}}
        <a href="{{route('transaction.create',$transaction_type)}}" class="float-right btn btn-primary btn" data-target="#create" data-toggle="modal">
            <i class="fa fa-plus"></i>
        </a>
    </h4>
    <form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control " placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="list-group list-group-flush">        
        
        @foreach ($data as $key => $row)
        <button type="button" class="list-group-item list-group-item-action mt-1 shadow-sm" style="border: none;" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{$loop->iteration}}00" data-toggle="modal" data-target="#detail" data-name="{{$row->name}} " data-description="{{$row->description}}" data-image="{{$row->images == NULL ? asset('backend/img/no-image.png'):asset($row->images)}}" data-transaction_date="{{Carbon\Carbon::parse($row->transaction_date)->format('d M y')}}" data-amount="{{'Rp. '.number_format($row->amount,0,',','.')}}">
            <span class="text-dark">
                {{str_limit($key+1 .". ".$row->name,20)}}
            </span>
            <span class="text-primary float-right">
                Rp. {{number_format($row->amount,0,'.',',')}}
            </span>
            <br>
            <span class="text-gray-500">
                {{Carbon\Carbon::parse($row->transaction_date)->format('d M y')}}
            </span>
        </button>            
        @endforeach            
        <li class="list-group-item mt-1 shadow-sm" style="border: none;" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{$data->count()+1}}00">
            <strong>Total</strong>
            <span class="text-primary float-right">
                <strong>
                Rp. {{number_format($data->sum('amount'),0,'.',',')}}
                </strong>
            </span>
        </li>
    </div>
</div>
@include('backend.transaction.modal-detail')
@include('backend.transaction.modal-create')
{{-- @include('backend.transaction.modal-complete') --}}
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    
    $('#transaction-table').on('click','a.delete-data',function(e) {
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

    // DETAIL
    $('#detail').on('shown.bs.modal', function (event) {        
        var button = $(event.relatedTarget); // Button that triggered the modal
        var image = button.data('image'); // Extract info from data-* attributes        
        var name = button.data('name'); // Extract info from data-* attributes        
        var amount = button.data('amount'); // Extract info from data-* attributes        
        var transaction_date = button.data('transaction_date'); // Extract info from data-* attributes        
        var description = button.data('description'); // Extract info from data-* attributes                
        
        var modal = $(this);
        modal.find('#image').attr('src',image);
        modal.find('#name').text(name);
        modal.find('#amount').text(amount);
        modal.find('#description').text(description);
        modal.find('#transaction_date').text(transaction_date);

        $('#detail').on('hidden.bs.modal', function (event) {        
            modal.find('#image').removeAttr('src',image);
            modal.find('#name').text('');
            modal.find('#amount').text('');
            modal.find('#description').text('');
            modal.find('#transaction_date').text('');
        });
    });

    // UPLOAD HBR PLUGINS
    uploadHBR.init({
        "target": "#uploads",
        "textNew": "Add Photo",
        // "textNew": "<i class='fa fa-plus'></i>",
        "max":1
    });

    
});
</script>
@endpush
@push('scripts')
<script>
    AOS.init();
</script>
@endpush