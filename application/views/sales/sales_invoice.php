<?php
$invoiceDate = !empty($date) ? date('d/m/Y', strtotime($date)) : '-';
$lineItems = array_filter(array_map('trim', explode(',', (string)$medicine_name)));
?>
<section id="main" class="invoice-page-wrap">
	<div class="container invoice-container">
		<div class="invoice-toolbar">
			<button id="print_button" title="Klik untuk cetak" type="button" onClick="window.print()" class="btn btn-primary btn-sm">
				<span class="fa fa-print"></span> Cetak Invoice
			</button>
		</div>

		<div class="invoice-card">
			<div class="invoice-header">
				<div>
					<h1>Invoice Penjualan Obat</h1>
					<p>Klinik Inventory & Pharmacy</p>
				</div>
				<div class="invoice-badge">INV</div>
			</div>

			<div class="invoice-meta-grid">
				<div>
					<div class="meta-label">ID Invoice</div>
					<div class="meta-value"><?php echo $invoice; ?></div>
				</div>
				<div>
					<div class="meta-label">Tanggal</div>
					<div class="meta-value"><?php echo $invoiceDate; ?></div>
				</div>
				<div>
					<div class="meta-label">Status</div>
					<div class="meta-value">Lunas</div>
				</div>
			</div>

			<div class="invoice-table-wrap">
				<table class="table invoice-table">
					<thead>
						<tr>
							<th style="width: 70px;">No</th>
							<th>Deskripsi Obat</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($lineItems)) { ?>
						<?php foreach ($lineItems as $index => $lineItem) { ?>
							<tr>
								<td><?php echo $index + 1; ?></td>
								<td><?php echo $lineItem; ?></td>
							</tr>
						<?php } ?>
					<?php } else { ?>
						<tr>
							<td>1</td>
							<td><?php echo $medicine_name; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="invoice-total-card">
				<div class="row-item">
					<span>Total</span>
					<strong>Rp <?php echo number_format((float)$amount, 0, ',', '.'); ?></strong>
				</div>
				<div class="row-item highlight">
					<span>Total Dibayar</span>
					<strong>Rp <?php echo number_format((float)$pay, 0, ',', '.'); ?></strong>
				</div>
			</div>

			<div class="invoice-footer-note">
				Terima kasih telah melakukan pembelian. Simpan invoice ini sebagai bukti transaksi.
			</div>
		</div>
	</div>
</section>

<style>
	.invoice-page-wrap {
		padding-bottom: 30px;
	}
	.invoice-toolbar {
		text-align: right;
		margin-bottom: 15px;
	}
	.invoice-card {
		background: linear-gradient(165deg, #f4f8fb 0%, #ffffff 60%);
		border-radius: 16px;
		padding: 24px;
		box-shadow: 0 8px 30px rgba(23, 85, 140, 0.12);
		border: 1px solid #d8e8f5;
		color: #1f2a3a;
	}
	.invoice-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 20px;
	}
	.invoice-header h1 {
		margin: 0;
		font-size: 28px;
		color: #1a73be;
	}
	.invoice-header p {
		margin: 4px 0 0;
		color: #6b7b8c;
	}
	.invoice-badge {
		width: 90px;
		height: 90px;
		border-radius: 50%;
		background: #1a73be;
		color: #fff;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 26px;
		font-weight: 700;
	}
	.invoice-meta-grid {
		display: grid;
		grid-template-columns: repeat(3, minmax(120px, 1fr));
		gap: 12px;
		margin-bottom: 18px;
	}
	.meta-label {
		font-size: 12px;
		text-transform: uppercase;
		color: #6b7b8c;
	}
	.meta-value {
		font-size: 16px;
		font-weight: 700;
	}
	.invoice-table thead tr {
		background: #1a73be;
		color: #fff;
	}
	.invoice-table tbody td {
		vertical-align: middle !important;
	}
	.invoice-total-card {
		margin-left: auto;
		max-width: 320px;
		background: #f3f9ff;
		border: 1px solid #d2e7fb;
		border-radius: 12px;
		padding: 12px 16px;
	}
	.invoice-total-card .row-item {
		display: flex;
		justify-content: space-between;
		padding: 8px 0;
		border-bottom: 1px dashed #b7d4ec;
	}
	.invoice-total-card .row-item.highlight {
		border-bottom: 0;
		font-size: 18px;
		color: #0f5b97;
	}
	.invoice-footer-note {
		margin-top: 16px;
		font-size: 13px;
		color: #6b7b8c;
	}
	@media (max-width: 768px) {
		.invoice-meta-grid {
			grid-template-columns: 1fr;
		}
		.invoice-header {
			flex-direction: column;
			align-items: flex-start;
			gap: 10px;
		}
	}
	@media print {
		a[href]:after {
			content: none !important;
		}
		#print_button,
		#no_print1,
		#no_print2,
		#no_print3,
		#no_print4 {
			display: none !important;
		}
		.invoice-card {
			box-shadow: none;
			border: 0;
			padding: 0;
		}
		.invoice-toolbar {
			display: none;
		}
	}
</style>
