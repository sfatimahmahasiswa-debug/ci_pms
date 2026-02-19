<?php
if ($msg == "main") {
	$msg = "";
} elseif ($msg == "empty") {
	$msg = "Mohon isi semua kolom wajib";
} elseif ($msg == "created") {
	$msg = "Berhasil ditambahkan";
} elseif ($msg == "edit") {
	$msg = "Berhasil diubah";
} elseif ($msg == "delete") {
	$msg = "Berhasil dihapus";
}
?>
<!-- /.Breadcrumb -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Inventory</a></li>
            <li class="active"><?php echo $msg; ?></li>
        </ol>
    </div>
</section>
<style>
	tr.expired {
		background: #ff000012 !important;
		color: #c57575 !important;
	}
</style>

<!-- /.container -->
<section id="main">
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.html" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Persediaan</a>
                    <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_info/main"
                        class="list-group-item active">
                        <span class="	fa fa-capsules" aria-hidden="true"></span> Masukkan Informasi Obat.</a>
                    <a href="<?php echo base_url(); ?>ShowForm/medicine_purchase_statement/main" class="list-group-item">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span> Pernyataan Pembelian</a>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_payment/main" class="list-group-item">
                        <span class="fa fa-pills" aria-hidden="true"></span> Pembayaran Supplier</a>
<!--                    <a href="--><?php //echo base_url(); ?><!--ShowForm/create_product_name/main" class="list-group-item">-->
<!--                        <span class="fa fa-plus" aria-hidden="true"></span> Ledger</a>-->
                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Masukkan Informasi Pembelian Obat</h3>
                    </div>

                    <div class="panel-body">

                        <!-- /.rounded-0 panel End -->
                        <?php echo form_open_multipart('Insert/medicine_purchase_info'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3" style="">
                                    <label for="medicine_name">Nama Obat</label>
									<select name="medicine_name" id="medicine_name" class="form-control selectpicker"
											data-live-search="true">
										<option value="">-- Pilih --</option>
										<?php foreach ($all_medicine as $info) { ?>
											<option value="<?php echo $info->medicine_name."#".$info->medicine_name_id; ?>"><?php echo $info->medicine_name; ?></option>
										<?php } ?>
									</select>
                                </div>
								<div class="col-sm-3" style="">
									<label for="generic">Obat</label>
									<select name="generic" id="generic" class="form-control selectpicker"
											data-live-search="true">
										<option value="">-- Pilih --</option>
										<?php foreach ($all_generic as $info) { ?>
											<option value="<?php echo $info->generic_name."#".$info->generic_id; ?>"><?php echo $info->generic_name; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-3" style="">
									<label for="presentation">Bentuk Sediaan</label>
									<select name="presentation" id="presentation" class="form-control selectpicker"
											data-live-search="true">
										<option value="">-- Pilih --</option>
										<?php foreach ($all_presen as $info) { ?>
											<option value="<?php echo $info->medicine_presentation."#".$info->medicine_presentation_id; ?>"><?php echo $info->medicine_presentation; ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            <div class="row">
								<div class="col-sm-3">
									<label for="qty">Jumlah Obat Masuk</label>
									<input type="number" class="form-control" id="qty" name="qty">
								</div>
                                <div class="col-sm-3" style="">
                                    <label for="unit_price">Harga Satuan</label>
                                    <input type="number" step=any class="form-control" id="unit_price" placeholder="Rp"  name="unit_price">
                                </div>
								<div class="col-sm-3">
									<label for="unit_sales_price">Harga Jual</label>
									<input type="number" step=any class="form-control" id="unit_sales_price" placeholder="Rp"
										   name="unit_sales_price">
								</div>
                            </div>
                            <div class="row">
								<div class="col-sm-3">
									<label for="unit">Volume</label>
									<input type="text" class="form-control" id="unit" placeholder="gm / ml"
										   name="unit">

								</div>
								<div class="col-sm-3">
									<label for="date">Tanggal Pembelian</label>
									<input type="date" class="form-control" id="date"
										   name="date" autocomplete="off">
								</div>
								<div class="col-sm-3">
									<label for="ex_date">Tanggal Kedaluwarsa</label>
									<input type="date"  class="form-control new_datepicker" id="ex_date"
										 placeholder="Tanggal" name="ex_date" autocomplete="off">
								</div>
								<input type="hidden" id="purchase_price" name="purchase_price" value="0">
								<input type="hidden" id="purchase_paid" name="purchase_paid" value="0">
								<input type="hidden" id="purchase_due" name="purchase_due" value="0">
                            </div>
							<div class="row">
								<div class="col-sm-4" style="margin-top: 17px;">
									<button type="submit" class="pull-left btn btn-primary">Simpan</button>
								</div>
							</div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.rounded-0 panel End -->
			</div>
                <!-- /.rounded-0 panel 2nd -->
			<div class="col-md-12">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0">
                        <form method="post" action="<?php echo base_url(); ?>export_csv/export">
                            <h3 class="panel-title">Daftar Obat
<!--								<input type="submit" name="export"-->
<!--                                    class="btn btn-success btn-xs" value="Export to CSV" />-->
							</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">#</th>
                                        <th style="text-align: center;">Detail</th>
                                        <th style="text-align: center;">Stok Tersedia</th>
                                        <th style="text-align: center;">Harga Satuan</th>
										 <th style="text-align: center;">Harga Jual</th>
										<th style="text-align: center;">Kedaluwarsa</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- /.Row from DB-->
                                <tbody>
                                    <?php
								$count = 0;
								$near_expiry_medicine = array();
								foreach ($all_value as $single_value) {
									$count++;
									$mid = $single_value->medicine_name_id;
									$available = $single_value->qty;
									if(isset($sold[$mid]))
										$available -= $sold[$mid];
									if($single_value->particulars != "Payment"){
										$today = strtotime(date("Y-m-d"));
										$expiry = strtotime($single_value->expiredate);
										$seconds_per_day = 60 * 60 * 24;
										$remaining_days = floor(($expiry - $today) / $seconds_per_day);
										if ($remaining_days >= 0 && $remaining_days <= 30) {
											$near_expiry_medicine[] = $single_value->medicine_name.' ('.$single_value->expiredate.')';
										}
									?>

                                    <tr class="<?= (date("Y-m-d") >= $single_value->expiredate) ? 'expired' : '' ?>">
                                        <td style="text-align: center;"><?php echo $count; ?></td>
                                        <td style="text-align: left;">
										<b>Obat:</b>	<?php echo $single_value->medicine_name; ?>  <br>
										<b>Generik:</b>	<?php echo $single_value->generic_name; ?></br>
										<b>Bentuk Sediaan:</b>	<?php echo $single_value->medicine_presentation; ?> </br>
										<b>Volume:</b>	<?php echo $single_value->unit; ?> </br>
										<b>Tgl. Beli:</b>	<?php echo $single_value->date; ?>
										</td>
                                        <!-- <td style="text-align: center;"><?php echo $single_value->qty; ?></td> -->
                                        <td style="text-align: center;"><?php echo $available; ?></td>
                                        <td style="text-align: center;"><?php echo 'Rp '.number_format((float)$single_value->unit_price, 0, ',', '.'); ?></td>
										<td style="text-align: center;"><?php echo 'Rp '.number_format((float)$single_value->unit_sales_price, 0, ',', '.'); ?></td>
										<td style="text-align: center;"><?php echo $single_value->expiredate; ?></td>
                                        <td style="text-align: center;">
											<a style="margin: 5px;" title="Update"
											   href="<?php echo base_url(); ?>ShowForm/edit_purchase_info/<?php echo $single_value->purchase_id; ?>">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
                                            <a style="margin: 5px;" title="Delete"
                                                href="<?php echo base_url(); ?>Delete/medicine_purchase_info/<?php echo $single_value->purchase_id; ?>">
												<span class="	fa fa-trash" style="color:crimson"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } //if condition
								} ?>
<!--									// foreach-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </form> <!-- /.Excel form -->
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.Container -->


<div class="modal fade" id="nearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="nearExpiryModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Tutup"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="nearExpiryModalLabel">Pengingat Kedaluwarsa Obat</h4>
			</div>
			<div class="modal-body" id="nearExpiryModalBody"></div>
		</div>
	</div>
</div>
<script type="text/javascript">

	function updatePurchasePrice() {
		var qty = parseFloat($('#qty').val()) || 0;
		var unit_price = parseFloat($('#unit_price').val()) || 0;
		$('#purchase_price').val(qty * unit_price);
	}
	$("#unit_price,#qty").on("change paste keyup", function () {
		updatePurchasePrice();
	});
	updatePurchasePrice();
	var nearExpiryMedicine = <?php echo json_encode(array_values(array_unique($near_expiry_medicine)), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	if (nearExpiryMedicine.length > 0) {
		$('#nearExpiryModalBody').html('Obat berikut mendekati masa kedaluwarsa:<br>- ' + nearExpiryMedicine.join('<br>- '));
		$('#nearExpiryModal').modal('show');
	}
</script>
