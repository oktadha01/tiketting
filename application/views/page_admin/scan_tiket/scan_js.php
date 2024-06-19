<script>
// kode manual input
function submitManualCode() {
    event.preventDefault();
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
        var textClass = data.result[0].status_tiket === 'Sudah Diambil' ? 'text-white' : 'text-black';

        resultElement.innerHTML =
            '<section class="fade-in rounded">' +
            '<div class="' + ribbonfide + '">' +
            '<div class="' + wrapClass + '">' +
            '<span class="' + ribbonClass + '">' + data.result[0].status_tiket + '</span>' +
            '</div> <br>' +
            '<div class="body text-center mt-0 pt-0">' +
            '   <div class="member-img success-animation pt-0 mt-0">' +
            '       <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>' +
            '   </div>' +
            '<center>' +
            '   <h6 class="text-dark l-green shadow rounded" style="width:73%;"><b>' +
            data.result[0].code_tiket +
            '</b></h6>' +
            '</center>' +
            '   <ul class="social-links list-unstyled">' +
            '       <b><span class="' + textClass + '">' + data.result[0].nama + '</span></b><br>' +
            '       <b><span class="' + textClass + '">' + data.result[0].email + '</span></b><br>' +
            '   </ul>' +
            '   <button id="approveButton" class="btn btn-success rounded" onclick="ambilTiket(\'' + data.result[0]
            .code_tiket + '\', event)" ' +
            isDisabled + '> <i class="fa fa-check-circle"></i> Approve</button>' +
            '</div>' +
            '</div>' +
            '</section>';


        setTimeout(function() {
            var ribbon5Element = resultElement.querySelector('.ribbons');

            if (ribbon5Element) {
                ribbon5Element.classList.add('hidden');
            }


        }, 1000);

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
        }, 10000);
    }
}
// Suara notifikasi
var successSound = new Audio('assets/suara/scanner-beep.mp3');

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

            successSound.play();
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
            console.log('Status XHR:', status);
            console.log('Respon XHR:', xhr.responseText);
        }

    });
}

// update status tiket
function ambilTiket(codeTiket) {
    event.preventDefault();

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

$('#scan-tiket').on('show.bs.modal', function() {
    var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
        fps: 30,
        qrbox: {
            width: 1020,
            height: 750
        }
    });

    html5QrCodeScanner.render(onScanSuccess, onScanError);
});

$('#scan-tiket').on('hide.bs.modal', function() {
    $('#reader').html('');

});

// html5QrCodeScanner.render(onScanSuccess, onScanError);


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