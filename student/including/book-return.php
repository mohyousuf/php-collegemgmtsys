<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$isbn = mysqli_real_escape_string($con, $_POST['isbn']);

$sql = "DELETE FROM student_book WHERE s_uname='$uname' AND isbn='$isbn'";
if(mysqli_query($con, $sql)){
    $sql = "SELECT * FROM book WHERE isbn='$isbn'";
    $res = mysqli_query($con,$sql);
    $qty = mysqli_fetch_assoc($res)['qty'];
    $newQty = $qty + 1;

    $sql = "UPDATE book SET qty='$newQty' WHERE isbn='$isbn'";
    mysqli_query($con,$sql);
    success('Book returned!');
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
