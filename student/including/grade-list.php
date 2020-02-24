<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT grade.batch_id,CONCAT(course.course_id,' : ',course.title)AS course,
CONCAT(module.module_id,' : ',module.title)AS module,grade FROM grade
INNER JOIN batch ON grade.batch_id=batch.batch_id
INNER JOIN course ON batch.course_id=course.course_id
INNER JOIN module ON grade.module_id=module.module_id
WHERE grade.s_uname='$uname' AND (
course.course_id LIKE '%$search%' OR
course.title LIKE '%$search%' OR
module.module_id LIKE '%$search%' OR
module.title LIKE '%$search%' OR
grade LIKE '%$search%' OR
grade.batch_id LIKE '%$search%')";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));

