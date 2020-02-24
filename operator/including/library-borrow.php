<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$isbn = mysqli_real_escape_string($con, $_POST['isbn']);

$sql = "SELECT * FROM student_book WHERE s_uname='$uname' AND isbn='$isbn'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0){
    error('Already reserved!');
}

$sql = "SELECT * FROM book WHERE isbn='$isbn'";
if($ress = mysqli_query($con, $sql)){
    $row = mysqli_fetch_assoc($ress);
    $qty = $row['qty'];
    if(is_numeric($qty)){
        if($qty < 1){
            error('Sorry! Book is not available in stocks');
        }
    }
    else
    {
        error('Oops! Something went wrong');
    }
}
else{
    error(mysqli_error($con)); 
}
$date = date("Y-m-d");
$sql = "INSERT INTO student_book(s_uname,isbn,date) VALUES('$uname','$isbn','$date')";
if(mysqli_query($con, $sql)){
    $sql = "SELECT * FROM book WHERE isbn='$isbn'";
    $res = mysqli_query($con,$sql);
    $qty = mysqli_fetch_assoc($res)['qty'];
    $newQty = $qty - 1;

    $sql = "UPDATE book SET qty='$newQty' WHERE isbn='$isbn'";
    mysqli_query($con,$sql);
    success('Book reserved!');
}
else{
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
