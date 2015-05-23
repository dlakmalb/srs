<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// get user inputs
if (isset($_POST['register'])):
    $code = ($_POST['selectcourse']);
    $prerequisite = ($_POST['selectprerequisites']);
    $corequisite = ($_POST['selectcorequisites']);

    $sql = "INSERT INTO courseprerequisites (course_code, prerequisite_course_code)
            VALUES('" . $code . "', '" . $prerequisite . "')";
    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        echo ($sql);
        $sql = "INSERT INTO coursecorequisites (course_code, corequisite_course_code)
            VALUES('" . $code . "', '" . $corequisite . "')";

        $result = $conn->query($sql);
        if ($result && $conn->affected_rows > 0) {
            header("Location: courserequisites.php");
            exit;
        } else {
            echo '<script language = "javascript">';
            echo 'alert("Course Already Exist")';
            echo '</script>';
        }
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
                <div class="container-fluid"><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Requisites Courses Registration
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-1">
                            <form class="form-horizontal" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectcourse" class="col-lg-4 control-label">Course Name</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control input-sm" id="selectcourse" name="selectcourse">
                                                <option> </option>
                                                <?php
                                                // load course codes and names to select box
                                                $sql = "SELECT course_code, course_name FROM `courses`";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                    echo "<option value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                                                }
                                                "</select>"
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectprerequisites" class="col-lg-4 control-label">Prerequisite Courses</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control input-sm" id="selectprerequisites" name="selectprerequisites">
                                                <option> </option>
                                                <?php
                                                // load course codes and names to select box
                                                $sql = "SELECT course_code, course_name FROM `courses`";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                    echo "<option value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                                                }
                                                "</select>"
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectcorequisites" class="col-lg-4 control-label">Corequisite Courses</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control input-sm" id="selectcorequisites" name="selectcorequisites">
                                                <option> </option>
                                                <?php
                                                // load course codes and names to select box
                                                $sql = "SELECT course_code, course_name FROM `courses`";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                    echo "<option value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                                                }
                                                "</select>"
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-6">
                                            <button onclick="duplicate_id()" type="submit" name= "register" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="courserequisites.php" type="reset" class="btn btn-default btn-block">Clear</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th>Course</th>
                                <th>Prerequisite Courses</th>
                                <th>Corequisite Courses</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT  courseprerequisites.course_code,
                                        prerequisite_course_code,
                                        corequisite_course_code 
                                FROM courseprerequisites
                                LEFT JOIN coursecorequisites ON courseprerequisites.course_code = coursecorequisites.course_code
                            ";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                            echo "<tr>";

                            echo "<td>" . $row['course_code'] . "</td>";
                            echo "<td>" . $row['prerequisite_course_code'] . "</td>";
                            echo "<td>" . $row['corequisite_course_code'] . "</td>";
                            echo "<td> <a href='coursesedit.php?course_code=" . $row['course_code'] . "'>edit</a></td>";
                            echo "<td> <a href='#' onClick='#'>delete</a></td>";

                            echo "</tr>";
                        }
                        ?>

                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectcourse").select2({placeholder: "Select Course", allowClear: true});</script>
        <script>$("#selectprerequisites").select2({placeholder: "Select Prerequisites Course", multiple: "multiple"});</script>
        <script>$("#selectcorequisites").select2({placeholder: "Select Corequisites Course", multiple: "multiple"});</script>
    </body>
</html>