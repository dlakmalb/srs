<?php require_once("dbconnection.php"); ?> 

<?php
unset($_SESSION['STUDENT_ID']);
unset($_SESSION['LECTURER_ID']);
unset($_SESSION['ADMIN_ID']);

header("Location: index.php");
mysqli_close($conn); // close connection
?>
