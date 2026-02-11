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
            <li><a href="#">Queue</a></li>
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
                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Queue</a>
                    <a href="<?php echo base_url(); ?>ShowForm/doctor/main" class="list-group-item">
                        <span class="fa fa-user-md" aria-hidden="true"></span> Doctor</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="rounded-0 panel panel-default">
                    <div class="panel-heading rounded-0 main-color-bg">
                        <h3 class="panel-title">Add Doctor</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/create_doctor'); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="doctor_code">Doctor Code</label>
                                    <input type="text" class="form-control" id="doctor_code" name="doctor_code" value="<?php echo $doctor_code; ?>" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="doctor_name">Doctor Name</label>
                                    <input type="text" class="form-control" id="doctor_name" name="doctor_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="doctor_category">Doctor Category</label>
                                    <input type="text" class="form-control" id="doctor_category" name="doctor_category">
                                </div>
                                <div class="col-sm-6">
                                    <label for="schedule_day">Schedule</label>
                                    <input type="text" class="form-control" id="schedule_day" name="schedule_day">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="schedule_time">Schedule Time</label>
                                    <input type="text" class="form-control" id="schedule_time" name="schedule_time">
                                </div>
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
                        <h3 class="panel-title">Doctor List</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th style="text-align: center;">Code</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Category</th>
                                    <th style="text-align: center;">Schedule</th>
                                    <th style="text-align: center;">Time</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($all_value as $single_value) {
                                    $count++; ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $count; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->doctor_code; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->doctor_name; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->doctor_category; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->schedule_day; ?></td>
                                        <td style="text-align: center;"><?php echo $single_value->schedule_time; ?></td>
                                        <td style="text-align: center;">
                                            <a style="margin: 5px;" class="btn btn-danger" href="<?php echo base_url(); ?>Delete/doctor/<?php echo $single_value->doctor_id; ?>">Delete</a>
                                            <a style="margin: 5px;" class="btn btn-success" href="<?php echo base_url(); ?>ShowForm/edit_doctor/<?php echo $single_value->doctor_id; ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
