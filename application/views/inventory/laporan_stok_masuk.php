<?php
/**
 * Laporan Stok Barang Masuk — Dokumen Keluaran A (Lampiran C-1)
 * Page shell – filter panel + AJAX result area.
 */
if ($msg == "main" || $msg == "") {
    $msg = "";
} else {
    $msg = htmlspecialchars($msg);
}
?>
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main">Persediaan</a></li>
            <li class="active">Laporan Stok Barang Masuk</li>
            <?php if ($msg): ?><li class="active"><?php echo $msg; ?></li><?php endif; ?>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog"></span> Persediaan</a>
                    <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="list-group-item">
                        <span class="fa fa-capsules"></span> Masukkan Informasi Obat</a>
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_masuk/main" class="list-group-item active">
                        <span class="fa fa-file-alt"></span> Laporan Stok Masuk</a>
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_habis/main" class="list-group-item">
                        <span class="fa fa-exclamation-triangle"></span> Stok Barang Habis</a>
                    <a href="<?php echo base_url(); ?>ShowForm/kartu_stok/main" class="list-group-item">
                        <span class="fa fa-id-card"></span> Kartu Stok Barang</a>
                    <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_statement/main" class="list-group-item">
                        <span class="fa fa-plus-circle"></span> Pernyataan Pembelian</a>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_payment/main" class="list-group-item">
                        <span class="fa fa-pills"></span> Pembayaran Supplier</a>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <div class="panel panel-default rounded-0">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title"><i class="fa fa-file-alt"></i> Laporan Stok Barang Masuk</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="lsm_date_from">Tanggal Dari</label>
                                <input type="date" class="form-control" id="lsm_date_from">
                            </div>
                            <div class="col-sm-4">
                                <label for="lsm_date_to">Tanggal Sampai</label>
                                <input type="date" class="form-control" id="lsm_date_to">
                            </div>
                            <div class="col-sm-4">
                                <label for="lsm_supplier">Supplier</label>
                                <select class="form-control selectpicker" id="lsm_supplier" data-live-search="true">
                                    <option value="">-- Semua Supplier --</option>
                                    <?php foreach ($all_sup as $s): ?>
                                        <option value="<?php echo htmlspecialchars($s->supplier_name); ?>">
                                            <?php echo htmlspecialchars($s->supplier_name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top:12px;">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" id="btn_lsm_search">
                                    <i class="fa fa-search"></i> Tampilkan Laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div id="lsm_result"></div>
            </div>
        </div>
    </div>
</section>

<script>
$("#btn_lsm_search").click(function () {
    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Get_ajax_value/get_laporan_stok_masuk",
        data: {
            date_from: $('#lsm_date_from').val(),
            date_to:   $('#lsm_date_to').val(),
            supplier:  $('#lsm_supplier').val()
        },
        success: function (data) {
            $('#lsm_result').html(data);
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan Laporan');
        },
        error: function () {
            $('#lsm_result').html('<div class="alert alert-danger">Terjadi kesalahan.</div>');
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan Laporan');
        }
    });
});
</script>
