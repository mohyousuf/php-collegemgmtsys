<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT batch_student.batch_id,CONCAT(module.module_id,' : ',module.title)AS module
FROM `batch_student`
INNER JOIN batch ON batch_student.batch_id=batch.batch_id
INNER JOIN course ON batch.course_id=course.course_id
INNER JOIN course_module ON course.course_id=course_module.course_id
INNER JOIN module ON course_module.module_id=module.module_id
WHERE batch_student.s_uname='$uname' AND (
batch_student.batch_id LIKE '%$search%' OR
module.module_id LIKE '%$search%' OR
module.title LIKE '%$search%')
";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
