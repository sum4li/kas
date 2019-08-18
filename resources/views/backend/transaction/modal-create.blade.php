<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0 bg-gradient-primary">
                    <h5 class="modal-title text-white">Selesaikan Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body rounded-0">                                                            
                        <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">                    
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control form-control-sm" autocomplete="off" autofocus="" required="">
                                        <input type="hidden" name="transaction_type" value="{{$transaction_type}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" name="transaction_date" class="form-control form-control-sm" autocomplete="off" required="">
                                    </div>
                                </div>                    
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control form-control-sm" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="amount" class="form-control form-control-sm" require="">
                                    </div>
                                </div>                    
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        <div id="uploads"></div>
                                    </div>
                                </div>                    
                            </div>
            
                            <div class="row">
                                <div class="col">
                                    <div class="form-gorup">
                                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                                        <button type="button" class="btn btn-light btn-sm shadow-sm" href="#" data-dismiss="">Batal</button>
                                        {{-- <a class="btn btn-light btn-sm shadow-sm" href="{{route('transaction.index')}}">Batal</a> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
