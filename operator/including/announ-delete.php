<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$id = mysqli_real_escape_string($con, $_POST['id']);

$sql = "DELETE FROM announcement WHERE id='$id'";
if(mysqli_query($con, $sql))
{
    success("Announcement deleted!");
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
