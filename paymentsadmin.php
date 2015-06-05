<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<?php
$condition = [];
$id = "";

if (isset($_GET["selectstudent"]) && strlen($_GET["selectstudent"]) > 0) {
    $id = $_GET["selectstudent"];
    $condition[] = " registrations.student_id = '$id'";
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
            <?php add_nav('paymentsadmin') ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Payments Information
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-3 col-sm-2">
                            <a class="btn btn-danger btn-block" href='#'>Confirmation</a> <br/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> New Payment</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">
                                                <div>
                                                    <label for="selectstudent" class="col-md-2 control-label">Student ID</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-control input-sm textBorder" id="selectstudent" name="selectstudent">
                                                        <option> </option>
                                                        <?php
                                                        $sql = "SELECT DISTINCT registrations.student_id, name
                                                                FROM registrations
                                                                LEFT JOIN students ON registrations.student_id = students.student_id";
                                                        $result = mysqli_query($conn, $sql);
                                                        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                                                            $sel = $row['student_id'] == $id ? "selected" : "";
                                                            echo "<option $sel value='" . $row['student_id'] . "'>" . $row['student_id'] . " - " . $row['name'] . "</option>";
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
                                                    <a href="paymentsadmin.php" type="reset" class="btn btn-default btn-block">Clear</a>

                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table" data-toggle="table" class="table table-hover table-bordered" data-click-to-select = "true">
                        <thead>	
                            <tr>
                                <th class="text-center">Student ID</th>
                                <th class="text-center">Courses</th>
                                <th class="text-center">Credits</th>
                                <th class="text-center">Course Fee</th>
                                <th data-field="state" data-checkbox="true"></th>
                            </tr>
                        </thead>
                        <?php
                        mysql_select_db('student_registration_db');

                        $sql = "SELECT
                                registrations.student_id,   
                                registrations.course_code,                                                             
                                courses.course_name,
                                courses.credits,
                                registrations.course_fee
                                FROM registrations
                                LEFT JOIN courses ON registrations.course_code = courses.course_code
                                $where_clause";

                        $result = $conn->query($sql);
                        ?>
                        <?php
                        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                            echo "<tr>";

                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td class='text-left'>" . $row['course_code'] . " - " . $row['course_name'] . "</td>";
                            echo "<td>" . $row['credits'] . "</td>";
                            echo "<td class='text-right'>" . number_format($row['course_fee'], 2) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                        <tfoot>
                            <tr> 
                                <td colspan="3" class="text-center">Total Amount </td>      
                                <td class="text-right" id="totalFee">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading"> Payment Summery</div>
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="GET">
                                        <fieldset>
                                            <div class="form-group">                    
                                                    <label class="col-md-2 control-label">Total Amount </label>
                                                    <div class="col-md-4">
                                                        <input id="summaryTotal" type="text" readonly class="col-md-2 form-control" value=" 0.00">
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                    <label for="selectstudent" class="col-md-2 control-label">Payment Date</label>
                                                    <div class="col-md-4">
                                                        <input name="summaryDate" id="datetimepicker" type="text" required placeholder="Payment Date" class="col-md-2 form-control" >
                                                </div>
                                           </div>
 <!--                                            <div class="form-group">
                                                <div>
                                                    <label for="selectstudent" class="col-md-2 control-label">Invoice No</label>
                                                </div>
                                            </div>-->
                                            <div class="form-group">
                                                <div class="col-md-2 col-md-offset-3">
                                                    <button type="button" onclick="return addPayement();" class="btn btn-primary btn-block">Print Invoice</button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <script>$("#selectstudent").select2({placeholder: "Select Student", allowClear: true});</script>
        <script>
            function getSelectedCourses()
            {
                var selections = $("#table").bootstrapTable("getSelections");
                var courses = [];
                for (var i = 0; i < selections.length; i++) {
                    var selection = selections[i];
                    var studentID = selection[0];
                    var courseCode = selection[1].substr(0,selection[1].search('-')).trim();
                    var feeValue = parseFloat(selection[3].replace(',','')); 
                    var course = {student:studentID, courses:courseCode, fee:feeValue };
                    courses.push(course);
                }
                return courses;
            }
            
            function updateFeeTotal()
            {
                var items = getSelectedCourses();
                var total = 0.0;
                
                for(var i = 0; i < items.length; i++)
                {
                    var course = items[i];
                    total+= course.fee ;
                }
                $("#totalFee").text(total.toFixed(2));
                $("#summaryTotal").val(total.toFixed(2));
            }
            
            function addPayement()
            {
                var items = getSelectedCourses();
                var jsonItems = JSON.stringify(items);
                
                return false;
            }
            
            $(function(){
                $("#table").on('all.bs.table',updateFeeTotal);
              });
        </script>
        <script>           
            $(function ()
            {
                $('#datetimepicker').datetimepicker(
                        {
                            format: 'YYYY-MM-DD HH:mm:ss',
                        }
                );

            });
        </script>
    </body>
</html>
