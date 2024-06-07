<!doctype html>
<html lang="en">

<head>
    <title>
        <?= $tittle; ?>
    </title>
    <!-- <title>:: Iconic :: Home</title> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->
    <!-- Meta untuk SEO -->
    <meta content="index, follow" name="robots">
    <meta content="website" property="og:type">

    <?php if (isset($description)) { ?>
        <meta content="<?php echo $description; ?>" name="description">
        <meta content="<?php echo $description; ?>" name="twitter:description">
    <?php } else { ?>
        <meta content="Wisdil.com" name="description">
        <meta content="Wisdil.com" name="twitter:description">
    <?php } ?>
    <meta content="@wisdil" name="twitter:site">
    <meta content="@Kanpa" name="twitter:creator">
    <meta content="wisdil" property="og:site_name">
    <?php if (isset($metafoto)) { ?>
        <meta property="og:image" content="<?php echo base_url('upload'); ?>/<?php echo $_metafoto; ?>">
    <?php } else { ?>
    <?php } ?>
    <?php if (isset($tittle)) { ?>
        <meta content="<?= $tittle; ?>" name="twitter:title" class="">
        <title><?= $tittle; ?></title>
    <?php } else { ?>
        <title>Wisdil.com</title>
    <?php } ?>
    <link href="<?php echo base_url('assets'); ?>/images/LOGO-WISDIL.jpg" rel="icon">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- daterange -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="    https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap-multiselect/bootstrap-multiselect.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/multi-select/css/multi-select.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/toastr/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/main.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/blog.css">

    <!-- add plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/slide_navigation.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/testimoni_slide.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="<?= base_url('assets'); ?>/bundles/libscripts.bundle.js"></script>
    <script src="<?= base_url('assets'); ?>/bundles/vendorscripts.bundle.js"></script>
    <script src="<?= base_url('assets'); ?>/bundles/c3.bundle.js"></script>



</head>