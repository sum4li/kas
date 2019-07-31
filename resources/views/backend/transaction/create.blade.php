@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">                    
                    <div class="col-6">
                        <div class="form-group">
                            <label>BOL / AWB #</label>
                            <input type="text" name="billing_number" class="form-control form-control-sm" autocomplete="off">
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
                            <select name="notify_id" id="notify" class="form-control form-control-sm" required=""></select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Agent</label>
                            <select name="agent_id" id="agent" class="form-control form-control-sm" required=""></select>
                            {{-- <input type="text" name="agent" id="agent" class="form-control form-control-sm" autocomplete="off"> --}}
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Vessel / Airplane</label>
                            <input type="text" name="vessel" id="vessel" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Voyage / Airplane #</label>
                            <input type="text" name="voyage" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Origin</label>
                            <input type="text" name="origin" id="origin" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Cargo Type</label>
                            <input type="text" name="cargo_type" id="cargo_type" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>                    

                    <div class="col-3">
                        <div class="form-group">
                          <label>ETD</label>
                          <input type="text" name="etd" class="form-control form-control-sm datepicker" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>ETA</label>
                          <input type="text" name="eta" class="form-control form-control-sm datepicker" required="" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>POL</label>
                          <input type="text" name="pol" id="pol" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>POD</label>
                          <input type="text" name="pod" id="pod" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                          <label>MBL #</label>
                          <input type="text" name="mbl" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>HBL #</label>
                          <input type="text" name="hbl" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>BC 11#</label>
                            <input type="text" name="bc11" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>BC 23#</label>
                            <input type="text" name="bc23" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button id="add-container" type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="tooltip" title="Tambah Container" data-placement="top">
                                <i class="fa fa-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Container #</label>
                            <input type="text" name="container_number[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Seal #</label>
                            <input type="text" name="seal_number[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="col-2">
                        <div class="form-group">
                          <label>Size</label>
                          <input type="text" name="size[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                          <label>Qty</label>
                          <input type="text" name="qty[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                          <label>Unit</label>
                          <select name="unit_id[]" class="form-control form-control-sm" id="unit">
                              @foreach (App\Unit::get() as $unit)
                              <option value="{{$unit->id}}">{{$unit->name}}</option>
                              @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>Weight</label>
                          <input type="text" name="weight[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>Meas</label>
                          <input type="text" name="measurement[]" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                          <label>Comodity</label>
                          <input type="text" name="commodity[]" id="commodity" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                          <label>Facility</label>
                          <input type="text" name="facility[]" id="facility" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12" id="new-container"></div>                    

                    <div class="col-3">
                        <div class="form-group">
                          <label>Pos</label>
                          <input type="text" name="pos" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                          <label>Sub Pos</label>
                          <input type="text" name="sub_pos" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" id="location" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                          <label>Gudang</label>
                          <input type="text" name="warehouse" id="warehouse" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                          <label>Delivery</label>
                          <input type="text" name="delivery" class="form-control form-control-sm datepicker" autocomplete="off">
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
                            <input type="text" name="trucking" id="trucking"  class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Manager Exp. Imp.</label>
                            <input type="text" name="manager" id="manager" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Staff Operasional</label>
                            <input type="text" name="staff_operasional" id="staff_operasional" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Salesman</label>
                            <input type="text" name="salesman" id="salesman" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Driver</label>
                            <input type="text" name="driver" id="driver" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Car #</label>
                            <input type="text" name="car_number" class="form-control form-control-sm" autocomplete="off">
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
$(document).ready(function () {

    function bootstrap_select2(selector){
        $(selector).select2({
            theme: 'bootstrap'
        });
    }

    function bootstrap_select2_destroy(selector){
        $(selector).select2('destroy');
    }

    // function select2_initialize(selector){
    //     $(selector).select2('destroy').select2();
    // }

    bootstrap_select2('#unit');

    //select2 for customer
    bootstrap_select2_ajax('#shipper','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#consignee','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#notify','body','{{route('customer.getCustomer')}}');
    bootstrap_select2_ajax('#agent','body','{{route('customer.getCustomer')}}');

    //typeahead autocomplete
    typeahead('#cargo_type','/api/cargo_type/%search%','%search%');
    typeahead('#origin','/api/origin/%search%','%search%');
    typeahead('#pol','/api/pol/%search%','%search%');
    typeahead('#pod','/api/pod/%search%','%search%');
    typeahead('#vessel','/api/vessel/%search%','%search%');
    typeahead('#commodity','/api/commodity/%search%','%search%');
    typeahead('#facility','/api/facility/%search%','%search%');
    typeahead('#location','/api/location/%search%','%search%');
    typeahead('#warehouse','/api/warehouse/%search%','%search%');
    typeahead('#manager','/api/manager/%search%','%search%');
    typeahead('#staff_operasional','/api/staff_operasional/%search%','%search%');
    typeahead('#salesman','/api/salesman/%search%','%search%');
    typeahead('#trucking','/api/trucking/%search%','%search%');
    typeahead('#driver','/api/driver/%search%','%search%');

    //datepicker
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight:true
    });

    //tooltip initialize
    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    //container form
    const container = '<div class="row" id="container-wrapper">'+
        '<div class="col-12">'+            
            '<button id="delete-container" type="button" class="btn btn-sm btn-danger shadow-sm float-right">'+
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

    
    //add container form
    $('#add-container').click(function(e){
        e.preventDefault();
        $("#new-container").append(container);
        // bootstrap_select2_destroy('.unit2');
        bootstrap_select2('.unit2');
    });

    //delete container
    $('body').on('click','#delete-container',function(e){
        e.preventDefault();
        $(this).parents('#container-wrapper').remove();
    });

});
</script>
@endpush
