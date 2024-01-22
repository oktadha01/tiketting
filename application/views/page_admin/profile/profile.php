<!-- alerts -->
<?php
        $sukses_message = $this->session->flashdata('sukses');
        $gagal_message = $this->session->flashdata('gagal');
        $pas_beda = $this->session->flashdata('pas');
    ?>

<?php if ($sukses_message): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Profil',
    text: '<?php echo $sukses_message; ?>',
});
</script>
<?php endif; ?>

<?php if ($pas_beda): ?>
<script>
Swal.fire({
    icon: 'warning',
    title: 'PASSWORD!!',
    text: '<?php echo $pas_beda; ?>',
});
</script>
<?php endif; ?>

<?php if ($gagal_message): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal!',
    text: '<?php echo $gagal_message; ?>',
});
</script>
<?php endif; ?>

<!-- akhir alerts -->

<div class="block-header">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h2><?= $tittle; ?></h2>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('User'); ?>"><i class="fa fa-dashboard"></i></a></li>
                <li class="breadcrumb-item active"><?= $bread?></li>
            </ul>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-4 col-md-12">
        <div class="card profile-header">
            <div class="body p-1 m-1">
                <div class="text-center blockquote blockquote-primary p-3 m-3">
                    <div class="profile-image"> <img
                            src="<?= base_url('assets'); ?>/images/user/<?= $userdata->fot_profil; ?>"
                            class="rounded-circle m-b-15" alt="">
                    </div>
                    <div>
                        <h4 class="mb-0"><strong><?= $userdata->nm_user; ?></strong>
                        </h4>
                        <span><?= $userdata->agency; ?></span>
                    </div>
                    <div class="m-t-15">
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-secondary">Message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <div class="body">
                <ul class="nav nav-tabs-new">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Overview">Setting</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Settings">Ubah Password</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="Overview">
                <div class="card mb-0 pb-0">
                    <div class="body blockquote blockquote-danger">
                        <div class="new_post">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <h6>Account Data</h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $userdata->agency; ?>"
                                            placeholder="agency">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control"
                                            value="<?php echo $userdata->nm_user; ?>" placeholder="Nama">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $userdata->kontak; ?>"
                                            placeholder="No HP">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" value="<?php echo $userdata->email; ?>"
                                            placeholder="Email">
                                    </div>
                                    <div class="body">
                                        <h6>Foto Profile</h6>
                                        <div class="media">
                                            <div class="media-left m-r-15">
                                                <img src="assets/images/user/<?php echo $userdata->fot_profil; ?>"
                                                    class="user-photo media-object" alt="User">
                                            </div>
                                            <div class="media-body">
                                                <p>Upload Foto .
                                                    <br> <em>Image should be at least 140px x 140px</em>
                                                </p>
                                                <button type="button" class="btn btn-default"
                                                    id="btn-upload-photo">Pilih Foto</button>
                                                <input type="file" id="filePhoto" class="sr-only">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-toolbar-b">
                                <button class="btn btn-primary">Ubah Profil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="Settings">
                <form class="forms-sample" action="<?php echo base_url('Profile/ubah_password') ?>" method="POST">
                    <div class="card">
                        <div class="body blockquote blockquote-info">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <h6>Change Password</h6>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passLama"
                                            placeholder="Current Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passBaru"
                                            placeholder="New Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="passKonf"
                                            placeholder="Confirm New Password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Password</button> &nbsp;&nbsp;
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>