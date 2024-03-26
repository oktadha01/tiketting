<form id="edit-content" enctype="multipart/form-data" method="post">
    <div class="form-group content">
        <input type="text" id="id-content" name="id_content" class="form-control" hidden />
    </div>
    <button type="button" class="btn btn-block btn-success m-t-20 edit-button">Edit Konten</button>
    
    <div id="ubah-content" class="modal">
    <form id="edit-content" enctype="multipart/form-data">
        <input type="hidden" id="id-content" name="id_content">
        <input type="hidden" id="id-content-article" name="id_article">
        <textarea id="isi-content" name="edit_content" class="form-control summernote" rows="10"></textarea>
        <div class="content">
            <!-- Ini adalah tempat untuk menampilkan gambar konten -->
            <img id="gambar-content" class="img-fluid img-thumbnail" src="" alt="">
        </div>
        <input type="file" name="image" id="image">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

    <div class="form-group" id="summernote-content" style="display:none;">
        <textarea id="content" name="edit_content" class="form-control summernote" rows="10"></textarea>
        <button type="submit" class="btn btn-block btn-primary m-t-20" id="btn-simpan-content">
            <span id="btn-text-content">Simpan</span>
            <span id="loading-icon" class="loading" style="display:none;">
                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                    <rect x="11" y="6" rx="1" width="2" height="7">
                        <animateTransform attributeName="transform" type="rotate" dur="9s" values="0 12 12;360 12 12"
                            repeatCount="indefinite" />
                    </rect>
                    <rect x="11" y="11" rx="1" width="2" height="9">
                        <animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12"
                            repeatCount="indefinite" />
                    </rect>
                </svg> Loading...
            </span>
        </button>
    </div>
</form>

<script>
$(document).on('click', '.btn-edit-content', function() {
    var id_content = $(this).data('id_content');
    var id_article = $(this).data('id_article');
    var content = $(this).data('content');
    var gambar_content = $(this).data('gambar_content');
    
    // Inisialisasi Summernote jika belum diinisialisasi
    if (!$('#isi-content').hasClass('summernote-initialized')) {
        $('.summernote').summernote();
        $('#isi-content').addClass('summernote-initialized');
    }

    // Set nilai input dan konten Summernote
    $('#ubah-content #id-content').val(id_content);
    $('#ubah-content #id-content-article').val(id_article);
    $('#ubah-content #isi-content').val(content);
    $('#isi-content').summernote('code', content);

    // Set src gambar konten
    $('#gambar-content').attr('src', "<?php echo base_url('upload/artikel/tanam.jpg'); ?>");

    // Tampilkan modal
    $('#ubah-content').modal('show');
});


</script>