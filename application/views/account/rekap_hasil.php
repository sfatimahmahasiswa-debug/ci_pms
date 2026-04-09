<?php
/**
 * Rekap Hasil — AJAX partial view.
 * Loaded into #show_report on the profit_loss page.
 * Contains @media print CSS that hides layout chrome (sidebar, topbar, footer)
 * so the printed/PDF output shows only this report.
 */

$label_type   = ($rekap_type === 'pembelian') ? 'Pembelian Obat' : 'Obat Keluar (Penjualan)';
$label_qty    = ($rekap_type === 'pembelian') ? 'Jml Dibeli'     : 'Jml Terjual';
$label_total  = ($rekap_type === 'pembelian') ? 'Total Pembelian' : 'Total Pendapatan';
?>

<style>
/* ── Screen-only: hide print header ─────────────────────────────── */
.rekap-print-header { display: none; }

/* ── Print styles ──────────────────────────────────────────────── */
@media print {
    /* Hide entire layout chrome */
    .sidebar,
    .sidebar-overlay,
    .topbar,
    #footer,
    #rekap-filter-panel,
    .btn-rekap-print,
    section#breadcrumb { display: none !important; }

    /* Remove sidebar margin so content fills the page */
    .page-wrapper  { display: block !important; }
    .main-wrapper  { margin-left: 0 !important; }
    .page-content  { padding: 0 !important; }

    /* Show the print-only company letterhead */
    .rekap-print-header { display: block !important; }

    /* Hide summary cards & on-screen header on print (we have print header) */
    .rekap-screen-header,
    .rekap-summary-cards { display: none !important; }

    /* Clean table for print */
    table { border-collapse: collapse !important; width: 100% !important; font-size: 11pt; }
    th, td { border: 1px solid #444 !important; padding: 5px 7px !important; }

    /* Type group header row */
    .rekap-type-header td { background: #1a2244 !important; color: #fff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    /* Category subtotal row */
    .rekap-cat-subtotal td { background: #d9eaf7 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    /* Type total row */
    .rekap-type-total td { background: #1a2244 !important; color: #fff !important; font-weight: 700; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    /* Grand total row */
    .rekap-grand-total td { background: #0d4a6e !important; color: #fff !important; font-weight: 700; font-size: 12pt; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    /* Avoid splitting a type group across pages */
    .rekap-type-group { page-break-inside: avoid; margin-bottom: 14pt; }

    @page { size: A4; margin: 1.8cm 2cm; }
}
</style>

<?php if (!empty($grouped)) : ?>

<!-- ═══ PRINT-ONLY LETTERHEAD ════════════════════════════════════ -->
<div class="rekap-print-header" style="text-align:center; margin-bottom:18px; padding-bottom:10px; border-bottom:2px solid #1a2244;">
    <h2 style="margin:0 0 4px; font-size:18pt; font-weight:800; letter-spacing:1px; color:#0d4a6e;">KLINIK HARMY MEDIKA</h2>
    <p style="margin:0; font-size:10pt; color:#555;">Laporan Rekapan — <strong><?php echo $label_type; ?></strong></p>
    <?php if (!empty($date_from) && !empty($date_to)) : ?>
        <p style="margin:4px 0 0; font-size:9pt; color:#666;">
            Periode: <?php echo date('d F Y', strtotime($date_from)); ?> s/d <?php echo date('d F Y', strtotime($date_to)); ?>
        </p>
    <?php elseif (!empty($date_to)) : ?>
        <p style="margin:4px 0 0; font-size:9pt; color:#666;">
            Per Tanggal: <?php echo date('d F Y', strtotime($date_to)); ?>
        </p>
    <?php else : ?>
        <p style="margin:4px 0 0; font-size:9pt; color:#666;">Semua Periode</p>
    <?php endif; ?>
    <p style="margin:2px 0 0; font-size:8pt; color:#888;">Dicetak: <?php echo date('d F Y, H:i'); ?> WIB</p>
</div>

<!-- ═══ ON-SCREEN HEADER ══════════════════════════════════════════ -->
<div class="rekap-screen-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px;">
    <div>
        <h4 style="margin:0; font-size:16px; font-weight:700; color:#1a2244;">
            <i class="fa fa-chart-bar" style="color:#3d8bbd;"></i>&nbsp;
            Rekapan <?php echo $label_type; ?>
        </h4>
        <small style="color:#888;">
            <?php if (!empty($date_from) && !empty($date_to)) : ?>
                Periode: <?php echo date('d M Y', strtotime($date_from)); ?> &mdash; <?php echo date('d M Y', strtotime($date_to)); ?>
            <?php elseif (!empty($date_to)) : ?>
                Per Tanggal: <?php echo date('d M Y', strtotime($date_to)); ?>
            <?php else : ?>
                Semua Periode
            <?php endif; ?>
        </small>
    </div>
    <button type="button" class="btn btn-success btn-rekap-print" onclick="window.print()">
        <i class="fa fa-print"></i>&nbsp; Cetak Laporan PDF
    </button>
</div>

<!-- ═══ SUMMARY CARDS ═════════════════════════════════════════════ -->
<div class="rekap-summary-cards row" style="margin-bottom:18px;">
    <div class="col-sm-4">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:10px; padding:14px 18px; box-shadow:0 2px 8px rgba(0,0,0,0.06); text-align:center;">
            <div style="font-size:26px; font-weight:800; color:#3d8bbd;"><?php echo number_format($grand_total_qty, 0, ',', '.'); ?></div>
            <div style="font-size:12px; color:#888; margin-top:3px;">Total Unit <?php echo ($rekap_type === 'pembelian') ? 'Dibeli' : 'Terjual'; ?></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:10px; padding:14px 18px; box-shadow:0 2px 8px rgba(0,0,0,0.06); text-align:center;">
            <div style="font-size:20px; font-weight:800; color:#e65100;">Rp <?php echo number_format($grand_total_harga, 0, ',', '.'); ?></div>
            <div style="font-size:12px; color:#888; margin-top:3px;"><?php echo $label_total; ?></div>
        </div>
    </div>
    <div class="col-sm-4">
        <div style="background:#fff; border:1px solid #e8ecf4; border-radius:10px; padding:14px 18px; box-shadow:0 2px 8px rgba(0,0,0,0.06); text-align:center;">
            <div style="font-size:26px; font-weight:800; color:#4CAF50;"><?php echo count($grouped); ?></div>
            <div style="font-size:12px; color:#888; margin-top:3px;">Tipe / Bentuk Sediaan</div>
        </div>
    </div>
</div>

<!-- ═══ GROUPED TABLE ═════════════════════════════════════════════ -->
<table class="table table-bordered" style="width:100%; font-size:13px; background:#fff;">
    <thead>
        <tr style="background:#1a2244; color:#fff;">
            <th style="width:36px; text-align:center;">#</th>
            <th>Tipe / Bentuk Sediaan</th>
            <th>Kategori (Generik)</th>
            <th>Merk Obat</th>
            <th style="text-align:center;"><?php echo $label_qty; ?></th>
            <th style="text-align:right;"><?php echo $label_total; ?> (Rp)</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $row_no    = 0;
    $type_no   = 0;

    foreach ($grouped as $type_name => $type_data) :
        $type_no++;
        $type_row_count = 0;
        foreach ($type_data['categories'] as $cat_data) {
            $type_row_count += count($cat_data['items']) + 1; // +1 for subtotal row
        }
        $type_row_count++; // +1 for type total row
    ?>

        <!-- ── Type separator row ──────────────────────────────── -->
        <tr class="rekap-type-header">
            <td colspan="6" style="background:#1a2244; color:#fff; font-weight:700; padding:8px 12px; font-size:13px;">
                <i class="fa fa-pills"></i>&nbsp;
                Tipe Sediaan: <?php echo htmlspecialchars($type_name); ?>
                &nbsp;&mdash;&nbsp;
                <span style="font-weight:400; font-size:11px; opacity:.85;">
                    <?php echo number_format($type_data['total_qty'], 0, ',', '.'); ?> unit &nbsp;|&nbsp;
                    Rp <?php echo number_format($type_data['total_harga'], 0, ',', '.'); ?>
                </span>
            </td>
        </tr>

        <?php foreach ($type_data['categories'] as $cat_name => $cat_data) :
            $is_first_cat_row = true;
            foreach ($cat_data['items'] as $item) :
                $row_no++;
        ?>
        <tr>
            <td style="text-align:center; color:#888;"><?php echo $row_no; ?></td>
            <td style="color:#888; font-size:11px;"><?php echo htmlspecialchars($type_name); ?></td>
            <?php if ($is_first_cat_row) : ?>
            <td rowspan="<?php echo count($cat_data['items']); ?>"
                style="vertical-align:middle; background:#f8fafb; font-weight:600; border-left:3px solid #3d8bbd;">
                <?php echo htmlspecialchars($cat_name); ?>
            </td>
            <?php $is_first_cat_row = false; endif; ?>
            <td><?php echo htmlspecialchars($item->medicine_name); ?></td>
            <td style="text-align:center;"><?php echo number_format($item->total_qty, 0, ',', '.'); ?></td>
            <td style="text-align:right;"><?php echo number_format($item->total_harga, 0, ',', '.'); ?></td>
        </tr>
        <?php endforeach; ?>

        <!-- Category subtotal -->
        <tr class="rekap-cat-subtotal">
            <td colspan="4" style="text-align:right; font-size:11px; font-style:italic; color:#1a2244; background:#eaf4fb; padding:5px 10px;">
                Subtotal <?php echo htmlspecialchars($cat_name); ?>:
            </td>
            <td style="text-align:center; font-weight:600; background:#eaf4fb;">
                <?php echo number_format($cat_data['total_qty'], 0, ',', '.'); ?>
            </td>
            <td style="text-align:right; font-weight:600; background:#eaf4fb;">
                <?php echo number_format($cat_data['total_harga'], 0, ',', '.'); ?>
            </td>
        </tr>

        <?php endforeach; ?>

        <!-- Type total -->
        <tr class="rekap-type-total">
            <td colspan="4" style="text-align:right; background:#1a2244; color:#fff; font-size:12px; padding:7px 12px;">
                Total <?php echo htmlspecialchars($type_name); ?>:
            </td>
            <td style="text-align:center; background:#1a2244; color:#fff; font-weight:700;">
                <?php echo number_format($type_data['total_qty'], 0, ',', '.'); ?>
            </td>
            <td style="text-align:right; background:#1a2244; color:#fff; font-weight:700;">
                <?php echo number_format($type_data['total_harga'], 0, ',', '.'); ?>
            </td>
        </tr>

    <?php endforeach; ?>

    <!-- Grand total -->
    <tr class="rekap-grand-total">
        <td colspan="4" style="text-align:right; background:#0d4a6e; color:#fff; font-size:14px; font-weight:800; padding:10px 12px;">
            TOTAL KESELURUHAN
        </td>
        <td style="text-align:center; background:#0d4a6e; color:#fff; font-size:14px; font-weight:800;">
            <?php echo number_format($grand_total_qty, 0, ',', '.'); ?>
        </td>
        <td style="text-align:right; background:#0d4a6e; color:#fff; font-size:14px; font-weight:800;">
            Rp <?php echo number_format($grand_total_harga, 0, ',', '.'); ?>
        </td>
    </tr>
    </tbody>
</table>

<?php else : ?>

<div class="alert alert-info" style="border-radius:10px; font-size:14px;">
    <i class="fa fa-info-circle"></i>&nbsp;
    Tidak ada data untuk ditampilkan. Silakan ubah filter pencarian dan klik <strong>Tampilkan Rekapan</strong>.
</div>

<?php endif; ?>
