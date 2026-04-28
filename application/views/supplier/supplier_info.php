<?php
if ($msg == "main") {
	$msg = "";
} elseif ($msg == "empty") {
	$msg = "Mohon isi semua kolom wajib";
} elseif ($msg == "created") {
	$msg = "Supplier berhasil ditambahkan";
} elseif ($msg == "edit") {
	$msg = "Supplier berhasil diubah";
} elseif ($msg == "delete") {
	$msg = "Supplier berhasil dihapus";
}
?>
<!-- /.Breadcrumb -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Supplier</a></li>
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
                    <a href="#" class="list-group-item active main-color-bg">
                        <span class="fa fa-truck" aria-hidden="true"></span> Informasi Supplier</a>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="list-group-item">
                        <span class="fa fa-plus-circle" aria-hidden="true"></span> Tambah Supplier</a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Add Supplier Form -->
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Tambah Supplier Baru</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/supplier'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="company_name">Nama Perusahaan <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nama supplier / perusahaan">
                                </div>
                                <div class="col-sm-6">
                                    <label for="mobile">No. Telepon</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Contoh: +62 21 1234567">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Alamat lengkap supplier"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <label for="previous_due">Hutang Awal (Rp)</label>
                                    <input type="number" class="form-control" id="previous_due" name="previous_due" value="0" min="0" step="0.01">
                                </div>
                                <div class="col-sm-3" style="margin-top:25px;">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.panel -->

                <!-- Supplier List -->
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0">
                        <h3 class="panel-title">Daftar Supplier</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">#</th>
                                    <th style="text-align:center;">Nama Supplier</th>
                                    <th style="text-align:center;">No. Telepon</th>
                                    <th style="text-align:center;">Alamat</th>
                                    <th style="text-align:center;">Hutang (Rp)</th>
                                    <th style="text-align:center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($all_value as $sv):
                                    $count++;
                                ?>
                                <tr>
                                    <td style="text-align:center;"><?php echo $count; ?></td>
                                    <td><?php echo htmlspecialchars($sv->supplier_name); ?></td>
                                    <td style="text-align:center;"><?php echo htmlspecialchars($sv->mobile); ?></td>
                                    <td><?php echo nl2br(htmlspecialchars($sv->address)); ?></td>
                                    <td style="text-align:center;">
                                        <?php echo number_format((float)$sv->previous_due, 0, ',', '.'); ?>
                                    </td>
                                    <td style="text-align:center;">
                                        <a style="margin:5px;" class="btn btn-success btn-xs"
                                           href="<?php echo base_url(); ?>ShowForm/edit_supplier/<?php echo $sv->supplier_id; ?>">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a style="margin:5px;" class="btn btn-danger btn-xs"
                                           href="<?php echo base_url(); ?>Delete/supplier/<?php echo $sv->supplier_id; ?>"
                                           onclick="return confirm('Hapus supplier ini?')">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.panel -->
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section>
