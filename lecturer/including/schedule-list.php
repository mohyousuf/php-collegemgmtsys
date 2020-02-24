<?php
include '../../including/sql_connection.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT * FROM schedule WHERE l_uname='$uname' AND
(day LIKE '%$search%' OR
time LIKE '%$search%' OR
batch_id LIKE '%$search%'
)";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $batch = mysqli_real_escape_string($con, $row['batch_id']);
    $sql = "SELECT student.uname,student.fname,student.lname,student.email FROM schedule
    INNER JOIN batch_student ON schedule.batch_id=batch_student.batch_id
    INNER JOIN student ON batch_student.s_uname=student.uname
    WHERE schedule.batch_id='$batch'";
    $res = mysqli_query($con,$sql);
    while($row2 = mysqli_fetch_assoc($res))
    {
        $row['students'][] = $row2;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
