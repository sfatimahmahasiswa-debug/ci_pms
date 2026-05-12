<?php
/**
 * Kartu Stok Barang — Dokumen Keluaran C (Lampiran C-3)
 * Page shell – medicine selector + AJAX result area.
 */
if ($msg == "main" || $msg == "") {
    $msg = "";
}
?>
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main">Persediaan</a></li>
            <li class="active">Kartu Stok Barang</li>
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
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_masuk/main" class="list-group-item">
                        <span class="fa fa-file-alt"></span> Laporan Stok Masuk</a>
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_habis/main" class="list-group-item">
                        <span class="fa fa-exclamation-triangle"></span> Stok Barang Habis</a>
                    <a href="<?php echo base_url(); ?>ShowForm/kartu_stok/main" class="list-group-item active">
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
                        <h3 class="panel-title"><i class="fa fa-id-card"></i> Kartu Stok Barang</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted" style="font-size:13px; margin-bottom:12px;">
                            Pilih obat untuk melihat riwayat masuk dan keluar secara kronologis (Lampiran C-3).
                        </p>
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="ks_medicine">Pilih Obat</label>
                                <select class="form-control selectpicker" id="ks_medicine" data-live-search="true">
                                    <option value="">-- Pilih Obat --</option>
                                    <?php foreach ($all_medicine as $m): ?>
                                        <option value="<?php echo $m->medicine_name_id; ?>">
                                            <?php echo htmlspecialchars($m->medicine_name); ?>
                                            <?php echo $m->generic_name ? ' — '.$m->generic_name : ''; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4" style="margin-top:25px;">
                                <button type="button" class="btn btn-primary" id="btn_ks_search">
                                    <i class="fa fa-search"></i> Tampilkan Kartu
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div id="ks_result"></div>
            </div>
        </div>
    </div>
</section>

<script>
$("#btn_ks_search").click(function () {
    var medicine_name_id = $('#ks_medicine').val();
    if (!medicine_name_id) {
        alert('Silakan pilih obat terlebih dahulu.');
        return;
    }
    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Get_ajax_value/get_kartu_stok",
        data: { medicine_name_id: medicine_name_id },
        success: function (data) {
            $('#ks_result').html(data);
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan Kartu');
        },
        error: function () {
            $('#ks_result').html('<div class="alert alert-danger">Terjadi kesalahan.</div>');
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Tampilkan Kartu');
        }
    });
});
</script>
