<?php
$invoiceDate = !empty($purchase->date) ? date('d/m/Y', strtotime($purchase->date)) : '-';
$invoiceNumber = !empty($purchase->invoice_id) ? 'FBM-' . $purchase->invoice_id : '-';
$supplierName = !empty($purchase->supplier_name) ? $purchase->supplier_name : '-';
?>
<section id="main" class="invoice-page-wrap">
	<div class="container invoice-container">
		<div class="invoice-toolbar">
			<a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main" class="btn btn-default btn-sm">
				<span class="fa fa-arrow-left"></span> Kembali
			</a>
			<button id="print_button" title="Klik untuk cetak PDF" type="button" onClick="window.print()" class="btn btn-primary btn-sm">
				<span class="fa fa-print"></span> Cetak Faktur (PDF)
			</button>
		</div>

		<div class="invoice-card">
			<div class="invoice-header">
				<div>
					<h1>Faktur Pembelian Barang Masuk</h1>
					<p>Klinik Harmy Medika</p>
				</div>
				<div class="invoice-badge"><img src="<?php echo base_url(); ?>assets/harmy.png" alt="Harmy Logo" class="invoice-badge-logo"></div>
			</div>

			<div class="invoice-meta-grid">
				<div>
					<div class="meta-label">No. Faktur</div>
					<div class="meta-value"><?php echo $invoiceNumber; ?></div>
				</div>
				<div>
					<div class="meta-label">Tanggal</div>
					<div class="meta-value"><?php echo $invoiceDate; ?></div>
				</div>
				<div>
					<div class="meta-label">Supplier</div>
					<div class="meta-value"><?php echo htmlspecialchars($supplierName); ?></div>
				</div>
			</div>

			<div class="invoice-table-wrap">
				<table class="table invoice-table">
					<thead>
						<tr>
							<th>Nama Obat</th>
							<th>Generik</th>
							<th>Bentuk</th>
							<th style="text-align:right;">Qty</th>
							<th style="text-align:right;">Harga Satuan</th>
							<th style="text-align:right;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo htmlspecialchars((string)$purchase->medicine_name); ?></td>
							<td><?php echo htmlspecialchars((string)$purchase->generic_name); ?></td>
							<td><?php echo htmlspecialchars((string)$purchase->medicine_presentation); ?></td>
							<td style="text-align:right;"><?php echo (float)$purchase->qty; ?></td>
							<td style="text-align:right;">Rp <?php echo number_format((float)$purchase->unit_price, 0, ',', '.'); ?></td>
							<td style="text-align:right;">Rp <?php echo number_format((float)$purchase->purchase_price, 0, ',', '.'); ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="invoice-total-card">
				<div class="row-item">
					<span>Total Pembelian</span>
					<strong>Rp <?php echo number_format((float)$purchase->purchase_price, 0, ',', '.'); ?></strong>
				</div>
				<div class="row-item">
					<span>Total Dibayar</span>
					<strong>Rp <?php echo number_format((float)$purchase->purchase_paid, 0, ',', '.'); ?></strong>
				</div>
				<div class="row-item highlight">
					<span>Sisa Hutang</span>
					<strong>Rp <?php echo number_format((float)$purchase->purchase_due, 0, ',', '.'); ?></strong>
				</div>
			</div>

			<div class="invoice-footer-note">
				Dokumen ini dapat dicetak melalui tombol <b>Cetak Faktur (PDF)</b>, lalu pilih <b>Save as PDF</b> pada dialog print browser.
			</div>
		</div>
	</div>
</section>

<style>
	.invoice-page-wrap { padding: 20px 0 30px; }
	.invoice-container { max-width: 980px; margin: 0 auto; }
	.invoice-toolbar { text-align: right; margin-bottom: 15px; display: flex; gap: 8px; justify-content: flex-end; }
	.invoice-card { background: linear-gradient(165deg, #f4f8fb 0%, #ffffff 60%); border-radius: 16px; padding: 24px; box-shadow: 0 8px 30px rgba(23, 85, 140, 0.12); border: 1px solid #d8e8f5; color: #1f2a3a; }
	.invoice-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
	.invoice-header h1 { margin: 0; font-size: 28px; color: #1a73be; }
	.invoice-header p { margin: 4px 0 0; color: #6b7b8c; }
	.invoice-badge { width: 90px; height: 90px; border-radius: 50%; background: #1a73be; overflow: hidden; }
	.invoice-badge-logo { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
	.invoice-meta-grid { display: grid; grid-template-columns: repeat(3, minmax(120px, 1fr)); gap: 12px; margin-bottom: 18px; }
	.meta-label { font-size: 12px; text-transform: uppercase; color: #6b7b8c; }
	.meta-value { font-size: 16px; font-weight: 700; }
	.invoice-table thead tr { background: #1a73be; color: #fff; }
	.invoice-table tbody td { vertical-align: middle !important; }
	.invoice-total-card { margin-left: auto; max-width: 360px; background: #f3f9ff; border: 1px solid #d2e7fb; border-radius: 12px; padding: 12px 16px; }
	.invoice-total-card .row-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed #b7d4ec; }
	.invoice-total-card .row-item.highlight { border-bottom: 0; font-size: 18px; color: #0f5b97; }
	.invoice-footer-note { margin-top: 16px; font-size: 13px; color: #6b7b8c; }
	@media (max-width: 768px) {
		.invoice-meta-grid { grid-template-columns: 1fr; }
		.invoice-header { flex-direction: column; align-items: flex-start; gap: 10px; }
	}
	@media print {
		a[href]:after { content: none !important; }
		.invoice-toolbar { display: none !important; }
		.invoice-card { box-shadow: none; border: 0; padding: 0; }
	}
</style>
