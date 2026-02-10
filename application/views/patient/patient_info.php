<?php
if ($msg == "main") {
    $msg = "";
} elseif ($msg == "empty") {
    $msg = "Please fill out all required fields";
} elseif ($msg == "created") {
    if (!empty($created_id)) {
        $msg = "Created Successfully. ID: " . $created_id;
    } else {
        $msg = "Created Successfully";
    }
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
            <li><a href="#">Patient</a></li>
            <li class="active"><?php echo $msg; ?></li>
        </ol>
    </div>
</section>

<section id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item active main-color-bg">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Patient
                    </a>
                    <a href="<?php echo base_url(); ?>ShowForm/patient/main" class="list-group-item">
                        <span class="far fa-user" aria-hidden="true"></span> Add Patient
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Add Patient</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/create_patient'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="birth_place">Birth Place</label>
                                    <input type="text" class="form-control" id="birth_place" name="birth_place">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="birth_date">Birth Date</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date">
                                </div>
                                <div class="col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="blood_type">Blood Type</label>
                                    <input type="text" class="form-control" id="blood_type" name="blood_type">
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="allergies">Allergies</label>
                                    <input type="text" class="form-control" id="allergies" name="allergies">
                                </div>
                                <div class="col-sm-6">
                                    <label for="hereditary_diseases">Hereditary Diseases</label>
                                    <input type="text" class="form-control" id="hereditary_diseases" name="hereditary_diseases">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="blood_sugar">Blood Sugar</label>
                                    <input type="text" class="form-control" id="blood_sugar" name="blood_sugar">
                                </div>
                                <div class="col-sm-6">
                                    <label for="blood_pressure">Blood Pressure</label>
                                    <input type="text" class="form-control" id="blood_pressure" name="blood_pressure">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4" style="margin-top: 17px;">
                                    <button type="submit" class="pull-left btn btn-primary">Create</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0">
                        <h3 class="panel-title">Patient List</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Phone</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_value as $single_value) { ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $single_value->patient_id; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->full_name; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->phone; ?></td>
                                        <td style="text-align: center;">
                                            <a style="margin: 5px;" class="btn btn-danger" href="<?php echo base_url(); ?>Delete/patient/<?php echo $single_value->patient_id; ?>">Delete</a>
                                            <a style="margin: 5px;" class="btn btn-success" href="<?php echo base_url(); ?>ShowForm/edit_patient/<?php echo $single_value->patient_id; ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.Container -->
</section>