<?php
include 'sql_connection.php';
include 'ChromePhp.php';

if($_POST['username'] == '')
{
    error('Please enter your username');
}
if($_POST['password'] == '')
{
    error('Please enter your password');
}
if($_POST['choice'] == '')
{
    error('Please select your role');
}

//PRONE TO SQL INJECTION 
/*$username = $_POST['username'];
$password = $_POST['password'];
$choice = $_POST['choice'];
*/

//PREVENT SQL INJECTION
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$choice = mysqli_real_escape_string($con, $_POST['choice']);

$sql = "SELECT * FROM $choice WHERE uname='$username' AND pass='$password'";
ChromePhp::log($sql);
$res = mysqli_query($con,$sql);
if(!mysqli_num_rows($res) > 0){
    error('Invalid username or password');
}
else
{
    session_start();
    if($choice == 'student'){
        $_SESSION['student_username'] = $username;
    }
    else if($choice == 'operator'){
        $_SESSION['operator_username'] = $username;
    }
    else if($choice == 'lecturer'){
        $_SESSION['lecturer_username'] = $username;
    }
    success($choice);
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}