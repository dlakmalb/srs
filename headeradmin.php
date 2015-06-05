<?php
require_once("dbconnection.php");
require_once("loginRequired.php");
adminLoginRequired();
?>
<?php
$admin_id = $_SESSION["ADMIN_ID"];
$sql = "SELECT name FROM admins WHERE admin_id = '$admin_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$navbar_username = $row['name'];

function add_nav($active = "") {
    global $navbar_username;
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
            <lable class="navbar-brand">Student Registration System</lable>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo($navbar_username) ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="signOut.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li <?php if($active == 'home' || $active == ''){ echo('class="active"');} ?> >
                    <a href="home.php"><i class="fa fa-fw fa-home"></i> Admin Panel</a>
                </li>
                <li <?php if($active == 'courses'){ echo('class="active"');} ?> >
                    <a href="courses.php"><i class="fa fa-fw fa-book"></i> Courses</a>
                </li>
                <li <?php if($active == 'students'){ echo('class="active"');} ?> >
                    <a href="students.php"><i class="fa fa-fw fa-users"></i> Students</a>
                </li>
                <li <?php if($active == 'lecturers'){ echo('class="active"');} ?> >
                    <a href="lecturers.php"><i class="fa fa-fw fa-user-plus"></i> Lecturers</a>
                </li>
                <li <?php if($active == 'administrators'){ echo('class="active"');} ?> >
                    <a href="admins.php"><i class="fa fa-fw fa-user-secret"></i> Administrators</a>
                </li>
                <li <?php if($active == 'paymentsadmin'){ echo('class="active"');} ?> >
                    <a href="paymentsadmin.php"><i class="fa fa-fw fa-money"></i> Payments</a>
                </li>
                <li <?php if($active == 'academic years'){ echo('class="active"');} ?> >
                    <a href="academicyears.php"><i class="fa fa-fw fa-calendar"></i> Academic Years</a>
                </li>
                <li <?php if($active == 'comcourses'){ echo('class="active"');} ?> >
                    <a href="compulsorycoursesadmin.php"><i class="fa fa-fw fa-info-circle"></i> Compulsory Courses</a>
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
        <script src="js/utility.js" type="text/javascript"></script>
    </head>
<?php } ?>
