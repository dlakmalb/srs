<?php
require_once("dbconnection.php");
require_once("headerlec.php");
require_once("utility.php");
require_once("loginRequired.php");
lecturerLoginRequired();
?> 
<?php
$condition = [];
$id = $name = $field = $nic = "";

if (isset($_GET["selectid"]) && strlen($_GET["selectid"]) > 0) {
    $hasId = true;
    $id = $_GET["selectid"];
    $condition[] = " students.student_id = '$id'";
}
if (isset($_GET["selectname"]) && strlen($_GET["selectname"]) > 0) {
    $hasName = true;
    $name = $_GET["selectname"];
    $condition[] = " students.name = '$name'";
}
if (isset($_GET["selectfield"]) && strlen($_GET["selectfield"]) > 0) {
    $hasField = true;
    $field = $_GET["selectfield"];
    $condition[] = " students.field = '$field'";
}
if (isset($_GET["selectnic"]) && strlen($_GET["selectnic"]) > 0) {
    $hasNic = true;
    $nic = $_GET["selectnic"];
    $condition[] = " students.nic = '$nic'";
}
$where_clause = "";
if (count($condition) > 0) {
    $where_clause = "Where " . implode(" AND ", $condition);
}
?>
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav('stuinfolec') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Student's Information
                            </h1>
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
                                                    <label for="selectid" class="col-md-2 control-label">Student ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectid" name="selectid">
                                                        <option> </option>
                                                        <?php
                                                        // load student id to select box
                                                        $sql = "SELECT student_id FROM `students`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['student_id'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['student_id'] . "'>" . $row['student_id'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectname" class="col-md-2 control-label">Student Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectname" name="selectname">
                                                        <option> </option>
                                                        <?php
                                                        // load student names to select box
                                                        $sql = "SELECT name FROM `students`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['name'] == $name ? "selected" : "";
                                                            echo "<option $sel value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectfield" class="col-md-2 control-label">Field</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm" id="selectfield" name="selectfield">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT DISTINCT field FROM `students`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['field'] == $field ? "selected" : "";
                                                            echo "<option $sel value='" . $row['field'] . "'>" . $row['field'] . "</option>";
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
                                                        $sql = "SELECT nic FROM `students`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['nic'] == $nic ? "selected" : "";
                                                            echo "<option $sel value='" . $row['nic'] . "'>" . $row['nic'] . "</option>";
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
                                                    <a href="studentsinfolec.php" type="reset" class="btn btn-default btn-block">Clear</a>
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
                                <th>Field</th>
                                <th>NIC Number</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT 
                                student_id,
                                name,
                                field,
                                nic
                            FROM students
                            $where_clause ORDER BY student_id";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['field'] . "</td>";
                            echo "<td>" . $row['nic'] . "</td>";
                            echo "<td> <a href='studentinfolec.php?student_id=" . $row['student_id'] . "'>More Info</a></td>";

                            echo "</tr>";
                        }
                        ?>

                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectid").select2({placeholder: "Select Student ID", allowClear: true});</script>
        <script>$("#selectname").select2({placeholder: "Select Student Name", allowClear: true});</script>
        <script>$("#selectfield").select2({placeholder: "Select Field", allowClear: true});</script>
        <script>$("#selectnic").select2({placeholder: "Select NIC", allowClear: true});</script>
        <script>$("#selectlevel").select2({placeholder: "Select Level", allowClear: true});</script>
    </body>
</html>
