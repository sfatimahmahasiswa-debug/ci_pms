
<section id="main">
  <div class="container-fluid">

    <!-- Welcome Banner -->
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-welcome">
          <div class="row">
            <div class="col-sm-8">
              <h2 class="welcome-title">
                Selamat Datang, <strong><?php echo htmlspecialchars($username); ?></strong> 👋
              </h2>
              <p class="welcome-subtitle">
                Berikut adalah ringkasan aktivitas sistem Klinik Harmy Medika hari ini.
              </p>
              <div class="welcome-meta">
                <div class="welcome-meta-item">
                  <i class="fa fa-calendar-check"></i>
                  <?php echo $current_date; ?>
                </div>
                <div class="welcome-meta-item">
                  <i class="fa fa-clock"></i>
                  <?php echo $current_time; ?> WIB
                </div>
                <div class="welcome-meta-item">
                  <i class="fa fa-hospital-alt"></i>
                  Sistem Aktif
                </div>
              </div>
            </div>
            <div class="col-sm-4 text-right hidden-xs">
              <i class="fa fa-hospital-alt dashboard-icon-bg"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Heading for Stats -->
    <div class="section-heading">
      <i class="fa fa-chart-pie"></i>
      <h5>Statistik Ringkasan</h5>
      <span class="section-badge">Update otomatis</span>
    </div>

    <!-- Stat Cards Row 1 -->
    <div class="row">

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
    <div class="row">

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
    <div class="row">
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

    <!-- Quick Actions & Info panels side by side -->
    <div class="row">
      <!-- Quick Actions -->
      <div class="col-md-8">
        <div class="section-heading">
          <i class="fa fa-bolt"></i>
          <h5>Akses Cepat</h5>
        </div>
        <div class="info-panel">
          <div class="info-panel-body">
            <div class="row">
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
              <div class="col-sm-6 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/data_master/main" class="btn btn-default btn-block quick-btn">
                  <i class="fa fa-cog"></i> Data Master
                </a>
              </div>
              <div class="col-sm-6 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/manage_staff/main" class="btn btn-danger btn-block quick-btn">
                  <i class="fa fa-id-badge"></i> Kelola Karyawan
                </a>
              </div>
              <div class="col-sm-6 col-xs-6" style="margin-bottom:10px;">
                <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="btn btn-primary btn-block quick-btn">
                  <i class="fa fa-truck"></i> Informasi Supplier
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- System Info -->
      <div class="col-md-4">
        <div class="section-heading">
          <i class="fa fa-info-circle"></i>
          <h5>Info Sistem</h5>
        </div>
        <div class="info-panel">
          <div class="info-panel-body">
            <table class="table" style="margin:0; font-size:13px;">
              <tr>
                <td style="border:none; padding: 6px 0; color: var(--text-secondary);"><i class="fa fa-hospital fa-fw"></i> Klinik</td>
                <td style="border:none; padding: 6px 0; font-weight:600;">Harmy Medika</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: var(--text-secondary);"><i class="fa fa-pills fa-fw"></i> Total Obat</td>
                <td style="padding: 6px 0; font-weight:600;"><?php echo number_format($medicine_qty); ?> item</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: var(--text-secondary);"><i class="fa fa-users fa-fw"></i> Karyawan</td>
                <td style="padding: 6px 0; font-weight:600;"><?php echo number_format($staff_count); ?> orang</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: var(--text-secondary);"><i class="fa fa-truck fa-fw"></i> Supplier</td>
                <td style="padding: 6px 0; font-weight:600;"><a href="<?php echo base_url(); ?>ShowForm/supplier_info/main"><?php echo number_format($supplier_count); ?> supplier</a></td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: var(--text-secondary);"><i class="fa fa-shield-alt fa-fw"></i> Status</td>
                <td style="padding: 6px 0;"><span class="label label-success">Online</span></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

