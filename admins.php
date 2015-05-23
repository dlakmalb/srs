<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<?php
$condition = [];
$id = $name = "";

if (isset($_GET["selectadminid"]) && strlen($_GET["selectadminid"]) > 0) {
    $hasId = true;
    $id = $_GET["selectadminid"];
    $condition[] = " admins.admin_id = '$id'";
}
if (isset($_GET["selectadminname"]) && strlen($_GET["selectadminname"]) > 0) {
    $hasName = true;
    $name = $_GET["selectadminname"];
    $condition[] = " admins.name = '$name'";
}
$where_clause = "";
if (count($condition) > 0) {
    $where_clause = "Where " . implode(" AND ", $condition);
}
if (isset($_POST['delete'])):
    $admin_id = ($_POST['admin_id']);

    $sql = "DELETE from admins where admin_id='$admin_id'";

    $result = $conn->query($sql);
    if ($result && $conn->affected_rows > 0) {
        header("Location: admins.php");
        exit;
    } else {
        echo '<script language = "javascript">';
        echo 'alert("Failed to delete")';
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
                                                    <label for="selectadminid" class="col-md-2 control-label">Administrator ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectadminid" name="selectadminid">
                                                        <option> </option>
                                                        <?php
                                                        // load admin id to select box
                                                        $sql = "SELECT admin_id FROM `admins`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['admin_id'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['admin_id'] . "'>" . $row['admin_id'] . "</option>";
                                                        }
                                                        "</select>"
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectadminname" class="col-md-2 control-label">Administrator Name</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectadminname" name="selectadminname">
                                                        <option> </option>
                                                        <?php
                                                        // load admin name to select box
                                                        $sql = "SELECT name FROM `admins`";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['name'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['name'] . "'>" . $row['name'] . "</option>";
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
                                FROM admins
                                $where_clause";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['admin_id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            echo "<td> <a href='adminsedit.php?admin_id=" . $row['admin_id'] . "'>Edit</a></td>";
                            ?>
                            <td>
                                <?php if ($_SESSION['ADMIN_ID'] != $row['admin_id']) { ?>
                                    <form method="post"  onsubmit="return confirm('Are you sure you want to delete?');" >
                                        <input type="hidden" value="<?php echo $row['admin_id'] ?>" name="admin_id" />
                                        <input type="submit" value='Delete' name="delete" class="btn btn-sm btn-link" />
                                    </form>

                                <?php } else { ?>
                                    <input type="button" value="Delete" class='btn btn-sm btn-link disabled' disabled />
                                <?php } ?>
                            </td>
                        </tr>
                        <?php      }         ?>



                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectadminid").select2({placeholder: "Select Administrator ID", allowClear: true});</script>
        <script>$("#selectadminname").select2({placeholder: "Select Administrator Name", allowClear: true});</script>
    </body>
</html>
