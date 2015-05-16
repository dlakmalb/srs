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
                                                        <option>ADMIN001</option>
                                                        <option>ADMIN002</option>
                                                        <option>ADMIN003</option>
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
                                                        <option>A.B.C Admin</option>
                                                        <option>D.E.F. Admin</option>
                                                        <option>G.H.I. Admin</option>
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
                        <tbody>
                            <tr>
                                <td>ADMIN001</td>
                                <td>A.B.C Admin</td>
                                <td>admin001@gmail.com</td>
                                <td>0718381712</td>
                                <td> <a href="updatecomplaint.php?complain_id=<?php echo $row['complain_id']?>">edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                            <tr>
                                <td>ADMIN002</td>
                                <td>D.E.F. Admin</td>
                                <td>admin002@gmail.com</td>
                                <td>0777123456</td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>edit</a></td>
                                <td> <a href='updatecomplaint.php?complain_id=" . $row['complain_id'] . "'>delete</a></td>
                            </tr>
                        </tbody>



                    </table>
                </div> 
            </div>
        </div>
        <script>$("#selectadminid").select2({placeholder: "Select Administrator ID", allowClear: true});</script>
        <script>$("#selectadminname").select2({placeholder: "Select Administrator Name", allowClear: true});</script>
    </body>
</html>