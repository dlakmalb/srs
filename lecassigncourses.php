<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<?php
// get user inputs
if (isset($_POST['register'])):
    $course_code = ($_POST['selectcoursecode']);
    $year = ($_POST['selectyear']);
    $lec_id = ($_POST['selectlecid']);

    $sql = "INSERT INTO lecturercourses (lecturer_id, course_code, academic_year)
            VALUES('" . $lec_id . "', '" . $course_code . "', '" . $year . "')";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: lecassigncourses.php");
        exit;
    } else {
        echo '<script language = "javascript">';
        echo 'alert("Please Enter Valide Information")';
        echo '</script>';
    }
endif;

if (isset($_POST['delete'])):
    $course_code = ($_POST['course']);
    $year = ($_POST['year']);
    $lec_id = ($_POST['lecturer']);

    $sql = "DELETE from lecturercourses where lecturer_id='$lec_id'
            AND academic_year='$year' AND course_code='$course_code' ";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: lecassigncourses.php");
        exit;
    } else {
        echo '<script language = "javascript">';
        echo 'alert("Failed to delete")';
        echo '</script>';
    }
endif;
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
                                Assign Courses
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Assign Courses to Lecturers </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectcoursecode" class="col-md-2 control-label">Course</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectcoursecode" name="selectcoursecode">
                                                        <option> </option>
                                                        <?php
                                                        // load course codes and names to select box
                                                        $sql = "SELECT course_code, course_name FROM `courses`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['course_code'] . "'>" . $row['course_code'] . "-" . $row['course_name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectyear" class="col-md-2 control-label">Academic Year</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectyear" name="selectyear">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT academic_year FROM `academicyear`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['academic_year'] . "'>" . $row['academic_year'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectlecid" class="col-md-2 control-label">Lecturer</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecid" name="selectlecid">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT lecturer_id, name FROM `lecturers`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['lecturer_id'] . "'>" . $row['lecturer_id'] . " - " . $row['name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-2">
                                                    <button type="submit" name="register" class="btn btn-primary btn-block">Assign</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="lecassigncourses.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Course Code</th>
                                <th>Course Name</th>
                                <th>Academic Year</th>
                                <th>Lecture</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php
                        // add to table
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                    lecturercourses.course_code,
                                    lecturercourses.academic_year,
                                    lecturercourses.lecturer_id,
                                    courses.course_name,
                                    lecturers.name,
                                    lecturers.salutation

                                FROM lecturercourses
                                LEFT JOIN courses ON lecturercourses.course_code = courses.course_code
                                LEFT JOIN lecturers ON lecturercourses.lecturer_id = lecturers.lecturer_id";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['course_code'] . "</td>";
                            echo "<td>" . $row['course_name'] . "</td>";
                            echo "<td>" . $row['academic_year'] . "</td>";
                            echo "<td>" . $row['salutation'] . " " . $row['name'] . "</td>";   
                            ?> 
                            <td>
                                <form method="post"  onsubmit="return confirm('Are you sure you want to delete?');" >
                                    <input type="hidden" value="<?php echo $row['course_code']?>" name="course" />
                                    <input type="hidden" value="<?php echo $row['academic_year']?>" name="year" />
                                    <input type="hidden" value="<?php echo $row['lecturer_id']?>" name="lecturer" />
                                    <input type="submit" value='Delete' name="delete" class="btn btn-sm btn-link" />
                                </form>
                            </td>
                            <?php

                            echo "</tr>";
                        }
                        ?>

                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectcoursecode").select2({placeholder: "Select Course", allowClear: true});</script>
        <script>$("#selectyear").select2({placeholder: "Select Academic Year", allowClear: true});</script>
        <script>$("#selectlecid").select2({placeholder: "Select Lecturer", allowClear: true});</script>
    </body>
</html>
