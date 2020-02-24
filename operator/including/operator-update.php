<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['fname'] != '' &&
    $_POST['lname'] != '' &&
    $_POST['dob'] != '' &&
    $_POST['address'] != '' &&
    $_POST['email'] != '' &&
    $_POST['phone'] != '' &&
    $_POST['uname'] != '' &&
    $_POST['newuname'] != '' &&
    $_POST['pass'] != ''
    ){

    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $newuname = mysqli_real_escape_string($con, $_POST['newuname']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    //Check if new username containes whitespace
    if(preg_match('/\s/', $newuname)){
        error('USERNAME cannot have spaces!');
    }
    //Check if password containes whitespace
    if(preg_match('/\s/', $pass)){
        error('PASSWORD cannot have spaces!');
    }

    //Check if a new username is entered
    if($uname != $newuname){
        $sql = "SELECT * FROM operator WHERE uname='$newuname';";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            error('USERNAME is not available');
        }
    }

    $sql = "UPDATE operator SET fname='$fname',lname='$lname',dob='$dob',address='$address',email='$email',phone='$phone',uname='$newuname',pass='$pass' WHERE uname='$uname'";
    if(mysqli_query($con, $sql)){
        success('Your details updated!');
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
