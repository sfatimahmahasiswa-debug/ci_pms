
<!-- /.container -->
<section id="main">
  <div class="container">

    <!-- Welcome Banner -->
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-welcome">
          <div class="row">
            <div class="col-sm-8">
              <h2 class="welcome-title">
                <i class="fa fa-tachometer-alt"></i>
                Selamat Datang, <strong><?php echo htmlspecialchars($username); ?></strong>
              </h2>
              <p class="welcome-subtitle">
                <i class="fa fa-calendar-check"></i>
                <?php echo $current_date; ?> &nbsp;|&nbsp;
                <i class="fa fa-clock"></i>
                <?php echo $current_time; ?> WIB
              </p>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
              <i class="fa fa-hospital-alt dashboard-icon-bg"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Stat Cards Row 1 -->
    <div class="row" style="margin-top:20px;">

      <!-- Obat-obatan -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="dash-card-link">
          <div class="dash-card dash-card-blue">
            <div class="dash-card-icon">
              <i class="fa fa-pills"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Obat-obatan</p>
              <h3 class="dash-card-value"><?php echo number_format($medicine_qty); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Lihat Detail</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Obat Generik -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/create_generic_name/main" class="dash-card-link">
          <div class="dash-card dash-card-purple">
            <div class="dash-card-icon">
              <i class="fa fa-capsules"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Obat Generik</p>
              <h3 class="dash-card-value"><?php echo number_format($generic_medicine_count); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Lihat Detail</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Penjualan Bulanan -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/sell_medicine/main" class="dash-card-link">
          <div class="dash-card dash-card-teal">
            <div class="dash-card-icon">
              <i class="fa fa-calendar-alt"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Penjualan Bulanan</p>
              <h3 class="dash-card-value">Rp <?php echo number_format($monthly_sales_number); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Lihat Detail</p>
            </div>
          </div>
        </a>
      </div>

    </div>

    <!-- Stat Cards Row 2 -->
    <div class="row" style="margin-top:16px;">

      <!-- Penjualan Harian -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/sell_medicine/main" class="dash-card-link">
          <div class="dash-card dash-card-orange">
            <div class="dash-card-icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Penjualan Harian</p>
              <h3 class="dash-card-value">Rp <?php echo number_format($today_sale_number); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Lihat Detail</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Produk Kadaluarsa -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="dash-card-link">
          <div class="dash-card <?php echo $near_expired_product > 0 ? 'dash-card-red' : 'dash-card-green'; ?>">
            <div class="dash-card-icon">
              <i class="fa fa-exclamation-triangle"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Produk Kadaluarsa</p>
              <h3 class="dash-card-value"><?php echo number_format($near_expired_product); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Periksa Sekarang</p>
            </div>
          </div>
        </a>
      </div>

      <!-- Karyawan -->
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <a href="<?php echo base_url(); ?>ShowForm/manage_staff/main" class="dash-card-link">
          <div class="dash-card dash-card-olive">
            <div class="dash-card-icon">
              <i class="fa fa-users"></i>
            </div>
            <div class="dash-card-body">
              <p class="dash-card-label">Karyawan</p>
              <h3 class="dash-card-value"><?php echo number_format($staff_count); ?></h3>
              <p class="dash-card-footer"><i class="fa fa-arrow-right"></i> Kelola Karyawan</p>
            </div>
          </div>
        </a>
      </div>

    </div>

    <?php if ($near_expired_product > 0): ?>
    <!-- Expired Products Alert -->
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible dashboard-alert" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="fa fa-exclamation-circle fa-lg"></i>
          <strong> Perhatian!</strong>
          Terdapat <strong><?php echo number_format($near_expired_product); ?></strong> produk yang sudah melewati tanggal kadaluarsa.
          <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="alert-link"> Klik di sini untuk memeriksa.</a>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Quick Actions -->
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12">
        <div class="panel panel-default dashboard-quick-actions">
          <div class="panel-heading main-color-bg">
            <h4 class="panel-title"><i class="fa fa-bolt"></i> Akses Cepat</h4>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/doctor/main" class="btn btn-primary btn-block quick-btn">
                  <i class="fa fa-user-md"></i> Antrean Pasien
                </a>
              </div>
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="btn btn-info btn-block quick-btn">
                  <i class="fa fa-warehouse"></i> Persediaan
                </a>
              </div>
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/sell_medicine/main" class="btn btn-success btn-block quick-btn">
                  <i class="fa fa-cash-register"></i> Penjualan
                </a>
              </div>
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/profit_loss/main" class="btn btn-warning btn-block quick-btn">
                  <i class="fa fa-chart-line"></i> Laporan Keuangan
                </a>
              </div>
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="btn btn-default btn-block quick-btn">
                  <i class="fa fa-cog"></i> Kelola Data Master
                </a>
              </div>
              <div class="col-sm-4 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/manage_staff/main" class="btn btn-danger btn-block quick-btn">
                  <i class="fa fa-id-badge"></i> Kelola Karyawan
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
