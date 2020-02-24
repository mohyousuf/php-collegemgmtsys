<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['batch_id'] != '' &&
    $_POST['newbatch_id'] != '' &&
    $_POST['course_id'] != ''
){

    $batch_id = mysqli_real_escape_string($con, $_POST['batch_id']);
    $newbatch_id = mysqli_real_escape_string($con, $_POST['newbatch_id']);
    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);

    //Check if new username containes whitespace
    if(preg_match('/\s/', $newbatch_id)){
        error('BATCH ID cannot have spaces!');
    }

    //Check if a new username is entered
    if($batch_id != $newbatch_id){
        $sql = "SELECT * FROM batch WHERE batch_id='$newbatch_id';";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            error('BATCH ID does not exist');
        }
    }

    $sql = "UPDATE batch SET batch_id='$newbatch_id',course_id='$course_id' WHERE batch_id='$batch_id'";
    if(mysqli_query($con, $sql)){
        success('Batch updated!');
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
