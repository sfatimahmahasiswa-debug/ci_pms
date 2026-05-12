<?php
/**
 * Tanda Terima Barang — Bukti penerimaan barang masuk dari supplier.
 * Dokumen Masukan B (Lampiran A-2)
 */
$it = $item;
?>
<style>
@media print {
    .sidebar, .sidebar-overlay, .topbar, #footer,
    .no-print { display: none !important; }
    .page-wrapper  { display: block !important; }
    .main-wrapper  { margin-left: 0 !important; }
    .page-content  { padding: 0 !important; }
    @page { size: A5; margin: 1.5cm 2cm; }
}
</style>

<section id="breadcrumb" class="no-print">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main">Persediaan</a></li>
            <li class="active">Tanda Terima Barang</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <!-- Action buttons -->
        <div class="row no-print" style="margin-bottom:15px;">
            <div class="col-md-12">
                <button onclick="window.print()" class="btn btn-success">
                    <i class="fa fa-print"></i> Cetak Tanda Terima
                </button>
                <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="btn btn-default" style="margin-left:8px;">
                    <i class="fa fa-arrow-left"></i> Kembali ke Persediaan
                </a>
            </div>
        </div>

        <!-- Tanda Terima Document -->
        <div class="panel panel-default" style="max-width:700px; margin:0 auto; border:1px solid #ccc;">
            <!-- Letterhead -->
            <div style="background:#1a2244; color:#fff; padding:18px 24px; text-align:center;">
                <h3 style="margin:0 0 4px; font-size:18pt; font-weight:800; letter-spacing:1px;">KLINIK HARMY MEDIKA</h3>
                <p style="margin:0; font-size:10pt; opacity:.85;">Sistem Informasi Manajemen Farmasi &amp; Gudang</p>
            </div>

            <div style="text-align:center; padding:12px 24px 0; border-bottom:2px solid #1a2244;">
                <h4 style="margin:0 0 4px; font-size:14pt; font-weight:700; letter-spacing:.5px; color:#1a2244;">TANDA TERIMA BARANG</h4>
                <p style="margin:0 0 8px; font-size:9pt; color:#666;">Lampiran A-2 &nbsp;|&nbsp; Dokumen Penerimaan Barang Gudang/Farmasi</p>
            </div>

            <div class="panel-body" style="padding:20px 24px;">
                <!-- Meta info -->
                <table style="width:100%; font-size:12pt; margin-bottom:16px;">
                    <tr>
                        <td style="width:38%; color:#555;">No. Tanda Terima</td>
                        <td style="width:4%;">:</td>
                        <td><strong>TTB-<?php echo date('Ymd', strtotime($it->date)); ?>-<?php echo str_pad($it->purchase_id, 4, '0', STR_PAD_LEFT); ?></strong></td>
                    </tr>
                    <tr>
                        <td style="color:#555;">Tanggal Terima</td>
                        <td>:</td>
                        <td><?php echo date('d F Y', strtotime($it->date)); ?></td>
                    </tr>
                    <tr>
                        <td style="color:#555;">No. Faktur / Invoice</td>
                        <td>:</td>
                        <td><?php echo !empty($it->no_faktur) ? htmlspecialchars($it->no_faktur) : '<em style="color:#aaa;">—</em>'; ?></td>
                    </tr>
                    <tr>
                        <td style="color:#555;">Nama Supplier</td>
                        <td>:</td>
                        <td><?php echo !empty($it->supplier_name) ? htmlspecialchars($it->supplier_name) : '<em style="color:#aaa;">—</em>'; ?></td>
                    </tr>
                </table>

                <hr style="margin:12px 0; border-color:#ddd;">

                <!-- Item detail -->
                <table class="table table-bordered" style="font-size:11pt; margin-bottom:0;">
                    <thead style="background:#f0f4fa;">
                        <tr>
                            <th colspan="2" style="text-align:center; color:#1a2244;">Detail Barang yang Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:45%; color:#555;">Nama Obat / Merk</td>
                            <td><strong><?php echo htmlspecialchars($it->medicine_name); ?></strong></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Nama Generik</td>
                            <td><?php echo htmlspecialchars($it->generic_name); ?></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Bentuk Sediaan</td>
                            <td><?php echo htmlspecialchars($it->medicine_presentation); ?></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Volume / Satuan</td>
                            <td><?php echo htmlspecialchars($it->unit); ?></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Jumlah Diterima</td>
                            <td><strong><?php echo number_format((float)$it->qty, 0, ',', '.'); ?> unit</strong></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Tanggal Kedaluwarsa</td>
                            <td>
                                <?php
                                $exp = $it->expiredate;
                                $today = date('Y-m-d');
                                $style = ($exp < $today) ? 'color:crimson; font-weight:700;' : '';
                                echo '<span style="'.$style.'">'.htmlspecialchars($exp).'</span>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Harga Satuan</td>
                            <td>Rp <?php echo number_format((float)$it->unit_price, 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Total Harga Beli</td>
                            <td><strong>Rp <?php echo number_format((float)$it->purchase_price, 0, ',', '.'); ?></strong></td>
                        </tr>
                        <tr>
                            <td style="color:#555;">Kondisi Barang</td>
                            <td><span style="color:green; font-weight:600;"><i class="fa fa-check-circle"></i> Baik / Sesuai Pesanan</span></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Signature area -->
                <table style="width:100%; margin-top:32px; font-size:10pt; text-align:center;">
                    <tr>
                        <td style="width:50%;">
                            <p style="margin:0 0 4px; color:#555;">Diterima oleh,</p>
                            <p style="margin:0 0 60px; color:#555; font-style:italic;">Bagian Gudang / Farmasi</p>
                            <p style="margin:0; border-top:1px solid #555; padding-top:4px;">( _________________________ )</p>
                        </td>
                        <td style="width:50%;">
                            <p style="margin:0 0 4px; color:#555;">Diketahui oleh,</p>
                            <p style="margin:0 0 60px; color:#555; font-style:italic;">Bagian Administrasi / Keuangan</p>
                            <p style="margin:0; border-top:1px solid #555; padding-top:4px;">( _________________________ )</p>
                        </td>
                    </tr>
                </table>

                <p style="text-align:right; color:#aaa; font-size:8pt; margin-top:20px;">
                    Dicetak: <?php echo date('d F Y, H:i'); ?> WIB
                </p>
            </div>
        </div>

    </div>
</section>
