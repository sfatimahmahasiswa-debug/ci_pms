<!-- /.container -->
<section id="main">
	<div class="container-fluid">

		<!-- Filter Panel -->
		<div class="row" id="rekap-filter-panel">
			<div class="col-md-12">
				<div class="panel panel-default" style="border-radius:10px;">
					<div class="panel-heading main-color-bg" style="border-radius:10px 10px 0 0;">
						<h3 class="panel-title" style="font-size:15px; font-weight:700;">
							<i class="fa fa-chart-bar"></i>&nbsp; Rekapan Obat
						</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label for="rekap_date_from">Tanggal Dari</label>
								<input type="date" class="form-control" id="rekap_date_from">
							</div>
							<div class="col-sm-3">
								<label for="rekap_date_to">Tanggal Sampai</label>
								<input type="date" class="form-control" id="rekap_date_to">
							</div>
							<div class="col-sm-3">
								<label for="rekap_type">Jenis Rekapan</label>
								<select class="form-control" id="rekap_type">
									<option value="obat_keluar">Obat Keluar (Penjualan)</option>
									<option value="pembelian">Pembelian Obat</option>
								</select>
							</div>
							<div class="col-sm-3">
								<label>&nbsp;</label>
								<button type="button" class="btn btn-primary btn-block" id="btn_rekap_search">
									<i class="fa fa-search"></i>&nbsp; Tampilkan Rekapan
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Result Area -->
		<div class="row">
			<div class="col-md-12">
				<div id="show_report"></div>
			</div>
		</div>

	</div>
</section>

<script type="text/javascript">
	$("#btn_rekap_search").click(function () {
		var btn = $(this);
		btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>&nbsp; Memuat...');

		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>Get_ajax_value/get_rekap_obat",
			data: {
				date_from:  $('#rekap_date_from').val(),
				date_to:    $('#rekap_date_to').val(),
				rekap_type: $('#rekap_type').val()
			},
			success: function (data) {
				$('#show_report').html(data);
				btn.prop('disabled', false).html('<i class="fa fa-search"></i>&nbsp; Tampilkan Rekapan');
			},
			error: function () {
				$('#show_report').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Terjadi kesalahan. Silakan coba lagi.</div>');
				btn.prop('disabled', false).html('<i class="fa fa-search"></i>&nbsp; Tampilkan Rekapan');
			}
		});
	});
</script>
