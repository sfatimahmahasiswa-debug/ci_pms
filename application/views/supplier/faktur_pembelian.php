<?php
/**
 * Faktur Pembelian per Supplier — Dokumen Masukan A (Lampiran A-1)
 * Shows all purchase invoices for a specific supplier in invoice format.
 */
$sup = $supplier;
?>
<style>
@media print {
    .sidebar, .sidebar-overlay, .topbar, #footer,
    .no-print { display: none !important; }
    .page-wrapper  { display: block !important; }
    .main-wrapper  { margin-left: 0 !important; }
    .page-content  { padding: 0 !important; }
    @page { size: A4; margin: 1.5cm 2cm; }
}
.fp-print-header { display:none; }
@media print { .fp-print-header { display:block !important; } }
</style>

<section id="breadcrumb" class="no-print">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/supplier_info/main">Informasi Supplier</a></li>
            <li class="active">Faktur Pembelian — <?php echo htmlspecialchars($sup->supplier_name); ?></li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 no-print">
                <div class="list-group">
                    <a href="#" class="list-group-item active main-color-bg">
                        <span class="fa fa-truck"></span> Informasi Supplier</a>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="list-group-item">
                        <span class="fa fa-plus-circle"></span> Tambah Supplier</a>
                    <a href="<?php echo base_url(); ?>ShowForm/arsip_pembelian/main" class="list-group-item">
                        <span class="fa fa-archive"></span> Arsip Pembelian</a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Action buttons -->
                <div class="no-print" style="margin-bottom:12px;">
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> Cetak Faktur
                    </button>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="btn btn-default" style="margin-left:8px;">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>

                <?php if (empty($all_value)): ?>
                <div class="alert alert-info"><i class="fa fa-info-circle"></i> Belum ada faktur pembelian untuk supplier ini.</div>
                <?php else:
                    $grand_total = 0;
                    $grand_paid  = 0;
                    $inv_no      = 0;
                    foreach ($all_value as $item):
                        if ($item->particulars !== 'Purchase Medicine') continue;
                        $inv_no++;
                        $grand_total += $item->purchase_price;
                        $grand_paid  += $item->purchase_paid;
                ?>
                <!-- Individual Invoice Card -->
                <div class="panel panel-default" style="border:1px solid #ccc; margin-bottom:20px; page-break-inside:avoid;">
                    <!-- Invoice header -->
                    <div class="fp-print-header" style="text-align:center; padding:10px 24px; border-bottom:2px solid #1a2244;">
                        <h3 style="margin:0; font-size:15pt; font-weight:800; color:#0d4a6e;">KLINIK HARMY MEDIKA</h3>
                        <p style="margin:2px 0 0; font-size:9pt; color:#666;">NOTA / FAKTUR PEMBELIAN — Lampiran A-1</p>
                    </div>
                    <div style="background:#1a2244; color:#fff; padding:10px 16px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap;">
                        <div>
                            <strong style="font-size:13pt;">FAKTUR PEMBELIAN</strong>
                            <span style="font-size:10pt; opacity:.8; margin-left:10px;">Lampiran A-1</span>
                        </div>
                        <div style="text-align:right; font-size:10pt;">
                            <div>No. Faktur: <strong><?php echo !empty($item->no_faktur) ? htmlspecialchars($item->no_faktur) : 'FKT-'.date('Ymd', strtotime($item->date)).'-'.str_pad($item->purchase_id, 4, '0', STR_PAD_LEFT); ?></strong></div>
                            <div>Tanggal: <?php echo date('d F Y', strtotime($item->date)); ?></div>
                        </div>
                    </div>

                    <div class="panel-body" style="padding:16px 20px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <p style="margin:0; font-size:11pt;"><strong>Dari Supplier:</strong></p>
                                <p style="margin:0; font-size:12pt; font-weight:700; color:#1a2244;"><?php echo htmlspecialchars($sup->supplier_name); ?></p>
                                <?php if (!empty($sup->mobile)): ?>
                                <p style="margin:2px 0 0; font-size:10pt; color:#666;"><i class="fa fa-phone"></i> <?php echo htmlspecialchars($sup->mobile); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($sup->address)): ?>
                                <p style="margin:2px 0 0; font-size:10pt; color:#666;"><i class="fa fa-map-marker-alt"></i> <?php echo nl2br(htmlspecialchars($sup->address)); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-6" style="text-align:right;">
                                <p style="margin:0; font-size:11pt;"><strong>Kepada:</strong></p>
                                <p style="margin:0; font-size:12pt; font-weight:700; color:#1a2244;">Klinik Harmy Medika</p>
                                <p style="margin:2px 0 0; font-size:10pt; color:#666;">Bagian Gudang / Farmasi</p>
                            </div>
                        </div>

                        <table class="table table-bordered" style="margin-top:14px; font-size:11pt;">
                            <thead style="background:#f0f4fa;">
                                <tr>
                                    <th>Nama Obat / Merk</th>
                                    <th>Generik</th>
                                    <th>Bentuk Sediaan</th>
                                    <th>Volume</th>
                                    <th style="text-align:center;">Jml</th>
                                    <th style="text-align:right;">Harga Satuan</th>
                                    <th style="text-align:right;">Total</th>
                                    <th>Kedaluwarsa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong><?php echo htmlspecialchars($item->medicine_name); ?></strong></td>
                                    <td><?php echo htmlspecialchars($item->generic_name); ?></td>
                                    <td><?php echo htmlspecialchars($item->medicine_presentation); ?></td>
                                    <td><?php echo htmlspecialchars($item->unit); ?></td>
                                    <td style="text-align:center;"><?php echo number_format((float)$item->qty, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;">Rp <?php echo number_format((float)$item->unit_price, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;"><strong>Rp <?php echo number_format((float)$item->purchase_price, 0, ',', '.'); ?></strong></td>
                                    <td><?php echo htmlspecialchars($item->expiredate); ?></td>
                                </tr>
                            </tbody>
                            <tfoot style="background:#f8f8f8;">
                                <tr>
                                    <td colspan="6" style="text-align:right; font-weight:700;">Total Tagihan</td>
                                    <td style="text-align:right; font-weight:700;">Rp <?php echo number_format((float)$item->purchase_price, 0, ',', '.'); ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6" style="text-align:right;">Sudah Dibayar</td>
                                    <td style="text-align:right;">Rp <?php echo number_format((float)$item->purchase_paid, 0, ',', '.'); ?></td>
                                    <td></td>
                                </tr>
                                <tr style="color:<?php echo ($item->purchase_due > 0) ? 'crimson' : 'green'; ?>; font-weight:700;">
                                    <td colspan="6" style="text-align:right;">Sisa Hutang</td>
                                    <td style="text-align:right;">Rp <?php echo number_format((float)$item->purchase_due, 0, ',', '.'); ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Signature -->
                        <table style="width:100%; margin-top:20px; font-size:10pt; text-align:center;">
                            <tr>
                                <td style="width:33%;">
                                    <p style="margin:0 0 50px; color:#555;">Dibuat oleh,</p>
                                    <p style="margin:0; border-top:1px solid #999; padding-top:4px; font-size:9pt;">Bagian Administrasi</p>
                                </td>
                                <td style="width:33%;">
                                    <p style="margin:0 0 50px; color:#555;">Diperiksa oleh,</p>
                                    <p style="margin:0; border-top:1px solid #999; padding-top:4px; font-size:9pt;">Bagian Gudang / Farmasi</p>
                                </td>
                                <td style="width:33%;">
                                    <p style="margin:0 0 50px; color:#555;">Disetujui oleh,</p>
                                    <p style="margin:0; border-top:1px solid #999; padding-top:4px; font-size:9pt;">Pimpinan Klinik</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <?php endforeach; ?>

                <!-- Grand Total Summary -->
                <?php if ($inv_no > 1): ?>
                <div class="panel panel-default no-print">
                    <div class="panel-heading" style="background:#f0f4fa;">
                        <h4 style="margin:0;">Ringkasan Pembelian — <?php echo htmlspecialchars($sup->supplier_name); ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><strong>Total Faktur:</strong> <?php echo $inv_no; ?></p>
                        <p><strong>Total Pembelian:</strong> Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></p>
                        <p><strong>Total Dibayar:</strong> Rp <?php echo number_format($grand_paid, 0, ',', '.'); ?></p>
                        <p style="color:<?php echo ($grand_total - $grand_paid > 0) ? 'crimson' : 'green'; ?>; font-weight:700;">
                            <strong>Total Sisa Hutang:</strong> Rp <?php echo number_format($grand_total - $grand_paid, 0, ',', '.'); ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
