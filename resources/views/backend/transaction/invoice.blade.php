@extends('backend.print')
@section('title','INVOICE '.$data->job_number)
@section('content')
<style>
    @font-face{
        font-family: 'Roboto-Reguler';
        src: url("{{storage_path('fonts/Roboto-Regular.woff2')}}") format("woff2");
    }
    body{
        font-family: 'Roboto-Reguler', sans-serif;
        font-size: 11px;
    }
    .card{
        padding: 1rem;
        border: 1px solid #333333;
        width: 100%;
        display: block;
    }
    .sign{
        padding: 1rem;
        border: 1px solid #333333;
        width: 20%;
        display: block;
    }
    .table{
        border-collapse: collapse;
        width: 100%;
    }
    .table td, th {
        padding: .2rem;
    }
    .table thead th {
        vertical-align: bottom;
        border: 1px solid #333333;
    }
    .table td, .table th {
        padding: .2rem;
        vertical-align: top;
        border: 1px solid #333333;
    }
    .table-borderless tbody + tbody, .table-borderless td, .table-borderless th, .table-borderless thead th {
        border: 0;
    }

    .bold{
        font-weight: bold;
    }

</style>
@php
    function number($number){
        $value = number_format(round($number,2),2,',','.');
        return $value;
    }

    function total_cost($buying,$ppn10,$pph2){
        $value = $buying + $ppn10 + $pph2;
        return $value;
    }
@endphp
{{-- detail customer --}}
<div style="width:100%">
<table class="table table-borderless">
    <tbody>
        <tr>
            <td colspan="6" align="left">
                <p style="font-size: 18px;" class="bold">
                    INVOICE
                </p> 
            </td>
        </tr>
        <tr>
            <td colspan="1" width="15%" class="bold">No</td>
            <td colspan="2" width="40%" class="bold">: {{$data->job_number ?? '-'}}</td>            
            <td colspan="1" class="bold">Kepada</td>
            <td colspan="2" class="bold">: {{$data->agent->name}}</td>
        </tr>
        <tr>
            <td colspan="1" class="bold">Tanggal</td>
            <td colspan="2" class="bold">: {{date('d-M-Y')}}</td>            
            <td colspan="1"></td>
            <td colspan="2" style="padding-left: 0.6rem;" class="bold"> {{$data->agent->address}}</td>
        </tr>        
        <tr>
            <td colspan="6">
                <div style="margin: 1rem 0;"></div>
            </td>
        </tr>
        
        <tr>
            <td colspan="1" class="bold">Shipper</td>
            <td colspan="2">: {{$data->shipper->name ?? '-'}}</td>
            <td colspan="1" class="bold">No Job</td>
            <td colspan="2">: {{$data->job_number ?? '-'}}</td>            
        </tr>
        <tr>
            <td colspan="1" class="bold">HB/L No</td>
            <td colspan="2">: {{$data->hbl ?? '-'}}</td>
            <td colspan="1" class="bold">Negara Asal</td>
            <td colspan="2">: {{$data->origin ?? '-'}} </td>
            
        </tr>
        <tr>
            <td colspan="1" class="bold">MB/L No</td>
            <td colspan="2">: {{$data->mbl ?? '-'}}</td>
            <td colspan="1" class="bold">Tipe</td>
            <td colspan="2">: {{$data->cargo_type ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1" class="bold">Container No.</td>
            <td colspan="2">: 
                @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->container_number ?? '-'}}
                @endforeach
            </td>
            <td colspan="1" class="bold">Qty</td>
            <td colspan="2">: 
                {{$container->sum('qty')}}
            </td>            
        </tr>
        <tr>
            <td colspan="1" class="bold">ETD / ETA</td>
            <td colspan="2">: {{Carbon\Carbon::parse($data->etd)->format('d-M-y') ?? '-'}} / {{Carbon\Carbon::parse($data->etd)->format('d-M-y') ?? '-'}}</td>
            <td colspan="1" class="bold">Weight</td>
            <td colspan="2">:                 
                {{$container->sum('weight')}}
            </td>            
        </tr>
        <tr>
            <td colspan="1" class="bold">
                @if($data->transaction_type == 'il' || $data->transaction_type == 'el')
                Voyage
                @else
                Flight
                @endif
            </td>
            <td colspan="2">: {{$data->vessel ?? '-'}} {{$data->voyage ?? '-'}}</td>            
            <td colspan="1" class="bold">CBM</td>
            <td colspan="2">: 
                {{$container->sum('measurement')}} cbm
            </td>
        </tr>
        <tr>
            <td colspan="1" class="bold">No SPJ</td>
            <td colspan="2">: {{$data->spj_number ?? '-'}}</td>            
            <td colspan="1" class="bold">BC 23</td>
            <td colspan="2">: {{$data->bc23 ?? '-'}}</td>            
        </tr>        
    </tbody>
</table>

{{-- detail biaya --}}
<div style="margin: 1rem 0;"></div>
<table class="table">
    <tbody>      
        <tr align="center">
            <td rowspan="1" width="2%" class="bold">No</td>
            <td rowspan="1" width="5%" class="bold">Kode</td>
            <td colspan="2" width="20%" class="bold">Keterangan</td>
            <td colspan="1" width="10%" class="bold">Status Pajak</td>
            <td colspan="1" width="10%" class="bold">Jumlah</td>
        </tr>
        {{-- space --}}
        <tr>
            <td colspan="6"></td>
        </tr>      
        
        @foreach ($charge as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->code}}</td>                
                <td colspan="2">{{$row->name}}</td>                
                <td align="right">{{$row->tax_status =='tax-free' ? '':'(PPH23)'}}</td>                
                <td align="right">
                    @if ($row->currency->slug == 'idr')
                    <span style="float:left">IDR</span> {{number($row->selling_idr) }}                        
                    @else
                    <span style="float:left">$</span> {{number($row->selling_usd) }}
                        
                    @endif
                </td>
            </tr>
        @endforeach
        {{-- space --}}
        <tr>
            <td colspan="6"></td>
        </tr>          
        
        @php
            $totalIdr = $charge->sum('selling_idr');
            $totalUsd = $charge->sum('selling_usd');
            $ppn10idr = $totalIdr*0.1;
            $ppn10usd = $totalUsd*0.1;
            $invoice_total_idr = $ppn10idr + $totalIdr;
            $invoice_total_usd = $ppn10usd + $totalUsd;
        @endphp
        <tr>
            <td colspan="5" align="right">Total</td>
            <td align="right">
                @if ($charge->first()->currency->slug == 'idr')
                <span style="float:left">IDR</span> {{number($totalIdr) }}                    
                @else
                <span style="float:left">$</span> {{number($totalUsd) }}                    
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="5" align="right">PPN 10 %</td>
            <td align="right">
                @if ($charge->first()->currency->slug == 'idr')
                <span style="float:left">IDR</span> {{number($ppn10idr) }}                    
                @else
                <span style="float:left">$</span> {{number($ppn10usd) }}                    
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="6"></td>
        </tr>    
        <tr>
            <td colspan="5" align="right" class="bold">Total Tagihan</td>
            <td align="right" class="bold">
                @if ($charge->first()->currency->slug == 'idr')
                <span style="float:left">IDR</span> {{number($invoice_total_idr) }}                    
                @else
                <span style="float:left">$</span> {{number($invoice_total_usd) }}                    
                @endif
            </td>
        </tr>
        
    </tbody>
</table>
</div>
<br>

{{-- rekening --}}
<div class="card">
    Pembayaran mohon ditransfer ke rekening:
    <br>
    @php
        $name = ['Nama','ALAMAT','BANK','KCP','SWIFTCODE'];
        $description = [
            'PT. TRANS ECOMET GLOBAL',
            'JL. RAYA SERANG KM. 39,5 KEL. PARIGI KEC. SERANG BANTEN',
            'BCA',
            'RUKO MODERN CIKARANG BLOK C6 D6-D5',
            'CENAIDIA'
        ];
    @endphp
    <table class="table table-borderless">
        <tbody>
            @for ($i = 0; $i < count($name); $i++)
            <tr>
                <td width='15%'>{{$name[$i]}}</td>
                <td width='85%'>: {{$description[$i]}}</td>
            </tr>
            @endfor
            <tr>
                <td>Rekening</td>
                <td>:
                    492 330 6342 (idr) <br>
                    &nbsp; 492 330 6334 (usd) 
                </td>
            </tr>
        </tbody>
    </table>     
</div>
<br>
<br>
{{-- tanda tangan --}}
<div class="sign">
    Mengetahui
    <br>
    <br>
    <br>
    <br>
    <br>
    Direktur
</div>
@endsection



