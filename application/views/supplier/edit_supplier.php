<?php
foreach ($one_value as $one_info) {
    $supplier_id   = $one_info->supplier_id;
    $supplier_name = $one_info->supplier_name;
    $mobile        = $one_info->mobile;
    $address       = $one_info->address;
    $previous_due  = $one_info->previous_due;
}
?>
<!-- /.Breadcrumb -->
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>ShowForm/supplier_info/main">Informasi Supplier</a></li>
            <li class="active">Edit Supplier</li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="list-group-item active main-color-bg">
                        <span class="fa fa-truck" aria-hidden="true"></span> Informasi Supplier</a>
                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="list-group-item">
                        <span class="fa fa-list" aria-hidden="true"></span> Daftar Supplier</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Edit Supplier</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/edit_supplier_info/' . $supplier_id); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="company_name">Nama Perusahaan <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                           value="<?php echo htmlspecialchars($supplier_name); ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="mobile">No. Telepon</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                           value="<?php echo htmlspecialchars($mobile); ?>">
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-sm-6">
                                    <label for="address">Alamat</label>
                                    <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($address); ?></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <label for="previous_due">Hutang Awal (Rp)</label>
                                    <input type="number" class="form-control" id="previous_due" name="previous_due"
                                           value="<?php echo $previous_due; ?>" min="0" step="0.01">
                                </div>
                            </div>
                            <div class="row" style="margin-top:15px;">
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                </div>
                                <div class="col-sm-3">
                                    <a href="<?php echo base_url(); ?>ShowForm/supplier_info/main" class="btn btn-default btn-block">
                                        <i class="fa fa-arrow-left"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
