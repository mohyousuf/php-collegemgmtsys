<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$module_id = mysqli_real_escape_string($con, $_POST['module_id']);
$sql = "DELETE FROM module WHERE module_id='$module_id'";
if(mysqli_query($con, $sql))
{
    success("Module deleted!");
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
