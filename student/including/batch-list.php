<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT batch_student.batch_id,course.duration,CONCAT(course.course_id,' : ',course.title) AS course FROM batch_student INNER JOIN batch ON batch_student.batch_id=batch.batch_id INNER JOIN course ON batch.course_id=course.course_id WHERE s_uname='$uname' AND (batch.batch_id LIKE '%$search%' OR course.course_id LIKE '%$search%' OR course.title LIKE '%$search%' OR course.duration LIKE '%$search%')";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
