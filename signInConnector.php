<?php 
require_once("dbconnection.php"); 
?> 

<?php

$username = $_POST['inputusername'];  // get input username
$password = $_POST['inputpassword'];  // get input password

unset($_SESSION['STUDENT_ID']);
unset($_SESSION['LECTURER_ID']);
unset($_SESSION['ADMIN_ID']);

$encrypt_password = md5($password);
$sql = "SELECT student_id FROM students WHERE student_id='$username' AND password='$encrypt_password' LIMIT 1";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_fetch_array($result, MYSQLI_BOTH);

if ($rowcount) { // username and password match
    $_SESSION['STUDENT_ID'] = $rowcount['student_id']; // accept login

    header("Location: homestu.php");
    exit();
} 

$sql = "SELECT lecturer_id FROM lecturers WHERE lecturer_id='$username' AND password='$encrypt_password' LIMIT 1";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_fetch_array($result, MYSQLI_BOTH);

if ($rowcount) { // username and password match
    $_SESSION['LECTURER_ID'] = $rowcount['lecturer_id']; // accept login

    header("Location: home.php");
    exit();
} 

$sql = "SELECT admin_id FROM admins WHERE admin_id='$username' AND password='$encrypt_password' LIMIT 1";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_fetch_array($result, MYSQLI_BOTH);

if ($rowcount) { // username and password match
    $_SESSION['ADMIN_ID'] = $rowcount['admin_id']; // accept login

    header("Location: home.php");
    exit();
} 

header("Location: index.php?success=0");

mysqli_close($conn); // close connection

exit;
?>
