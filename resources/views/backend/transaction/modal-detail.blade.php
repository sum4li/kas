<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0 bg-gradient-primary">
                    <h5 class="modal-title text-white">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body rounded-0">                                                            
                    <img class="card-img-top" id="image">
                    <div class="card-body">
                        <strong>
                            <h5 class="card-title text-dark" id="name"></h5>
                        </strong>
                        <span class="text-primary font-weight-bold" id="transaction_date" style="font-size: 0.75rem;"></span>
                        <span class="text-success font-weight-bold float-right" id="amount" style="font-size: 1rem;"></span>
                        <p class="card-text" id="description"></p>
                        <a class="btn btn-success btn-sm" id="edit-button">
                            Edit
                        </a>
                        <a class="btn btn-danger btn-sm" id="delete-button">
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
