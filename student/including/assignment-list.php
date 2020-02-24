<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT CONCAT(assignment.batch_id,' (',course.course_id,' : ',course.title,')')AS batch,
CONCAT(assignment.module_id,' : ',module.title)AS module,
assignment.title AS title,
assignment.date,
assignment.file
FROM `assignment`
JOIN batch ON assignment.batch_id=batch.batch_id
JOIN course ON batch.course_id=course.course_id
JOIN module ON assignment.module_id=module.module_id
WHERE assignment.s_uname='$uname' AND (
assignment.batch_id LIKE '%$search%' OR
assignment.title LIKE '%$search%' OR
assignment.date LIKE '%$search%' OR
assignment.module_id LIKE '%$search%' OR
course.title LIKE '%$search%' OR
course.course_id LIKE '%$search%' OR
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
