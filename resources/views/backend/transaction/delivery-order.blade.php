@extends('backend.print')
@section('title','SPJ '.$data->spj_number)
@section('content')
<div class="header">
    <strong>
        PT TRANS ECOMET GLOBAL
    </strong>
    <br>
    Jl. Raya Serang Km. 39.5 Kel. Parigi Kec. Cikande, Serang, Banten
    <br>
    Telp : 021-5484464
    <br>
    <span style="font-weight:bold; text-align:center;display:inline-block;width:100%">SURAT PERINTAH JALAN</span>    
    <hr>
    <span style="text-align:center;display:inline-block;width:100%">SPJ No. {{$data->spj_number}}</span>
</div>
<div>
Berikut ini kami sampaikan perintah jalan kepada: 
<div style="width:100%">
<table class="table table-borderless">
    <tbody>
        <tr>
            <td width="30%">BC 23#</td>
            <td width="70%">: {{$data->bc23}}</td>
        </tr>
        <tr>
            <td>Type Cargo</td>
            <td>: {{$data->cargo_type}}</td>
        </tr>        
        <tr>
            <td>No Job</td>
            <td>: {{$data->job_number}}</td>
        </tr>
        <tr>
            <td>Nama Supir</td>
            <td>: {{$data->driver}}</td>
        </tr>
        <tr>
            <td>No Kontainer</td>
            <td>: 
                @foreach ($container as $row)
                    {{$loop->index == 0 ? '':','}}
                    {{$row->container_number}}
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Tujuan</td>
            <td>: {{$data->consignee->name}}</td>
        </tr>
        <tr>
            <td>Jumlah barang</td>
            <td>: 
                {{-- @foreach ($container as $row)
                    {{$loop->index == 0 ? '':','}}
                    {{$row->qty}}
                @endforeach --}}
                {{$container->sum('qty')}}
            </td>
        </tr>
        <tr>
            <td>Berat Barang</td>
            <td>: 
                {{-- @foreach ($container as $row)
                    {{$loop->index == 0 ? '':','}}
                    {{$row->weight}}
                @endforeach     --}}
                {{$container->sum('weight')}}
            </td>
        </tr>
        <tr>
            <td>CBM</td>
            <td>: 
                {{-- @foreach ($container as $row)
                    {{$loop->index == 0 ? '':','}}
                    {{$row->measurement}}
                @endforeach     --}}
                {{$container->sum('measurement')}}
            </td>
        </tr>
        <tr>
            <td>Shipper/Pengirim</td>
            <td>: {{$data->shipper->name}}</td>
        </tr>
        <tr>
            <td>Consignee/Penerima</td>
            <td>: {{$data->consignee->name}}</td>
        </tr>
        <tr>
            <td>Alamat Consignee/Penerima</td>
            <td>: {{$data->consignee->address}}</td>
        </tr>
        <tr>
            <td>
                @if ($data->transaction_type == 'il' || $data->transaction_type =='el')
                MBL No.                
                @else
                MAWB No.                    
                @endif
            </td>
            <td>: {{$data->mbl}}</td>
        </tr>
        <tr>
            <td>
                @if ($data->transaction_type == 'il' || $data->transaction_type =='el')
                HBL No.                
                @else
                HAWB No.                    
                @endif
            </td>
            <td>: {{$data->hbl}}</td>
        </tr>
    </tbody>
</table>
</div>
<br>
Catatan:<br>
Bongkar muat di pabrik adalah tanggung jawab gudang pabrik.<br>
mohon dihitung dan dicek jika ada kerusakan atau kekurangan.
<br>
<br>
<strong>
    PT. TRANS ECOMET GLOBAL
</strong>
<br>
<br>

<table class="table table-borderless">
    <tbody>
        <tr align="center">
            <td>Manager Exp. Imp.</td>
            <td>Staff Operasional</td>
            <td>Supir</td>
            <td>
                Tgl : <br>
                Nama : <br>
            </td>
        </tr>
        <tr align="center">
            <td colspan="4">
                <br><br><br>
            </td>
        </tr>
        <tr align="center">
            <td>{{$data->manager}}</td>
            <td>{{$data->staff_operasional}}</td>
            <td>{{$data->driver}}</td>
            <td>(..........................)</td>
        </tr>
    </tbody>
</table>
@endsection



