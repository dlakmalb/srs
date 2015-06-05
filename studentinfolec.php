<?php
require_once("dbconnection.php");
require_once("headerlec.php");
require_once("utility.php");
require_once("loginRequired.php");
lecturerLoginRequired();
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
            <?php add_nav('stuinfolec') ?>

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
                    <table id="table" class="table table-hover table-bordered">
                        <thead>	
                            <tr>
                                <th class="text-center">Level</th>
                                <th class="text-center">Course</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Academic Year </th>
                                <th class="text-center">Credits</th>
                                <th class="text-center">Course Fee</th>
                                <th class="text-center">Results</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysql_select_db('student_registration_db');

                            $sql = "SELECT 
                                        courses.course_code,
                                        course_name,
                                        department,
                                        academic_year,
                                        grade,
                                        `level`,
                                        credits,
                                        SUBSTR(courses.course_code,3,1) as category
                                    FROM courses join registrations on courses.course_code=registrations.course_code
                                    WHERE student_id = '{$_GET['student_id']}'
                                    ORDER BY level";

                            $result = $conn->query($sql);
                            $categoryCredits=array("X" => 0, "Y" => 0, "Z" => 0, "J" => 0,
                                                    "M" => 0, "I" => 0, "E" => 0, "L" => 0, "K" => 0);
                            $totalGradePoints = 0.0;
                            $totalResultCredits = 0;
                            ?>
                            <?php
                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                
                                $categoryCredits[$row['category']] += $row['credits'];
                                $gp = getGradePoint($row["grade"]);
                                $level= $row['level'];
                                if($gp != 0 && ($level == 5 || $level ==6))
                                {
                                    $credits = $row['credits'];
                                    $totalGradePoints += ($gp * $credits);
                                    $totalResultCredits += $credits;
                                }
                                
                                echo "<tr>";

                                echo "<td class='text-center'>" . $row['level'] . "</td>";
                                echo "<td>" . $row['course_code'] . "-" . $row['course_name'] . "</td>";
                                echo "<td>" . $row['department'] . "</td>";
                                echo "<td class='text-center'>" . $row['academic_year'] . "</td>";
                                echo "<td class='text-center'>" . $row['credits'] . "</td>";
                                echo "<td class='text-center'>" . number_format(calc_course_fee($row['level'], $row['credits']), 2) . "</td>";
                                echo "<td class='text-center'>" . gradeText($row['grade']) . "</td>";
                                echo "</tr>";
                            }
                            $totalCredits = array_sum($categoryCredits);
                            $gpa = "-";
                            if($totalResultCredits > 0)
                            {
                                $gpa = number_format($totalGradePoints / $totalResultCredits,2) ;
                            }

                            
                            ?>
                        </tbody>
                    </table>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Credit Categories</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class=" control-label col-md-1">X</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["X"]); ?> </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">I</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["I"]); ?></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class=" control-label col-md-1">Y</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["Y"]); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">J</label>
                                            <label class=" control-label">:  <?php echo($categoryCredits["J"]); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">Total Credits</label>
                                            <label class=" control-label">: <?php echo($totalCredits); ?></label>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class=" control-label col-md-1">Z</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["Z"]); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">K</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["K"]); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">Current GPA</label>
                                            <label class=" control-label">: <?php echo($gpa); ?></label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class=" control-label col-md-1">E</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["E"] + $categoryCredits["L"]); ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class=" control-label">M</label>
                                            <label class=" control-label">: <?php echo($categoryCredits["M"] ); ?></label>
                                        </div>
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