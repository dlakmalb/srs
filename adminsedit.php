<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?>
<?php
// fill fields
$sql = "SELECT
        admin_id,
        name,
        address,
        gender,
        email,
        telephone,
        password
        FROM admins
        WHERE admin_id = '{$_GET['admin_id']}'";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$id = $row['admin_id'];
$name = $row['name'];
$address = $row['address'];
$gender = $row['gender'];
$email = $row['email'];
$telephone = $row['telephone'];
$password = $row['password'];

// get user inputs
if (isset($_POST['update'])):
    $id = ($_POST['inputadminid']);
    $name = ($_POST['inputadminname']);
    $address = ($_POST['inputaddress']);
    $gender = ($_POST['radiogender']);
    $telephone = ($_POST['inputtelephone']);
    $email = ($_POST['inputemail']);
//    $password = ($_POST['inputpassword']);
    $password_update = "";
    if (isset($_POST['inputpassword']) && strlen($_POST['inputpassword']) > 0) {
        $password = ($_POST['inputpassword']);
        $password_hash = md5($password);
        $password_update = " , password='$password_hash' ";
    }

    $sql = "UPDATE admins
            SET admin_id = '$id',
                name = '$name',
                address = '$address',
                gender = '$gender',
                email = '$email',                
                telephone = '$telephone' ".$password_update. "
            WHERE admin_id = '$id'";

    $result = $conn->query($sql);
    if ($result) {
        header("Location: admins.php");
        exit;
    } else {
        $error_message = $conn->error();
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
                                Edit Administration
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
                            <form class="form-horizontal" action="" method="POST" onsubmit="return checkPassword()">
                                <fieldset>
                                    <div class="form-group">
                                        <label for="inputadminid" class="col-lg-3 control-label">ID</label>
                                        <div class="col-lg-9">
                                            <input value= "<?php echo ($_GET["admin_id"]) ?>" readonly="" required='required' class="form-control input-sm textBorder" id="inputadminid" name="inputadminid" placeholder="Administrator ID" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputadminname" class="col-lg-3 control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input value = "<?php echo ($name) ?>" required='required' class="form-control input-sm textBorder" id="inputadminname" name="inputadminname" placeholder="Administrator Name" type="text">
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
                                    <div>
                                        Leave password fields empty if you do not want to change the password
                                    </div><br>
                                    <div class="form-group">
                                        <label for="inputpassword" class="col-lg-3 control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input value = "" class="form-control input-sm textBorder" id="inputpassword" name="inputpassword" placeholder="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpasswordconfirm" class="col-lg-3 control-label">Confirm</label>
                                        <div class="col-lg-9">
                                            <input value = "" class="form-control input-sm textBorder" id="inputpasswordconfirm" name="inputpasswordconfirm" placeholder="Confirm Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-9">
                                            <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
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
