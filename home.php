<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<!DOCTYPE html>
<html>
    <?php add_head() ?>
    <body background="images/background.jpg">  
        <div id="wrapper">
            <?php add_nav() ?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to Administration Panel
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
