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

// Predefined therapeutic categories and their medicine names
$predefined_categories = array(
	'ANTIBIOTIK / ANTIINFEKSI' => array(
		'Lostacef', 'Dionicol', 'Nilocin', 'Zidalev', 'Infatrim', 'Yusimox',
		'Frazidol', 'Zultrop', 'Dionicol Syrup', 'Yusimox Syrup',
		'Bioplacenton', 'Erlamycetin (tetes telinga)', 'Erlamycetin Plus (tetes mata)',
		'Erlamycetin (salep mata)', 'Allertol',
	),
	'ANTIVIRUS' => array('Acyclovir', 'Acyclovir (salep)'),
	'ANTIFUNGI' => array('Ketoconazole', 'Ketoconazole (salep)'),
	'ANALGESIK / ANTIPIRETIK / ANTIINFLAMASI (NSAID)' => array(
		'Afeten', 'Aspilet', 'Etafemin', 'Farsifen', 'Farsifen Syrup',
		'Zelona', 'Faxiden', 'Faxiden gel', 'Novagesic',
	),
	'KORTIKOSTEROID / ANTIINFLAMASI STEROID' => array(
		'Danason', 'Eltazon', 'Ometilson', 'Dexamethasone', 'Synalten',
	),
	'ANTIHISTAMIN / ANTI ALERGI' => array(
		'Alerzin', 'Orphen', 'Loratadine', 'Chlorpheniramine maleate', 'Allertol',
	),
	'OBAT BATUK / FLU / SALURAN NAPAS' => array(
		'Calortusin', 'Hufaxol', 'Grantusif', 'Tera F', 'Flutop-C', 'Itrabatt', 'Zenirex',
	),
	'BRONKODILATOR / RESPIRASI' => array('Grafalin'),
	'KARDIOVASKULAR' => array('Farmoten', 'Fargoxin', 'ISDN', 'Zenicardo', 'Zevas 5', 'Selvim'),
	'SARAF / VERTIGO / VITAMIN NEUROTROPIK' => array('Histigo', 'Narmic', 'Beneuron'),
	'ANTIDIABETES' => array('Glikos', 'Renabetic'),
	'SALURAN CERNA (GASTROINTESTINAL)' => array(
		'Gasela', 'Bufantacid', 'Trianta', 'Laxana', 'Imamid', 'Kanina',
		'Omegesic', 'Omedom', 'Omedom Syrup', 'Norvom', 'Microlax', 'Kompolax',
	),
	'VITAMIN / SUPLEMEN / MINERAL' => array(
		'Caviplex', 'Omegavit', 'Calcifar', 'Lecozinc', 'Lecozinc Syrup',
		'Vitcur', 'Vit C', 'Vit K',
	),
	'HERBAL' => array('Kejibeling', 'Vitcur'),
	'MUSKULOSKELETAL / ASAM URAT' => array('Omeric'),
	'TOPIKAL (KULIT / SALEP / LUAR)' => array(
		'Bedak salicyl', 'Synalten', 'Ketoconazole (salep)', 'Bioplacenton',
	),
	'OBAT MATA & TELINGA' => array(
		'Erlamycetin (tetes telinga)', 'Erlamycetin Plus (tetes mata)',
		'Erlamycetin (salep mata)', 'Allertol',
	),
	'LAIN-LAIN / ALAT KESEHATAN / ANTISEPTIK' => array(
		'Test pack', 'GOM', 'Betadine', 'Sirplus',
	),
);

// Build lookup: lowercase medicine_name -> list of DB rows
$medicine_db_rows = array();
foreach ($all_value as $row) {
	$key = strtolower(trim($row->medicine_name));
	$medicine_db_rows[$key][] = $row;
}

// Build set of all predefined medicine names (lowercase) for uncategorized detection
$all_predefined_keys = array();
foreach ($predefined_categories as $meds) {
	foreach ($meds as $med) {
		$all_predefined_keys[strtolower(trim($med))] = true;
	}
}

// Medicines in DB not matching any predefined entry go to uncategorized
$uncategorized = array();
foreach ($all_value as $row) {
	if (!isset($all_predefined_keys[strtolower(trim($row->medicine_name))])) {
		$uncategorized[] = $row;
	}
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
						<span class="fa fa-capsules" aria-hidden="true"></span> Presentase Obat</a>
					<a href="<?php echo base_url(); ?>ShowForm/create_generic_name/main" class="list-group-item">
						<span class="fa fa-plus-circle" aria-hidden="true"></span> Kategori Obat </a>
					<a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="list-group-item active">
						<span class="fa fa-pills" aria-hidden="true"></span> Nama Obat</a>
					<a href="<?php echo base_url(); ?>storage" class="list-group-item">
						<span class="fa fa-pills" aria-hidden="true"></span> Storage Obat</a>
				</div>
			</div>
			<div class="col-md-9">
				<div class="rounded-0 panel panel-default">
					<div class="panel-heading rounded-0 main-color-bg">
						<h3 class="panel-title">Create Nama Obat</h3>
					</div>

					<div class="panel-body">
						<?php echo form_open_multipart('Insert/medicine_name'); ?>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-6">
									<label for="generic_name">Kategori Obat</label>
									<select name="generic_name" id="generic_name" class="form-control selectpicker"
											data-live-search="true">
										<option value="">-- Pilih Kategori --</option>
										<?php foreach (array_keys($predefined_categories) as $cat): ?>
											<option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-sm-6">
									<label for="medicine_name">Nama Obat</label>
									<select name="medicine_name" id="medicine_name" class="form-control selectpicker"
											data-live-search="true" disabled>
										<option value="">-- Pilih Kategori Dulu --</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4" style="margin-top: 17px;">
									<button type="submit" class="pull-left btn btn-primary">Buat</button>
								</div>
							</div>
						</div>
						</form>
					</div>
				</div><!-- /.rounded-0 panel End -->

				<!-- /.rounded-0 panel 2nd -->
				<div class="rounded-0 panel panel-default">
					<div class="panel-heading rounded-0">
						<h3 class="panel-title">Daftar Nama Obat</h3>
					</div>
					<div class="panel-body">
						<table class="table table-bordered table-hover" id="medicine-name-table">
							<thead>
							<tr>
								<th style="text-align: center; width: 50px;">#</th>
								<th style="text-align: center;">Nama Obat</th>
								<th style="text-align: center; width: 100px;">Aksi</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$count = 0;
							foreach ($predefined_categories as $cat => $meds):
								// Collect DB rows whose medicine_name is in this category's list
								$cat_rows = array();
								foreach ($meds as $med) {
									$key = strtolower(trim($med));
									if (isset($medicine_db_rows[$key])) {
										foreach ($medicine_db_rows[$key] as $db_row) {
											$cat_rows[] = $db_row;
										}
									}
								}
								// Skip categories that have no matching entries in the database
								if (empty($cat_rows)) continue;
							?>
							<tr>
								<td colspan="3" style="background-color:#dce8f5; font-weight:bold; padding:8px 12px; font-size:13px; letter-spacing:0.3px;">
									<?php echo htmlspecialchars($cat); ?>
								</td>
							</tr>
							<?php foreach ($cat_rows as $row): $count++; ?>
							<tr>
								<td style="text-align: center;"><?php echo $count; ?></td>
								<td><?php echo htmlspecialchars($row->medicine_name); ?></td>
								<td style="text-align: center;">
									<a style="margin: 5px;" class="btn btn-danger btn-sm rounded-0"
									   href="<?php echo base_url(); ?>Delete/medicine_name/<?php echo $row->medicine_name_id; ?>">Delete
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endforeach; ?>
							<?php if (!empty($uncategorized)): ?>
							<tr>
								<td colspan="3" style="background-color:#dce8f5; font-weight:bold; padding:8px 12px; font-size:13px;">
									TIDAK DIKATEGORIKAN
								</td>
							</tr>
							<?php foreach ($uncategorized as $row): $count++; ?>
							<tr>
								<td style="text-align: center;"><?php echo $count; ?></td>
								<td><?php echo htmlspecialchars($row->medicine_name); ?></td>
								<td style="text-align: center;">
									<a style="margin: 5px;" class="btn btn-danger btn-sm rounded-0"
									   href="<?php echo base_url(); ?>Delete/medicine_name/<?php echo $row->medicine_name_id; ?>">Delete
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

<script>
(function () {
	var medicinesByCategory = <?php echo json_encode($predefined_categories, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

	document.getElementById('generic_name').addEventListener('change', function () {
		var category = this.value;
		var $medicineSelect = $('#medicine_name');

		// Destroy selectpicker, rebuild options, re-init
		$medicineSelect.selectpicker('destroy');
		$medicineSelect.empty();

		if (!category || !medicinesByCategory[category] || medicinesByCategory[category].length === 0) {
			$medicineSelect.append('<option value="">-- Pilih Kategori Dulu --</option>');
			$medicineSelect.prop('disabled', true);
		} else {
			$medicineSelect.append('<option value="">-- Pilih Nama Obat --</option>');
			medicinesByCategory[category].forEach(function (med) {
				$medicineSelect.append(
					$('<option>').val(med).text(med)
				);
			});
			$medicineSelect.prop('disabled', false);
		}

		$medicineSelect.selectpicker({ liveSearch: true });
	});
})();
</script>
			</div>
		</div> <!-- /.row -->
	</div> <!-- /.Container -->
</section>

