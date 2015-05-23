<?php require_once("dbconnection.php"); ?> 

<?php

unset($_SESSION['username']) ;
unset($_SESSION['user_id']) ;

header("Location: index.php");
mysqli_close($conn); // close connection
?>
