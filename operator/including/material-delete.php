<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$id = mysqli_real_escape_string($con, $_POST['id']);
$sql = "SELECT * FROM material WHERE id='$id'";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
$file = $row['file'];
$loc =  '../../materials/' . $file;

$sql = "DELETE FROM material WHERE id='$id'";
if(mysqli_query($con, $sql))
{
    if(file_exists($loc)){
        unlink($loc);
    }
    success("Material deleted!");
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
