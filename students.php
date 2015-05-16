<?php
require_once("dbconnection.php");
require_once("header.php");
?> 
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav() ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Students Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-2">
                            <a class="btn btn-info btn-block" href='studentsadd.php'>Add Student</a> <br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Students </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labelid" class="col-md-2 control-label">Student ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectid" name="selectid">
                                                        <option> </option>
                                                        <option>211068611</option>
                                                        <option>711068901</option>
                                                        <option>211068750</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labelname" class="col-md-2 control-label">Student Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectname" name="selectname">
                                                        <option> </option>
                                                        <option>B.A.D.L.Bulathsinghala</option>
                                                        <option>H.A.M.C.W.Hewawitharana</option>
                                                        <option>P.M.B.Weebedda</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labeldept" class="col-md-2 control-label">Department</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectdept" name="selectdept">
                                                        <option> </option>
                                                        <option>Electrical and Computer Engineering</option>
                                                        <option>Civil Engineering</option>
                                                        <option>Electrical Engineering</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labelnic" class="col-md-2 control-label">NIC Number</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectnic" name="selectnic">
                                                        <option> </option>
                                                        <option>910034103v</option>
                                                        <option>900044103v</option>
                                                        <option>900064103v</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-2">
                                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="students.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Department</th>
                                <th>NIC Number</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>211068611</td>
                                <td>B.A.D.L.Bulathsinghala</td>
                                <td>Electrical and Computer Engineering</td>
                                <td>910034103v</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                            <tr>
                                <td>711068901</td>
                                <td>H.A.M.C.W.Hewawitharana</td>
                                <td>Electrical and Computer Engineering</td>
                                <td>900044103v</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                        </tbody>



                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectid").select2({placeholder: "Select Student ID", allowClear: true});</script>
        <script>$("#selectname").select2({placeholder: "Select Student Name", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectnic").select2({placeholder: "Select NIC", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>