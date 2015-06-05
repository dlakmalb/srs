<?php
require_once("dbconnection.php");
require_once("headeradmin.php");
require_once("loginRequired.php");
adminLoginRequired();
?> 
<?php
$request_data = $_POST["request"];

$request = json_decode($request_data,true);

var_dump($request);

?>