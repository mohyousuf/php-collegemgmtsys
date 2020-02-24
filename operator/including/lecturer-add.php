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
    $_POST['pass'] != ''
    ){

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if(preg_match('/\s/', $uname)){
        error('Username cannot have spaces!');
    }
    if(preg_match('/\s/', $pass)){
        error('Password cannot have spaces!');
    }

    $sql = "SELECT * FROM lecturer WHERE uname='$uname';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        error('USERNAME not available');
    }


    $sql = "INSERT INTO lecturer(fname, lname, dob, address, email, phone, uname, pass) VALUES ('$fname','$lname','$dob','$address','$email','$phone','$uname','$pass');";
    if(mysqli_query($con, $sql)){
        success('Lecturer created!');
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
