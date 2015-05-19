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
                                Administrators Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-2">
                            <a class="btn btn-info btn-block" href='adminsadd.php'>Add Administrator</a> <br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Search Administrators </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labeladminid" class="col-md-2 control-label">Administrator ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectadminid" name="selectadminid">
                                                        <option> </option>
                                                        <?php
                                                        // load admin id to select box
                                                        $sql = "SELECT admin_id FROM `admins`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['admin_id'] . "'>" . $row['admin_id'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="labeladminname" class="col-md-2 control-label">Administrator Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectadminname" name="selectadminname">
                                                        <option> </option>
                                                        <?php
                                                        // load admin name to select box
                                                        $sql = "SELECT name FROM `admins`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
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
                                                    <a href="admins.php" type="reset" class="btn btn-default btn-block">Clear</a>

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
                                <th>Administrator ID</th>
                                <th>Administrator Name</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                    admin_id,
                                    name,
                                    email,
                                    telephone
                                FROM admins";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['admin_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            echo "<td> <a href='adminsedit.php?admin_id=" . $row['admin_id'] . "'>edit</a></td>";
                            echo "<td> <a href=''>delete</a></td>";

                            echo "</tr>";
                        }
                        ?>



                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectadminid").select2({placeholder: "Select Administrator ID", allowClear: true});</script>
        <script>$("#selectadminname").select2({placeholder: "Select Administrator Name", allowClear: true});</script>
    </body>
</html>