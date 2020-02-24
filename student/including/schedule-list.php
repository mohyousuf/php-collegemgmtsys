<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT schedule.batch_id,schedule.day,schedule.time,CONCAT(lecturer.fname,' ',lecturer.lname)AS lecturer
FROM schedule
INNER JOIN batch_student ON batch_student.batch_id=schedule.batch_id
INNER JOIN lecturer ON schedule.l_uname=lecturer.uname
WHERE batch_student.s_uname='$uname' AND (
schedule.batch_id LIKE '%$search%' OR
schedule.day LIKE '%$search%' OR
schedule.time LIKE '%$search%' OR
lecturer.lname LIKE '%$search%' OR
lecturer.fname LIKE '%$search%'
)
";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
