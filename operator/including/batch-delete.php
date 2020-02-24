<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
$sql = "DELETE FROM batch WHERE batch_id='$batch_id'";
if(mysqli_query($con, $sql))
{
    success("Batch deleted!");
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
