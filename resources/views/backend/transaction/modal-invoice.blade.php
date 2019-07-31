<!-- Modal -->
<div class="modal fade" id="makeInvoice" tabindex="-1" role="dialog" aria-labelledby="makeInvoice" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0 bg-gradient-primary">
                    <h5 class="modal-title text-white">Data Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body rounded-0">
                    <form action="{{route('transaction.makeInvoice')}}" method="POST" id="form">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Kepada</label>
                                <select name="invoice_to" class="custom-select custom-select-sm" required="">
                                    <option value="consignee">Consignee</option>
                                    <option value="agent">Agent</option>
                                </select>                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tanggal Diterbitkan</label>
                                <input type="text" name="issue_date" class="form-control form-control-sm datepicker" required="">
                                <input type="hidden" name="transaction_id" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Tanggal Batas Pembayaran</label>
                                <input type="text" name="due_date" class="form-control form-control-sm datepicker" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                                <button class="btn btn-light btn-sm shadow-sm" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
