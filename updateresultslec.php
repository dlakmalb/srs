<?php
require_once("dbconnection.php");
require_once("headerlec.php");
require_once("utility.php");
require_once("loginRequired.php");
lecturerLoginRequired();
?>
<?php
//---------- update grades
if(isset($_POST['updategrades']))
{
    $students = $_POST['student'];
    $grades = $_POST['grade'];
    $codes = $_POST['code'];
    $years = $_POST['year'];
    
    foreach ($students as $index => $student) {
        $grade = $grades[$index];
        $year = $years[$index];
        $code = $codes[$index];
        
        $target = $grade != "Pending" ? "'$grade'" : 'NULL';
        $sql = "UPDATE registrations SET grade =$target
                WHERE student_id='$student' AND course_code='$code' AND academic_year='$year' ";
        $result = mysqli_query($conn, $sql);
    }
    
    header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    exit();
}
/// --- end update



$lec_id = $_SESSION["LECTURER_ID"];

$condition = [];
$id = "";

if (isset($_GET["selectid"]) && strlen($_GET["selectid"]) > 0) {
    $id = $_GET["selectid"];
    $condition[] = " registrations.student_id = '$id'";
}
$where_clause = "";
if (count($condition) > 0) {
    $where_clause = "Where " . implode(" AND ", $condition);
}
?>
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body background="images/background.jpg"> 
        <div id="wrapper">
            <?php add_nav('profile') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Update Results
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
                                                    <label for="selectid" class="col-md-2 control-label">Student ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectid" name="selectid">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT DISTINCT student_id, name FROM `students`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['student_id'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['student_id'] . "'>" . $row['student_id'] . " - " . $row['name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method='post'>
                        <table id="table" class="table table-hover table-bordered">
                            <thead>	
                                <tr>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Course</th>
                                    <th class="text-center">Academic Year</th>
                                    <th class="text-center" >Results</th>
                                </tr>
                            </thead>
                            <?php
                            mysql_select_db('student_registration_db');

                            $sql = "SELECT
                                    lecturercourses.course_code,
                                    registrations.student_id,
                                    students.name,
                                    course_name,
                                    registrations.academic_year,
                                    grade
                                FROM registrations
                                LEFT JOIN courses ON registrations.course_code = courses.course_code
                                LEFT JOIN students ON registrations.student_id= students.student_id
                                LEFT JOIN lecturercourses ON registrations.course_code = lecturercourses.course_code
                                WHERE lecturer_id = '$lec_id'
                                $where_clause ORDER BY 'student_id'";

                            $result = $conn->query($sql);
                            ?>
                            <?php
                            $grades = array("Pending","A+","A","A-","B+","B","B-","C+","C","C-","D","Eligible");

                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                echo "<tr>";

                                echo "<td>" . $row['student_id'] . " - " . $row['name'] . "</td>";
                                echo "<td>" . $row['course_code'] . " - " . $row['course_name'] . "</td>";
                                echo "<td class = 'text-center'>" . $row['academic_year'] . "</td>";
                                echo "<td>";

                                $current_grade = $row['grade'];
                                if(is_null($current_grade))
                                {
                                    $current_grade="Pending";
                                }
                                echo ("<input type='hidden' name='student[]' value='{$row['student_id']}' />
                                        <input type='hidden' name='code[]' value='{$row['course_code']}' />
                                        <input type='hidden' name='year[]' value='{$row['academic_year']}' />");
                                ?>
                                <select class="grade" name='grade[]'>
                                    <?php
                                        foreach ($grades as $g) {
                                            $sel = $current_grade == $g ? "selected" : "";
                                            echo "<option $sel value='$g'>$g</option> \n";
                                        }
                                    ?>
                                </select>

                                <?php
                                echo "</td>";

                                echo "</tr>";
                            }
                            ?>
                            <tr> 
                                <td colspan="3" class="text-center">Update Results </td>
                                <td> <input class='btn btn-sm center-block btn-primary' name='updategrades' value='Update' type='submit' /> </td>
                            </tr>
                        </table>
                    </form>
                </div> 
            </div>
        </div>
        <script>

            $("#selectid").select2({placeholder: "Select Student ID", allowClear: true});
            $(".grade").select2({placeholder: "Select Grade", width: 110});

        </script>
    </body>
</html>
