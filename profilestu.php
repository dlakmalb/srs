<?php
require_once("dbconnection.php");
require_once("headerstu.php");
require_once("loginRequired.php");
studentLoginRequired();
?>
<?php
$stud_id = $_SESSION["STUDENT_ID"];

// fill fields
$sql = "SELECT
        name,
        student_id,
        gender,
        birthday,
        address,
        nic,
        telephone,
        field,
        email
        FROM students
        WHERE student_id = $stud_id";

$result = $conn->query($sql);
$row = $result->fetch_array();

$name = $row['name'];
$id = $row['student_id'];
$gender = $row['gender'];
$birthday = $row['birthday'];
$nic = $row['nic'];

$address = $row['address'];
$email = $row['email'];
$telephone = $row['telephone'];
$field = $row['field'];
?>

<!DOCTYPE html>
<html>
<?php add_head() ?>
    <body> 
        <div id="wrapper">
<?php add_nav() ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                My Profile
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Personal Information </div>
                                <div class="panel-body">
                                    <div>
                                        <label class="control-label h3"><?php echo ($name); ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Student ID</label>
                                        <label class="control-label">: <?php echo ($id) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Specialization</label>
                                        <label class="control-label">: <?php echo ($field) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Gender</label>
                                        <label class="control-label">: <?php echo ($gender) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Date of Birth</label>
                                        <label class="control-label">: <?php echo ($birthday) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">NIC</label>
                                        <label class="control-label">: <?php echo ($nic) ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Contact Information </div>
                                <div class="panel-body">
                                    <div>
                                        <label class="control-label col-md-3">Address</label>
                                        <label class="control-label">: <?php echo ($address) ?></label>
                                    </div> 
                                    <div>
                                        <label class="control-label col-md-3">Telephone</label>
                                        <label class="control-label">: <?php echo ($telephone) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Email</label>
                                        <label class="control-label">: <?php echo ($email) ?></label>
                                    </div> 
                                    <!--
                                    <p>
                                        Address : Kandetiya Road,Makandura,Gonawila<br><br>
                                        Telephone : 0718381712<br><br>
                                        Email : dlakmalb@gmail.com
                                    </p>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
            </div>
        </div>
        <script>$("#selectcode").select2({placeholder: "Select Course Code", allowClear: true});</script>
        <script>$("#selectname").select2({placeholder: "Select Course Name", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectcredit").select2({placeholder: "Select Credit", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>