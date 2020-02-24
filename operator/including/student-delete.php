<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);

$sql = "DELETE FROM student WHERE uname='$uname'";
if(mysqli_query($con, $sql))
{
    success("Student deleted!");
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
