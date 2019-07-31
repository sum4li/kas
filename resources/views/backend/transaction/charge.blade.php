<div class="col-lg-12">
    {{-- <div class="card border-left-primary"> --}}
    <div class="card mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Biaya</h6>
        </div>
        <div class="card-body">
            <form action="{{route('transaction.storeCharge',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                          <label>Kode</label>
                          <input type="text" name="code" id="code" class="form-control form-control-sm" required="" autofocus="">
                        </div>
                    </div>                    
                    <div class="col-3">
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="name" id="name" class="form-control form-control-sm" required="" autofocus="">
                        </div>
                    </div>           
                    <div class="col-3">
                        <div class="form-group">
                          <label>Currency</label>
                          <select name="currency_id" id="" class="form-control form-control-sm select2">
                              @foreach ($currency as $row)
                                  <option value="{{$row->id}}">{{$row->name}}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>         
                    <div class="col-3">
                        <div class="form-group">
                          <label>Status Pajak</label>
                          <select name="tax_status" id="" class="form-control form-control-sm select2">
                              <option value="tax-free">Bebas Pajak</option>
                              <option value="taxed">Kena Pajak</option>
                          </select>
                        </div>
                    </div>         
                    <div class="col-3">
                        <div class="form-group">
                          <label>Selling</label>
                          <input type="text" name="selling" id="selling" class="form-control form-control-sm">
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                          <label>Buying</label>
                          <input type="text" name="buying" id="buying" class="form-control form-control-sm">
                        </div>
                    </div>                    
                    <div class="col-3">
                        <div class="form-group">
                          <label>Debit Note</label>
                          <input type="text" name="debit_note" id="debit_note" value="0" class="form-control form-control-sm">
                        </div>
                    </div>                    
                    <div class="col-3">
                        <div class="form-group">
                          <label>Credit Note</label>
                          <input type="text" name="credit_note" id="credit_note" value="0" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                            <a class="btn btn-light btn-sm shadow-sm" href="{{route('transaction.index')}}">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Selling</th>
                        <th>Buying</th>
                        <th>Debit Note</th>
                        <th>Credit Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactionCharge->get() as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->name}}</td>
                        <td>
                            <strong>IDR</strong> {{number_format($row->selling_idr,0,',','.')}} / 
                            <strong>USD</strong> {{number_format($row->selling_usd,0,',','.')}}
                        </td>
                        <td>
                            <strong>IDR</strong> {{number_format($row->buying_idr,0,',','.')}} / 
                            <strong>USD</strong> {{number_format($row->buying_usd,0,',','.')}}
                        </td>
                        <td>
                            <strong>IDR</strong> {{number_format($row->debit_note_idr,0,',','.')}} / 
                            <strong>USD</strong> {{number_format($row->debit_note_usd,0,',','.')}}
                        </td>
                        <td>
                            <strong>IDR</strong> {{number_format($row->credit_note_idr,0,',','.')}} / 
                            <strong>USD</strong> {{number_format($row->credit_note_usd,0,',','.')}}
                        </td>
                        <td class="text-center">
                            <div class="dropdown no-arrow dropup">
                                <button class=" btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="dropdown-item">                                                
                                        <a href="{{route('transaction.editCharge',[$data->id,$row->id])}}"
                                            class="btn btn-success btn-sm shadow-sm"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Edit">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a href="{{route('transaction.destroyCharge',[$data->id,$row->id])}}"
                                            class="btn btn-danger btn-sm shadow-sm delete-data"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Delete">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>        
                                </div>
                            </div>
                        </td>
                    </tr>                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>