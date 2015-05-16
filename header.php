<?php

function add_nav() {
    ?> 
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=" ">Student Registration System</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> User <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Admin Panel</a>
                </li>
                <li>
                    <a href="courses.php"><i class="fa fa-fw fa-book"></i> Courses</a>
                </li>
                <li>
                    <a href="students.php"><i class="fa fa-fw fa-users"></i> Students</a>
                </li>
                <li>
                    <a href="lecturers.php"><i class="fa fa-fw fa-user-plus"></i> Lecturers</a>
                </li>
                <li>
                    <a href="admins.php"><i class="fa fa-fw fa-user-secret"></i> Administrators</a>
                </li>
                <li>
                    <a href="bootstrap-grid.html"><i class="fa fa-fw fa-money"></i> Payments</a>
                </li>
                <li>
                    <a href="bootstrap-grid.html"><i class="fa fa-fw fa-calendar"></i> Academic Years</a>
                </li>
                <li>
                    <a href="bootstrap-grid.html"><i class="fa fa-fw fa-info-circle"></i> About</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
<?php }
?>
<?php

function add_head() {
    ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Student Registration System</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" type="text/css" href="css/select2.css" />
        <link rel="stylesheet" type="text/css" href="css/select2-bootstrap3.css" />
        <link rel="stylesheet" href="css/bootstrap-table.css">
        <script src="js/moment.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>

    </head>
<?php } ?>
