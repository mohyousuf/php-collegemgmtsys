<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
$module_id = mysqli_real_escape_string($con, $_POST['module_id']);
$s_uname = mysqli_real_escape_string($con, $_POST['s_uname']);
$sql = "DELETE FROM grade WHERE batch_id='$batch_id' AND module_id='$module_id' AND s_uname='$s_uname' ";
if(mysqli_query($con, $sql))
{
    success("Result deleted!");
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
