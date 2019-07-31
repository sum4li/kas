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
                        <div class="col-6">
                            <div class="form-group">
                                <label>BOL / AWB #</label>
                                <input type="text" name="billing_number" value="{{$data->billing_number}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="transaction_type" class="custom-select custom-select-sm" required="">
                                    @php
                                        $type=['il','el','iu','eu'];
                                        $name=['impor laut','ekspor laut','impor udara','ekspor udara'];
                                    @endphp
                                    @for ($i = 0; $i < 4; $i++)
                                <option value="{{$type[$i]}}">{{title_case($name[$i])}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Shipper</label>
                                <select name="shipper_id" id="shipper" class="form-control form-control-sm"  required=""></select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Consignee</label>
                                <select name="consignee_id" id="consignee" class="form-control form-control-sm"  required=""></select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Notify Party</label>
                                <select name="notify_id" id="notify" class="form-control form-control-sm"  required=""></select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Agent</label>
                                <select name="agent_id" id="agent" class="form-control form-control-sm"  required=""></select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Vessel / Airplane</label>
                                <input type="text" name="vessel" value="{{$data->vessel}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Voyage / Airplane #</label>
                                <input type="text" name="voyage" value="{{$data->voyage}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Origin</label>
                                <input type="text" name="origin" value="{{$data->origin}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Cargo Type</label>
                                <input type="text" name="cargo_type" value="{{$data->cargo_type}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>                    
    
                        <div class="col-3">
                            <div class="form-group">
                              <label>ETD</label>
                              <input type="text" name="etd" value="{{$data->etd}}" class="form-control form-control-sm datepicker" required="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>ETA</label>
                              <input type="text" name="eta" value="{{$data->eta}}" class="form-control form-control-sm datepicker" required="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>POL</label>
                              <input type="text" name="pol" value="{{$data->pol}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>POD</label>
                              <input type="text" name="pod" value="{{$data->pod}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-3">
                            <div class="form-group">
                              <label>MBL #</label>
                              <input type="text" name="mbl" value="{{$data->mbl}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>HBL #</label>
                              <input type="text" name="hbl" value="{{$data->hbl}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>BC 11#</label>
                                <input type="text" name="bc11" value="{{$data->bc11}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>BC 23#</label>
                                <input type="text" name="bc23" value="{{$data->bc23}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="button" id="add-container" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Tambah Container" data-placement="top">
                                    <i class="fa fa-plus fa-fw"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-12" id="container"></div>
                        <div class="col-12" id="new-container"></div>                        
                        
                        <div class="col-3">
                            <div class="form-group">
                              <label>Pos</label>
                              <input type="text" name="pos" value="{{$data->pos}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label>Sub Pos</label>
                              <input type="text" name="sub_pos" value="{{$data->sub_pos}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" value="{{$data->location}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                              <label>Gudang</label>
                              <input type="text" name="warehouse" value="{{$data->warehouse}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                              <label>Delivery</label>
                              <input type="text" name="delivery" value="{{$data->delivery}}" class="form-control form-control-sm datepicker" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Trucking</label>
                                <hr>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Trucking</label>
                                <input type="text" name="trucking" value="{{$data->trucking}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Manager Exp. Imp.</label>
                                <input type="text" name="manager" value="{{$data->manager}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Staff Operasional</label>
                                <input type="text" name="staff_operasional" value="{{$data->staff_operasional}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Salesman</label>
                                <input type="text" name="salesman" value="{{$data->salesman}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Driver</label>
                                <input type="text" name="driver" value="{{$data->driver}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Car #</label>
                                <input type="text" name="car_number" value="{{$data->car_number}}" class="form-control form-control-sm" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                            <a class="btn btn-light btn-sm shadow-sm" href="{{route('transaction.index')}}">Batal</a>
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
    

    function bootstrap_select2(selector){
        $(selector).select2({
            theme: 'bootstrap'
        });
    }

    bootstrap_select2_ajax('#shipper','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#consignee','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#notify','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#agent','body','{{route('customer.getCustomer')}}');

    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight:true
    });

    var shipper = {
        id : "{{$data->shipper_id}}",
        name : "{{$data->shipper->name}}"
    };
    var consignee = {
        id : "{{$data->consignee_id}}",
        name : "{{$data->consignee->name}}"
    };
    var notify = {
        id : "{{$data->notify_id}}",
        name : "{{$data->notify->name}}"
    };
    var agent = {
        id : "{{$data->agent_id}}",
        name : "{{$data->agent->name}}"
    };

    var init_shipper = new Option(shipper.name, shipper.id, false, false);
    var init_consignee = new Option(consignee.name, consignee.id, false, false);
    var init_notify = new Option(notify.name, notify.id, false, false);
    var init_agent = new Option(agent.name, notify.id, false, false);
    $('#shipper').append(init_shipper).trigger('change');
    $('#consignee').append(init_consignee).trigger('change');
    $('#notify').append(init_notify).trigger('change');
    $('#agent').append(init_agent).trigger('change');

    var url = "{!! route('transaction.getContainer',$data->id) !!}";
    $.getJSON(url,function(data){
        $.each(data,function(index,value){                
            if(index != 0){
                var removeButton = '<div class="col-12">'+            
                    '<button id="delete-container" class="btn btn-sm btn-danger float-right" type="button">'+
                        '<i class="fa fa-times"></i>'+
                    '</button>'+
                '</div>';
                var containerWrapper = 'id="container-wrapper"';
            }else{
                var removeButton = '';
                var containerWrapper = '';
            }

            function selected_unit(val){
                if(value.unit_id == val){
                    return "selected";
                    
                }else {
                    return "";
                }
                
            }
            var container = '<div class="row" '+containerWrapper+'>'+
                    removeButton+
                    '<div class="col-6">'+
                        '<div class="form-group">'+
                            '<label>Container #</label>'+
                            '<input type="text" name="container_number[]" value="'+value.container_number+'" class="form-control form-control-sm">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-6">'+
                        '<div class="form-group">'+
                            '<label>Seal #</label>'+
                            '<input type="text" name="seal_number[]" value="'+value.seal_number+'" class="form-control form-control-sm">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-2">'+
                        '<div class="form-group">'+
                            '<label>Size</label>'+
                                '<input type="text" name="size[]" value="'+value.size+'" class="form-control form-control-sm" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-2">'+
                        '<div class="form-group">'+
                            '<label>Qty</label>'+
                            '<input type="text" name="qty[]" value="'+value.qty+'" class="form-control form-control-sm" autocomplete="off">'+                    
                        '</div>'+
                    '</div>'+                
                    '<div class="col-2">'+
                        '<div class="form-group">'+
                            '<label>Unit</label>'+
                            '<select name="unit_id[]" class="form-control form-control-sm unit2">'+
                                @foreach (App\Unit::get() as $unit)
                                // '<option value="{{$unit->id}}">{{$unit->name}}</option>'+
                                '<option value="{{$unit->id}}"'+selected_unit("{{$unit->id}}")+'>{{$unit->name}}</option>'+
                                // '<option value="{{$unit->id}}"'+ value.unit_id == {{$unit->id}} ? "selected":""+'>{{$unit->name}}</option>'+
                                @endforeach
                        '</select>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-3">'+
                        '<div class="form-group">'+
                            '<label>Weight</label>'+
                            '<input type="text" name="weight[]" value="'+value.weight+'" class="form-control form-control-sm" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-3">'+
                        '<div class="form-group">'+
                            '<label>Meas</label>'+
                            '<input type="text" name="measurement[]" value="'+value.measurement+'" class="form-control form-control-sm" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-6">'+
                        '<div class="form-group">'+
                            '<label>Comodity</label>'+
                            '<input type="text" name="commodity[]" id="commodity" value="'+value.commodity+'" class="form-control form-control-sm" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-6">'+
                        '<div class="form-group">'+
                        '<label>Facility</label>'+
                        '<input type="text" name="facility[]" id="facility" value="'+value.facility+'" class="form-control form-control-sm" autocomplete="off">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-12">'+
                        '<hr>'+
                    '</div>'+                    
                '</div>';

            $('#container').append(container);
            bootstrap_select2('.unit2');
            console.log(selected_unit('090c5b97-7629-4f29-aab6-bd902f841aed'));
        });
    });


    const container = '<div class="row" id="container-wrapper">'+
        '<div class="col-12">'+            
            '<button id="delete-container" class="btn btn-sm btn-danger float-right" type="button">'+
                '<i class="fa fa-times"></i>'+
            '</button>'+
        '</div>'+
        '<div class="col-6">'+
            '<div class="form-group">'+
                '<label>Container #</label>'+
                '<input type="text" name="container_number[]" class="form-control form-control-sm">'+                                
            '</div>'+
        '</div>'+
        '<div class="col-6">'+
            '<div class="form-group">'+
                '<label>Seal #</label>'+
                '<input type="text" name="seal_number[]" class="form-control form-control-sm">'+                                
            '</div>'+
        '</div>'+
        '<div class="col-2">'+
            '<div class="form-group">'+
                '<label>Size</label>'+
                    '<input type="text" name="size[]" class="form-control form-control-sm" autocomplete="off">'+
            '</div>'+
        '</div>'+
        '<div class="col-2">'+
            '<div class="form-group">'+
                '<label>Qty</label>'+
                '<input type="text" name="qty[]" class="form-control form-control-sm" autocomplete="off">'+                    
            '</div>'+
        '</div>'+                
        '<div class="col-2">'+
            '<div class="form-group">'+
                '<label>Unit</label>'+
                '<select name="unit_id[]" class="form-control form-control-sm unit2">'+
                    @foreach (App\Unit::get() as $unit)
                    '<option value="{{$unit->id}}">{{$unit->name}}</option>'+
                    @endforeach
            '</select>'+
            '</div>'+
        '</div>'+
        '<div class="col-3">'+
            '<div class="form-group">'+
                '<label>Weight</label>'+
                '<input type="text" name="weight[]" class="form-control form-control-sm" autocomplete="off">'+
            '</div>'+
        '</div>'+
        '<div class="col-3">'+
            '<div class="form-group">'+
                '<label>Meas</label>'+
                '<input type="text" name="measurement[]" class="form-control form-control-sm" autocomplete="off">'+
            '</div>'+
        '</div>'+
        '<div class="col-6">'+
            '<div class="form-group">'+
                '<label>Comodity</label>'+
                '<input type="text" name="commodity[]" id="commodity" class="form-control form-control-sm" autocomplete="off">'+
            '</div>'+
        '</div>'+
        '<div class="col-6">'+
            '<div class="form-group">'+
              '<label>Facility</label>'+
              '<input type="text" name="facility[]" id="facility" class="form-control form-control-sm" autocomplete="off">'+
            '</div>'+
        '</div>'+
        '<div class="col-12">'+
            '<hr>'+
        '</div>'+                    
    '</div>';

    $('#add-container').click(function(e){
        e.preventDefault();
        $("#new-container").append(container);
        bootstrap_select2('.unit2');
    });

    $('body').on('click','#delete-container',function(e){
        e.preventDefault();
        $(this).parents('#container-wrapper').remove();
    });

    });
</script>
    
@endpush