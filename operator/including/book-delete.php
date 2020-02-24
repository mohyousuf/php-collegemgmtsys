<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$isbn = mysqli_real_escape_string($con, $_POST['isbn']);
$sql = "DELETE FROM book WHERE isbn='$isbn'";
if(mysqli_query($con, $sql))
{
    success("Book deleted!");
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
