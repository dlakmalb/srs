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

if($can_register)
{
    header("Location: coursesregstu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body background="images/background.jpg"> 
        <div id="wrapper">
            <?php add_nav('courseregistration') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                    Registration for Academic Years
                                  
                            </h1>
                        </div>
                    </div><br>
                    <div>
                        <div class="row">
                            <div class="col-md-9 col-md-offset-1">
                                <div class="panel panel-danger">
                                    <div class="panel-heading"> No Registerations Available </div>
                                    <div class="panel-body text-center">
                                        Sorry....! <br/><br/>
                                        Currently there are no available academic years for registration
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