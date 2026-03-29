<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($page_title) ? $page_title : 'Dashboard' ?> | Klinik Harmy Medika</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/icon.png">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<?php
    $current_uri = $this->uri->uri_string();
    $current_segment = $this->uri->segment(2); // e.g. medicine_purchase_info
?>

<!-- Mobile overlay -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<div class="page-wrapper">

    <!-- ===== SIDEBAR ===== -->
    <nav class="sidebar" id="sidebar">

        <!-- Brand -->
        <a href="<?php echo base_url(); ?>Main/enter" class="sidebar-brand">
            <span class="sidebar-brand-icon"><i class="fa fa-medkit"></i></span>
            <span class="sidebar-brand-text">Harmy Medika</span>
        </a>

        <div class="sidebar-divider"></div>
        <span class="sidebar-label">Menu Utama</span>

        <ul class="sidebar-nav">
            <li class="sidebar-nav-item <?php echo ($current_segment === '' || $current_uri === 'Main/enter' || $current_segment === 'enter') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>Main/enter">
                    <span class="sidebar-nav-icon"><i class="fa fa-tachometer-alt"></i></span>
                    <span class="sidebar-nav-text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-nav-item <?php echo ($current_segment === 'medicine_purchase_info' || $current_segment === 'edit_purchase_info') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-truck-loading"></i></span>
                    <span class="sidebar-nav-text">Obat Masuk</span>
                </a>
            </li>
            <li class="sidebar-nav-item <?php echo ($current_segment === 'medicine_purchase_statement') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_statement/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-warehouse"></i></span>
                    <span class="sidebar-nav-text">Persediaan</span>
                </a>
            </li>
            <li class="sidebar-nav-item <?php echo ($current_segment === 'sell_medicine' || $current_segment === 'sell_statement') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/sell_medicine/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-cash-register"></i></span>
                    <span class="sidebar-nav-text">Jual Obat</span>
                </a>
            </li>
            <li class="sidebar-nav-item <?php echo ($current_segment === 'profit_loss') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/profit_loss/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-chart-bar"></i></span>
                    <span class="sidebar-nav-text">Rekapan</span>
                </a>
            </li>
            <li class="sidebar-nav-item <?php echo ($current_segment === 'manage_staff' || $current_segment === 'edit_staff_info') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/manage_staff/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-users"></i></span>
                    <span class="sidebar-nav-text">Mengelola Karyawan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-divider"></div>
        <span class="sidebar-label">Lainnya</span>

        <ul class="sidebar-nav">
            <li class="sidebar-nav-item <?php echo ($current_segment === 'doctor' || $current_segment === 'edit_doctor') ? 'active' : ''; ?>">
                <a href="<?php echo base_url(); ?>ShowForm/doctor/main">
                    <span class="sidebar-nav-icon"><i class="fa fa-user-md"></i></span>
                    <span class="sidebar-nav-text">Antrean Pasien</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <a href="<?php echo base_url(); ?>main/logout" class="sidebar-logout">
                <span class="sidebar-nav-icon"><i class="fa fa-sign-out-alt"></i></span>
                <span class="sidebar-nav-text">Keluar</span>
            </a>
        </div>

    </nav>
    <!-- ===== END SIDEBAR ===== -->

    <!-- ===== MAIN WRAPPER ===== -->
    <div class="main-wrapper" id="main-wrapper">

        <!-- Topbar -->
        <div class="topbar">
            <button class="topbar-toggle" id="sidebar-toggle" type="button" title="Toggle menu">
                <i class="fa fa-bars"></i>
            </button>
            <span class="topbar-brand">
                <i class="fa fa-medkit"></i> Klinik Harmy Medika
            </span>
            <div class="topbar-right">
                <span class="topbar-user">
                    <i class="fa fa-user-circle"></i>
                    <span class="hidden-xs"><?php echo isset($username) ? htmlspecialchars($username) : htmlspecialchars($this->session->userdata('username')); ?></span>
                </span>
                <a href="<?php echo base_url(); ?>main/logout" class="topbar-logout-btn hidden-xs">
                    <i class="fa fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Page Content -->
        <div class="page-content">
