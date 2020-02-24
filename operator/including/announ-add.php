<?php
include '../../including/sql_connection.php';

if(
    $_POST['title'] != '' &&
    $_POST['msg'] != ''
    ){

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);

    
    $sql = "INSERT INTO announcement(title,msg) VALUES ('$title','$msg');";
    if(mysqli_query($con, $sql)){
        success('Announcement created!');
    }
    else
    {
        error(mysqli_error($con));
    }
}
else
{
    error('You must fill all the required fields...');
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}

?>
