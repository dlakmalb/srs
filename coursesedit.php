<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// fill fields
$sql = "SELECT
        course_code,
        course_name,
        department,
        level,
        credits
        FROM courses 
        WHERE course_code = '{$_GET['course_code']}'";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$code = $row['course_code'];
$name = $row['course_name'];
$dept = $row['department'];
$level = $row['level'];
$credits = $row['credits'];

// get user inputs
if (isset($_POST['update'])):
    $code = ($_REQUEST['inputcoursecode']);
    $name = ($_POST['inputcoursename']);
    $department = ($_POST['inputdepartment']);
    $level = ($_POST['inputlevel']);
    $credits = ($_POST['inputcredits']);

    $sql = "UPDATE courses
            SET course_code = '$code',
                course_name = '$name',
                department = '$dept',
                level = '$level',
                credits = '$credits'
            WHERE course_code = '$code'";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: courses.php"); 
        exit;
    } else {
        header("Location: courses.php"); 
        exit;
    }
endif;
?>
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('courses') ?>
            <div id="page-wrapper">
                <div class="container-fluid"><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Edit Course
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            <form class="form-horizontal" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="inputcoursecode" class="col-lg-3 control-label">Course Code</label>
                                        <div class="col-lg-9">
                                            <input value= "<?php echo ($_GET["course_code"])?>" required='required' readonly="" class="form-control input-sm textBorder" id="inputcoursecode" name="inputcoursecode" placeholder="Course Code (Ex. ECX5245)" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputcoursename" class="col-lg-3 control-label">Course Name</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($name) ?>" required='required' class="form-control input-sm textBorder" id="inputcoursename" name="inputcoursename" placeholder="Course Name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputdepartment" class="col-lg-3 control-label">Department</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($dept) ?>" required='required' class="form-control input-sm textBorder" id="inputdepartment" name="inputdepartment" placeholder="Department" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputlevel" class="col-lg-3 control-label">Level</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($level) ?>" required='required' class="form-control input-sm textBorder" id="inputlevel" name="inputlevel" placeholder="Level" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputcredits" class="col-lg-3 control-label">Credits</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($credits) ?>" required='required' class="form-control input-sm textBorder" id="inputcredits" name="inputcredits" placeholder="Credits" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-5 col-lg-offset-4">
                                            <a href="courserequisites.php?course_code=<?php echo($code);?>" class="btn btn-primary btn-block">Manage Requisites</a>
                                        </div>
                                        <div class="col-lg-3 ">
                                            <button onclick="duplicate_id()" type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </body>
</html>
