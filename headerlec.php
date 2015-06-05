<?php
require_once("dbconnection.php");
require_once("loginRequired.php");
lecturerLoginRequired();
?>
<?php
$lec_id = $_SESSION["LECTURER_ID"];
$sql = "SELECT name FROM lecturers WHERE lecturer_id = '$lec_id'";
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
                <li <?php if ($active == 'home' || $active == '') { echo('class="active"');}?> >
                    <a href="homelec.php"><i class="fa fa-fw fa-home"></i> Lecturer Panel</a>
                </li>
                <li <?php if ($active == 'profile') { echo('class="active"');} ?> >
                    <a href="profilelec.php"><i class="fa fa-fw fa-users"></i> My Profile</a>
                </li>
                <li <?php if ($active == 'stuinfolec') { echo('class="active"');}?> >
                    <a href="studentsinfolec.php"><i class="fa fa-fw fa-book"></i> Student's Information</a>
                </li>  
                <li <?php if ($active == 'resultsinfolec') {echo('class="active"'); }?> >
                    <a href="resultsinfolec.php"><i class="fa fa-fw fa-bar-chart-o"></i> Results Information</a>
                </li>                
                <li <?php if($active == 'comcourses'){ echo('class="active"');} ?> >
                    <a href="compulsorycourseslec.php"><i class="fa fa-fw fa-info-circle"></i> Compulsory Courses</a>
                </li>                
                <li <?php if($active == 'letter'){ echo('class="active"');} ?> >
                    <a href="compulsorycourseslec.php"><i class="fa fa-fw fa-envelope"></i> Request Letters</a>
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
