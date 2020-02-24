<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$course_id = mysqli_real_escape_string($con, $_POST['course_id']);

$sql = "DELETE FROM course WHERE course_id='$course_id'";
if(mysqli_query($con, $sql))
{
    success("Course deleted!");
}
else
{
    error(mysqli_error($con));
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}
