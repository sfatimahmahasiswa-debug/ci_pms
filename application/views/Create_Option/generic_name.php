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
                    <a href="<?php echo base_url(); ?>ShowForm/create_medicine_presentation/main"
                        class="list-group-item">
                        <span class="	fa fa-capsules" aria-hidden="true"></span> Type Obat</a>
                    <a href="<?php echo base_url(); ?>ShowForm/create_generic_name/main" class="list-group-item active">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span> Kategori Obat </a>
                    <a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="list-group-item">
                        <span class="fa fa-pills" aria-hidden="true"></span> Nama Obat</a>
                    <a href="<?php echo base_url(); ?>storage" class="list-group-item">
						<span class="fa fa-pills" aria-hidden="true"></span> Storage Obat</a>
<!--                    <a href="--><?php //echo base_url(); ?><!--ShowForm/create_product_category/main" class="list-group-item">-->
<!--                        <span class="fa fa-tasks" aria-hidden="true"></span> Product Category</a>-->
<!--                    <a href="--><?php //echo base_url(); ?><!--ShowForm/create_product_name/main" class="list-group-item">-->
<!--                        <span class="fa fa-plus" aria-hidden="true"></span> Product Name</a>-->

                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Buat Kategori Obat</h3>
                    </div>

                    <div class="panel-body">
                        <!-- /.rounded-0 panel End -->
                        <div class="row">
                            <div class="col-md-3">
                                <?php echo form_open_multipart('Insert/generic_name'); ?>
                                <div class="box-body">
                                    <!--											  <p  style="font-size: 20px; color: #066;">--><?php //echo $msg; ?>
                                    <!--</p>-->
                                    <div class="form-group" style="width: 400px;">
                                        <label for="generic_name">Kategori Obat</label>
                                        <input type="text" class="form-control" id="generic_name" placeholder=""
                                            name="generic_name">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="pull-left btn btn-primary">Buat</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.rounded-0 panel End -->
                <!-- /.rounded-0 panel 2nd -->
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0">
                        <h3 class="panel-title">Kategori Obat List</h3>
                    </div>
                    <div class="panel-body">
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">No</th>
                                        <th style="text-align: center;">Kategori Obat</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <!-- /.Row from DB-->
                                <tbody id="generic-name-tbody">
                                    <?php
								$count = 0;
								foreach ($all_value as $single_value) {
									$count++;
									?>
                                    <tr class="generic-data-row">
                                        <td class="row-number" style="text-align: center;"><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($single_value->generic_name); ?></td>
                                        <td style="text-align: center;">
                                            <a style="margin: 5px;" class="btn btn-danger btn-sm rounded-0"
                                                href="<?php echo base_url(); ?>Delete/generic_name/<?php echo $single_value->generic_id; ?>">Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- Pagination Controls -->
                            <div style="display:flex; align-items:center; justify-content:center; gap:12px; margin-top:10px;">
                                <button id="generic-prev-btn" class="btn btn-default btn-sm" onclick="changeGenericPage(-1)">
                                    &#8592; Sebelumnya
                                </button>
                                <span id="generic-page-info" style="font-weight:bold;"></span>
                                <button id="generic-next-btn" class="btn btn-default btn-sm" onclick="changeGenericPage(1)">
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
        return document.querySelectorAll('#generic-name-tbody .generic-data-row');
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
                var numCell = row.querySelector('.row-number');
                if (numCell) numCell.textContent = i + 1;
            } else {
                row.style.display = 'none';
            }
        }

        document.getElementById('generic-page-info').textContent = 'Halaman ' + currentPage + ' dari ' + totalPages;
        document.getElementById('generic-prev-btn').disabled = (currentPage === 1);
        document.getElementById('generic-next-btn').disabled = (currentPage === totalPages);
    }

    window.changeGenericPage = function(dir) {
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
    if (document.readyState !== 'loading') {
        renderPage();
    }
})();
</script>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.Container -->
</section>
