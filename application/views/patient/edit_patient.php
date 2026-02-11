<?php
foreach ($one_value as $one_info) {
    $record_id = $one_info->patient_id;
    $full_name = $one_info->full_name;
    $birth_place = $one_info->birth_place;
    $birth_date = $one_info->birth_date;
    $gender = $one_info->gender;
    $blood_type = $one_info->blood_type;
    $phone = $one_info->phone;
    $allergies = $one_info->allergies;
    $hereditary_diseases = $one_info->hereditary_diseases;
    $blood_sugar = $one_info->blood_sugar;
    $blood_pressure = $one_info->blood_pressure;
}
?>
<section id="breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="#">Patient</a></li>
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
                        <h3 class="panel-title">Edit Patient</h3>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open_multipart('Insert/edit_patient/'.$record_id); ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="birth_place">Birth Place</label>
                                    <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?php echo $birth_place; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="birth_date">Birth Date</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" id="gender">
                                        <option value="Male" <?php echo ($gender=='Male')?'selected':''; ?>>Male</option>
                                        <option value="Female" <?php echo ($gender=='Female')?'selected':''; ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="blood_type">Blood Type</label>
                                    <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo $blood_type; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="allergies">Allergies</label>
                                    <input type="text" class="form-control" id="allergies" name="allergies" value="<?php echo $allergies; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="hereditary_diseases">Hereditary Diseases</label>
                                    <input type="text" class="form-control" id="hereditary_diseases" name="hereditary_diseases" value="<?php echo $hereditary_diseases; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="blood_sugar">Blood Sugar</label>
                                    <input type="text" class="form-control" id="blood_sugar" name="blood_sugar" value="<?php echo $blood_sugar; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label for="blood_pressure">Blood Pressure</label>
                                    <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" value="<?php echo $blood_pressure; ?>">
                                </div>
                            </div>
                            <div class="row">
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
<<<<<<< HEAD
</section>
=======
</section>
>>>>>>> e1efea390dc75040418f7ca7a7b9fda0a1abdbea
