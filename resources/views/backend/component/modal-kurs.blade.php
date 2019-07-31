<!-- Modal -->
@php
    $usd = App\Currency::where('slug','usd')->get()->first();
    $idr = App\Currency::where('slug','idr')->get()->first();
    // rate dari usd to idr
    $rates = App\ExchangeRate::whereDate('created_at',date('Y-m-d'))
    ->where('exchange_from_id',$usd->id)
    ->get();
    $rates = $rates->count() > 0 ? $rates->first()->rates : 0;        
@endphp
<div class="modal fade" id="kurs" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header bg-gradient-primary text-white rounded-0">
                <h5 class="modal-title">Selamat Datang {{Auth::user()->name}}</h5>
                <button type="button" class="close tet-white " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body rounded-0">                                
                    <form action="{{route('exchangeRate.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>Mohon isi nilai tukar rupiah hari ini untuk melanjutkan</p>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>USD</label>
                                  <input type="hidden" name="exchange_from_id" value="{{$usd->id}}" class="form-control form-control-sm" readonly="">
                                  <input type="hidden" name="exchange_to_id" value="{{$idr->id}}" class="form-control form-control-sm" readonly="">                          
                                  <input type="text" name="usd" value="1" class="form-control form-control-sm" disabled="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                  <label>IDR</label>
                                  <input type="text" name="idr" value="{{$rates}}" class="form-control form-control-sm" required="">
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-gorup">
                                    <button type="submit" class="btn btn-sm shadow-sm btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-sm shadow-sm btn-light" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
