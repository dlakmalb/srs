<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("utility.php");
require_once("loginRequired.php");
adminLoginRequired();

?>
<?php
$sql = "SELECT
	name, 
	student_id,
	field,
	email,
	telephone,
	address,
	gender,
	nic,
	birthday	
        FROM students
        WHERE student_id = '{$_GET['student_id']}'";

$result = $conn->query($sql);
$row = $result->fetch_array();

$name = $row['name'];
$id = $row['student_id'];
$field = $row['field'];
$email = $row['email'];
$telephone = $row['telephone'];
$address = $row['address'];
$gender = $row['gender'];
$nic = $row['nic'];
$birthday = $row['birthday'];
?>

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('students') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?php echo ($name) ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> More Information about <?php echo ($name) ?> </div>
                                <div class="panel-body">
                                    <div>
                                        <label class="control-label col-md-3">Student ID</label>
                                        <label class="control-label">: <?php echo ($id) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Specialization</label>
                                        <label class="control-label">: <?php echo ($field) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Email</label>
                                        <label class="control-label">: <?php echo ($email) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Telephone</label>
                                        <label class="control-label">: <?php echo ($telephone) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Address</label>
                                        <label class="control-label">: <?php echo ($address) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Gender</label>
                                        <label class="control-label">: <?php echo ($gender) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">National ID Card</label>
                                        <label class="control-label">: <?php echo ($nic) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Birthday</label>
                                        <label class="control-label">: <?php echo ($birthday) ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </body>
</html>