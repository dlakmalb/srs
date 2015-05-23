<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// get user inputs
if (isset($_POST['register'])):
    $id = ($_POST['inputlecid']);
    $salutation = ($_POST['selectsalutation']);
    $name = ($_POST['inputlecname']);
    $address = ($_POST['inputaddress']);
    $Gender = ($_POST['radiogender']);
    $nic = ($_POST['inputnic']);
    $birthday = ($_POST['datetimepicker']);
    $Telephone = ($_POST['inputtelephone']);
    $email = ($_POST['inputemail']);
    $dept = ($_POST['inputdept']);
    $Password = ($_POST['inputpassword']);

    $sql = "INSERT INTO lecturers (lecturer_id, salutation, name, birthday, nic, gender, address, telephone, email, department, password)
            VALUES('" . $id . "', '" . $salutation . "', '" . $name . "', '" . $birthday . "', '" . $nic . "', '" . $Gender . "',  '" . $address . "', '" . $Telephone . "', '" . $email . "', '" . $dept . "', '" . $Password . "')";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: lecturers.php");
        exit;
    } else {
        echo '<script language = "javascript">';
        echo 'alert("Lecturer Already Exist")';
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
                                Lecturer Registration
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
                                            <input required='required' class="form-control input-sm textBorder" id="inputlecid" name="inputlecid" placeholder="Lecturer ID" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectsalutation" class="col-md-3 control-label">Salutation</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control input-sm textBorder" id="selectsalutation" name="selectsalutation">
                                                <option> </option>
                                                <option>Mr.</option>
                                                <option>Ms.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputlecname" class="col-lg-3 control-label">Lecturer Name</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputlecname" name="inputlecname" placeholder="Lecturer Name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputaddress" class="col-lg-3 control-label">Address</label>
                                        <div class="col-lg-9">
                                            <textarea required='required' class="form-control input-sm textBorder" style="resize: none" rows="5" id="inputaddress" name="inputaddress" placeholder="Address"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="radiogender" class="col-lg-3 control-label">Gender</label>
                                        <div class="col-lg-9">
                                            <label class="radio-inline"><input required='required' type="radio" name="radiogender" value="male">Male</label>
                                            <label class="radio-inline"><input required='required' type="radio" name="radiogender" value="female">Female</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputnic" class="col-lg-3 control-label">NIC Number</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputnic" name="inputnic" placeholder="NIC Number" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="datetimepicker" class="col-lg-3 control-label">Birth Day</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id='datetimepicker' name='datetimepicker' placeholder="Birth Day" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputtelephone" class="col-lg-3 control-label">Telephone</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputtelephone" name="inputtelephone" placeholder="Telephone" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputemail" class="col-lg-3 control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputemail" name="inputemail" placeholder="Email" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputdept" class="col-lg-3 control-label">Department</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputdept" name="inputdept" placeholder="Department" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpassword" class="col-lg-3 control-label">Password</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputpassword" name="inputpassword" placeholder="Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputpasswordconfirm" class="col-lg-3 control-label">Confirm</label>
                                        <div class="col-lg-9">
                                            <input required='required' class="form-control input-sm textBorder" id="inputpasswordconfirm" name="inputpasswordconfirm" placeholder="Confirm Password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-6">
                                            <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
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
