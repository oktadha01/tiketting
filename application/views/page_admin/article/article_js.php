<script>
// data list artikel
$(document).ready(function() {

    var limit = 8;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit) {
        var output = '';
        output += '<div class="post_data">';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output +=
            '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
        $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start, search = '') {
        $.ajax({
            url: "<?php echo base_url(); ?>Article/fetch",
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
                        '<div class="alert alert-warning alert-dismissible shadow-lg p-3 mb-4" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button>' +
                        '<i class="fa fa-folder-open"></i>Tidak Ada Data Artikel ...</div>'
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

    $('#search-artikel').on('input', function() {
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

    function reload_data() {
        var limit = 8;
        var start = 0;

        $('#load_data').html('');
        lazzy_loader(limit);
        load_data(limit, start);
    }

    // data select tags
    $(function() {
        $('select').each(function() {
            $(this).select2({
                theme: 'bootstrap4',
            });
        });
    });

    function select_tag() {
        $.ajax({
            url: '<?=site_url('Article/select_data_tag')?>',
            type: 'GET',
            success: function(data) {
                $('#select-tag').html(data);
                $('#select-tag').change(function() {
                    var selectValue = $(this).val();
                    var tagsInput = $('#tags-input');
                    var tagslect = $('#select2-tags')

                    if (selectValue === 'add tag') {
                        tagsInput.show();
                        tagslect.hide();
                    } else {
                        tagsInput.hide();
                        tagslect.show();
                    }
                });
            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }

    select_tag();

    $('#select-tag').on('change', function() {
        // console.log('Tag terpilih:', $(this).val());
    });

    // kode simpan data
    $('#tambah-data').on('hidden.bs.modal', function() {
        $('#artikel-baru')[0].reset();

        $('.dropify-clear').trigger('click');
        $('.dropify-preview .dropify-render img').attr('src', '');
    });

    $('#tambah-data').submit(function(event) {
        event.preventDefault();

        $('#btn-text').hide();
        $('#loading-icon').show();
        $('#btn-simpan').attr('disabled', true);

        var formData = new FormData($('#artikel-baru')[0]);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Article/buat_artikel') ?>',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#loading-icon').hide();
                $('#btn-text').show();
                $('#btn-simpan').attr('disabled', false);

                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: ' Artikel berhasil ditambahkan.',
                        timer: 1500
                    });

                    reload_data();

                    $('#tambah-data').modal('hide');
                    $('#artikel-baru')[0].reset();
                    $('.dropify-clear').trigger('click');
                    $('.dropify-preview .dropify-render img').attr('src', '');

                } else {
                    console.error('Terjadi kesalahan saat validasi data di server.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat validasi data di server.',
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#loading-icon').hide();
                $('#btn-text').show();
                $('#btn-simpan').attr('disabled', false);

                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                });
            }
        });
    });
    // akhir kode simpan dat

    function select_tagedit() {
        $.ajax({
            url: '<?=site_url('Article/select_data_tag')?>',
            type: 'GET',
            success: function(data) {
                $('#edit-select-tag').html(data);
                $('#edit-select-tag').change(function() {
                    var selectValue = $(this).val();
                    var tagsInput = $('#edit-tags-input');
                    var tagslect = $('#edit-select2-tags')

                    if (selectValue === 'add tag') {
                        tagsInput.show();
                        tagslect.hide();
                    } else {
                        tagsInput.hide();
                        tagslect.show();
                    }
                });
            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }

    select_tagedit();

    // kode edit judul
    $(document).on('click', '.btn-edit', function() {
        var id_article = $(this).data('id_article');
        var judul_article = $(this).data('judul_article');
        var tgl_article = $(this).data('tgl_article');
        var meta_desc = $(this).data('meta_desc');
        var tags = $(this).data('tags');
        var gambar = $(this).data('gambar');
        var defaultgambarValue = 'upload/artikel/' + gambar;

        $('#ubah-artikel #edit-id-article').val(id_article);
        $('#ubah-artikel #edit-judul').val(judul_article);
        $('#ubah-artikel #edit-tanggal').val(tgl_article);
        $('#ubah-artikel #edit-meta-desc').val(meta_desc);
        $('#ubah-artikel #edit-select-tag').val(tags);
        $('#ubah-artikel #gambar-lama').val(gambar);

        // Set nilai file default untuk dropify untuk poster
        $('#edit-image').attr('data-default-file', defaultgambarValue);
        $('#edit-image').dropify();

    });

    $('#ubah-artikel').on('hidden.bs.modal', function() {
        $('#artikel-edit')[0].reset();

        $('.dropify-clear').trigger('click');
        $('.dropify-preview .dropify-render img').attr('src', '');
    });

    $('#artikel-edit').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Article/edit_judul'); ?>",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status) {
                    console.log(response);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Event Berhasil Diubah.',
                        timer: 1500
                    });

                    reload_data();

                    $('#ubah-artikel').modal('hide');
                    $('#artikel-edit')[0].reset();
                    $('.dropify-preview .dropify-render img').attr('src', response
                        .newImagePath);
                    $('.dropify-clear').trigger('click');

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message ||
                            'Terjadi kesalahan saat validasi data di server.',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim permintaan ke server.',
                });
            },
        });
    });
    // akhir kode edit judul

    // tambah content
    $(document).on('click', '.btn-content', function() {
        var id_content = $(this).data('id_content');
        var id_article = $(this).data('id_article');
        // console.log("ID content:", id_content);

        $('#tambah-content #id-addcontent-article').val(id_article);
        $('#tambah-content #id-content-gbr-add').val(id_content);

        $.ajax({
            url: '<?php echo base_url("Article/get_data_gambar"); ?>',
            method: 'POST',
            data: {
                id_content: id_content
            },
            dataType: 'json',
            success: function(response) {
                $('#gambar-content-container').empty();
                response.forEach(function(imageData) {
                    var imgElement =
                        '<div class="col-lg-4 col-md-6 col-sm-12 m-b-10 image-container">' +
                        '<img class="img-fluid img-thumbnail" src="' + imageData
                        .url +
                        '" alt="' + imageData.alt + '">' +
                        '<button type="button" class="btn btn-danger delete-button" data-id="' +
                        imageData.id_gambar +
                        '" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>' +
                        '</div>';
                    $('#gambar-content-container').append(imgElement);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    function reloadGambaradd(id_content) {
        $.ajax({
            url: '<?php echo base_url("Article/get_data_gambar"); ?>',
            method: 'POST',
            data: {
                id_content: id_content
            },
            dataType: 'json',
            success: function(response) {
                $('#gambar-content-add').empty();
                response.forEach(function(imageData) {
                    var imgElement =
                        '<div class="col-lg-4 col-md-6 col-sm-12 m-b-10 image-container">' +
                        '<img class="img-fluid img-thumbnail" src="' + imageData
                        .url +
                        '" alt="' + imageData.alt + '">' +
                        '<button type="button" class="btn btn-danger delete-button" data-id="' +
                        imageData.id_gambar +
                        '" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>' +
                        '</div>';
                    $('#gambar-content-add').append(imgElement);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // tambah gambar
    $(function() {
        // photo upload
        $('#btn-upload-add').on('click', function() {
            $('#filePhoto-add').trigger('click');
        });

        $('#filePhoto-add').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImage-add').attr('src', e.target.result).show();
                    $('#btn-upload-add').hide();
                    $('#btn-upload-photo-add').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        });

        // Simpan gambar
        $('#btn-upload-photo-add').click(function() {
            var formData = new FormData();
            formData.append('id_content', $('#id-content-gbr-add').val());
            formData.append('gambar', $('#filePhoto-add')[0].files[0]);

            $.ajax({
                url: '<?= base_url('Article/tambah_gambar') ?>',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var id_content = $('#id-content-gbr-add').val();
                    reloadGambaradd(id_content);
                    $('#btn-upload-add').hide();
                    $('#btn-upload-photo-add').show();
                    $('#previewImage-add').hide();
                    alert('Gambar berhasil disimpan:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append(
                '<span><i class="fa fa-check-circle"></i></span>');
        });
    });

    $('#tambah-content').submit(function(event) {
        event.preventDefault();

        $('#btn-text-content').hide();
        $('#loading-icon').show();
        $('#btn-simpan-content').attr('disabled', true);

        var formData = new FormData($('#artikel-content')[0]);

        var content = $('.summernote').summernote('code');
        formData.append('content_article', content);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('Article/isi_content') ?>',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                $('#btn-text-content').show();
                $('#loading-icon').hide();
                $('#btn-simpan-content').attr('disabled', false);

                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Artikel berhasil ditambahkan.',
                        timer: 1500
                    });

                    reload_data();
                    $('#tambah-content').modal('hide');
                    $('#artikel-content')[0].reset();

                } else {
                    console.error('Terjadi kesalahan saat validasi data di server.');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat validasi data di server.',
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#btn-text-content').show();
                $('#loading-icon').hide();
                $('#btn-simpan-content').attr('disabled', false);

                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim data ke server.',
                });
            }
        });
    });

    // akhir tambah content

    // edit content

    $('#ubah-content').on('shown.bs.modal', function(e) {
        var id_article = $(e.relatedTarget).data('id_article');
        var id_content = $(e.relatedTarget).data('id_content');

        $.ajax({
            url: '<?php echo base_url("Article/get_content_by_article_id"); ?>',
            method: 'POST',
            data: {
                id_article: id_article,
                id_content: id_content
            },
            dataType: 'json',
            success: function(response) {
                $('#gambar-content-container').empty();
                $('.content').empty();

                response.forEach(function(data) {

                    var id_content = data.id_content;
                    var id_article = data.id_article;

                    var combinedElement =
                        '<div class="card pb-2 mb-2">' +
                        '<div class="body mb-0 pb-0">' +
                        '<div class="col-lg-12" id="aniimated-thumbnials">' +
                        '<div id="gambar-content-container" class="list-unstyled row clearfix">';
                    if (data.photos !== null) {

                        data.photos.forEach(function(photo) {
                            combinedElement +=
                                '<div class="col-md-4 col-sm-6 m-b-10 pr-1 pl-1 image-container">' +
                                '<img class="img-fluid img-thumbnail" src="<?php echo base_url('upload/artikel/content/'); ?>' +
                                photo.gambar_content + '" alt="">' +
                                '<img class="img-fluid img-thumbnail" id="previewImage_' +
                                data.id_content +
                                '" src="#" alt="Preview" style="max-width: 100%; display: none;">' +
                                '<button type="button" class="btn btn-danger delete-button" data-id_content="' +
                                id_content + '" data-id_article="' +
                                id_article + '" data-id="' +
                                photo.id_foto_content +
                                '" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>' +
                                '</div>';
                        });

                    }

                    var editButton =
                        '<button type="button" class="btn btn-block btn-success m-t-20 edit-button" data-id_content="' +
                        id_content + '" data-id_article="' +
                        id_article + '" data-id="' + id_content +
                        '"><span class="sr-only">Edit Konten</span></button>';

                    combinedElement +=
                        '</div>' +
                        '</div>' +
                        '<div class="col-lg-12 pr-0">' +
                        '<form class="form-upload-gambar" enctype="multipart/form-data">' +

                        '<input type="text" class="id-content-gbr" name="id_content" value="' +
                        data.id_content + '" hidden />' +
                        '<div class="media-body align-right">' +
                        '<button type="button" class="btn-sm btn-primary m-b-20 m-t-0 ml-auto btn-upload-photo">Tambah Gambar</button>' +

                        '<input type="file" class="filePhoto sr-only" data-id-content="' +
                        data.id_content + '">' +

                        '<button type="button" class="btn-upload simpan btn-sm btn-info m-b-10 m-t-0" style="display: none;" id="simpanGambar_' +
                        data.id_content + '">Simpan Gambar</button>' +
                        '</div>' +
                        '</form>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-lg-12">' +
                        '<form id="edit-content" enctype="multipart/form-data" method="post">' +
                        '<input type="text" data-id-content="' + data.id_content +
                        '" name="id_content" class="form-control" hidden />' +
                        '<input type="text" data-id-article="' + data.id_article +
                        '" name="id_article" class="form-control" hidden /> ' +
                        '<div class="form-group content">' + data.content +
                        '<button type="button" class="btn btn-block btn-success m-t-20 edit-button" data-id_content="' +
                        id_content + '" data-id_article="' + id_article +
                        '><span class="sr-only">Edit Konten</span></i></button>' +
                        '<div class="form-group" id="summernote-content" style="display: none;">' +
                        '<textarea id="isi-content" name="edit_content" class="form-control summernote" rows="10">' +
                        data.content + ' </textarea>' +
                        '<button type="submit" class="btn btn-block btn-primary m-t-20" id="btn-ubah-content"> <span id="btn-text-edit-content">Simpan</span> <span id="loading-iconconten" class="loading" style="display:none;"> Loading... </span> </button>' +
                        '</div>' +
                        '</form' +

                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('#ubah-content #data-artikel').append(combinedElement);
                });

                $('.btn-upload-photo').off('click').on('click', function() {
                    $(this).closest('.col-lg-12').find('.filePhoto').trigger(
                        'click');
                });

                $(document).on('change', '.filePhoto', function() {
                    var input = this;
                    var id_content = $(input).data('id-content');
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#previewImage_' + id_content).attr('src', e
                                .target.result).show();
                            $('.btn-upload-photo').hide();
                            $('.content' + id_content).show();
                            $('#simpanGambar_' + id_content).show();
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });

                // Simpan gambar
                $(document).on('click', '.btn-upload', function() {
                    var formData = new FormData();
                    var id_content = $(this).closest('.col-lg-12').find(
                        '.id-content-gbr').val();
                    formData.append('id_content', id_content);
                    formData.append('gambar', $(this).closest('.col-lg-12').find(
                        '.filePhoto')[0].files[0]);

                    $.ajax({
                        url: '<?= base_url('Article/tambah_gambar') ?>',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            reloadGambar(id_content, id_article);
                            $('.btn-upload').hide();
                            $('.btn-upload-photo').show();
                            $('#previewImage_' + id_content).hide();
                            alert('Gambar berhasil disimpan !! ');
                        },
                        error: function(xhr, status, error) {
                            console.error('Terjadi kesalahan:', error);
                        }
                    });
                });

                // plans
                $('.btn-choose-plan').on('click', function() {
                    $('.plan').removeClass('selected-plan');
                    $('.plan-title span').find('i').remove();

                    $(this).parent().addClass('selected-plan');
                    $(this).parent().find('.plan-title').append(
                        '<span><i class="fa fa-check-circle"></i></span>'
                    );
                });

                // $('#isi-content').summernote('code', content);
                // $('#ubah-content .content').html(content);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    $(document).on('click', '#ubah-content .edit-button', function() {
        var id_content = $(this).data('id_content');
        var id_article = $(this).data('id_article');

        $('.content[data-id_content="' + id_content + '"]').hide();
        $('#gambar-content-container').hide();
        $('.btn-upload-photo').hide();
        $('#previewImage_' + id_content).hide();
        // Sembunyikan tombol simpan
        $('.simpan').hide();

        // Ambil teks konten yang ingin diedit
        var existingContent = $('.content[data-id_content="' + id_content + '"]').text();
        console.log(existingContent); // Log teks konten ke konsol

        // Masukkan teks konten ke dalam textarea untuk diedit
        $('#isi-content').val(existingContent);

        // Tampilkan Summernote dan konten yang akan diedit
        $('#summernote-content textarea[data-id-content="' + id_content + '"]').summernote({
            // Konfigurasi Summernote
        });

        // Tampilkan #summernote-content berdasarkan id_content yang dipilih
        $('#summernote-content[data-id-content="' + id_content + '"]').show();
    });




    function reloadGambar(id_content, id_article) {

        $.ajax({
            url: '<?php echo base_url("Article/get_content_by_article_id"); ?>',
            method: 'POST',
            data: {
                id_article: id_article,
                id_content: id_content
            },
            dataType: 'json',
            success: function(response) {
                $('#data-artikel').empty();

                response.forEach(function(data) {
                    var combinedElement =
                        '<div class="card pb-2 mb-2">' +
                        '<div class="body mb-0 pb-0">' +
                        '<div class="col-lg-12" id="aniimated-thumbnials">' +
                        '<div id="gambar-content-container" class="list-unstyled row clearfix">';
                    if (data.photos !== null) {

                        data.photos.forEach(function(photo) {
                            combinedElement +=
                                '<div class="col-md-4 col-sm-6 m-b-10 pr-1 pl-1 image-container">' +
                                '<img class="img-fluid img-thumbnail" src="<?php echo base_url('upload/artikel/content/'); ?>' +
                                photo.gambar_content + '" alt="">' +
                                '<img class="img-fluid img-thumbnail" id="previewImage_' +
                                data.id_content +
                                '" src="#" alt="Preview" style="max-width: 100%; display: none;">' +
                                '<button type="button" class="btn btn-danger delete-button" data-id_content="' +
                                id_content + '" data-id_article="' +
                                id_article + '" data-id="' +
                                photo.id_foto_content +
                                '" title="Delete"><span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></button>' +
                                '</div>';
                        });
                    }

                    combinedElement +=
                        '</div>' +
                        '</div>' +
                        '<div class="col-lg-12 pr-0">' +
                        '<form class="form-upload-gambar" enctype="multipart/form-data">' +

                        '<input type="text" class="id-content-gbr" name="id_content" value="' +
                        data.id_content + '" hidden />' +
                        '<div class="media-body align-right">' +
                        '<button type="button" class="btn-sm btn-primary m-b-20 m-t-0 ml-auto btn-upload-photo">Tambah Gambar</button>' +

                        '<input type="file" class="filePhoto sr-only" data-id-content="' +
                        data.id_content + '">' +

                        '<button type="button" class="btn-upload simpan btn-sm btn-info m-b-10 m-t-0" style="display: none;" id="simpanGambar_' +
                        data.id_content + '">Simpan Gambar</button>' +
                        '</div>' +
                        '</form>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-lg-12">' +
                        '<div class="form-group content">' + data.content +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    $('#data-artikel').append(combinedElement);
                });

                $('.btn-upload-photo').off('click').on('click', function() {
                    $(this).closest('.col-lg-12').find('.filePhoto').trigger(
                        'click');
                });

                $(document).on('change', '.filePhoto', function() {
                    var input = this;
                    var id_content = $(input).data('id-content');
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#previewImage_' + id_content).attr('src', e
                                .target.result).show();
                            $('.btn-upload-photo').hide();
                            $('.content' + id_content).show();
                            $('#simpanGambar_' + id_content).show();
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                });

                $('.btn-choose-plan').on('click', function() {
                    $('.plan').removeClass('selected-plan');
                    $('.plan-title span').find('i').remove();

                    $(this).parent().addClass('selected-plan');
                    $(this).parent().find('.plan-title').append(
                        '<span><i class="fa fa-check-circle"></i></span>'
                    );
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }


    $('#edit-content').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);

        $('#btn-text-edit-content').hide();
        $('#loading-iconconten').show();
        $('#btn-ubah-content').attr('disabled', true);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Article/edit_content'); ?>",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                $('#loading-iconconten').hide();
                $('#btn-text-edit-content').show();
                $('#btn-ubah-content').attr('disabled', false);

                $('#summernote-content').hide();
                $(this).hide();
                $('.simpan').hide();
                $('#btn-smp').show();
                $('.content').show();
                $('#aniimated-thumbnials').show();

                if (response.status) {
                    console.log(response);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data Content Berhasil Diubah.',
                        timer: 1500
                    });

                    reload_data();

                    $('#ubah-content').modal('hide');
                    $('#edit-content')[0].reset();


                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message ||
                            'Terjadi kesalahan saat validasi data di server.',
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#loading-iconconten').hide();
                $('#btn-text-edit-content').show();
                $('#btn-ubah-content').attr('disabled', false);

                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat mengirim permintaan ke server.',
                });
            },
        });
    });
    // akhir ubah content

    $(document).on('click', '.delete-button', function() {
        if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
            var idGambar = $(this).data('id');
            var id_article = $(this).data('id_article');
            var id_content = $(this).data('id_content');


            $.ajax({
                url: '<?= base_url('Article/hapus_gambar') ?>',
                method: 'POST',
                data: {
                    id_gambar: idGambar,
                    id_article: id_article,
                    id_content: id_content
                },
                success: function(response) {

                    reloadGambar(id_content, id_article);

                    alert('Gambar berhasil di Hapus:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        }
    });

});
</script>