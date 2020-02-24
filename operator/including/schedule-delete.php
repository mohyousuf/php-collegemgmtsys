<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
$l_uname = mysqli_real_escape_string($con, $_POST['l_uname']);
$day = mysqli_real_escape_string($con, $_POST['day']);
$time = mysqli_real_escape_string($con, $_POST['time']);

$sql = "DELETE FROM schedule WHERE batch_id='$batch_id' AND l_uname='$l_uname' AND day='$day' AND time='$time'";
if(mysqli_query($con, $sql))
{
    success("Class schedule deleted!");
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
