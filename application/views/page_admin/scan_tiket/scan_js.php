<script>
// manipulasi data sceneQR
function onScanSuccess(qrCodeMessage) {
    $.ajax({
        url: '<?php echo base_url('Scan_tiket/get_data_from_qr'); ?>',
        method: 'GET',
        data: {
            qrCodeMessage: qrCodeMessage
        },
        success: function(data) {
            updateResult(data);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            console.log('Status XHR:', status);
            console.log('Respon XHR:', xhr.responseText);
        }

    });
}

// kode manual input
function submitManualCode() {
    var manualCode = document.getElementById("manualCodeInput").value;
    if (manualCode.trim() !== "") {
        $.ajax({
            url: '<?php echo base_url('Scan_tiket/get_data_from_qr'); ?>',
            method: 'GET',
            data: {
                manualCode: manualCode
            },
            success: function(data) {
                updateResult(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                console.log('Status XHR:', status);
                console.log('Respon XHR:', xhr.responseText);
            }
        });
    }
}

function onScanError(errorMessage) {}

// kode untuk menampilkan data hasil scan dan input manual
var resultElement = document.getElementById("result");

function updateResult(data) {
    if (data.result.length > 0) {
        var isDisabled = data.result[0].status_tiket === 'Sudah Diambil' ? 'hidden' : '';
        var ribbonClass = data.result[0].status_tiket === 'Sudah Diambil' ? 'ribbon5' : 'ribbon6';
        var wrapClass = data.result[0].status_tiket === 'Sudah Diambil' ? '' : 'wrap';
        var ribbonfide = data.result[0].status_tiket === 'Sudah Diambil' ? 'ribbons fade-out' : 'ribbon';

        resultElement.innerHTML =
            '<section class="fade-in">' +
            '<div class="' + ribbonfide + '">' +
            '<div class="' + wrapClass + '">' +
            '<span class="' + ribbonClass + '">' + data.result[0].status_tiket + '</span>' +
            '</div> <br>' +
            '<div class="body text-center pb-2">' +
            '   <div class="member-img">' +
            '       <span><img src="<?= base_url("assets"); ?>/images/user/avatar3.jpg" alt="profile-image" class="rounded-circle" /></span>' +
            '   </div><br>' +
            '<center>' +
            '   <h6 class="text-dark l-green shadow rounded" style="width: 50%;"><b>' +
            data.result[0].code_tiket +
            '</b></h6>' +
            '</center>' +
            '   <ul class="social-links list-unstyled">' +
            '       <span class="text-dark">' + data.result[0].nama + '</span><br>' +
            '       <span class="text-dark">' + data.result[0].email + '</span><br>' +
            '   </ul>' +
            '   <button class="btn btn-success rounded" onclick="ambilTiket(\'' + data.result[0].code_tiket + '\')" ' +
            isDisabled + '> <i class="fa fa-check-circle"> Approve</button>' +
            '</div>' +
            '</div>' +
            '</section>';

        setTimeout(function() {
            var ribbon5Element = resultElement.querySelector('.ribbons');

            if (ribbon5Element) {
                ribbon5Element.classList.add('hidden');
            }
        }, 5000);

    } else {
        resultElement.innerHTML =
            '<section class="ml-4 pl-4" >' +
            '<div class="ribbons-wrapper fade-in">' +
            '<div class="ribbon2 fade-out">' +
            '<span class="ribbon1"> &ensp; Data Tiket Tidak Ditemukan &ensp; </span>' +
            '</div>' +
            '<div class="ribbon5 fade-out hidden">' +
            '<span>Sudah Diambil</span>' +
            '</div>' +
            '</div>' +
            '</section>';

        setTimeout(function() {
            var ribbon2Element = resultElement.querySelector('.ribbon2');

            if (ribbon2Element) {
                ribbon2Element.classList.add('hidden');
            }
        }, 4000);
    }
}

// update status tiket
function ambilTiket(codeTiket) {
    $.ajax({
        url: '<?php echo base_url('Scan_tiket/update_tiket'); ?>',
        method: 'POST',
        data: {
            code_tiket: codeTiket
        },
        success: function(response) {
            console.log('Status_tiket berhasil diupdate');
            var card = resultElement.querySelector('.ribbon');
            if (card) {
                // Tambahkan kelas animasi fade-out
                card.classList.add('fade-out-animation');

                setTimeout(function() {
                    card.remove();
                }, 1000);
            }
        },
        error: function(error) {
            console.error('Gagal mengupdate status_tiket', error);
        }
    });
}

var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
});

html5QrCodeScanner.render(onScanSuccess, onScanError);

// datatable scan tiket
$(document).ready(function() {
    var table;

    table = $('#data-tiket').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Scan_tiket/get_datatiket')?>",
            "type": "POST",
        },

        "columnDefs": [{
                "targets": [3, 4, 5],
                "className": 'text-right'
            },
            {
                "targets": [0],
                "className": 'text-left'
            },
            {
                "targets": [1, 2],
                "className": 'text-center'
            },
            {
                "targets": [4, 5, 6],
                "orderable": false
            },
        ]
    })
});
</script>