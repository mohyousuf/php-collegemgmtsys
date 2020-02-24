<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['id'] != '' &&
    $_POST['title'] != '' &&
    $_POST['msg'] != ''
    ){

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $msg = mysqli_real_escape_string($con, $_POST['msg']);

    $sql = "UPDATE announcement SET title='$title',msg='$msg' WHERE id='$id'";
    ChromePhp::log($sql);
    if(mysqli_query($con, $sql)){
        success('Annnouncement updated!');
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
