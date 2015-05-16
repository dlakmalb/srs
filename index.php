<?php 
require_once("dbconnection.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Student Registration System</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body style="padding-top: 0px "class="mainBody" background="images/background.PNG">
        <div class="navbar navbar-default navbar-fixed-bottom navfooter">
            <p>
                Copyright © 2015 By Dhananjaya Lakmal Bulathsinghala<br>
                All Rights Reserved
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 vcenter">
                    <div class="title text-center">
                        <h3>
                            Student Registration System
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" action="signInConnector.php" method="POST">
                                <div class="form-group">
                                    <input type="text" required='required' class="form-control textTransparent textBorder" id="inputusername" name="inputusername" placeholder="Username" />
                                </div>
                                <div class="form-group">
                                    <input type="password"  class="form-control textTransparent textBorder" id="inputpassword" name="inputpassword" placeholder="Password" />
                                </div><br>
                                <div class="form-group">
                                    <input class="form-control btn btn-block btn-primary" type="submit" name="signIn" value="Sign In" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET ['success']) && $_GET ['success'] == 0) {

            echo '<script language="javascript">';
            echo 'alert("Invalid Credentials")';
            echo '</script>';
        }
        ?>
    </body>
</html>