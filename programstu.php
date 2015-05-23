<?php
require_once("dbconnection.php");
require_once("headerstu.php");
require_once("utility.php");
require_once("loginRequired.php");
studentLoginRequired();
?>
<?php
$condition = [];
$code = $academic_year = $name = $dept = $creditcategory = $level = "";
$condition[] = " student_id = '{$_SESSION['STUDENT_ID']}' ";

if (isset($_GET["selectdept"]) && strlen($_GET["selectdept"]) > 0) {
    $dept = $_GET["selectdept"];
    $condition[] = " courses.department = '$dept'";
}
if (isset($_GET["selectcreditcategory"]) && strlen($_GET["selectcreditcategory"]) > 0) {
    $creditcategory = $_GET["selectcreditcategory"];
    $condition[] = " SUBSTR(courses.course_code,3,1) = '$creditcategory'";
}
if (isset($_GET["selectlevel"]) && strlen($_GET["selectlevel"]) > 0) {
    $level = $_GET["selectlevel"];
    $condition[] = " courses.level = '$level'";
}
if (isset($_GET["selectacademicyear"]) && strlen($_GET["selectacademicyear"]) > 0) {
    $academic_year = $_GET["selectacademicyear"];
    $condition[] = " registrations.academic_year = '$academic_year'";
}

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
            <?php add_nav() ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                My Programme
                            </h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Overall Results </div>
                                <div class="panel-body">
                           <?php
                            $sql = "SELECT      grade, credits
                                    FROM courses join registrations on courses.course_code=registrations.course_code ";

                            $result = $conn->query($sql);
                            $totalGradePoints = 0.0;
                            $total5_6Credits = 0;
                            $totalCredits = 0;
                            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                $gp = getGradePoint($row["grade"]);
                                if($gp!= 0)
                                {
                                    $totalCredits += $row['credits'];
                                    if($level == 5 || $level ==6 )
                                    {
                                        $credits = $row['credits'];
                                        $totalGradePoints += ($gp * $credits);
                                        $total5_6Credits += $credits;
                                    }
                                }
                            }
                            $gpa = 0.0;
                            if($total5_6Credits > 0)
                            {
                                $gpa = $totalGradePoints / $total5_6Credits ;
                            }
                            echo($total5_6Credits." ".$totalCredits." ".$gpa);
                            ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Programmes </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectacademicyear" class="col-md-2 control-label">Academic Year</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectacademicyear" name="selectacademicyear">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT distinct academic_year FROM `registrations`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['academic_year'] == $academic_year ? "selected" : "";
                                                            echo "<option $sel value='" . $row['academic_year'] . "'>" . $row['academic_year'] . "</option>";
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
                                                <div class="col-md-4">
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
                                                    <label for="selectcreditcategory" class="col-md-2 control-label">Credit Category</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectcreditcategory" value="<?php echo $credit; ?>" name="selectcreditcategory">
                                                        <?php
                                                        $credits = [" ", "X", "Y", "Z", "J", "M", "I", "E", "K"];
                                                        foreach ($credits as $crdt) {
                                                            $sel = $crdt == $creditcategory ? "selected" : "";
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
                                                <div class="col-md-4">
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
                                                <div class="col-md-2 col-md-offset-2">
                                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="programstu.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Level</th>
                                <th>Course</th>
                                <!--<th>Course Name</th>-->
                                <th>Department</th>
                                <th>Academic Year </th>
                                <th>Credits</th>
                                <th>Course Fee</th>
                                <th>Results</th>
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
                            $where_clause  ORDER BY 'level'";

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

                                echo "<td>" . $row['level'] . "</td>";
                                echo "<td>" . $row['course_code'] . "-" . $row['course_name'] . "</td>";
                                // echo "<td>" . $row['course_name'] . "</td>";
                                echo "<td>" . $row['department'] . "</td>";
                                echo "<td>" . $row['academic_year'] . "</td>";
                                echo "<td>" . $row['credits'] . "</td>";
                                echo "<td>" . number_format(calc_course_fee($row['level'], $row['credits']), 2) . "</td>";
                                echo "<td>" . $row['grade'] . "</td>";
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
        <script>$("#selectacademicyear").select2({placeholder: "Select Academic Year", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectcreditcategory").select2({placeholder: "Select Credit", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>