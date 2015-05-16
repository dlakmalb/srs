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
                                Assign Courses
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Assign Courses to Lecturers </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labelcoursecode" class="col-md-2 control-label">Course Code</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectcoursecode" name="selectcoursecode">
                                                        <option> </option>
                                                        <option>ECX5245 - Database Management System</option>
                                                        <option>ECX5267 - Software Testing and Quality Assurance</option>
                                                        <option>ECX5234 - Data Communication</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectyear" class="col-md-2 control-label">Academic Year</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectyear" name="selectyear">
                                                        <option> </option>
                                                        <option>2011-2012</option>
                                                        <option>2012-2013</option>
                                                        <option>2013-2014</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectlecid" class="col-md-2 control-label">Lecturer</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecid" name="selectlecid">
                                                        <option> </option>
                                                        <option>ABD</option>
                                                        <option>DEF</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-2">
                                                    <button type="submit" class="btn btn-primary btn-block">Assign</button>
                                                </div>   
                                                <div class="col-md-2">
                                                    <a href="lecassigncourses.php.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Academic Year</th>
                                <th>Lecture</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ECX5245</td>
                                <td>Database Management System</td>
                                <td>2013-2014</td>
                                <td>ABC</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                            <tr>
                                <td>ECX5267</td>
                                <td>Software Testing and Quality Assurance</td>
                                <td>2012-2013</td>
                                <td>DEF</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                        </tbody>



                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectcoursecode").select2({placeholder: "Select Course Code", allowClear: true});</script>
        <script>$("#selectyear").select2({placeholder: "Select Academic Year", allowClear: true});</script>
        <script>$("#selectlecid").select2({placeholder: "Select Lecturer", allowClear: true});</script>
    </body>
</html>