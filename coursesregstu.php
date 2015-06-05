<?php
require_once("dbconnection.php");
require_once("headerstu.php");
require_once("loginRequired.php");
studentLoginRequired();
require_once("utility.php");
?>
<?php
$student_id = $_SESSION['STUDENT_ID'];

// ----------- find current registration year
$sql = "select academic_year
from academicyear
where can_register = 'enable'
order by academic_year desc
limit 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQL_ASSOC);
$can_register = false;

if ($row) {
    $can_register = true;
    $registration_year = $row['academic_year'];
}

if(!$can_register)
{
    header("Location: coursesregstunotavailable.php");
    exit;
}

/// -------------- retrieving currently registered courses for this year
$sql = "SELECT 
        courses.course_code,
        course_name,
        department,
        `level`,
        credits,
        course_fee,
        SUBSTR(courses.course_code,3,1) as category
    FROM courses join registrations on registrations.course_code = courses.course_code
    where student_id ='{$_SESSION['STUDENT_ID']}' AND academic_year = '$registration_year' ";

$result = $conn->query($sql);

$registeredCourses = array();
$registered_course_ids = array();
$categoryCredits = array("X" => 0, "Y" => 0, "Z" => 0, "J" => 0,
    "M" => 0, "I" => 0, "E" => 0, "L" => 0, "K" => 0);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $registeredCourses[] = $row;
    $registered_course_ids[] = $row['course_code'];
    $categoryCredits[$row['category']] += $row['credits'];
}
$totalRegisteredCredits = array_sum($categoryCredits);


// Handle registeration and de registeration on post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course = $_POST['course'];
    $year = $_POST['year'];

    $date = date('Y-m-d');

    //get currently registered subjects
    $all_registered_courses = array();
    $sql = "select course_code from registrations 
                where student_id='$student_id'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $all_registered_courses[] = $row["course_code"];
    }

    if (isset($_POST['register'])) {
        //find prerequisites
        $sql = "select prerequisite_course_code from courseprerequisites
                where course_code='$course'";

        $result = mysqli_query($conn, $sql);
        $prerequisites = array();
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $prerequisites[] = $row["prerequisite_course_code"];
        }

        //find co-requisites
        $sql = "select corequisite_course_code from coursecorequisites
                where course_code='$course'";

        $result = mysqli_query($conn, $sql);
        $corequisites = array();
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $corequisites[] = $row["corequisite_course_code"];
        }

        //find credit cout of the course
        $sql = "select credits from courses where course_code='$course'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQL_ASSOC);
        $course_credit_count = $row["credits"];


        //---------- check if course registration is acceptable
        $has_error = false;
        //check if prerequisites are met
        if (!$has_error) {
            $previous_regs = array_diff($all_registered_courses, $registered_course_ids);
            $unmet_prereqs = array_diff($prerequisites, $previous_regs);
            if (count($unmet_prereqs) > 0) {
                $error_message = "Course pre-requisites are not met";
                $has_error = true;
            }
        }

        if ((!$has_error) && (!$can_register)) {
            $error_message = "Registrations are not allowed right now";
            $has_error = true;
        }

        if (!$has_error) {
            //check if co-requisites are met
            $unmet_coreqs = array_diff($corequisites, $all_registered_courses);
            if (count($unmet_coreqs) > 0) {
                $error_message = "Course co-requisites are not met";
                $has_error = true;
            }
        }

        if (!$has_error) {
            if ($course_credit_count + $totalRegisteredCredits > MAX_CREDITS_PER_YEAR) {
                $error_message = "Too many credits per year";
                $has_error = true;
            }
        }

        if (!$has_error) {
            $fee = $_POST['fee'];
            $sql = "insert into registrations(student_id,academic_year,course_code,date,course_fee)
                values('$student_id','$year','$course','$date',$fee)";
            $result = mysqli_query($conn, $sql);
        }
    } elseif (isset($_POST['deregister'])) {
        //find prerequisites
        $sql = "select course_code from coursecorequisites
                where corequisite_course_code='$course'";

        $result = mysqli_query($conn, $sql);
        $courses_requiring_course = array();
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $courses_requiring_course[] = $row["course_code"];
        }

        $unmet_coreqs = array_intersect($courses_requiring_course, $registered_course_ids);
        if (count($unmet_coreqs) > 0) {
            $error_message = "Cannot deregister the course. Other pending registrations require this course.";
        } else {
            $sql = "DELETE from registrations where student_id='$student_id' AND course_code ='$course' AND academic_year = '$year' ";
            $result = mysqli_query($conn, $sql);
        }
    }
}


// end handling register/deregister
?>

<?php
/// ----------  retrieving currently registered courses for this year - AGAIN - after update
$sql = "SELECT 
        courses.course_code,
        course_name,
        department,
        `level`,
        credits,
        course_fee,
        SUBSTR(courses.course_code,3,1) as category
    FROM courses join registrations on registrations.course_code = courses.course_code
    where student_id ='{$_SESSION['STUDENT_ID']}' AND academic_year = '$registration_year' ";

$result = $conn->query($sql);

$registeredCourses = array();
$categoryCredits = array("X" => 0, "Y" => 0, "Z" => 0, "J" => 0,
    "M" => 0, "I" => 0, "E" => 0, "L" => 0, "K" => 0);
while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $registeredCourses[] = $row;
    $categoryCredits[$row['category']] += $row['credits'];
}
$totalRegisteredCredits = array_sum($categoryCredits);

//----- building the search where clause from filter selection
$condition = [];
$code = $name = $dept = $credit = $level = "";

if (isset($_GET["selectcode"]) && strlen($_GET["selectcode"]) > 0) {
    $hasCode = true;
    $code = $_GET["selectcode"];
    $condition[] = " courses.course_code = '$code'";
}
//if (isset($_GET["selectname"]) && strlen($_GET["selectname"]) > 0) {
//    $hasName = true;
//    $name = $_GET["selectname"];
//    $condition[] = " courses.course_name = '$name'";
//}
if (isset($_GET["selectdept"]) && strlen($_GET["selectdept"]) > 0) {
    $hasDept = true;
    $dept = $_GET["selectdept"];
    $condition[] = " courses.department = '$dept'";
}
if (isset($_GET["selectcredit"]) && strlen($_GET["selectcredit"]) > 0) {
    $hasCredit = true;
    $credit = $_GET["selectcredit"];
    $condition[] = " courses.credits = '$credit'";
}
if (isset($_GET["selectlevel"]) && strlen($_GET["selectlevel"]) > 0) {
    $hasLevel = true;
    $level = $_GET["selectlevel"];
    $condition[] = " courses.level = '$level'";
}
$condition[] = " course_code not in
     (select course_code from registrations
       where student_id='$student_id' and academic_year='$registration_year') ";

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
            <?php add_nav('courseregistration') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?php if ($can_register == true) { ?>
                                    Registration for
                                    <?php
                                    echo ($registration_year);
                                } else {
                                    ?>
                                    <?php
                                    echo 'Cannot Allow to Register for this';
                                }
                                ?> Academic Year
                            </h1>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="panel panel-info">
                                    <div class="panel-heading"> Search Courses </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal" action="" method="GET">
                                            <fieldset>
                                                <div class="form-group">
                                                    <div>
                                                        <label for="selectcode" class="col-md-2 control-label">Course</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control input-sm" id="selectcode" name="selectcode">
                                                            <option> </option>
                                                            <?php
// load course codes and names to select box
                                                            $sql = "SELECT course_code, course_name FROM `courses`";
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
                                                        <label for="selectdept" class="col-md-2 control-label">Department</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control input-sm" id="selectdept" name="selectdept">
                                                            <option> </option>
                                                            <?php
// load course codes and names to select box
                                                            $sql = "SELECT DISTINCT department FROM `courses`";
                                                            $result = mysqli_query($conn, $sql);
                                                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                                $sel = $row['department'] == $dept ? "selected" : "";
                                                                echo "<option $sel value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                                                            }
                                                            "</select>"
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <label for="selectcredit" class="col-md-2 control-label">Credit</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control input-sm" id="selectcredit" value="<?php echo $credit; ?>" name="selectcredit">
                                                            <?php
                                                            $credits = [" ", "0", "3", "6", "9"];
                                                            foreach ($credits as $crdt) {
                                                                $sel = $crdt == $credit ? "selected" : "";
                                                                echo ("<option $sel>$crdt</option>");
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div>
                                                        <label for="selectlevel" class="col-md-2 control-label">Level</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control input-sm" id="selectlevel" name="selectlevel">
                                                            <option> </option>
                                                            <?php
// load course codes and names to select box
                                                            $sql = "SELECT DISTINCT level FROM `courses`";
                                                            $result = mysqli_query($conn, $sql);
                                                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                                $sel = $row['level'] == $level ? "selected" : "";
                                                                echo "<option $sel value='" . $row['level'] . "'>" . $row['level'] . "</option>";
                                                            }
                                                            "</select>"
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="col-md-3 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                    </div>   
                                                    <div class="col-md-3">
                                                        <a href="coursesregstu.php" type="reset" class="btn btn-default btn-block">Clear</a>

                                                    </div>
                                                </div>                                            
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="panel panel-info">
                                    <div class="panel-heading"> Credit Details </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <label class="col-md-12 col-md-offset-1">Maximum credit count per year is 45 credits</label>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">X</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["X"]); ?> </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">Y</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["Y"]); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">Z</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["Z"]); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">E</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["E"] + $categoryCredits["L"]); ?></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">I</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["I"]); ?></label>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">J</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["J"]); ?></label>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">K</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["K"]); ?></label>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label col-md-1">M</label>
                                                <label class=" control-label">: <?php echo($categoryCredits["M"]); ?></label>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-2">
                                                <label class=" control-label">Total</label>
                                                <label class=" control-label">: <?php echo($totalRegisteredCredits); ?></label>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($error_message)): ?>
                        <div class="well">
                            <span class="text-danger" > Error : 
                                <?php echo($error_message); ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <h2>Available Courses</h2>
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th class="text-center">Course</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Credits</th>
                                <th class="text-center">Course Fee</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Register</th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                courses.course_code,
                                course_name,
                                department,
                                `level`,
                                credits
                            FROM courses 
                            
                            $where_clause ORDER BY level";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                            echo "<tr>";

                            echo "<td>" . $row['course_code'] . " - " . $row['course_name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td class='text-center'>" . $row['level'] . "</td>";
                            echo "<td class='text-center'>" . $row['credits'] . "</td>";
                            echo "<td class='text-center'>" . number_format(calc_course_fee($row['level'], $row['credits']), 2) . "</td>";
                            echo "<td class='text-center'> <a href='requisitecoursesstu.php?course_code=" . $row['course_code'] . "'>More Info</a></td>";
                            ?>
                            <td> 
                                <form  method="POST">
                                    <input type="hidden" name="course" value="<?php echo($row['course_code']); ?>" />
                                    <input type="hidden" name="year" value="<?php echo($registration_year ); ?>" />
                                    <input type="hidden" name="fee" value="<?php echo(calc_course_fee($row['level'], $row['credits']) ); ?>" />
                                    <input class='btn btn-sm btn-success center-block' name="register" type="submit" value="Register" />
                                </form>
                            </td>
                            <?php
                            echo "</tr>";
                        }
                        ?>

                    </table>
                    <h2>Registered Courses</h2>
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th class="text-center">Course</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Credits</th>
                                <th class="text-center">Course Fee</th>
                                <th class="text-center">Deregister</th>
                            </tr>
                        </thead>
                        <?php ?>
                        <?php
                        foreach ($registeredCourses as $row) {
                            echo "<tr>";

                            echo "<td>" . $row['course_code'] . " - " . $row['course_name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td class='text-center'>" . $row['level'] . "</td>";
                            echo "<td class='text-center'>" . $row['credits'] . "</td>";
                            echo "<td class='text-center'>" . number_format($row['course_fee'], 2) . "</td>";
                            ?>
                            <td>
                                <form  method="POST">
                                    <input type="hidden" name="course" value="<?php echo($row['course_code']); ?>" />
                                    <input type="hidden" name="year" value="<?php echo($registration_year ); ?>" />
                                    <input class='btn btn-sm btn-warning center-block' name="deregister" type="submit" value="Deregister" />
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
        <script>$("#selectcode").select2({placeholder: "Select Course", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectcredit").select2({placeholder: "Select Credit", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>