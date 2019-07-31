@extends('backend.layouts')
@section('title','Detail Data')
@section('content')
<div class="col-12 d-none">
    <div class="card mb-4 shadow-sm">
        <span data-toggle="tooltip" title="More Detail">
            <a href="#more-detail" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </a>
        </span>
        <div class="card-body">            
            <div class="row">                    
                <div class="col-3">
                    <div class="form-group">
                        <label>Job #</label>
                        <input type="text" name="job_number" value="{{$data->job_number}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>BOL / AWB #</label>
                        <input type="text" name="billing_number" value="{{$data->billing_number}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="transaction_type" class="custom-select custom-select-sm" disabled="">
                            @php
                                $type=['il','el','iu','eu'];
                                $name=['impor laut','ekspor laut','impor udara','ekspor udara'];
                            @endphp
                            @for ($i = 0; $i < 4; $i++)
                        <option value="{{$type[$i]}}" {{$data->transaction_type == $type[$i] ? 'selected':''}}>{{title_case($name[$i])}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Shipper</label>
                        <input type="text" name="shipper" value="{{$data->shipper->name}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Consignee</label>
                        <input type="text" name="consignee" value="{{$data->consignee->name}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Notify Party</label>
                        <input type="text" name="notify" value="{{$data->notify->name}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Agent</label>
                        <input type="text" name="agent" value="{{$data->agent->name}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label>Vessel / Airplane</label>
                        <input type="text" name="vessel" value="{{$data->vessel}}" class="form-control form-control-sm" readonly="">
                    </div>
                </div>

                
                <div id="more-detail" class="col-12 collapse">    {{-- more detail --}}                    
                    <div class="row"> {{-- row start --}}
                        <div class="col-3">
                            <div class="form-group">
                                <label>Voyage / Airplane #</label>
                                <input type="text" name="voyage" value="{{$data->voyage}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Origin</label>
                                <input type="text" name="origin" value="{{$data->origin}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Cargo Type</label>
                                <input type="text" name="cargo_type" value="{{$data->cargo_type}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>                    
    
                        <div class="col-3">
                            <div class="form-group">
                                <label>ETD</label>
                                <input type="text" name="etd" value="{{$data->etd}}" class="form-control form-control-sm datepicker" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>ETA</label>
                                <input type="text" name="eta" value="{{$data->eta}}" class="form-control form-control-sm datepicker" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>POL</label>
                                <input type="text" name="pol" value="{{$data->pol}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>POD</label>
                                <input type="text" name="pod" value="{{$data->pod}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>MBL #</label>
                                <input type="text" name="mbl" value="{{$data->mbl}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>HBL #</label>
                                <input type="text" name="hbl" value="{{$data->hbl}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>BC 11#</label>
                                <input type="text" name="bc11" value="{{$data->bc11}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>BC 23#</label>
                                <input type="text" name="bc23" value="{{$data->bc23}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div id="container" class="col-12"></div>
                            
                        <div class="col-3">
                            <div class="form-group">
                                <label>Pos</label>
                                <input type="text" name="pos" value="{{$data->pos}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Sub Pos</label>
                                <input type="text" name="sub_pos" value="{{$data->sub_pos}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" value="{{$data->location}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Gudang</label>
                                <input type="text" name="warehouse" value="{{$data->warehouse}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Delivery</label>
                                <input type="text" name="delivery" value="{{$data->delivery}}" class="form-control form-control-sm datepicker" readonly="">
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
                                <label>SPJ #</label>
                                <input type="text" name="spj_number" value="{{$data->spj_number}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Trucking</label>
                                <input type="text" name="trucking" value="{{$data->trucking}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Manager Exp. Imp.</label>
                                <input type="text" name="manager" value="{{$data->manager}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Staff Operasional</label>
                                <input type="text" name="staff_operasional" value="{{$data->staff_operasional}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Salesman</label>
                                <input type="text" name="salesman" value="{{$data->salesman}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Driver</label>
                                <input type="text" name="driver" value="{{$data->driver}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Car #</label>
                                <input type="text" name="car_number" value="{{$data->car_number}}" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                    </div> {{-- end of row --}}                    
                </div> {{-- end of more-detail --}}                
            </div>
        </div>
    </div>
</div>
@include('backend.transaction.charge')
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        function bootstrap_select2(selector){
            $(selector).select2({
                theme: 'bootstrap'
            });
        }

        bootstrap_select2('.select2');

        var url = "{!! route('transaction.getContainer',$data->id) !!}";
        // url = url.replace(':id',button.data('id'));
        $.getJSON(url,function(data){
            $.each(data,function(index,value){   
                var iteration = index + 1;            
                function input(column,label,value){
                    return '<div class="'+column+'">'+
                            '<div class="form-group">'+
                                '<label>'+label+'</label>'+
                                '<input type="text" value="'+value+'" class="form-control form-control-sm" readonly="">'+
                            '</div>'+
                    '</div>';
                } 
                var container = '<div class="row">'+                     
                        '<div class="col-12">'+
                            '<label>Container - '+ iteration  +'</label>'+
                            '<hr>'+
                        '</div>'+          
                        input('col-6','Container #',value.container_number)+            
                        input('col-6','Seal #',value.seal_number)+            
                        input('col-2','Size',value.size)+            
                        input('col-2','Qty',value.qty)+            
                        input('col-2','Unit',value.unit_id)+            
                        input('col-3','Weight',value.weight)+            
                        input('col-3','Meas',value.measurement)+            
                        input('col-6','Unit',value.commodity)+            
                        input('col-6','Unit',value.facility)+                                    
                        
                        '<div class="col-12">'+
                            '<hr>'+
                        '</div>'+          
                    '</div>';
                $('#container').append(container);
            });
        });
    });
</script>
@endpush
