<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT assignment.*,assignment.batch_id AS batch,
CONCAT(assignment.module_id,' : ',module.title)AS module,
CONCAT(student.fname,' ',student.lname,' (',student.uname,')')AS student,
assignment.title AS title,
assignment.date,
assignment.file
FROM `assignment`
JOIN batch ON assignment.batch_id=batch.batch_id
JOIN course ON batch.course_id=course.course_id
JOIN module ON assignment.module_id=module.module_id
JOIN student ON assignment.s_uname=student.uname
WHERE assignment.batch_id LIKE '%$search%' OR
assignment.title LIKE '%$search%' OR
assignment.date LIKE '%$search%' OR
assignment.module_id LIKE '%$search%' OR
course.title LIKE '%$search%' OR
course.course_id LIKE '%$search%' OR
module.title LIKE '%$search%' OR
student.uname LIKE '%$search%' OR
student.fname LIKE '%$search%' OR
student.lname LIKE '%$search%'
";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
