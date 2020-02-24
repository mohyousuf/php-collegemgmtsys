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


    $sql = "SELECT * FROM grade WHERE batch_id='$batch_id' AND module_id='$module_id' AND s_uname='$s_uname';";
    ChromePhp::log($sql);
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error("It's already marked");
    }


    $sql = "INSERT INTO grade(batch_id, module_id,s_uname,grade) VALUES ('$batch_id','$module_id','$s_uname','$grade');";
    if(mysqli_query($con, $sql)){
        success('Result added!');
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
