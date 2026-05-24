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
<?php echo form_open_multipart('Insert/medicine_name', array('id' => 'medicine-name-form')); ?>
<div class="rounded-0 panel panel-default">
<div class="panel-heading rounded-0 main-color-bg" style="overflow: hidden;">
<h3 class="panel-title" style="display: inline-block; margin-top: 8px;">Create Nama Obat</h3>
<div class="pull-right">
<a href="javascript:history.back()" class="btn btn-default btn-sm" style="margin-right: 6px;">Back</a>
<button type="submit" class="btn btn-primary btn-sm">Save</button>
</div>
</div>

<div class="panel-body">
<div class="row">
<div class="col-sm-4">
<label for="generic_name">Kategori Obat <span style="color:#d9534f;">*</span></label>
<select name="generic_name" id="generic_name" class="form-control selectpicker" data-live-search="true" required>
<option value="">-- Pilih Kategori --</option>
<?php foreach ($all_generic as $info): ?>
<option value="<?php echo htmlspecialchars($info->generic_name); ?>"><?php echo htmlspecialchars($info->generic_name); ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="col-sm-4">
<label for="medicine_name">Nama Obat <span style="color:#d9534f;">*</span></label>
<input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Ketik nama obat" required>
</div>
<div class="col-sm-4">
<label for="kandungan_obat">Kandungan Obat <span style="color:#d9534f;">*</span></label>
<input type="text" class="form-control" id="kandungan_obat" name="kandungan_obat" placeholder="Ketik kandungan obat" required>
</div>
</div>
</div>
</div>
</form>

<div class="rounded-0 panel panel-default">
<div class="panel-heading rounded-0">
<h3 class="panel-title">Daftar Nama Obat</h3>
</div>
<div class="panel-body">
<div class="row" style="margin-bottom: 15px;">
<div class="col-sm-5">
<label for="filter_generic_name">Filter Kategori Obat <span style="color:#d9534f;">*</span></label>
<select id="filter_generic_name" class="form-control selectpicker" data-live-search="true">
<option value="">-- Pilih Kategori Dulu --</option>
<?php foreach ($all_generic as $info): ?>
<option value="<?php echo htmlspecialchars($info->generic_name); ?>"><?php echo htmlspecialchars($info->generic_name); ?></option>
<?php endforeach; ?>
</select>
</div>
</div>

<div class="alert alert-info" id="medicine-empty-notice" style="margin-bottom: 15px;">
Pilih kategori obat terlebih dahulu untuk menampilkan daftar nama obat.
</div>

<table class="table table-bordered table-hover" id="medicine-name-table">
<thead>
<tr>
<th style="text-align: center; width: 60px;">#</th>
<th style="text-align: center; width: 220px;">Kategori Obat</th>
<th style="text-align: center;">Nama Obat</th>
<th style="text-align: center;">Kandungan Obat</th>
<th style="text-align: center; width: 100px;">Aksi</th>
</tr>
</thead>
<tbody id="medicine-name-tbody">
<?php foreach ($all_value as $single_value): ?>
<?php $categoryKey = strtolower(trim((string) $single_value->generic_name)); ?>
<tr class="medicine-data-row" data-generic-name="<?php echo htmlspecialchars($categoryKey); ?>" style="display:none;">
<td class="row-number" style="text-align: center;"></td>
<td><?php echo htmlspecialchars((string) $single_value->generic_name); ?></td>
<td><?php echo htmlspecialchars((string) $single_value->medicine_name); ?></td>
<td><?php echo htmlspecialchars((string) ($single_value->medicine_presentation_name ? $single_value->medicine_presentation_name : '-')); ?></td>
<td style="text-align: center;">
<a style="margin: 5px;" class="btn btn-danger btn-sm rounded-0"
   href="<?php echo base_url(); ?>Delete/medicine_name/<?php echo $single_value->medicine_name_id; ?>">Hapus
</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<script>
(function () {
var filterSelect = document.getElementById('filter_generic_name');
var rows = document.querySelectorAll('#medicine-name-tbody .medicine-data-row');
var notice = document.getElementById('medicine-empty-notice');

function normalize(value) {
return (value || '').toString().trim().toLowerCase();
}

function renderRows() {
var selected = normalize(filterSelect.value);
var visibleCount = 0;

for (var i = 0; i < rows.length; i++) {
var row = rows[i];
var rowCategory = normalize(row.getAttribute('data-generic-name'));
var show = selected !== '' && rowCategory === selected;

row.style.display = show ? '' : 'none';
if (show) {
visibleCount++;
var noCell = row.querySelector('.row-number');
if (noCell) {
noCell.textContent = visibleCount;
}
}
}

if (selected === '') {
notice.style.display = '';
notice.className = 'alert alert-info';
notice.textContent = 'Pilih kategori obat terlebih dahulu untuk menampilkan daftar nama obat.';
} else if (visibleCount === 0) {
notice.style.display = '';
notice.className = 'alert alert-warning';
notice.textContent = 'Belum ada nama obat pada kategori yang dipilih.';
} else {
notice.style.display = 'none';
}
}

filterSelect.addEventListener('change', renderRows);
document.addEventListener('DOMContentLoaded', renderRows);
if (document.readyState !== 'loading') {
renderRows();
}
})();
</script>
</div>
</div> <!-- /.row -->
</div> <!-- /.Container -->
</section>
