<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/ribbons.css">
<link rel="stylesheet" href="<?= base_url('assets'); ?>/css/artikel.css">

<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2><?= $tittle; ?></h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= site_url('Article'); ?>"><i class="fa fa-money"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><?= $bread?></li>
                </ul>
            </div>
            <div class="navbar-right col-lg-6 col-md-6 col-sm-12 ">
                <form id="navbar-search" class="navbar-form search-form shadow" style="float: right;">
                    <input id="search-artikel" class="form-control" placeholder=" Search Article here..." type="text">
                    <button type="button" class="btn btn-default"> &nbsp; <i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-lg-12 col-md-6 col-sm-12 d-flex flex-row-reverse mt-3">
            <button type="button" class="btn btn-primary shadow rounded" data-toggle="modal"
                data-target="#tambah-data"><i class="fa fa-file-archive-o"></i>
                <span> &nbsp;Tambah Artikel</span></button>
        </div>
        <div class="body pt-2 pb-1 mb-1">
            <ul class="comment-reply list-unstyled" id="load_data">
            </ul>
            <div id="load_data_message"></div>
        </div>
    </div>
</div>

<!-- JUDUL -->
<!-- modal tambah-->
<div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="artikel-baru" enctype="multipart/form-data" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body">
                                    <div class="form-group">
                                        <input type="text" id="judul" name="judul" class="form-control"
                                            placeholder="Judul Article" />
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <!-- <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                placeholder="Tanggal Article" /> -->
                                            <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                                class="form-control" id="tanggal" name="tanggal"
                                                placeholder="Tanggal Article">
                                        </div>
                                        <div class="col-md-12 col-lg-6 mb-2">
                                            <div class="input-wrapper" id="select2-tags">
                                                <select class="select h-100" id="select-tag" name="tags"
                                                    style=" height: 73%;" data-dropdown-parent="#tambah-data">
                                                </select>
                                            </div>
                                            <div class="input-group demo-tagsinput-area" id="tags-input"
                                                style="display: none;">
                                                <input type="text" class="form-control" name="tags_input"
                                                    data-role="tagsinput" placeholder="Masukkan tags baru">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="card mb-0">
                                                <div class="header pt-2 pb-0">
                                                    <label class="label-up">Upload Gambar</label>
                                                </div>
                                                <div class="body pt-2">
                                                    <input type="file" class="dropify" id="image" name="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 pl-0 pb-0">
                                            <textarea class="form-control" rows="11" cols="30" name="meta_desc"
                                                placeholder="Isikan Meta Deskripsi" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Keluar</button>
                        <button type="submit" class="btn btn-primary " id="btn-simpan">
                            <span id="btn-text">Post</i></span>
                            <span id="loading-icon" class="loading" style="display:none;">
                                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                    <rect x="11" y="6" rx="1" width="2" height="7">
                                        <animateTransform attributeName="transform" type="rotate" dur="9s"
                                            values="0 12 12;360 12 12" repeatCount="indefinite" />
                                    </rect>
                                    <rect x="11" y="11" rx="1" width="2" height="9">
                                        <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                            values="0 12 12;360 12 12" repeatCount="indefinite" />
                                    </rect>
                                </svg> Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal tambah-->

<!-- modal ubah judul artikel-->
<div class="modal fade" id="ubah-artikel" tabindex="-1" role="dialog" aria-labelledby="etambah-data" aria-hidden="true"
    data-modal-parent="tambah-data">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="artikel-edit" enctype="multipart/form-data" method="post">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body">
                                    <div class="form-group">
                                        <input type="text" id="edit-id-article" name="id_article" class="form-control"
                                            hidden />
                                        <input type="text" id="edit-judul" name="judul" class="form-control"
                                            placeholder="Judul Article" />
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <input data-provide="datepicker" data-date-autoclose="true" type="text"
                                                class="form-control" id="edit-tanggal" name="tanggal"
                                                placeholder="Tanggal Article">
                                        </div>
                                        <div class="col-md-12 col-lg-6 mb-2">
                                            <div class="input-wrapper" id="edit-select2-tags">
                                                <select class="select h-100" id="edit-select-tag" name="tags"
                                                    style=" height: 73%;" data-dropdown-parent="#ubah-artikel">
                                                </select>
                                            </div>
                                            <div class="input-group demo-tagsinput-area" id="edit-tags-input"
                                                style="display: none;">
                                                <input type="text" class="form-control" name="tags_input"
                                                    data-role="tagsinput" placeholder="Masukkan tags baru">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="card mb-0">
                                                <div class="header pt-2 pb-0">
                                                    <label class="label-up">Upload Gambar</label>
                                                </div>
                                                <div class="body pt-2">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="edit-image"
                                                            name="edit_image">
                                                    </div>
                                                </div>
                                                <input type="hidden" id="gambar-lama" value="" name="gambar_lama">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 pl-0 pb-0">
                                            <textarea class="form-control" rows="11" cols="30" id="edit-meta-desc"
                                                name="meta_desc" placeholder="Isikan Meta Deskripsi"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Keluar</button>
                        <button type="submit" class="btn btn-primary " id="btn-simpan">
                            <span id="btn-text">Post</i></span>
                            <span id="loading-icon" class="loading" style="display:none;">
                                <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                    <rect x="11" y="6" rx="1" width="2" height="7">
                                        <animateTransform attributeName="transform" type="rotate" dur="9s"
                                            values="0 12 12;360 12 12" repeatCount="indefinite" />
                                    </rect>
                                    <rect x="11" y="11" rx="1" width="2" height="9">
                                        <animateTransform attributeName="transform" type="rotate" dur="0.75s"
                                            values="0 12 12;360 12 12" repeatCount="indefinite" />
                                    </rect>
                                </svg> Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal ubah -->

<!-- KONTEN -->
<!-- model tambah konten -->
<div class="modal fade" id="tambah-content" tabindex="-1" role="dialog" aria-labelledby="tambah-content"
    aria-hidden="true" data-modal-parent="tambah-data">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <div id="gambar-content-add" class="list-unstyled row clearfix">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 m-b-10 pl-0">
                                    <img class="img-fluid img-thumbnail" id="previewImage-add" src="#" alt="Preview"
                                        style="max-width: 100%; display: none;">
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 d-flex flex-row-reverse pt-0 pb-15 pr-0">
                                    <form id="form-gambar-add" enctype="multipart/form-data">
                                        <input type="text" id="id-content-gbr-add" name="id_content"
                                            class="form-control" hidden />
                                        <div class="media-body">
                                            <button type="button" class="btn-sm btn-primary m-b-8 m-t-0 m-r-0"
                                                id="btn-upload-add">Tambah
                                                Gambar</button>
                                            <input type="file" id="filePhoto-add" class="sr-only">
                                        </div>
                                        <button type="button" id="btn-upload-photo-add"
                                            class="simpan btn-sm btn-info m-b-8 m-t-0 m-r-0"
                                            style="display: none;">Simpan Gambar</button>
                                    </form>
                                </div>
                                <form id="artikel-content" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <input type="text" id="id-addcontent-article" name="id_article"
                                            class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <textarea id="content-article" name="content_article"
                                            class="form-control summernote" rows="10"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-block btn-primary m-t-20 "
                                        id="btn-simpan-content">
                                        <span id="btn-text-content">Post</i></span>
                                        <span id="loading-icon" class="loading" style="display:none;">
                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" />
                                                <rect x="11" y="6" rx="1" width="2" height="7">
                                                    <animateTransform attributeName="transform" type="rotate" dur="9s"
                                                        values="0 12 12;360 12 12" repeatCount="indefinite" />
                                                </rect>
                                                <rect x="11" y="11" rx="1" width="2" height="9">
                                                    <animateTransform attributeName="transform" type="rotate"
                                                        dur="0.75s" values="0 12 12;360 12 12"
                                                        repeatCount="indefinite" />
                                                </rect>
                                            </svg> Loading...
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- akhir model tambah konten -->
<!-- model ubah konten -->
<!-- <div class="modal fade" id="ubah-content" tabindex="-1" role="dialog" aria-labelledby="tambah-content"
    aria-hidden="true" data-modal-parent="tambah-data">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card m-b-2" id="data-artikel">
                            <div class="body" id="body">
                                <div id="gambar-content-container" class="list-unstyled row clearfix">
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 m-b-10 pl-0">
                                    <img class="img-fluid img-thumbnail" id="previewImage" src="#" alt="Preview"
                                        style="max-width: 100%; display: none;">
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12 d-flex flex-row-reverse pt-0 pb-15 pr-0">
                                    <form id="form-upload-gambar" enctype="multipart/form-data">
                                        <input type="text" id="id-content-gbr" name="id_content" class="form-control"
                                            hidden />
                                        <div class="media-body">
                                            <button type="button" class="btn-sm btn-primary m-b-20 m-t-0 m-r-0"
                                                id="btn-upload-photo">Tambah
                                                Gambar</button>
                                            <input type="file" id="filePhoto" class="sr-only">
                                        </div>
                                        <button type="button" id="btn-upload"
                                            class="simpan btn-sm btn-info m-b-20 m-t-0 m-r-0"
                                            style="display: none;">Simpan Gambar</button>
                                    </form>
                                </div>
                                <form id="edit-content" enctype="multipart/form-data" method="post">
                                    <div class="form-group content">
                                    </div>
                                    <input type="text" id="id-content" name="id_content" class="form-control" hidden />
                                    <input type="text" id="id-content-article" name="id_article" class="form-control"
                                        hidden />
                                    <button type="button" class="btn btn-block btn-success m-t-20 edit-button">Edit
                                        Konten</button>
                                    <div class="form-group" id="summernote-content" style="display:none;">
                                        <textarea id="isi-content" name="edit_content" class="form-control summernote"
                                            rows="10"></textarea>
                                        <button type="submit" class="btn btn-block btn-primary m-t-20"
                                            id="btn-ubah-content">
                                            <span id="btn-text-edit-content">Simpan</span>
                                            <span id="loading-iconconten" class="loading" style="display:none;">
                                                Loading...
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="ubah-content" tabindex="-1" role="dialog" aria-labelledby="tambah-content"
    aria-hidden="true" data-modal-parent="tambah-data">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Content</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12" id="data-artikel">
                        <!-- tampilan gambar -->
                        <div id="gambar-content-container" class="list-unstyled row clearfix">
                        </div>
                        <!-- tampilan content -->
                        <div class="form-group content">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- akhir model ubah konten -->