<?php
include '../../including/sql_connection.php';

if(
    $_POST['batch_id'] != '' &&
    $_POST['course_id'] != ''
    ){

    $batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);

    if(preg_match('/\s/', $batch_id)){
        error('BATCH ID cannot have spaces!');
    }

    $sql = "SELECT * FROM batch WHERE batch_id='$batch_id';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error("BATCH ID is not available");
    }

    
    $sql = "INSERT INTO batch(batch_id, course_id) VALUES ('$batch_id','$course_id');";
    if(mysqli_query($con, $sql)){
        success('Batch created!');
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
