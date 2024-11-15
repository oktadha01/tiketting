<script>
$(document).ready(function() {
    const defaultColor = "#ffffff";

    function initializeColorPicker(selector, columnName) {
        const colorPicker = $(selector).colorpicker({
            format: 'hex',
            color: defaultColor
        });

        getColorFromServer(columnName, function(response) {
            // console.log('Server response for', columnName, ':', response);
            if (response && response[columnName]) {
                const color = response[columnName] || defaultColor;
                // console.log(`Setting color for ${selector} to ${color}`);
                colorPicker.colorpicker('setValue', color);
                $(selector).val(color);
                updateColorDisplay(selector, color);

                // Update preview
                updatePreviewColor(selector, color);
            } else {
                // console.log(
                //     `Setting default color for ${selector} to ${defaultColor}`
                // );
                colorPicker.colorpicker('setValue', defaultColor);
                $(selector).val(defaultColor);
                updateColorDisplay(selector, defaultColor);

                // Update preview
                updatePreviewColor(selector, defaultColor);
            }
        });

        colorPicker.on('changeColor', function(event) {
            const newColor = event.color.toString('hex');
            updateColorDisplay(selector, newColor);
            updatePreviewColor(selector, newColor);
        });
    }

    function getColorFromServer(columnName, callback) {
        const id_event = $('#id-event').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo site_url('Custom_tiket/get_color');?>/' + id_event,
            success: function(response) {
                // console.log('Server response:', response);
                callback(response);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching color from server:', error);
                callback({
                    success: false
                });
            }
        });
    }

    function updateColorDisplay(selector, color) {
        // console.log(`Updating color for ${selector} to: ${color}`);
        $(selector).val(color);
    }

    function updatePreviewColor(selector, color) {
        if (selector === '#color-nama') {
            $('.nama').css('color', color);
        } else if (selector === '#color-email') {
            $('.email').css('color', color);
        } else if (selector === '#color-kategori') {
            $('.kategori').css('color', color);
        } else if (selector === '#color-kode') {
            $('.kode-tiket').css('color', color);
        }
    }

    initializeColorPicker('#color-nama', 'color_nama');
    initializeColorPicker('#color-email', 'color_email');
    initializeColorPicker('#color-kategori', 'color_kategori');
    initializeColorPicker('#color-kode', 'color_code_tiket');
});

$(function() {
    $('#btn-upload-photo').on('click', function() {
        $(this).siblings('#filePhoto').trigger('click');
    });

    $('#filePhoto').on('change', function() {
        if (this.files && this.files[0]) {
            readURL(this);
        }
    });

    function readURL(input) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#previewImage').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

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

        if (filePhoto) {
            formData.append('filePhoto', filePhoto);
        }

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
});
</script>