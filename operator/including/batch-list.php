<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT batch_id,batch.course_id,CONCAT(batch.course_id,' : ',course.title) AS course FROM batch INNER JOIN course ON batch.course_id=course.course_id WHERE batch_id LIKE '%$search%' OR batch.course_id LIKE '%$search%' OR course.title LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $batch_id = mysqli_real_escape_string($con, $row['batch_id']);
    $sql = "SELECT s_uname,student.fname,student.lname,student.email FROM batch_student INNER JOIN student ON batch_student.s_uname=student.uname WHERE batch_id='$batch_id'";
    $res = mysqli_query($con, $sql);
    while($row2 = mysqli_fetch_assoc($res))
    {
        $row['students'][] = $row2;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
