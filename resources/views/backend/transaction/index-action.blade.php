<div class="dropdown no-arrow dropup">
    <button class=" btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-item">
            <span data-toggle="tooltip" data-placement="top" title="Invoice">
                @php
                    $invoice_id == NULL ? $url = "#makeInvoice": $url = route('transaction.printInvoice',[$id]);
                @endphp                
                <a href="{{$url}}"
                    target="_blank"
                    data-toggle="modal"
                    data-transaction_id = {{$id}}
                    class="btn btn-secondary btn-sm shadow-sm">
                    <i class="fa fa-file-invoice-dollar"></i>                    
                </a>
            </span>
            <a href="{{route('transaction.printJobSheet',[$id])}}"
                target="_blank"
                class="btn btn-secondary btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Job Sheet">
                <i class="fa fa-file-excel"></i>
            </a>
            <a href="{{route('transaction.printDeliveryOrder',[$id])}}"
                target="_blank"
                class="btn btn-secondary btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Surat Jalan">
                <i class="fa fa-file"></i>
            </a>
            <a href="{{route('transaction.show',[$id])}}"
                class="btn btn-info btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Detail">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{route('transaction.edit',[$id])}}"
                class="btn btn-success btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <a href="{{route('transaction.destroy',[$id])}}"
                class="btn btn-danger btn-sm shadow-sm delete-data"
                data-toggle="tooltip"
                data-placement="top"
                title="Delete">
                <i class="fa fa-times"></i>
            </a>
            {{-- <a href="{{route('transaction.print',[$id])}}"
                target="_blank"
                class="btn btn-primary btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Cetak">
                <i class="fa fa-print"></i>
            </a> --}}
        </div>        
    </div>
</div>
