<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT * FROM schedule 
INNER JOIN lecturer ON schedule.l_uname=lecturer.uname 
WHERE batch_id LIKE '%$search%' OR 
l_uname LIKE '%$search%' OR 
day LIKE '%$search%'OR 
time LIKE '%$search%' OR 
lecturer.fname LIKE '%$search%' OR 
lecturer.lname LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $batch_id = mysqli_real_escape_string($con, $row['batch_id']);
    $sql = "SELECT * FROM batch_student
    INNER JOIN student ON batch_student.s_uname=student.uname 
    WHERE batch_id='$batch_id'";
    $res = mysqli_query($con, $sql);
    while($row2 = mysqli_fetch_assoc($res))
    {   
        $row['students'][] = $row2;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
