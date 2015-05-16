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
                            Courses Information
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-2">
                        <a class="btn btn-info btn-block" href='coursesadd.php'>Add Course</a> <br/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Search Courses </div>
                            <div class="panel-body">
                        <form class="form-horizontal" action="" method="GET">
                            <fieldset>
                                <div class="form-group">
                                    <div>
                                        <label for="labelcode" class="col-md-2 control-label">Course Code</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control input-sm" id="selectcode" name="selectcode">
                                            <option> </option>
                                            <option>ECX5245</option>
                                            <option>ECX5267</option>
                                            <option>ECX5234</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label for="labelname" class="col-md-2 control-label">Course Name</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control input-sm" id="selectname" name="selectname">
                                            <option> </option>
                                            <option>Database Management System</option>
                                            <option>Software Testing and Quality Assurance</option>
                                            <option>Data Communication</option>
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
                                        <label for="labelcredit" class="col-md-2 control-label">Credit</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control input-sm" id="selectcredit" name="selectcredit">
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
                                        <label for="labellevel" class="col-md-2 control-label">Level</label>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control input-sm" id="selectlevel" name="selectlevel">
                                            <option> </option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
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
                    </div>
                </div>
                <table id="table" class="table table-hover table-bordered">
                    <thead>	
                        <tr>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Department</th>
                            <th>Level</th>
                            <th>Credits</th>
                            <th>Course Fee</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ECX5245</td>
                            <td>Database Management System</td>
                            <td>Electrical and Computer Engineering</td>
                            <td>5</td>
                            <td>6</td>
                            <td>6600.00</td>
                            <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                            <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                        </tr>
                        <tr>
                            <td>ECX5267</td>
                            <td>Software Testing and Quality Assurance</td>
                            <td>Electrical and Computer Engineering</td>
                            <td>5</td>
                            <td>6</td>
                            <td>6600.00</td>
                            <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                            <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                        </tr>
                    </tbody>



                </table>
            </div> 
        </div>
        </div>
        <script>$("#selectcode").select2({placeholder: "Select Course Code", allowClear: true});</script>
        <script>$("#selectname").select2({placeholder: "Select Course Name", allowClear: true});</script>
        <script>$("#selectdept").select2({placeholder: "Select Department", allowClear: true});</script>
        <script>$("#selectcredit").select2({placeholder: "Select Credit", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>