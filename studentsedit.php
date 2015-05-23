<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// fill fields
$sql = "SELECT
        student_id,
        name,
        address,
        gender,
        nic,
        birthday,
        telephone,
        email,
        field,
        password
        FROM students 
        WHERE student_id = '{$_GET['student_id']}'";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$id = $row['student_id'];
$name = $row['name'];
$address = $row['address'];
$gender = $row['gender'];
$nic = $row['nic'];
$birthday = $row['birthday'];
$telephone = $row['telephone'];
$email = $row['email'];
$field = $row['field'];
$password = $row['password'];

// get user inputs
if (isset($_POST['update'])):
    $id = ($_REQUEST['inputid']);
    $name = ($_POST['inputname']);
    $address = ($_POST['inputaddress']);
    $gender = ($_POST['radiogender']);
    $nic = ($_POST['inputnic']);
    $birthday = ($_POST['datetimepicker']);
    $telephone = ($_POST['inputtelephone']);
    $email = ($_POST['inputemail']);
    $field = ($_POST['inputfield']);
    // $passwordconfirm = ($_POST['inputpasswordconfirm']);
    $password_update="";
    if(isset($_POST['inputpassword']) && strlen($_POST['inputpassword']) >0 )
    {
        $password = ($_POST['inputpassword']);
        $password_hash= md5($password);
        $password_update=" , password='$password_hash' ";
    }
    
    

    $sql = "UPDATE students
            SET student_id = '$id',
                name = '$name',
                address = '$address',
                gender = '$gender',
                nic = '$nic',
                birthday = '$birthday',
                telephone = '$telephone',
                email = '$email',
                field = '$field' ".$password_update. "
            WHERE student_id = '$id'";
    
    $result = $conn->query($sql);
    if ($result) {
        header("Location: students.php");
        exit;
    } else {
        $error_message = $conn->error();
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
                                Edit Student
                            </h1>
                        </div>
                    </div>
                    
                    <!-- Error Message -->
                    <?php if(isset($error_message)): ?>
                    <div class="well">
                        <?php echo($error_message); ?>
                    </div>
                    <?php endif; ?>
                    
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            <form class="form-horizontal" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="inputid" class="col-lg-3 control-label">Student ID</label>
                                        <div class="col-lg-9">
                                            <input value= "<?php echo ($_GET["student_id"])?>" required='required' readonly="" class="form-control input-sm textBorder" id="inputid" name="inputid" placeholder="Student ID" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputname" class="col-lg-3 control-label">Student Name</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($name) ?>" required='required' class="form-control input-sm textBorder" id="inputname" name="inputname" placeholder="Student Name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputaddress" class="col-lg-3 control-label">Address</label>
                                        <div class="col-lg-9">
                                            <textarea required='required' class="form-control input-sm textBorder" style="resize: none" rows="5" id="inputaddress" name="inputaddress" placeholder="Address"><?php echo ($address) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="radiogender" class="col-lg-3 control-label">Gender</label>
                                        <div class="col-lg-9">
                                            <?php 
                                            if($gender =='male')
                                            {?>
                                            <label class="radio-inline"><input required='required' type="radio" name="radiogender" checked="checked" value="male">Male</label>
                                                <label class="radio-inline"><input required='required' type="radio" name="radiogender" value="female">Female</label>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <label class="radio-inline"><input required='required' type="radio" name="radiogender" value="male">Male</label>
                                                <label class="radio-inline"><input required='required' type="radio" name="radiogender" checked="checked" value="female">Female</label>
                                                <?php
                                            } 
                                            ?>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputnic" class="col-lg-3 control-label">NIC Number</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($nic) ?>" required='required' class="form-control input-sm textBorder" id="inputnic" name="inputnic" placeholder="NIC Number" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="datetimepicker" class="col-lg-3 control-label">Birth Day</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($birthday) ?>" required='required' class="form-control input-sm textBorder" id='datetimepicker' name='datetimepicker' placeholder="Birth Day" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtelephone" class="col-lg-3 control-label">Telephone</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($telephone) ?>" required='required' class="form-control input-sm textBorder" id="inputtelephone" name="inputtelephone" placeholder="Telephone" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputemail" class="col-lg-3 control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($email) ?>" required='required' class="form-control input-sm textBorder" id="inputemail" name="inputemail" placeholder="Email" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputfield" class="col-lg-3 control-label">Field</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo($field);?>" required='required' class="form-control input-sm textBorder" id="inputfield" name="inputfield" placeholder="Field of Study" type="text">
                                        </div>
                                    </div>
                                    Leave password fields empty if you do not want to change the password
                                    <div class="form-group">
                                        <label for="inputpassword" class="col-lg-3 control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input value = "" class="form-control input-sm textBorder" id="inputpassword" name="inputpassword" placeholder="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpasswordconfirm" class="col-lg-3 control-label">Confirm</label>
                                        <div class="col-lg-9">
                                            <input value = ""  class="form-control input-sm textBorder" id="inputpasswordconfirm" name="inputpasswordconfirm" placeholder="Confirm Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-9">
                                            <button type="submit" name= "update" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <script type="text/javascript">
            $(function ()
            {
                $('#datetimepicker').datetimepicker(
                        {
                            format: 'YYYY-MM-DD',
                        }
                );

            });
        </script>
    </body>
</html>
