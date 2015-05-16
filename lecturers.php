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
                                Lectures Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-2">
                            <a class="btn btn-info btn-block" href='lecturersadd.php'>Add Lecturer</a> <br/>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-info btn-block" href='lecassigncourses.php'>Assign Courses</a> <br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Lecturers </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labellecid" class="col-md-2 control-label">Lecturer ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecid" name="selectlecid">
                                                        <option> </option>
                                                        <option>LEC001</option>
                                                        <option>LEC002</option>
                                                        <option>LEC003</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labellecname" class="col-md-2 control-label">Lecturer Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecname" name="selectlecname">
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
                                                    <a href="lecturers.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Lecturer ID</th>
                                <th>Lecturer Name</th>
                                <th>Department</th>
                                <th>NIC Number</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>LEC001</td>
                                <td>B.A.D.L.Bulathsinghala</td>
                                <td>Electrical and Computer Engineering</td>
                                <td>910034103v</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                            <tr>
                                <td>LEC002</td>
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
        <script>$("#selectlecid").select2({placeholder: "Select Lecturer ID", allowClear: true});</script>
        <script>$("#selectlecname").select2({placeholder: "Select Lecturer Name", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectnic").select2({placeholder: "Select NIC", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>