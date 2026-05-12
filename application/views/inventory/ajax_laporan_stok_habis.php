<?php
/**
 * AJAX partial — Laporan Stok Barang Habis result table.
 * Used by laporan_stok_habis.php AND rekap stok_habis option.
 */
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
.sh-print-header { display:none; }
@media print { .sh-print-header { display:block !important; } }
</style>

<!-- Print letterhead -->
<div class="sh-print-header" style="text-align:center; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #1a2244;">
    <h2 style="margin:0; font-size:16pt; font-weight:800; color:#0d4a6e;">KLINIK HARMY MEDIKA</h2>
    <p style="margin:4px 0 0; font-size:11pt; font-weight:700;">LAPORAN STOK BARANG HABIS</p>
    <p style="margin:2px 0 0; font-size:9pt; color:#666;">Lampiran B-3 / C-6</p>
    <p style="margin:2px 0 0; font-size:8pt; color:#888;">Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
</div>

<!-- On-screen header -->
<div class="no-print" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
    <h4 style="margin:0; color:#c0392b; font-weight:700;">
        <i class="fa fa-exclamation-triangle"></i> Laporan Stok Barang Habis
        <?php if (isset($threshold)): ?>
            <small style="font-size:12px; color:#888; font-weight:400;">&nbsp; Ambang batas ≤ <?php echo (int)$threshold; ?> unit</small>
        <?php endif; ?>
    </h4>
    <button onclick="window.print()" class="btn btn-success btn-sm no-print">
        <i class="fa fa-print"></i> Cetak / PDF
    </button>
</div>

<?php if (empty($results)): ?>
<div class="alert alert-success">
    <i class="fa fa-check-circle"></i>
    <strong>Semua stok tersedia.</strong> Tidak ada obat yang habis atau di bawah ambang batas.
</div>
<?php else: ?>
<div class="table-responsive">
<table class="table table-bordered table-hover" style="font-size:12px;">
    <thead style="background:#c0392b; color:#fff;">
        <tr>
            <th style="text-align:center;">#</th>
            <th>Nama Obat</th>
            <th>Generik</th>
            <th>Bentuk Sediaan</th>
            <th>Supplier</th>
            <th>Kedaluwarsa</th>
            <th style="text-align:center;">Jml Masuk</th>
            <th style="text-align:center;">Jml Keluar</th>
            <th style="text-align:center;">Sisa Stok</th>
            <th style="text-align:center;">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $n = 0; foreach ($results as $r):
        $n++;
        $sisa = (float)$r->sisa_stok;
        $status_style = $sisa <= 0 ? 'background:#fff0f0; color:crimson; font-weight:700;' : 'background:#fff8e1; color:#e65100; font-weight:600;';
        $status_label = $sisa <= 0 ? '<span style="color:crimson;"><i class="fa fa-times-circle"></i> Habis</span>' : '<span style="color:#e65100;"><i class="fa fa-exclamation-circle"></i> Hampir Habis</span>';
    ?>
        <tr style="<?php echo $sisa <= 0 ? 'background:#fff5f5;' : 'background:#fffde7;'; ?>">
            <td style="text-align:center;"><?php echo $n; ?></td>
            <td><strong><?php echo htmlspecialchars($r->medicine_name); ?></strong></td>
            <td><?php echo htmlspecialchars($r->generic_name); ?></td>
            <td><?php echo htmlspecialchars($r->medicine_presentation); ?></td>
            <td><?php echo htmlspecialchars($r->supplier_name); ?></td>
            <td><?php echo htmlspecialchars($r->expiredate); ?></td>
            <td style="text-align:center;"><?php echo number_format((float)$r->total_masuk, 0, ',', '.'); ?></td>
            <td style="text-align:center;"><?php echo number_format((float)$r->total_keluar, 0, ',', '.'); ?></td>
            <td style="text-align:center; <?php echo $status_style; ?>">
                <?php echo number_format($sisa, 0, ',', '.'); ?>
            </td>
            <td style="text-align:center;"><?php echo $status_label; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr style="background:#f8f8f8; font-weight:700;">
            <td colspan="9" style="text-align:right;">Total item yang perlu pengadaan ulang:</td>
            <td style="text-align:center; color:crimson;"><?php echo count($results); ?> item</td>
        </tr>
    </tfoot>
</table>
</div>
<?php endif; ?>
