<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
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
                                                    <label for="selectlecid" class="col-md-2 control-label">Lecturer ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecid" name="selectlecid">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT lecturer_id FROM `lecturers`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['lecturer_id'] . "'>" . $row['lecturer_id'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectlecname" class="col-md-2 control-label">Lecturer Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectlecname" name="selectlecname">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT salutation, name FROM `lecturers`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['name'] . "'>" . $row['salutation'] . " " . $row['name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectdept" class="col-md-2 control-label">Department</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectdept" name="selectdept">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT DISTINCT department FROM `lecturers`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectnic" class="col-md-2 control-label">NIC Number</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectnic" name="selectnic">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT nic FROM `lecturers`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['nic'] . "'>" . $row['nic'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
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
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                    lecturer_id,
                                    salutation,
                                    name,
                                    department,
                                    nic
                                FROM lecturers";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['lecturer_id'] . "</td>";
                            echo "<td>" . $row['salutation'] . " " . $row['name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td>" . $row['nic'] . "</td>";
                            echo "<td> <a href='lecturersedit.php?lecturer_id=".$row['lecturer_id']."'>edit</a></td>";
                            echo "<td> <a href=''>delete</a></td>";

                            echo "</tr>";
                        }
                        ?>

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