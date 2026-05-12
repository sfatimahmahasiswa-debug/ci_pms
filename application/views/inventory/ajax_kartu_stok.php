<?php
/**
 * AJAX partial — Kartu Stok Barang per medicine.
 * Shows chronological IN (masuk) and OUT (keluar) movements with running balance.
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
.ks-print-header { display:none; }
@media print { .ks-print-header { display:block !important; } }
</style>

<?php
// Build combined chronological events
$events = array();
foreach ($masuk as $m) {
    $events[] = array(
        'date'       => $m->date,
        'type'       => 'masuk',
        'keterangan' => 'Pembelian' . (!empty($m->no_faktur) ? ' — Faktur: '.$m->no_faktur : '') . (!empty($m->supplier_name) ? ' ('.$m->supplier_name.')' : ''),
        'masuk'      => (float)$m->jumlah,
        'keluar'     => 0,
        'harga'      => $m->purchase_price,
    );
}
foreach ($keluar as $k) {
    $events[] = array(
        'date'       => $k->date,
        'type'       => 'keluar',
        'keterangan' => 'Pengeluaran — Invoice #' . $k->invoice,
        'masuk'      => 0,
        'keluar'     => (float)$k->jumlah,
        'harga'      => $k->total_price,
    );
}
usort($events, function($a, $b) { return strcmp($a['date'], $b['date']); });

$med_name = $med_info ? htmlspecialchars($med_info->medicine_name) : '—';
$total_masuk  = array_sum(array_column($masuk,  'jumlah'));
$total_keluar = array_sum(array_column($keluar, 'jumlah'));
$saldo_akhir  = $total_masuk - $total_keluar;
?>

<!-- Print letterhead -->
<div class="ks-print-header" style="text-align:center; margin-bottom:14px; padding-bottom:8px; border-bottom:2px solid #1a2244;">
    <h2 style="margin:0; font-size:16pt; font-weight:800; color:#0d4a6e;">KLINIK HARMY MEDIKA</h2>
    <p style="margin:4px 0 0; font-size:11pt; font-weight:700;">KARTU STOK BARANG</p>
    <p style="margin:2px 0 0; font-size:10pt; color:#333;">Obat: <strong><?php echo $med_name; ?></strong></p>
    <p style="margin:2px 0 0; font-size:9pt; color:#666;">Lampiran C-3</p>
    <p style="margin:2px 0 0; font-size:8pt; color:#888;">Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
</div>

<!-- On-screen header -->
<div class="no-print" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; flex-wrap:wrap; gap:8px;">
    <h4 style="margin:0; color:#1a2244; font-weight:700;">
        <i class="fa fa-id-card"></i> Kartu Stok — <span style="color:#3d8bbd;"><?php echo $med_name; ?></span>
    </h4>
    <button onclick="window.print()" class="btn btn-success btn-sm no-print">
        <i class="fa fa-print"></i> Cetak Kartu
    </button>
</div>

<!-- Summary cards -->
<div class="row no-print" style="margin-bottom:12px;">
    <div class="col-sm-3">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:8px; padding:12px; text-align:center;">
            <div style="font-size:22px; font-weight:800; color:#3d8bbd;"><?php echo number_format($total_masuk, 0, ',', '.'); ?></div>
            <div style="font-size:11px; color:#888;">Total Masuk</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:8px; padding:12px; text-align:center;">
            <div style="font-size:22px; font-weight:800; color:#e65100;"><?php echo number_format($total_keluar, 0, ',', '.'); ?></div>
            <div style="font-size:11px; color:#888;">Total Keluar</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:8px; padding:12px; text-align:center;">
            <div style="font-size:22px; font-weight:800; color:<?php echo $saldo_akhir <= 0 ? 'crimson' : '#4CAF50'; ?>;">
                <?php echo number_format(max(0, $saldo_akhir), 0, ',', '.'); ?>
            </div>
            <div style="font-size:11px; color:#888;">Saldo Akhir</div>
        </div>
    </div>
    <div class="col-sm-3">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:8px; padding:12px; text-align:center;">
            <div style="font-size:18px; font-weight:800; color:<?php echo $saldo_akhir <= 0 ? 'crimson' : '#4CAF50'; ?>;">
                <?php echo $saldo_akhir <= 0 ? '<i class="fa fa-times-circle"></i>' : '<i class="fa fa-check-circle"></i>'; ?>
            </div>
            <div style="font-size:11px; color:#888;"><?php echo $saldo_akhir <= 0 ? 'Stok Habis' : 'Tersedia'; ?></div>
        </div>
    </div>
</div>

<?php if (empty($events)): ?>
<div class="alert alert-info"><i class="fa fa-info-circle"></i> Belum ada riwayat transaksi untuk obat ini.</div>
<?php else:
    $saldo_berjalan = 0;
?>
<div class="table-responsive">
<table class="table table-bordered" style="font-size:12px;">
    <thead style="background:#1a2244; color:#fff;">
        <tr>
            <th style="text-align:center;">#</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th style="text-align:center; color:#a5d6ff;">Barang Masuk</th>
            <th style="text-align:center; color:#ffcdd2;">Barang Keluar</th>
            <th style="text-align:center;">Saldo</th>
        </tr>
    </thead>
    <tbody>
    <tr style="background:#f0f4fa;">
        <td style="text-align:center; color:#aaa;">—</td>
        <td>—</td>
        <td><em style="color:#888;">Saldo Awal</em></td>
        <td style="text-align:center;">—</td>
        <td style="text-align:center;">—</td>
        <td style="text-align:center; font-weight:700;">0</td>
    </tr>
    <?php $n = 0; foreach ($events as $e):
        $n++;
        $saldo_berjalan += $e['masuk'] - $e['keluar'];
        $is_masuk = $e['type'] === 'masuk';
    ?>
    <tr style="<?php echo $is_masuk ? 'background:#f0f8ff;' : 'background:#fff5f5;'; ?>">
        <td style="text-align:center; color:#888;"><?php echo $n; ?></td>
        <td><?php echo htmlspecialchars($e['date']); ?></td>
        <td><?php echo htmlspecialchars($e['keterangan']); ?></td>
        <td style="text-align:center; font-weight:<?php echo $is_masuk ? '700' : '400'; ?>; color:<?php echo $is_masuk ? '#1565C0' : '#aaa'; ?>;">
            <?php echo $is_masuk ? number_format($e['masuk'], 0, ',', '.') : '—'; ?>
        </td>
        <td style="text-align:center; font-weight:<?php echo !$is_masuk ? '700' : '400'; ?>; color:<?php echo !$is_masuk ? 'crimson' : '#aaa'; ?>;">
            <?php echo !$is_masuk ? number_format($e['keluar'], 0, ',', '.') : '—'; ?>
        </td>
        <td style="text-align:center; font-weight:700; color:<?php echo $saldo_berjalan <= 0 ? 'crimson' : '#333'; ?>;">
            <?php echo number_format($saldo_berjalan, 0, ',', '.'); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot style="background:#1a2244; color:#fff; font-weight:700;">
        <tr>
            <td colspan="3" style="text-align:right;">TOTAL</td>
            <td style="text-align:center;"><?php echo number_format($total_masuk, 0, ',', '.'); ?></td>
            <td style="text-align:center;"><?php echo number_format($total_keluar, 0, ',', '.'); ?></td>
            <td style="text-align:center;"><?php echo number_format(max(0, $saldo_akhir), 0, ',', '.'); ?></td>
        </tr>
    </tfoot>
</table>
</div>
<?php endif; ?>
