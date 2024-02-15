<div id="navigasi" class="nav">
    <div class="row bg-w-blue nav-transaksi mb-2" style="position: fixed;z-index: 9;width: -webkit-fill-available;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <span class="close-top" style="cursor: pointer;"><i class="fa-solid fa-arrow-left"></i> <span id="span-text-navi"> Transaction</span></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3 mt-5">
        <div id="load-data-navi" class="row">
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
                <h4 class="title" id="nm-e-tiket">E-Tiket </h4>
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