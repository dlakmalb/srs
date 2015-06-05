<?php
require_once("dbconnection.php");
require_once("headerlec.php");
require_once("loginRequired.php");
lecturerLoginRequired();
?>
<?php
$lec_id = $_SESSION["LECTURER_ID"];

// fill fields
$sql = "SELECT
        salutation,
        name,
        lecturer_id,
        gender,
        birthday,
        address,
        nic,
        telephone,
        department,
        email
        FROM lecturers
        WHERE lecturer_id = '$lec_id'";

$result = $conn->query($sql);
$row = $result->fetch_array();

$sal = $row['salutation'];
$name = $row['name'];
$id = $row['lecturer_id'];
$gender = $row['gender'];
$birthday = $row['birthday'];
$nic = $row['nic'];
$address = $row['address'];
$email = $row['email'];
$telephone = $row['telephone'];
$dept = $row['department'];
?>

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('profile') ?>

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
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Personal Information </div>
                                <div class="panel-body">
                                    <div>
                                        <label class="control-label h3"><?php echo ($name) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Lecturer ID</label>
                                        <label class="control-label">: <?php echo ($id) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Department</label>
                                        <label class="control-label">: <?php echo ($dept) ?></label>
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
                        <div class="col-md-12">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th class="text-center">Academic Year</th>
                                <th class="text-center">Courses</th>
                                <th class="text-center">Update Results</th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                lecturer_id,
                                lecturercourses.course_code,
                                course_name,
                                 lecturercourses.academic_year
                            FROM lecturercourses 
                            LEFT JOIN courses ON lecturercourses.course_code = courses.course_code
                            WHERE lecturer_id = '$lec_id'
                            ORDER BY academic_year";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                            echo "<tr>";
                            
                            echo "<td class='text-center'>" . $row['academic_year'] . "</td>";
                            echo "<td>" . $row['course_code'] . " - " . $row['course_name'] . "</td>";
                            echo "<td class='text-center'> <a href='updateresultslec.php?course_code=" . $row['course_code'] . "'>Update</a></td>";
                            echo "</tr>";
                        }
                        ?>

                    </table>
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