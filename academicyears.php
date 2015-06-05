<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<?php
// get user inputs
if (isset($_POST['register'])):
    $year = ($_POST['inputacademicyear']);
    $status = ($_POST['radiostatus']);

    $sql = "INSERT INTO academicyear (academic_year, can_register)
            VALUES('" . $year . "', '" . $status . "')";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: academicyears.php");
        exit;
    } else {
        $showError = true;
       
    }
endif;

// enable/disable
if (isset($_POST['enable']) || isset($_POST['disable']) ):
    $year = ($_POST['year']);
    $target= "disable";
    if(isset($_POST['enable']))
    {
        $target="enable";
    }

    $sql = "UPDATE academicyear SET can_register = '{$target}'
            WHERE academic_year='{$year}' ";

    $result = $conn->query($sql);
    header("Location: academicyears.php");
    exit();
endif;

// add to table
mysql_select_db('student_registration_db');

$sql = "SELECT 
            academic_year,
            can_register            
        FROM academicyear";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <?php
        if(isset($showError) && $showError == true):
            echo '<script language = "javascript">';
            echo 'alert("Academic Year Already Exist")';
            echo '</script>';
        endif;
        ?>
        <div id="wrapper">
            <?php add_nav('academic years') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Academic Years Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Academic Years Registration</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="POST">
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="inputacademicyear" class="col-lg-2 control-label">Academic Year</label>
                                                <div class="col-md-4">
                                                    <input required='required' class="form-control input-sm textBorder" id="inputacademicyear" name="inputacademicyear" placeholder="Academic Year" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="radiostatus" class="col-lg-2 control-label">Status</label>
                                                <div class="col-lg-4">
                                                    <label class="radio-inline"><input required='required' type="radio" name="radiostatus" value="enable">Enable</label>
                                                    <label class="radio-inline"><input required='required' type="radio" name="radiostatus" value="disable">Disable</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-2">
                                                    <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="academicyears.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th class="text-center">Academic Year</th>                                
                                <th class="text-center">Status</th>                                
                                <th colspan=2 class="text-center">Change Status</th>
                            </tr>
                        </thead>

                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td class='text-center'>" . $row['academic_year'] . "</td>";
                            echo "<td class='text-center'>" . $row['can_register'] . "</td>";

                            if ($row["can_register"] != "enable") {
                                ?>
                                <td class='text-center'>
                                    <form method="post" >
                                        <input type="hidden" name="year" value="<?php echo $row['academic_year']; ?>" />
                                        <input type="submit" name="enable" value="Enable" class="btn btn-sm btn-link" />
                                    </form>
                                </td>
                                <td> </td>
                                <?php
                            } else {
                                ?>
                                <td> </td>
                                <td class='text-center'>
                                    <form method="post" >
                                        <input type="hidden"  name="year"  value="<?php echo $row['academic_year']; ?>" />
                                        <input type="submit" name="disable" value="Disable" class="btn btn-sm btn-link" />
                                    </form>
                                </td>
                            <?php
                            }
                            echo "</tr>";
                        }
                        ?>                        
                    </table>
                </div> 
            </div>
        </div>
        
    </body>
</html>
