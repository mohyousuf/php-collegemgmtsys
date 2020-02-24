<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['batch_id'] != '' &&
    $_POST['day'] != '' &&
    $_POST['l_uname'] != '' &&
    $_POST['time'] != '' &&
    $_POST['newbatch_id'] != '' &&
    $_POST['newday'] != '' &&
    $_POST['newl_uname'] != '' &&
    $_POST['newtime'] != ''
    ){

    $batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
    $l_uname = mysqli_real_escape_string($con, $_POST['l_uname']);
    $day = mysqli_real_escape_string($con, $_POST['day']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
    $newbatch_id = mysqli_real_escape_string($con, $_POST['newbatch_id']);
    $newl_uname = mysqli_real_escape_string($con, $_POST['newl_uname']);
    $newday = mysqli_real_escape_string($con, $_POST['newday']);
    $newtime = mysqli_real_escape_string($con, $_POST['newtime']);

    $sql = "SELECT * FROM schedule WHERE batch_id='$newbatch_id' AND l_uname='$newl_uname' AND day='$newday' AND time='$newtime'";
    $res = mysqli_query($con, $sql);
    if(mysqli_num_rows($res) > 0){
        error("It is already scheduled!");
    }

    $sql = "UPDATE schedule SET batch_id='$newbatch_id',l_uname='$newl_uname',day='$newday',time='$newtime' WHERE batch_id='$batch_id' AND day='$day' AND time='$time' AND l_uname='$l_uname' ";
    if(mysqli_query($con, $sql)){
        success('Class schedule updated!');
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
