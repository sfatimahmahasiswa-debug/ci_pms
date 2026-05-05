<?php
if ($msg == "main") {
	$msg = "";
} elseif ($msg == "empty") {
	$msg = "Please fill out all required fields";
} elseif ($msg == "created") {
	$msg = "Created Successfully";
} elseif ($msg == "edit") {
	$msg = "Edited Successfully";
} elseif ($msg == "delete") {
	$msg = "Deleted Successfully";
}
?>
<!-- /.Breadcrumb -->
<section id="breadcrumb">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="#"> Buat Opsi</a></li>
			<li class="active"><?php echo $msg; ?></li>
		</ol>
	</div>
</section>

<!-- /.container -->
<section id="main">
	<div class="container">

		<div class="row">
			<div class="col-md-3">
				<div class="list-group">
					<a href="index.html" class="list-group-item active main-color-bg">
						<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>  Buat Opsi</a>
					<a href="<?php echo base_url(); ?>ShowForm/create_medicine_presentation/main" class="list-group-item">
						<span class="	fa fa-capsules" aria-hidden="true"></span> Presentase Obat</a>
					<a href="<?php echo base_url(); ?>ShowForm/create_generic_name/main" class="list-group-item">
						<span class="fa fa-plus-circle" aria-hidden="true"></span> Kategori Obat </a>
					<a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="list-group-item active">
						<span class="fa fa-pills" aria-hidden="true"></span> Nama Obat</a>
					<a href="<?php echo base_url(); ?>storage" class="list-group-item">
						<span class="fa fa-pills" aria-hidden="true"></span> Storage Obat</a>

<!--					<a href="--><?php //echo base_url(); ?><!--ShowForm/create_product_category/main" class="list-group-item">-->
<!--						<span class="fa fa-tasks" aria-hidden="true"></span> Product Category</a>-->
<!--					<a href="--><?php //echo base_url(); ?><!--ShowForm/create_product_name/main" class="list-group-item">-->
<!--						<span class="fa fa-plus" aria-hidden="true"></span> Product Name</a>-->

				</div>
			</div>
			<div class="col-md-9">
				<div class="rounded-0 panel panel-default">
					<div class="panel-heading rounded-0 main-color-bg">
						<h3 class="panel-title">Create Nama Obat</h3>
					</div>

					<div class="panel-body">

						<!-- /.rounded-0 panel End -->
								<?php echo form_open_multipart('Insert/medicine_name'); ?>
								<div class="box-body">
									<div class="row">
									<div class="col-sm-6" style="">
										<label for="generic_name">Kategori Obat</label>
										<select name="generic_name" id="generic_name" class="form-control selectpicker"
												data-live-search="true">
											<option value="">-- Select --</option>
											<?php foreach ($all_generic as $info) { ?>
												<option value="<?php echo $info->generic_name; ?>"><?php echo $info->generic_name; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-sm-6">
<!--									<div class="form-group" style="width: 400px;">-->
										<label for="medicine_name">Nama Obat</label>
										<input type="text" class="form-control" id="medicine_name" placeholder="" name="medicine_name">
<!--									</div>-->
								</div>
									</div>
									<div class="row">
								<div class="col-sm-4" style="margin-top: 17px;">
									<button type="submit" class="pull-left btn btn-primary">Buat</button>
								</div>
									</div>
								</form>
							</div>
					</div>
				</div><!-- /.rounded-0 panel End -->
				<!-- /.rounded-0 panel 2nd -->
				<div class="rounded-0 panel panel-default">
					<div class="panel-heading rounded-0">
						<h3 class="panel-title">Daftar Nama Obat</h3>
					</div>
					<div class="panel-body">
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="medicine-name-table">
								<thead>
								<tr>
									<th style="text-align: center;">#</th>
									<th style="text-align: center;">Kategori Obat</th>
									<th style="text-align: center;">Nama Obat</th>
									<th style="text-align: center;">Aksi</th>
								</tr>
								</thead>
								<!-- /.Row from DB-->
								<tbody id="medicine-name-tbody">
								<?php
								// Group medicines by category
								$grouped = array();
								foreach ($all_value as $single_value) {
									$cat = $single_value->generic_name ? $single_value->generic_name : '(Tanpa Kategori)';
									$grouped[$cat][] = $single_value;
								}
								ksort($grouped);
								$count = 0;
								foreach ($grouped as $category => $medicines) {
									foreach ($medicines as $single_value) {
										$count++;
										?>
									<tr class="medicine-data-row" data-category="<?php echo htmlspecialchars($category); ?>">
										<td style="text-align: center;"><?php echo $count; ?></td>
										<td><?php echo htmlspecialchars($category); ?></td>
										<td><?php echo $single_value->medicine_name; ?></td>
										<td style="text-align: center;">
											<a style="margin: 5px;" class="btn btn-danger btn-sm rounded-0"
											   href="<?php echo base_url(); ?>Delete/medicine_name/<?php echo $single_value->medicine_name_id; ?>">Delete
											</a>
										</td>
									</tr>
								<?php } } ?>
								</tbody>
							</table>
							<!-- Pagination Controls -->
							<div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-top:10px;">
								<button id="medicine-prev-btn" class="btn btn-default btn-sm" onclick="changeMedicinePage(-1)">
									&#8592; Sebelumnya
								</button>
								<span id="medicine-page-info" style="font-weight:bold;"></span>
								<button id="medicine-next-btn" class="btn btn-default btn-sm" onclick="changeMedicinePage(1)">
									Berikutnya &#8594;
								</button>
							</div>
						</div>
					</div>
				</div>

<script>
(function() {
	var ROWS_PER_PAGE = 10;
	var currentPage = 1;

	function getDataRows() {
		return document.querySelectorAll('#medicine-name-tbody .medicine-data-row');
	}

	function renderPage() {
		var rows = getDataRows();
		var total = rows.length;
		var totalPages = Math.max(1, Math.ceil(total / ROWS_PER_PAGE));
		if (currentPage > totalPages) currentPage = totalPages;

		var start = (currentPage - 1) * ROWS_PER_PAGE;
		var end = start + ROWS_PER_PAGE;

		for (var i = 0; i < total; i++) {
			var row = rows[i];
			if (i >= start && i < end) {
				row.style.display = '';
			} else {
				row.style.display = 'none';
			}
		}

		document.getElementById('medicine-page-info').textContent = 'Halaman ' + currentPage + ' dari ' + totalPages;
		document.getElementById('medicine-prev-btn').disabled = (currentPage === 1);
		document.getElementById('medicine-next-btn').disabled = (currentPage === totalPages);
	}

	window.changeMedicinePage = function(dir) {
		var rows = getDataRows();
		var total = rows.length;
		var totalPages = Math.max(1, Math.ceil(total / ROWS_PER_PAGE));
		currentPage += dir;
		if (currentPage < 1) currentPage = 1;
		if (currentPage > totalPages) currentPage = totalPages;
		renderPage();
	};

	document.addEventListener('DOMContentLoaded', function() {
		renderPage();
	});
	// Also run immediately in case DOM is already ready
	if (document.readyState !== 'loading') {
		renderPage();
	}
})();
</script>
			</div>
		</div> <!-- /.row -->
	</div> <!-- /.Container -->
</section>

