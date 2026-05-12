<?php
/**
 * Laporan Stok Barang Habis — Dokumen Masukan E & Keluaran F (Lampiran B-3 / C-6)
 * Page shell – filter + AJAX result area.
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
            <li class="active">Laporan Stok Barang Habis</li>
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
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_masuk/main" class="list-group-item">
                        <span class="fa fa-file-alt"></span> Laporan Stok Masuk</a>
                    <a href="<?php echo base_url(); ?>ShowForm/laporan_stok_habis/main" class="list-group-item active">
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
                        <h3 class="panel-title"><i class="fa fa-exclamation-triangle"></i> Laporan Stok Barang Habis</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted" style="font-size:13px; margin-bottom:12px;">
                            Menampilkan obat/bahan medis dengan sisa stok di bawah ambang batas yang ditentukan.
                        </p>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="sh_threshold">Ambang Batas Stok (≤)</label>
                                <input type="number" class="form-control" id="sh_threshold" value="0" min="0">
                                <small class="text-muted">0 = hanya yang habis; &gt;0 = termasuk hampir habis</small>
                            </div>
                            <div class="col-sm-4" style="margin-top:25px;">
                                <button type="button" class="btn btn-warning" id="btn_sh_search">
                                    <i class="fa fa-search"></i> Cari Stok Habis
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div id="sh_result"></div>
            </div>
        </div>
    </div>
</section>

<script>
$("#btn_sh_search").click(function () {
    var btn = $(this);
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memuat...');
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Get_ajax_value/get_laporan_stok_habis",
        data: {
            threshold: $('#sh_threshold').val()
        },
        success: function (data) {
            $('#sh_result').html(data);
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Cari Stok Habis');
        },
        error: function () {
            $('#sh_result').html('<div class="alert alert-danger">Terjadi kesalahan.</div>');
            btn.prop('disabled', false).html('<i class="fa fa-search"></i> Cari Stok Habis');
        }
    });
});
// Auto-load on page entry
$(document).ready(function () {
    $('#btn_sh_search').trigger('click');
});
</script>
