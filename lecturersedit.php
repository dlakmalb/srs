<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// fill fields
$sql = "SELECT
        lecturer_id,
        salutation,
        name,
        birthday,
        nic,
        gender,
        address,
        telephone,
        email,
        department,
        password
        FROM lecturers 
        WHERE lecturer_id = '{$_GET['lecturer_id']}'";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$id = $row['lecturer_id'];
$salutation = $row['salutation'];
$name = $row['name'];
$birthday = $row['birthday'];
$nic = $row['nic'];
$gender = $row['gender'];
$address = $row['address'];
$telephone = $row['telephone'];
$email = $row['email'];
$dept = $row['department'];
$password = $row['password'];

// get user inputs
if (isset($_POST['update'])):
    $id = ($_POST['inputlecid']);
    $salutation = ($_POST['selectsalutation']);
    $name = ($_POST['inputlecname']);
    $address = ($_POST['inputaddress']);
    $Gender = ($_POST['radiogender']);
    $nic = ($_POST['inputnic']);
    $birthday = ($_POST['datetimepicker']);
    $telephone = ($_POST['inputtelephone']);
    $email = ($_POST['inputemail']);
    $dept = ($_POST['inputdept']);
    $Password = ($_POST['inputpassword']);

    $sql = "UPDATE lecturers
            SET lecturer_id = '$id',
                salutation = '$salutation',
                name = '$name',
                address = '$address',
                gender = '$gender',
                nic = '$nic',
                birthday = '$birthday',
                telephone = '$telephone',
                email = '$email',
                department = '$dept',
                password = '$password'
            WHERE lecturer_id = '$id'";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: lecturers.php");
        exit;
    } else {
        header("Location: lecturers.php");
        exit;
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
                                Edit Lecturer
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            <form class="form-horizontal" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="inputlecid" class="col-lg-3 control-label">Lecturer ID</label>
                                        <div class="col-lg-9">
                                            <input value= "<?php echo ($_GET["lecturer_id"]) ?>" required='required' readonly="" class="form-control input-sm textBorder" id="inputlecid" name="inputlecid" placeholder="Lecturer ID" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectsalutation" class="col-md-3 control-label">Salutation</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control input-sm textBorder" id="selectsalutation" name="selectsalutation">
                                                <option> </option>
                                                <?php
                                                $salutations = ["Mr.", "Ms."];
                                                foreach ($salutations as $sal) {
                                                    $sel = $sal == $salutation ? "selected" : "";
                                                    echo ("<option $sel>$sal</option>");
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputlecname" class="col-lg-3 control-label">Lecturer Name</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($name) ?>" required='required' class="form-control input-sm textBorder" id="inputlecname" name="inputlecname" placeholder="Lecturer Name" type="text">
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
                                            <label class="radio-inline"><input checked="" required='required' type="radio" name="radiogender" value="male">Male</label>
                                            <label class="radio-inline"><input required='required' type="radio" name="radiogender" value="female">Female</label>
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
                                        <label for="inputdept" class="col-lg-3 control-label">Department</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($dept) ?>" required='required' class="form-control input-sm textBorder" id="inputdept" name="inputdept" placeholder="Department" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpassword" class="col-lg-3 control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($password) ?>" required='required' class="form-control input-sm textBorder" id="inputpassword" name="inputpassword" placeholder="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpasswordconfirm" class="col-lg-3 control-label">Confirm</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($password) ?>" required='required' class="form-control input-sm textBorder" id="inputpasswordconfirm" name="inputpasswordconfirm" placeholder="Confirm Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-9">
                                            <button type="submit" name="update" class="btn btn-primary btn-block">Register</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <script>$("#selectsalutation").select2({placeholder: "Select Salutation", allowClear: true});</script>
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