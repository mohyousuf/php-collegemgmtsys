<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['batch_id'] != '' &&
    $_POST['l_uname'] != '' &&
    $_POST['day'] != '' &&
    $_POST['time'] != ''
    ){

    $batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
    $l_uname = mysqli_real_escape_string($con, $_POST['l_uname']);
    $day = mysqli_real_escape_string($con, $_POST['day']);
    $time = mysqli_real_escape_string($con, $_POST['time']);


    $sql = "SELECT * FROM schedule WHERE batch_id='$batch_id' AND l_uname='$l_uname' AND day='$day' AND time='$time';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error("It's already scheduled");
    }


    $sql = "INSERT INTO schedule(batch_id, l_uname,day,time) VALUES ('$batch_id','$l_uname','$day','$time');";
    if(mysqli_query($con, $sql)){
        success('Class schedule created!');
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
