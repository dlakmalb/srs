<?php

function add_header() {
    ?> 
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php">
                    Student Registration System
                </a>
            </div>
            <div class="collapse navbar-collapse" >
                <div class=" navbar-right pull-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Signed in as 

                                /<!add echo to user>

                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li class = ""><a href="changeuserinfo.php">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp; Update Profile</a></li>
                                <li class = ""><a href="signOut.php">
                                        <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp; Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar col-md-2">
        <div class="container-fluid">
            <ul class="nav nav-sidebar">
           <!-- <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>-->
                <li><a href="courses.php">Courses</a></li>
                <li><a href="#">Students</a></li>
                <li><a href="#">Lectures</a></li>
                <li><a href="#">Administrators</a></li>
                <li><a href="#">Payments</a></li>
                <li><a href="#">Academic Years</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </div>
    </div>
<?php }
?>