<div class="dropdown no-arrow dropup">
    <button class=" btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-item">            
            <span data-toggle="modal" data-target="#show"
                data-id="{{$id}}"
                <a href="#"
                    class="btn btn-info btn-sm shadow-sm"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="Detail">
                    <i class="fa fa-search"></i>
                </a>
            </span>
            <a href="{{route('customer.edit',[$id])}}"
                class="btn btn-success btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <a href="{{route('customer.destroy',[$id])}}"
                class="btn btn-danger btn-sm shadow-sm delete-data"
                data-toggle="tooltip"
                data-placement="top"
                title="Delete">
                <i class="fa fa-trash"></i>
            </a>
        </div>        
    </div>
</div>

