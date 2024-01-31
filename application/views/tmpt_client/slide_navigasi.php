<div id="navigasi" class="nav">
    <div class="row bg-w-blue nav-transaksi mb-2">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <span class="close-top" style="cursor: pointer;"><i class="fa-solid fa-arrow-left"></i> Back</span>
                </div>
                <div class="col-6">
                    <span id="span-text-navi" class="float-right">Transaction</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div id="load-data-navi" class="row" style="overflow: scroll;max-height: 50rem;">
            <span></span>
        </div>
    </div>
</div>
<!-- Transaksi -->
<div class="modal fade" id="detail-transaksi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="title" id="defaultModalLabel">Detail Transaction </span>
                <span data-dismiss="modal"><i class="fa-regular fa-circle-xmark"></i></span>
            </div>
            <div id="load-data-detail-trans-m" class="modal-body">

            </div>
        </div>
    </div>
</div>
<!-- end transaksi -->

<!-- tiket -->
<div class="modal fade" id="detail-e-tiket" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">E-Tiket </h4>
            </div>
            <div id="load-data-detail-tiket-m" class="modal-body">

            </div>
            <div class="modal-footer" style="display: block;">
                <div class="row">
                    <div class="col pl-0">
                        <button type="button" id="btn-close-modal-tiket" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                    </div>
                    <div class="col pr-0">
                        <button id="btn-download-m" type="button" class="btn btn-info float-right download-file" data-dismiss="modal">Download E-Tiket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end tiket -->