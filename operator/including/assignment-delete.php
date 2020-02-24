<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
$module_id = mysqli_real_escape_string($con, $_POST['module_id']);
$s_uname = mysqli_real_escape_string($con, $_POST['s_uname']);
$title = mysqli_real_escape_string($con, $_POST['title']);

$sql = "SELECT * FROM assignment WHERE batch_id='$batch_id' AND module_id='$module_id' AND s_uname='$s_uname' AND title='$title'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$file = $row['file'];
$loc =  '../../assignments/' . $file;

$sql = "DELETE FROM assignment WHERE batch_id='$batch_id' AND module_id='$module_id' AND s_uname='$s_uname' AND title='$title'";
if(mysqli_query($con, $sql))
{
    if(file_exists($loc)){
        unlink($loc);
    }
    success("Assignment deleted!");
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
