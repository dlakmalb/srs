<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
?>
<?php
// update tables
if (isset($_POST['register'])):
    $code = ($_POST['selectcourse']);

    $prerequisites = array();
    $corequisites = array();
    if(isset($_POST['selectprerequisites']))
    {
        $prerequisites = $_POST['selectprerequisites'];
    }
    if(isset($_POST['selectcorequisites']))
    {
        $corequisites = $_POST['selectcorequisites'];
    }
    
    // prerequisites
    $sql = "DELETE from courseprerequisites where course_code='$code'";
    $result = $conn->query($sql);
    
    foreach ($prerequisites as $prereq) {
        $sql = "INSERT INTO courseprerequisites (course_code, prerequisite_course_code)
            VALUES('" . $code . "', '" . $prereq . "')";
        $result = $conn->query($sql);
    }
    
    // corequisites
    $sql = "DELETE from coursecorequisites where course_code='$code'";
    $result = $conn->query($sql);
    
    foreach ($corequisites as $coreq) {
        $sql = "INSERT INTO coursecorequisites (course_code, corequisite_course_code)
            VALUES('" . $code . "', '" . $coreq . "')";
        $result = $conn->query($sql);
    }
    header("Location: coursesedit.php?course_code=".$code);
    exit();
endif;  ///----------- End of saving


//-------------------------------------------------------------------------
// load page fields

$course_code = $_GET["course_code"];
// fill fields
$sql = "SELECT
        course_code,
        course_name from courses
        WHERE course_code = '$course_code'";

$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

$name = $row['course_name'];

//find co requisites
$sql = "SELECT
        corequisite_course_code
        from coursecorequisites
        WHERE course_code = '$course_code'";

$result = $conn->query($sql);
$corequisites= array();
while($row = mysqli_fetch_array($result))
{
    $corequisites[] = $row['corequisite_course_code'];
}

//find pre requisites
$sql = "SELECT
        prerequisite_course_code
        from courseprerequisites
        WHERE course_code = '$course_code'";

$result = $conn->query($sql);
$prerequisites= array();
while($row = mysqli_fetch_array($result))
{
    $prerequisites[] = $row['prerequisite_course_code'];
}

?>
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body> 
        <div id="wrapper">
            <?php add_nav() ?>
            <div id="page-wrapper">
                <div class="container-fluid"><br>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Manage Courses Requisites
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-md-offset-1">
                            <form class="form-horizontal" action="" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectcourse" class="col-lg-4 control-label">Course Name</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input class="form-control" value="<?php echo($course_code." - ".$name);?>" readonly="readonly" />
                                            <input name="selectcourse" type="hidden" value="<?php echo($course_code);?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectprerequisites" class="col-lg-4 control-label">Prerequisite Courses</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control input-sm" id="selectprerequisites" name="selectprerequisites[]" multiple="multiple">
                                                <?php
                                                // load course codes and names to select box
                                                $sql = "SELECT course_code, course_name FROM `courses`";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                    //disallow adding same course
                                                    if($row['course_code']==$course_code)
                                                    {
                                                        continue;
                                                    }
                                                    
                                                    $selected="";
                                                    if(in_array($row['course_code'], $prerequisites))
                                                    {
                                                        $selected=" selected='selected' ";
                                                    }
                                                    echo "<option ".$selected. " value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name']. "</option>";
                                                }
                                                "</select>"
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                            <label for="selectcorequisites" class="col-lg-4 control-label">Corequisite Courses</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <select class="form-control input-sm" id="selectcorequisites" name="selectcorequisites[]"  multiple="multiple">
                                                <?php
                                                // load course codes and names to select box
                                                $sql = "SELECT course_code, course_name FROM `courses`";
                                                $result = mysqli_query($conn, $sql);
                                                while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                    //disallow adding same course
                                                    if($row['course_code']==$course_code)
                                                    {
                                                        continue;
                                                    }
                                                    
                                                    $selected="";
                                                    if(in_array($row['course_code'], $corequisites))
                                                    {
                                                        $selected=" selected='selected' ";
                                                    }
                                                    echo "<option ".$selected." value='" . $row['course_code'] . "'>" . $row['course_code'] . " - " . $row['course_name'] . "</option>";
                                                }
                                                "</select>"
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-3 col-lg-offset-6">
                                            <button onclick="duplicate_id()" type="submit" name= "register" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="coursesedit.php?course_code=<?php echo($course_code);?>" class="btn btn-default btn-block">Cancel</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    
                </div> 
            </div>
        </div>
        <script>$("#selectcourse").select2({placeholder: "Select Course", allowClear: true});</script>
        <script>$("#selectprerequisites").select2({placeholder: "Select Prerequisites Course", multiple: "multiple"});</script>
        <script>$("#selectcorequisites").select2({placeholder: "Select Corequisites Course", multiple: "multiple"});</script>
    </body>
</html>