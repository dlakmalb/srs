<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// get user inputs
if (isset($_POST['register'])):
    $code = ($_POST['inputcoursecode']);
    $name = ($_POST['inputcoursename']);
    $department = ($_POST['inputdepartment']);
    $level = ($_POST['inputlevel']);
    $credits = ($_POST['inputcredits']);

    $sql = "INSERT INTO courses (course_code, course_name, credits, department, level)
            VALUES('" . $code . "', '" . $name . "',  '" . $credits . "', '" . $department . "', '" . $level . "')";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: courses.php");
        exit;
    } else {
        echo '<script language = "javascript">';
        echo 'alert("Course Already Exist")';
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
                <div class="container-fluid"><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Course Registration
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
                                            <input required='required' class="form-control input-sm textBorder" id="inputcoursecode" name="inputcoursecode" placeholder="Course Code (Ex. ECX5245)" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputcoursename" class="col-lg-3 control-label">Course Name</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputcoursename" name="inputcoursename" placeholder="Course Name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputdepartment" class="col-lg-3 control-label">Department</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputdepartment" name="inputdepartment" placeholder="Department" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputlevel" class="col-lg-3 control-label">Level</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputlevel" name="inputlevel" placeholder="Level" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputcredits" class="col-lg-3 control-label">Credits</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputcredits" name="inputcredits" placeholder="Credits" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-6">
                                            <button onclick="duplicate_id()" type="submit" name= "register" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="reset" class="btn btn-default btn-block">Clear</button>
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
