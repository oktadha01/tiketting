<section class="conteiner">
    <div class="row" style="justify-content: center;">
        <div class="card m-1" style="max-width:31rem">
            <div class="card-header">
                <center>
                    <h5 class="font-weight-bold">Segera selesaikan pembayaran</h5>
                </center>
            </div>
            <div class="card-body">
                <center>
                    <h1 id="demo" style="font-family: fantasy; letter-spacing: 2px;">00:52:38</h1>
                </center>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <span>Total Pembayaran</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right">Rp 147.695,00</span>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <span>Virtual akun</span>
                    </div>
                    <div class="col-6">
                        <span class="float-right">3816529150853030</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$currentDateTime = date('m-d-Y H:i:s');
$newDateTime = date('m-d-Y H:i:s', strtotime($currentDateTime . ' +3 hours'));

echo $newDateTime;
?>