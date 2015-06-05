<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("utility.php");
require_once("loginRequired.php");
adminLoginRequired();
?>
<?php
$sql = "SELECT
        courses.course_code,
        corequisite_course_code,
        prerequisite_course_code,
        course_name,
        department,
        level,
        credits,
        SUBSTR(courses.course_code,3,1) as category
        FROM courses
        LEFT JOIN coursecorequisites ON courses.course_code = coursecorequisites.course_code
        LEFT JOIN courseprerequisites ON courses.course_code = courseprerequisites.course_code
        WHERE courses.course_code = '{$_GET['course_code']}'
        ORDER BY level";

$result = $conn->query($sql);
$row = $result->fetch_array();

$code = $row['course_code'];
$name = $row['course_name'];
$dept = $row['department'];
$level = $row['level'];
$credits = $row['credits'];
$category = $row['category'];
?>

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('courses') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                <?php echo ($_GET['course_code']) ?> - <?php echo ($name) ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> More Information about <?php echo ($name) ?> </div>
                                <div class="panel-body">
                                    <div>
                                        <label class="control-label col-md-3">Department</label>
                                        <label class="control-label">: <?php echo ($dept) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Level</label>
                                        <label class="control-label">: <?php echo ($level) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Credits</label>
                                        <label class="control-label">: <?php echo ($credits) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Course Fee</label>
                                        <label class="control-label">: LKR <?php echo number_format(calc_course_fee($row['level'], $row['credits']), 2) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Course Category</label>
                                        <label class="control-label">: <?php echo ($category) ?></label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Prerequisite Courses</label>
                                        <label class="control-label">: 
                                            <?php
                                            $sql = "SELECT
                                                    prerequisite_course_code
                                                    FROM courses
                                                    JOIN courseprerequisites ON courses.course_code = courseprerequisites.course_code
                                                    WHERE courses.course_code = '{$_GET['course_code']}'
                                                    ORDER BY level";

                                            $result = $conn->query($sql);
                                            $prereqcourse = array();
                                            while ($row = $result->fetch_array()) {
                                                $prereqcourse[] = $row['prerequisite_course_code'];
                                            }
                                            if(count($prereqcourse) >0)
                                            {
                                                 echo implode(", ", $prereqcourse);
                                            }
                                            else
                                            {
                                                echo ("  -");
                                            }
                                            ?>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="control-label col-md-3">Corequisite Courses</label>
                                        <label class="control-label">: 
                                            <?php
                                            
                            $sql = "SELECT
                                    corequisite_course_code
                                    FROM courses
                                    JOIN coursecorequisites ON courses.course_code = coursecorequisites.course_code
                                    WHERE courses.course_code = '{$_GET['course_code']}'
                                    ORDER BY level";

                                            $result = $conn->query($sql);
                                            $coreqcourse = array();
                                            while ($row = $result->fetch_array()) {
                                                $coreqcourse[] = $row['corequisite_course_code'];
                                            }
                                            if(count($coreqcourse) >0)
                                            {
                                                 echo implode(", ", $coreqcourse);
                                            }
                                            else
                                            {
                                                echo ("  -");
                                            }
                                            ?>

                                        </label>
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