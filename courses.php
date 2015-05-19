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
                                                    <label for="selectcode" class="col-md-2 control-label">Course Code</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectcode" name="selectcode">
                                                        <option> </option>
                                                        <?php
                                                        // load course codes and names to select box
                                                        $sql = "SELECT course_code, course_name FROM `courses`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['course_code'] . "'>" . $row['course_code'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectname" class="col-md-2 control-label">Course Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectname" name="selectname">
                                                        <option> </option>
                                                        <?php
                                                        // load course codes and names to select box
                                                        $sql = "SELECT course_name FROM `courses`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['course_name'] . "'>" . $row['course_name'] . "</option>";
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
                                                        // load course codes and names to select box
                                                        $sql = "SELECT DISTINCT department FROM `courses`";
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
                                                    <label for="selectcredit" class="col-md-2 control-label">Credit</label>
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
                                                    <label for="selectlevel" class="col-md-2 control-label">Level</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectlevel" name="selectlevel">
                                                        <option> </option>
                                                        <?php
                                                        // load course codes and names to select box
                                                        $sql = "SELECT DISTINCT level FROM `courses`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['level'] . "'>" . $row['level'] . "</option>";
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
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                course_code,
                                course_name,
                                department,
                                `level`,
                                credits
                            FROM courses";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                            echo "<tr>";

                            echo "<td>" . $row['course_code'] . "</td>";
                            echo "<td>" . $row['course_name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td>" . $row['level'] . "</td>";
                            echo "<td>" . $row['credits'] . "</td>";
                            echo "<td>" . $row['credits'] . "</td>";
                            echo "<td> <a href='coursesedit.php?course_code=".$row['course_code']."'>edit</a></td>";
                            echo "<td> <a href='#' onClick='#'>delete</a></td>";

                            echo "</tr>";
                        }
                        ?>

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