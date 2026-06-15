<section id="main">
	<div class="container-fluid">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-chart-bar"></i> Laporan Inventory Otomatis</h3>
			</div>
			<div class="panel-body">
				<p><strong>Total Stok Saat Ini:</strong> <?php echo number_format((int)$total_stock); ?> unit</p>
				<p><strong>Update:</strong> <?php echo htmlspecialchars($generated_at); ?> WIB</p>
			</div>
		</div>

		<div class="panel panel-info" id="laporan-stok">
			<div class="panel-heading"><strong>Laporan Stok</strong></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Obat</th>
							<th>Barang Masuk</th>
							<th>Barang Keluar</th>
							<th>Stok Akhir</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($stock_report)): ?>
						<?php $no = 1; foreach ($stock_report as $row): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo htmlspecialchars($row->medicine_name); ?></td>
								<td><?php echo number_format((int)$row->qty_masuk); ?></td>
								<td><?php echo number_format((int)$row->qty_keluar); ?></td>
								<td><?php echo number_format((int)$row->stok_akhir); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr><td colspan="5" class="text-center">Belum ada data stok.</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="panel panel-success" id="laporan-barang-masuk">
			<div class="panel-heading"><strong>Laporan Barang Masuk (50 transaksi terakhir)</strong></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Invoice</th>
							<th>Supplier</th>
							<th>Nama Obat</th>
							<th>Qty</th>
							<th>Total Pembelian</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($incoming_report)): ?>
						<?php $no = 1; foreach ($incoming_report as $row): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo htmlspecialchars($row->date); ?></td>
								<td><?php echo htmlspecialchars($row->invoice_id); ?></td>
								<td><?php echo htmlspecialchars($row->supplier_name); ?></td>
								<td><?php echo htmlspecialchars($row->medicine_name); ?></td>
								<td><?php echo number_format((int)$row->qty); ?></td>
								<td>Rp <?php echo number_format((float)$row->purchase_price, 0, ',', '.'); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr><td colspan="7" class="text-center">Belum ada data barang masuk.</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="panel panel-warning" id="laporan-barang-keluar">
			<div class="panel-heading"><strong>Laporan Barang Keluar (50 transaksi terakhir)</strong></div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Invoice</th>
							<th>Nama Obat</th>
							<th>Qty</th>
							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
					<?php if (!empty($outgoing_report)): ?>
						<?php $no = 1; foreach ($outgoing_report as $row): ?>
							<tr>
								<td><?php echo $no++; ?></td>
								<td><?php echo htmlspecialchars($row->date); ?></td>
								<td><?php echo htmlspecialchars($row->invoice); ?></td>
								<td><?php echo htmlspecialchars($row->medicine_name); ?></td>
								<td><?php echo number_format((int)$row->qty); ?></td>
								<td>Rp <?php echo number_format((float)$row->total_price, 0, ',', '.'); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr><td colspan="6" class="text-center">Belum ada data barang keluar.</td></tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
