<?php
/**
 * AJAX partial — Laporan Stok Barang Masuk result table.
 * Loaded into #lsm_result by laporan_stok_masuk.php
 */
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
.lsm-print-header { display:none; }
@media print { .lsm-print-header { display:block !important; } }
</style>

<!-- Print letterhead -->
<div class="lsm-print-header" style="text-align:center; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #1a2244;">
    <h2 style="margin:0; font-size:16pt; font-weight:800; color:#0d4a6e;">KLINIK HARMY MEDIKA</h2>
    <p style="margin:4px 0 0; font-size:11pt; font-weight:700;">LAPORAN STOK BARANG MASUK</p>
    <p style="margin:2px 0 0; font-size:9pt; color:#666;">Lampiran C-1</p>
    <?php if (!empty($date_from) && !empty($date_to)): ?>
    <p style="margin:2px 0 0; font-size:9pt; color:#666;">
        Periode: <?php echo date('d F Y', strtotime($date_from)); ?> s/d <?php echo date('d F Y', strtotime($date_to)); ?>
    </p>
    <?php endif; ?>
    <p style="margin:2px 0 0; font-size:8pt; color:#888;">Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
</div>

<!-- On-screen header -->
<div class="no-print" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
    <h4 style="margin:0; color:#1a2244; font-weight:700;">
        <i class="fa fa-file-alt"></i> Laporan Stok Barang Masuk
        <?php if (!empty($date_from) && !empty($date_to)): ?>
            <small style="font-size:12px; color:#888; font-weight:400;">
                &nbsp; <?php echo date('d M Y', strtotime($date_from)); ?> — <?php echo date('d M Y', strtotime($date_to)); ?>
            </small>
        <?php endif; ?>
    </h4>
    <button onclick="window.print()" class="btn btn-success btn-sm">
        <i class="fa fa-print"></i> Cetak / PDF
    </button>
</div>

<?php if (empty($results)): ?>
<div class="alert alert-info"><i class="fa fa-info-circle"></i> Tidak ada data untuk ditampilkan.</div>
<?php else:
    $grand_qty   = 0;
    $grand_total = 0;
?>
<div class="table-responsive">
<table class="table table-bordered table-striped table-hover" style="font-size:12px;">
    <thead style="background:#1a2244; color:#fff;">
        <tr>
            <th style="text-align:center;">#</th>
            <th>No. Faktur</th>
            <th>Tgl. Beli</th>
            <th>Nama Obat</th>
            <th>Generik</th>
            <th>Bentuk Sediaan</th>
            <th>Supplier</th>
            <th style="text-align:center;">Jml Masuk</th>
            <th style="text-align:right;">Harga Satuan</th>
            <th style="text-align:right;">Total Harga</th>
            <th>Kedaluwarsa</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 0; foreach ($results as $r):
        $n++;
        $grand_qty   += $r->qty;
        $grand_total += $r->purchase_price;
        $exp_class = (!empty($r->expiredate) && $r->expiredate < date('Y-m-d')) ? 'style="color:crimson;"' : '';
    ?>
        <tr>
            <td style="text-align:center;"><?php echo $n; ?></td>
            <td><?php echo !empty($r->no_faktur) ? htmlspecialchars($r->no_faktur) : '<em style="color:#aaa;">—</em>'; ?></td>
            <td><?php echo htmlspecialchars($r->date); ?></td>
            <td><strong><?php echo htmlspecialchars($r->medicine_name); ?></strong></td>
            <td><?php echo htmlspecialchars($r->generic_name); ?></td>
            <td><?php echo htmlspecialchars($r->medicine_presentation); ?></td>
            <td><?php echo htmlspecialchars($r->supplier_name); ?></td>
            <td style="text-align:center;"><?php echo number_format((float)$r->qty, 0, ',', '.'); ?></td>
            <td style="text-align:right;">Rp <?php echo number_format((float)$r->unit_price, 0, ',', '.'); ?></td>
            <td style="text-align:right;"><strong>Rp <?php echo number_format((float)$r->purchase_price, 0, ',', '.'); ?></strong></td>
            <td <?php echo $exp_class; ?>><?php echo htmlspecialchars($r->expiredate); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot style="background:#1a2244; color:#fff; font-weight:700;">
        <tr>
            <td colspan="7" style="text-align:right;">TOTAL</td>
            <td style="text-align:center;"><?php echo number_format($grand_qty, 0, ',', '.'); ?></td>
            <td></td>
            <td style="text-align:right;">Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
<?php endif; ?>
