<?php
require_once("dbconnection.php");
require_once("headerlec.php");
require_once("utility.php");
require_once("loginRequired.php");
lecturerLoginRequired();
?>
<?php
$lec_id = $_SESSION["LECTURER_ID"];
$condition = [];
$code = $name = $id = "";

if (isset($_GET["selectcode"]) && strlen($_GET["selectcode"]) > 0) {
    $code = $_GET["selectcode"];
    $condition[] = " registrations.course_code = '$code'";
}
if (isset($_GET["selectid"]) && strlen($_GET["selectid"]) > 0) {
    $id = $_GET["selectid"];
    $condition[] = " registrations.student_id = '$id'";
}
$condition[] = "lecturercourses.lecturer_id='$lec_id'";
$where_clause = "";
if (count($condition) > 0) {
    $where_clause = "Where " . implode(" AND ", $condition);
}
?>

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('resultsinfolec') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Results Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Students</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectcode" class="col-md-2 control-label">Course</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-control input-sm" id="selectcode" name="selectcode">
                                                        <option> </option>
                                                        <?php
                                                        // load course codes and names to select box
                                                        $sql = "SELECT  lecturercourses.course_code, course_name
                                                                FROM lecturercourses JOIN courses ON lecturercourses.course_code = courses.course_code
                                                                WHERE lecturercourses.lecturer_id='$lec_id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['course_code'] == $code ? "selected" : "";
                                                            echo "<option $sel value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectid" class="col-md-2 control-label">Student ID</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class="form-control input-sm" id="selectid" name="selectid">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT registrations.student_id FROM
                                                                lecturercourses JOIN courses ON lecturercourses.course_code = courses.course_code
                                                                JOIN registrations ON registrations.course_code = lecturercourses.course_code AND registrations.academic_year = lecturercourses.academic_year
                                                                JOIN students ON students.student_id = registrations.student_id
                                                                WHERE lecturercourses.lecturer_id='$lec_id'";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['student_id'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['student_id'] . "'>" . $row['student_id'] . "</option>";
                                                        }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="resultsinfolec.php" type="reset" class="btn btn-default btn-block">Clear</a>

                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Student Name</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Academic Year</th>
                                <th class="text-center">Results</th>
                            </tr>
                        </thead>
                        <?php
                    //    mysql_select_db('student_registration_db');

                        $sql = "SELECT
                                registrations.student_id,
                                students.name,
                                courses.course_code,
                                courses.course_name,
                                registrations.academic_year,
                                registrations.grade

                                FROM 
                                lecturercourses JOIN courses ON lecturercourses.course_code = courses.course_code
                                JOIN registrations ON registrations.course_code = lecturercourses.course_code AND registrations.academic_year = lecturercourses.academic_year
                                JOIN students ON students.student_id = registrations.student_id
                                 $where_clause ORDER BY 'students.student_id'";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                            echo "<tr>";

                            echo "<td class = 'text-center'>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['course_code'] . " - ". $row['course_name'] . "</td>";
                            echo "<td class = 'text-center'>" . $row['academic_year'] . "</td>";
                            echo "<td class = 'text-center'>" . gradeText($row['grade']) . "</td>";

                            echo "</tr>";
                        }
                        ?>

                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectcode").select2({placeholder: "Select Course", allowClear: true});</script>
        <script>$("#selectid").select2({placeholder: "Select Student ID", allowClear: true});</script>
    </body>
</html>
