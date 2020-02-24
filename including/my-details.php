<?php
include 'sql_connection.php';

$user = mysqli_real_escape_string($con, $_POST['user']);
$uname = mysqli_real_escape_string($con, $_POST['uname']);

if($user == 'operator')
{
    $sql = "SELECT * FROM operator WHERE uname='$uname'";
}
else if($user == 'student')
{
    $sql = "SELECT * FROM student WHERE uname='$uname'";
}
else if($user == 'lecturer')
{
    $sql = "SELECT * FROM lecturer WHERE uname='$uname'";
}
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
