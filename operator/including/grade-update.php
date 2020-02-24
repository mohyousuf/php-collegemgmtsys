<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['batch_id'] != '' &&
    $_POST['module_id'] != '' &&
    $_POST['s_uname'] != '' &&
    $_POST['grade'] != ''
    ){

    $batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
    $module_id = mysqli_real_escape_string($con, $_POST['module_id']);
    $s_uname = mysqli_real_escape_string($con, $_POST['s_uname']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);

    $sql = "UPDATE grade SET grade='$grade' WHERE batch_id='$batch_id' AND module_id='$module_id' AND s_uname='$s_uname' ";
    if(mysqli_query($con, $sql)){
        success('Result updated!');
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
