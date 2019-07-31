
<div class="dropdown no-arrow dropup">
    <button class=" btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <div class="dropdown-item">
            <a href="{{route('unit.edit',[$id])}}"
                class="btn btn-success btn-sm shadow-sm"
                data-toggle="tooltip"
                data-placement="top"
                title="Edit">
                <i class="fa fa-pen"></i>
            </a>
            <a href="{{route('unit.destroy',[$id])}}"
                class="btn btn-danger btn-sm shadow-sm delete-data"
                data-toggle="tooltip"
                data-placement="top"
                title="Delete">
                <i class="fa fa-times"></i>
            </a>
        </div>        
    </div>
</div>
