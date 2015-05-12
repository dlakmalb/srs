<?php
require_once("header.php");
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Student Registration System</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/select2.css" />
        <link rel="stylesheet" type="text/css" href="css/select2-bootstrap3.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.min.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.min.css" />
        <script src="js/moment.js"></script>
        <script src="js/jquery-2.1.3.min.js"></script> 
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script src="js/collapse.js"></script>
    </head>
    <body background="images/background.PNG"> 
        <?php add_header() ?>

        <div class="container-fluid col-md-offset-2"><br>

            <div class="col-md-12">
                <a class="btn btn-primary btn-block" href='##'>Add Course</a><br>
                <form class="form-horizontal" action="" method="GET">
                    <fieldset>
                        <div class="form-group">
                            <div>
                                <label for="inputcode" class="col-md-2 control-label">Course Code</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm textTransparent textBorder" id="selectcode" name="selectcode">
                                    <option> </option>
                                    <option>ECX5245</option>
                                    <option>ECX5267</option>
                                    <option>ECX5234</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputname" class="col-md-2 control-label">Course Name</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm textTransparent textBorder" id="selectname" name="selectname">
                                    <option> </option>
                                    <option>Database Management System</option>
                                    <option>Software Testing and Quality Assurance</option>
                                    <option>Data Communication</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputdept" class="col-md-2 control-label">Department</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm textTransparent textBorder" id="selectdept" name="selectdept">
                                    <option> </option>
                                    <option>Electrical and Computer Engineering</option>
                                    <option>Civil Engineering</option>
                                    <option>Electrical Engineering</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputcredit" class="col-md-2 control-label">Credit</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm textTransparent textBorder" id="selectcredit" name="selectcredit">
                                    <option> </option>
                                    <option>0</option>
                                    <option>3</option>
                                    <option>6</option>
                                    <option>9</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="inputlevel" class="col-md-2 control-label">Level</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control input-sm textTransparent textBorder" id="selectlevel" name="selectlevel">
                                    <option> </option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                    <option>7</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-2">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>   
                            <div class="col-md-2">
                                <a href="courses.php" type="reset" class="btn btn-default btn-block">Clear</a>

                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div> 
        <script>$("#selectcode").select2({placeholder: "Select Course Code"});</script>
        <script>$("#selectname").select2({placeholder: "Select Course Name"});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department"});</script>
        <script>$("#selectcredit").select2({placeholder: "Select Credit"});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level"});</script>
    </body>
</html>