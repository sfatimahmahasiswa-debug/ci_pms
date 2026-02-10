<?php
// Optional: pesan notifikasi jika ingin, bisa tambahkan variabel $msg jika perlu
?>
<!-- /.Breadcrumb -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#"> Buat Opsi</a></li>
            <li class="active">Storage Obat</li>
        </ol>
    </div>
</section>

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
                    <a href="<?php echo base_url(); ?>ShowForm/create_medicine_name/main" class="list-group-item">
                        <span class="fa fa-pills" aria-hidden="true"></span> Nama Obat</a>
                    <a href="<?php echo base_url(); ?>storage" class="list-group-item active">
                        <span class="fa fa-pills" aria-hidden="true"></span> Storage Obat</a>
                    <a href="<?php echo base_url(); ?>ShowForm/create_supplier/main" class="list-group-item">
                        <span class="fa fa-truck-moving" aria-hidden="true"></span> Supplier</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Form Klasifikasi Penyimpanan Obat</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo site_url('storage/save'); ?>" method="post">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="medicine_name">Nama Obat:</label>
                                        <select name="medicine_name" id="medicine_name" class="form-control selectpicker" data-live-search="true" required>
                                            <option value="">-- Pilih --</option>
                                            <?php foreach ($all_medicine as $info) { ?>
                                                <option value="<?php echo $info->medicine_name; ?>"><?php echo $info->medicine_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Kategori Penyimpanan:</label>
                                        <select name="storage_category" class="form-control" required>
                                            <option value="Suhu Ruangan">Suhu Ruangan (15-25°C)</option>
                                            <option value="Lemari Pendingin">Lemari Pendingin (2-8°C)</option>
                                            <option value="Freezer">Freezer (<0°C)</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-sm-6">
                                        <label>Suhu Penyimpanan (°C):</label>
                                        <input type="text" class="form-control" name="storage_temperature" placeholder="Contoh: 2-8">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Keterangan Tambahan:</label>
                                        <textarea class="form-control" name="notes" placeholder="Misal: Hindari sinar matahari langsung"></textarea>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 17px;">
                                    <div class="col-sm-4">
                                        <button type="submit" class="pull-left btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0">
                        <h3 class="panel-title">Daftar Klasifikasi Penyimpanan Obat</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Nama Obat</th>
                                    <th style="text-align: center;">Kategori</th>
                                    <th style="text-align: center;">Suhu</th>
                                    <th style="text-align: center;">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; foreach($storage as $row): $count++; ?>
                                <tr>
                                    <td style="text-align: center;"><?= $count ?></td>
                                    <td><?= htmlspecialchars($row->medicine_name) ?></td>
                                    <td><?= htmlspecialchars($row->storage_category) ?></td>
                                    <td><?= htmlspecialchars($row->storage_temperature) ?></td>
                                    <td><?= htmlspecialchars($row->notes) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.Container -->
</section> 