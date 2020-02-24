<?php
include '../../including/sql_connection.php';

if(
    $_POST['module_id'] != '' &&
    $_POST['title'] != ''
    ){

    $module_id = mysqli_real_escape_string($con, $_POST['module_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);

    if(preg_match('/\s/', $module_id)){
        error('Username cannot have spaces!');
    }

    $sql = "SELECT * FROM module WHERE module_id='$module_id';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error('MODULE ID not available');
    }


    $sql = "INSERT INTO module(module_id, title) VALUES ('$module_id','$title');";
    if(mysqli_query($con, $sql)){
        success('Module created!');
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
