<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['newmodule_id'] != '' &&
    $_POST['module_id'] != '' &&
    $_POST['title'] != ''
    ){

    $newmodule_id = mysqli_real_escape_string($con, $_POST['newmodule_id']);
    $module_id = mysqli_real_escape_string($con, $_POST['module_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);

    //Check if new username containes whitespace
    if(preg_match('/\s/', $newmodule_id)){
        error('MODULE ID cannot have spaces!');
    }

    //Check if a new username is entered
    if($module_id != $newmodule_id){
        $sql = "SELECT * FROM module WHERE module_id='$newmodule_id';";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            error('MODULE ID is not available');
        }
    }


    $sql = "UPDATE module SET module_id='$newmodule_id',title='$title' WHERE module_id='$module_id'";
    if(mysqli_query($con, $sql)){
        success('Module updated!');
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
