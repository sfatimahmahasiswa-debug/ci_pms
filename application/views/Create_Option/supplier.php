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
                        <span class="	fa fa-capsules" aria-hidden="true"></span> Presentase Obat</a>
                    <a href="<?php echo base_url(); ?>ShowForm/create_generic_name/main" class="list-group-item">
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
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.Container -->
</section>
