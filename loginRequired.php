<?php
require_once("dbconnection.php"); 
function adminLoginRequired() {
    if(! isset($_SESSION['ADMIN_ID']) )
    {
        header("Location: index.php");
        die;
    }
} 
function studentLoginRequired() {
    if(! isset($_SESSION['STUDENT_ID']) )
    {
        header("Location: index.php");
        die;
    }
} 
function lecturerLoginRequired() {
    if(! isset($_SESSION['LECTURER_ID']) )
    {
        header("Location: index.php");
        die;
    }
} 
//if(! isset($_SESSION['student_id']) )
//{
//    header("Location: index.php");
//    die;
//}
?>