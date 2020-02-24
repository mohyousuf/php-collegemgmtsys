<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['id'] != '' &&
    $_POST['title'] != '' &&
    $_POST['module_id'] != ''
    ){

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $module_id = mysqli_real_escape_string($con, $_POST['module_id']);

    $sql = "UPDATE material SET title='$title',module_id='$module_id' WHERE id='$id'";
    ChromePhp::log($sql);
    if(mysqli_query($con, $sql)){
        success('Material updated!');
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
