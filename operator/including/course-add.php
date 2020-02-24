<?php
include '../../including/sql_connection.php';

if(
    $_POST['course_id'] != '' &&
    $_POST['title'] != '' &&
    $_POST['duration'] != ''
    ){

    $course_id = mysqli_real_escape_string($con, $_POST['course_id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $module = explode(',', mysqli_real_escape_string($con, $_POST['module']));

    if(preg_match('/\s/', $course_id)){
        error('COURSE ID cannot have spaces!');
    }

    $sql = "SELECT * FROM course WHERE course_id='$course_id';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error('COURSE ID is not available');
    }

    if($_POST['module'] != ''){
        for($i=0; $i < count($module); $i++)
        {
            $trim = trim($module[$i]);
            $sql = "SELECT * FROM module WHERE module_id='$trim';";
            $query = mysqli_query($con, $sql);
            if(mysqli_num_rows($query) == 0)
            {
                error("Module '$trim' does not exist!");
            }
        } 
    }
    
    $sql = "INSERT INTO course(course_id, title, duration) VALUES ('$course_id','$title','$duration');";
    if(mysqli_query($con, $sql)){
        if($_POST['module'] != ''){
            for($i=0; $i < count($module); $i++)
            {
                $trim = trim($module[$i]);
                $sql = "INSERT INTO course_module(course_id, module_id) VALUE ('$course_id','$trim');";
                mysqli_query($con, $sql);              
            } 
        }
        success('Course created!');
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
