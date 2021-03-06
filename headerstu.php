<?php
require_once("dbconnection.php");
require_once("loginRequired.php");
studentLoginRequired();
?>
<?php
$stud_id = $_SESSION["STUDENT_ID"];
$sql = "SELECT name FROM students WHERE student_id = '$stud_id'";
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
            <lable class="navbar-brand"  >Student Registration System</lable>
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
                    <a href="homestu.php"><i class="fa fa-fw fa-home"></i> Student Panel</a>
                </li>
                <li <?php if($active == 'profile'){ echo('class="active"');} ?> >
                    <a href="profilestu.php"><i class="fa fa-fw fa-user"></i> My Profile</a>
                </li>
                <li <?php if($active == 'program'){ echo('class="active"');} ?> >
                    <a href="programstu.php"><i class="fa fa-fw fa-book"></i> My Programmes</a>
                </li>
                <li <?php if($active == 'courseregistration'){ echo('class="active"');} ?> >
                    <a href="coursesregstu.php"><i class="fa fa-fw fa-user-plus"></i> Courses Registration</a>
                </li>
                <li <?php if($active == 'comcourses'){ echo('class="active"');} ?> >
                    <a href="compulsorycoursesstu.php"><i class="fa fa-fw fa-info-circle"></i> Compulsory Courses</a>
                </li>
            </ul>
        </div>
       
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
