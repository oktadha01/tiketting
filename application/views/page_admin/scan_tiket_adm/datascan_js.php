<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.2/FileSaver.min.js"></script>
<script>
var successSound = new Audio('assets/suara/scanner-beep.mp3');


$(document).ready(function() {
    var table;

    table = $('#data-tiket').DataTable({
        "paging": true,
        "autoWidth": true,
        "search": true,
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?=site_url('Scan_tiket/get_datatiket/')?><?= $this->uri->segment(3);?>",
            "type": "POST",
            "data": function(d) {
                d.status_filter = $('#status_filter').val();
            }
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
    $('#status_filter').on('change ', function() {
        // console.log('Nilai select: ' + $(this).val());
        table.draw();
    });
});

$(document).ready(function() {

    var limit = 8;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit) {
        var output = '';
        // for (var count = 0; count < limit; count++) {
        output += '<div class="post_data">';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        // }
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Scan_tiket/fetch",
            method: "POST",
            data: {
                limit: limit,
                start: start,
                search: search
            },
            cache: false,
            success: function(data) {
                if (data.trim() === '') {
                    $('#load_data_message').html(
                        '<div class="alert alert-danger alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        '<i class="fa fa-folder-open"></i> Data Event Tidak Ada Lagi...</div>'
                    );
                    action = 'active';
                } else {
                    $('#load_data').append(data);
                    $('#load_data_message').html("");
                    action = 'inactive';
                }
            }
        });
    }

    if (action == 'inactive') {
        action = 'active';
        load_data(limit, start);
    }

    $('#search-event').on('input', function() {
        var search = $(this).val();
        $('#load_data').html('');
        start = 0;
        lazzy_loader(limit);
        load_data(limit, start, search);
    });

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action ==
            'inactive') {
            lazzy_loader(limit);
            action = 'active';
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start);
            }, 1000);
        }
    });

});

$('#export-excel').on('click', function() {
    $.ajax({
        url: "<?=site_url('Scan_tiket/get_datatiket/')?><?= $this->uri->segment(3);?>",
        type: "POST",
        data: {
            status_filter: $('#status_filter').val(),
            length: -1
        },
        success: function(response) {
            console.log("Full response from server:",
                response);

            if (!response) {
                console.error("Tidak ada respons dari server.");
                return;
            }

            if (typeof response === 'string') {
                response = JSON.parse(response);
            }

            if (!response.data) {
                console.error("Respons tidak memiliki properti 'data'.");
                console.log("Respons yang diterima:", response);
                return;
            }

            if (!Array.isArray(response.data)) {
                console.error("Data tidak dalam format array.");
                console.log("Tipe data:", typeof response.data);
                return;
            }

            var tableData = [];
            var headers = ['No', 'Nama', 'Gender', 'Email', 'Kontak', 'No. Identitas', 'Status'];

            // Tambahkan header ke tableData
            tableData.push(headers);

            // Tambahkan baris data ke tableData
            response.data.forEach(function(row, index) {
                var rowData = [];
                rowData.push(row[0]);
                rowData.push(row[1]);
                rowData.push(row[2]);
                rowData.push(row[3]);
                rowData.push(row[4]);
                rowData.push(row[5]);
                rowData.push($(row[6]).text().trim());
                tableData.push(rowData);
            });

            // Buat worksheet dan workbook
            var ws = XLSX.utils.aoa_to_sheet(tableData);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Data Tiket");

            // Header style using xlsx-style
            var headerStyle = {
                fill: {
                    patternType: "solid",
                    fgColor: {
                        rgb: "0000FF"
                    }
                },
                font: {
                    color: {
                        rgb: "FFFFFF"
                    },
                    bold: true
                }
            };

            headers.forEach(function(header, index) {
                var cell_address = {
                    c: index,
                    r: 0
                };
                var cell_ref = XLSX.utils.encode_cell(cell_address);
                if (!ws[cell_ref]) return;
                Object.assign(ws[cell_ref], headerStyle);
            });

            var colWidths = headers.map(header => ({
                wpx: header.length * 10
            }));
            ws['!cols'] = colWidths;

            var wbout = XLSX.write(wb, {
                bookType: 'xlsx',
                type: 'binary'
            });

            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) {
                    view[i] = s.charCodeAt(i) & 0xFF;
                }
                return buf;
            }

            // simpan file dengan nama event
            var filename = 'data_tiket_' + response.nm_event + '.xlsx';
            saveAs(new Blob([s2ab(wbout)], {
                type: "application/octet-stream"
            }), filename);
        },
        error: function(error) {
            console.error("Kesalahan dalam mengambil data: ", error);
        }
    });
});
</script>