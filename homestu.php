<?php
require_once("dbconnection.php");
require_once("headerstu.php");
require_once("loginRequired.php");
studentLoginRequired();
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
                                Welcome to Student Panel
                            </h1>
                        </div>
                    </div>
                    <div class="row">                        
                        <ul style="list-style-type: none; display: inline">
                            <li>
                                <img src="images/banner.jpg" alt="banner" style="width:1100px;height:400px; animation: linear">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>