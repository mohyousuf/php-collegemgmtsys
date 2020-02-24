<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT * FROM lecturer WHERE uname LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $uname = mysqli_real_escape_string($con, $row['uname']);
    $sql = "SELECT * FROM schedule WHERE l_uname='$uname'";
    $scheduleResult = mysqli_query($con, $sql);
    while($scheduleRow = mysqli_fetch_assoc($scheduleResult)){
        $row['schedule'][] = $scheduleRow;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
