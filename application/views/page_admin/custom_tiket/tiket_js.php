<script>
$(document).ready(function() {

    let namaColorPicker;
    let emailColorPicker;
    let kategoriColorPicker;
    let kodeColorPicker;

    let defaultColor = "#ffffff";

    window.addEventListener("load", startup, false);

    function startup() {
        const id_event = document.querySelector("#id-event").value;

        function initializeColorPicker(selector, columnName, updateFunction) {
            const colorPicker = $(selector).colorpicker({
                format: 'hex',
                color: defaultColor
            });

            getColorFromServer(id_event, columnName, function(response) {

                if (response && response.success !== undefined && response[columnName] !== undefined) {
                    const color = response[columnName] || defaultColor;
                    colorPicker.colorpicker('setValue', color);
                    updateFunction({
                        color: color
                    });
                } else {
                    colorPicker.colorpicker('setValue', defaultColor);
                    updateFunction({
                        color: defaultColor
                    });
                }
            });

            colorPicker.on('changeColor', function(event) {
                updateFunction(event);
            });
        }

        initializeColorPicker('#color-nama', 'color_nama', updateNama);
        initializeColorPicker('#color-email', 'color_email', updateEmail);
        initializeColorPicker('#color-kategori', 'color_kategori', updatekategori);
        initializeColorPicker('#color-kode', 'color_code_tiket', updatekode);
    }

    function getColorFromServer(id, columnName, callback) {
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('Custom_tiket/get_color');?>/' + id,
            success: function(response) {

                if (response && response.success && response[columnName]) {
                    callback(response);
                } else {
                    callback({
                        success: false
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching color from server:', error);
                callback({
                    success: false
                });
            }
        });
    }

    function updateNama(event) {
        updateColor('.nama', event);
    }

    function updateEmail(event) {
        updateColor('.email', event);
    }

    function updatekategori(event) {
        updateColor('.kategori', event);
    }

    function updatekode(event) {
        updateColor('.kode-tiket', event);
    }

    function updateColor(selector, event) {
        console.log('Updating color for ${selector} to:', event.color);
        const element = document.querySelector(selector);
        if (element) {
            element.style.color = event.color || defaultColor;
        }
    }

});

$(function() {

    $('#btn-upload-photo').on('click', function() {
        $(this).siblings('#filePhoto').trigger('click');
    });

    $('#filePhoto').on('change', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

});

// simpan data custom tiket

$("#simpan-warna").submit(function(e) {
    e.preventDefault();

    $('#btn-text').hide();
    $('#loading-icon').show();
    $('#btn-simpan').attr('disabled', true);

    var id_event = $('#id-event').val();
    var color_nama = $('#color-nama').val();
    var color_email = $('#color-email').val();
    var color_kategori = $('#color-kategori').val();
    var color_code_tiket = $('#color-kode').val();
    var filePhoto = $('#filePhoto')[0].files[0];

    var formData = new FormData();
    formData.append('id_event', id_event);
    formData.append('color_nama', color_nama);
    formData.append('color_email', color_email);
    formData.append('color_kategori', color_kategori);
    formData.append('color_code_tiket', color_code_tiket);
    formData.append('filePhoto', filePhoto);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('Custom_tiket/save_custom');?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('#btn-text').show();
            $('#loading-icon').hide();
            $('#btn-simpan').attr('disabled', false);

            if (response.status === 'success') {
                Swal.fire({
                    position: "top-center",
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Perform Berhasil Dibuat.',
                    timer: 1400
                });
            } else {
                console.error('Terjadi kesalahan saat validasi data di server.');

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: response.message ||
                        'Terjadi kesalahan saat validasi data di server.',
                });
            }
        },
        error: function(xhr, status, error) {
            $('#btn-text').show();
            $('#loading-icon').hide();
            $('#btn-simpan').attr('disabled', false);

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengirim data ke server.',
            });
        }
    });
});
</script>