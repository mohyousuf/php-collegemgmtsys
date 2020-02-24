<?php
include '../../including/sql_connection.php';

if(
    $_POST['fname'] != '' &&
    $_POST['lname'] != '' &&
    $_POST['dob'] != '' &&
    $_POST['address'] != '' &&
    $_POST['email'] != '' &&
    $_POST['phone'] != '' &&
    $_POST['uname'] != '' &&
    $_POST['pass'] != '' &&
    $_POST['batch'] != ''
    ){

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $batch = explode(',', mysqli_real_escape_string($con, $_POST['batch']));

    if(preg_match('/\s/', $uname)){
        error('Username cannot have spaces!');
    }
    if(preg_match('/\s/', $pass)){
        error('Password cannot have spaces!');
    }

    $sql = "SELECT * FROM student WHERE uname='$uname';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error('USERNAME not available');
    }

    for($i=0; $i < count($batch); $i++)
    {
        $trimmedBatch = trim($batch[$i]);
        $sql = "SELECT * FROM batch WHERE batch_id='$trimmedBatch';";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) == 0)
        {
            error("Batch '$trimmedBatch' does not exist!");
        }
    } 

    $sql = "INSERT INTO student(fname, lname, dob, address, email, phone, uname, pass) VALUES ('$fname','$lname','$dob','$address','$email','$phone','$uname','$pass');";
    if(mysqli_query($con, $sql)){
        for($i=0; $i < count($batch); $i++)
        {
            $trimmedBatch = trim($batch[$i]);
            $sql = "INSERT INTO batch_student(batch_id, s_uname) VALUE ('$trimmedBatch','$uname');";
            mysqli_query($con, $sql);              
        } 
        success('Student created!');
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
