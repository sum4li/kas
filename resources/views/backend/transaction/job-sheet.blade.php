@extends('backend.print')
@section('title','JobSheet '.$data->job_number)
@section('content')
<style>
    body{
        font-size: 11px;
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
<div style="width:100%">
<table class="table">
    <tbody>
        <tr>
            <td colspan="10" align="center">
                <strong>PT. TRANS ECOMET GLOBAL</strong>
                <br>
                Job Sheet
            </td>
        </tr>
        <tr>
            <td colspan="1">Ref/Job No</td>
            <td colspan="4">{{$data->job_number ?? '-'}}</td>
            <td colspan="1">Salesman</td>
            <td colspan="4">{{$data->salesman ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">B/L No</td>
            <td colspan="4">{{$data->billing_number ?? '-'}}</td>
            <td colspan="1">Order Date</td>
            <td colspan="4">{{$data->created_at ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">MB/L No</td>
            <td colspan="4">{{$data->mbl ?? '-'}}</td>
            <td colspan="1">Location</td>
            <td colspan="4">{{$data->location ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">Shipper</td>
            <td colspan="4">{{$data->shipper->name ?? '-'}}</td>
            <td colspan="1">ETD/ETA</td>
            <td colspan="4">{{$data->etd ?? '-'}}/{{$data->eta ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">Consignee</td>
            <td colspan="4">{{$data->consignee->name ?? '-'}}</td>
            <td colspan="1">ETD/ETA</td>
            <td colspan="4">{{$data->etd ?? '-'}}/{{$data->eta ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">Notify</td>
            <td colspan="4">{{$data->notify->name ?? '-'}}</td>
            <td colspan="1">Cargo Type</td>
            <td colspan="4">{{$data->cargo_type ?? '-'}}</td>
        </tr>
        <tr>
            <td colspan="1">Agent</td>
            <td colspan="4">{{$data->agent->name ?? '-'}}</td>
            <td colspan="1">Qty</td>
            <td colspan="4">
                {{-- @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->qty ?? '-'}}
                @endforeach --}}
                {{$container->sum('qty')}}
            </td>
        </tr>
        <tr>
            <td colspan="1">BC23#</td>
            <td colspan="4">{{$data->bc23 ?? '-'}}</td>
            <td colspan="1">Gross W</td>
            <td colspan="4">
                {{-- @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->weight ?? '-'}}
                @endforeach --}}
                {{$container->sum('weight')}}
            </td>
        </tr>
        <tr>
            <td colspan="1">Invoice No</td>
            <td colspan="4">-</td>
            <td colspan="1">CBM</td>
            <td colspan="4">
                {{-- @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->measurement ?? '-'}}
                @endforeach --}}
                {{$container->sum('measurement')}}
            </td>
        </tr>
        <tr>
            <td colspan="1">Vessel</td>
            <td colspan="4">{{$data->vessel ?? '-'}} / {{$data->voyage ?? '-'}}</td>
            <td colspan="1">Net Weight</td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="1">POL</td>
            <td colspan="4">{{$data->pol ?? '-'}}</td>
            <td colspan="1">Commodity</td>
            <td colspan="4">
                @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->commodity ?? '-'}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="1">POD</td>
            <td colspan="4">{{$data->pod ?? '-'}}</td>
            <td colspan="1">Container No.</td>
            <td colspan="4">
                @foreach ($container as $row)
                {{$loop->index ==0 ? '':','}}                    
                {{$row->container_number ?? '-'}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="1">Trucking</td>
            <td colspan="4">{{$data->trucking ?? '-'}}</td>
            <td colspan="1"></td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="10">
                &nbsp;
            </td>
        </tr>
        <tr align="center">
            <td rowspan="2">Description</td>
            <td rowspan="2">Remark</td>
            <td colspan="2">Selling</td>
            <td colspan="2">Buying</td>
            <td colspan="2">Debit Note</td>
            <td colspan="2">Credit Note</td>
        </tr>
        <tr align="center">
            <td>USD</td>
            <td>IDR</td>
            <td>USD</td>
            <td>IDR</td>
            <td>USD</td>
            <td>IDR</td>
            <td>USD</td>
            <td>IDR</td>            
        </tr>
        @foreach ($charge as $row)
            <tr>
                <td>{{$row->name}}</td>
                <td></td>                
                <td align="right">{{number($row->selling_usd) }}</td>
                <td align="right">{{number($row->selling_idr) }}</td>
                <td align="right">{{number($row->buying_usd) }}</td>
                <td align="right">{{number($row->buying_idr) }}</td>
                <td align="right">{{number($row->debit_note_usd) }}</td>
                <td align="right">{{number($row->debit_note_idr) }}</td>
                <td align="right">{{number($row->credit_note_usd) }}</td>
                <td align="right">{{number($row->credit_note_idr) }}</td>
            </tr>
        @endforeach
        <tr><td colspan="10"></td></tr>
        <tr>
            <td><strong>SUBTOTAL</strong></td>
            <td></td>
            <td align="right">{{number($charge->sum('selling_usd')) }}</td>
            <td align="right">{{number($charge->sum('selling_idr')) }}</td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right">{{number($charge->sum('debit_note_usd')) }}</td>
            <td align="right">{{number($charge->sum('debit_note_idr')) }}</td>
            <td align="right">{{number($charge->sum('credit_note_usd')) }}</td>
            <td align="right">{{number($charge->sum('credit_note_idr')) }}</td>            
        </tr>
        <tr>
            <td><strong>PPN 10%</strong></td>
            <td></td>
            <td align="right">{{number($charge->sum('selling_usd')*0.1) }}</td>
            <td align="right">{{number($charge->sum('selling_idr')*0.1) }}</td>
            <td align="right">{{number($charge->sum('selling_usd')*0.1) }}</td>
            <td align="right">{{number($charge->sum('selling_idr')*0.1) }}</td>
            <td align="right">{{number($charge->sum('debit_note_usd')*0.1) }}</td>
            <td align="right">{{number($charge->sum('debit_note_idr')*0.1) }}</td>
            <td align="right">{{number($charge->sum('credit_note_usd')*0.1) }}</td>
            <td align="right">{{number($charge->sum('credit_note_idr')*0.1) }}</td>            
        </tr>
        <tr>
            <td><strong>INVOICE TOTAL</strong></td>
            <td></td>
            <td align="right">
                @php
                    $invoice_total_usd = $charge->sum('selling_usd')*0.1 + $charge->sum('selling_usd');
                @endphp
                {{ number($invoice_total_usd) }}
            </td>
            <td align="right">
                @php
                    $invoice_total_idr = $charge->sum('selling_idr')*0.1 + $charge->sum('selling_idr');
                @endphp
                {{ number($invoice_total_idr) }}
            </td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>            
        </tr>
        <tr>
            <td><strong>PPH 2%</strong></td>
            <td></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right">{{number($charge->sum('selling_usd')*0.02) }}</td>
            <td align="right">{{number($charge->sum('selling_idr')*0.02) }}</td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>            
        </tr>
        <tr>            
            <td><strong>TOTAL COST</strong></td> {{-- total cost = sum buying + selling ppn 10% + pph 2% --}}
            <td></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right">
                @php
                  $total_cost_usd = total_cost($charge->sum('buying_usd'),$charge->sum('selling_usd')*0.1,$charge->sum('selling_usd')*0.02);  
                @endphp
                {{ number($total_cost_usd) }}
            </td>
            <td align="right">
                @php
                    $total_cost_idr = total_cost($charge->sum('buying_idr'),$charge->sum('selling_idr')*0.1,$charge->sum('selling_idr')*0.02);
                @endphp
                {{ number($total_cost_idr) }}
            </td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>
            <td align="right"></td>            
        </tr>
        <tr>
            <td><strong>Total Profit USD</strong></td>
            <td colspan="9">{{number($invoice_total_usd - $total_cost_usd)}}</td>
        </tr>
        <tr>
            <td><strong>Total Profit IDR</strong></td>
            <td colspan="9">{{number($invoice_total_idr - $total_cost_idr)}}</td>
        </tr>
    </tbody>
</table>
</div>
<br>
Remark Payment Term: 
<br>
<br>

<table class="table table-borderless">
    <tbody>
        <tr align="center">
            <td>Approved</td>
            <td>
                Jakarta<br>
                Secured By<br>
            </td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <br><br><br>
            </td>
        </tr>
        <tr align="center">
            <td>(..........................)</td>
            <td>(..........................)</td>
        </tr>
    </tbody>
</table>
@endsection



