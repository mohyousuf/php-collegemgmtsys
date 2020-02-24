<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT material.*,
CONCAT(material.module_id,' : ',module.title)AS module
FROM material
JOIN course_module ON material.module_id=course_module.module_id
JOIN module ON material.module_id=module.module_id
JOIN batch ON course_module.course_id=batch.course_id
JOIN batch_student ON batch.batch_id=batch_student.batch_id
WHERE batch_student.s_uname='$uname' AND (
material.title LIKE '%$search%' OR
material.module_id LIKE '%$search%' OR
module.title LIKE '%$search%'
)";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
