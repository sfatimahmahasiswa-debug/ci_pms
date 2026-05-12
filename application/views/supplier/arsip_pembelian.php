<?php
/**
 * Arsip Pembelian Barang — Dokumen Keluaran D (Lampiran C-4)
 * Full list of purchase records as a purchase archive.
 */
if ($msg == "main" || $msg == "") {
    $msg = "";
}
$grand_total = 0;
$grand_paid  = 0;
$grand_due   = 0;
$count       = 0;
?>
<style>
@media print {
    .sidebar, .sidebar-overlay, .topbar, #footer,
    .no-print { display: none !important; }
    .page-wrapper  { display: block !important; }
    .main-wrapper  { margin-left: 0 !important; }
    .page-content  { padding: 0 !important; }
    @page { size: A4 landscape; margin: 1.5cm; }
}
.ap-print-header { display:none; }
@media print { .ap-print-header { display:block !important; } }
</style>

<section id="breadcrumb" class="no-print">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/supplier_info/main">Informasi Supplier</a></li>
            <li class="active">Arsip Pembelian Barang</li>
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
                    <a href="<?php echo base_url(); ?>ShowForm/arsip_pembelian/main" class="list-group-item active">
                        <span class="fa fa-archive"></span> Arsip Pembelian</a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="no-print" style="margin-bottom:12px;">
                    <button onclick="window.print()" class="btn btn-success">
                        <i class="fa fa-print"></i> Cetak Arsip
                    </button>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="btn btn-default" style="margin-left:8px;">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="col-md-12">
                <!-- Print letterhead -->
                <div class="ap-print-header" style="text-align:center; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #1a2244;">
                    <h2 style="margin:0; font-size:16pt; font-weight:800; color:#0d4a6e;">KLINIK HARMY MEDIKA</h2>
                    <p style="margin:4px 0 0; font-size:11pt; font-weight:700;">ARSIP PEMBELIAN BARANG</p>
                    <p style="margin:2px 0 0; font-size:9pt; color:#666;">Lampiran C-4</p>
                    <p style="margin:2px 0 0; font-size:8pt; color:#888;">Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
                </div>

                <!-- On-screen panel -->
                <div class="panel panel-default">
                    <div class="panel-heading main-color-bg">
                        <h3 class="panel-title"><i class="fa fa-archive"></i> Arsip Pembelian Barang — Lampiran C-4</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (empty($all_value)): ?>
                        <div class="alert alert-info"><i class="fa fa-info-circle"></i> Belum ada data pembelian.</div>
                        <?php else: ?>
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="font-size:11px;">
                            <thead style="background:#1a2244; color:#fff;">
                                <tr>
                                    <th style="text-align:center;">#</th>
                                    <th>Tgl. Beli</th>
                                    <th>No. Faktur</th>
                                    <th>Nama Obat</th>
                                    <th>Generik</th>
                                    <th>Bentuk Sediaan</th>
                                    <th>Supplier</th>
                                    <th style="text-align:center;">Jml</th>
                                    <th style="text-align:right;">Total Harga</th>
                                    <th style="text-align:right;">Dibayar</th>
                                    <th style="text-align:right;">Sisa</th>
                                    <th>Kedaluwarsa</th>
                                    <th class="no-print">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($all_value as $row):
                                if ($row->particulars !== 'Purchase Medicine') continue;
                                $count++;
                                $grand_total += $row->purchase_price;
                                $grand_paid  += $row->purchase_paid;
                                $grand_due   += $row->purchase_due;
                                $exp_style = (!empty($row->expiredate) && $row->expiredate < date('Y-m-d')) ? 'color:crimson; font-weight:600;' : '';
                            ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $count; ?></td>
                                    <td><?php echo htmlspecialchars($row->date); ?></td>
                                    <td><?php echo !empty($row->no_faktur) ? htmlspecialchars($row->no_faktur) : '<em style="color:#aaa;">—</em>'; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row->medicine_name); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row->generic_name); ?></td>
                                    <td><?php echo htmlspecialchars($row->medicine_presentation); ?></td>
                                    <td><?php echo htmlspecialchars($row->supplier_name); ?></td>
                                    <td style="text-align:center;"><?php echo number_format((float)$row->qty, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;">Rp <?php echo number_format((float)$row->purchase_price, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;">Rp <?php echo number_format((float)$row->purchase_paid, 0, ',', '.'); ?></td>
                                    <td style="text-align:right; color:<?php echo $row->purchase_due > 0 ? 'crimson' : '#333'; ?>;">
                                        Rp <?php echo number_format((float)$row->purchase_due, 0, ',', '.'); ?>
                                    </td>
                                    <td style="<?php echo $exp_style; ?>"><?php echo htmlspecialchars($row->expiredate); ?></td>
                                    <td class="no-print">
                                        <a href="<?php echo base_url(); ?>ShowForm/tanda_terima_barang/<?php echo $row->purchase_id; ?>" class="btn btn-xs btn-info" title="Cetak Tanda Terima">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot style="background:#1a2244; color:#fff; font-weight:700;">
                                <tr>
                                    <td colspan="8" style="text-align:right;">TOTAL</td>
                                    <td style="text-align:right;">Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;">Rp <?php echo number_format($grand_paid, 0, ',', '.'); ?></td>
                                    <td style="text-align:right;">Rp <?php echo number_format($grand_due, 0, ',', '.'); ?></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
