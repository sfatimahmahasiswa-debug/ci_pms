<?php
foreach ($one_value as $one_info) {
    $record_id = $one_info->doctor_id;
    $doctor_code = $one_info->doctor_code;
    $doctor_name = $one_info->doctor_name;
    $doctor_category = $one_info->doctor_category;
    $schedule_day = $one_info->schedule_day;
    $schedule_time = $one_info->schedule_time;
}
?>
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Queue</a></li>
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
                        <h3 class="panel-title">Edit Doctor</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/edit_doctor/' . $record_id); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="doctor_code">Doctor Code</label>
                                    <input type="text" class="form-control" id="doctor_code" name="doctor_code" value="<?php echo $doctor_code; ?>" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="doctor_name">Doctor Name</label>
                                    <input type="text" class="form-control" id="doctor_name" name="doctor_name" value="<?php echo $doctor_name; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="doctor_category">Doctor Category</label>
                                    <input type="text" class="form-control" id="doctor_category" name="doctor_category" value="<?php echo $doctor_category; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="schedule_day">Schedule</label>
                                    <input type="text" class="form-control" id="schedule_day" name="schedule_day" value="<?php echo $schedule_day; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="schedule_time">Schedule Time</label>
                                    <input type="text" class="form-control" id="schedule_time" name="schedule_time" value="<?php echo $schedule_time; ?>">
                                </div>
                                <div class="col-sm-4" style="margin-top: 17px;">
                                    <button type="submit" class="pull-left btn btn-primary">Update</button>
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
