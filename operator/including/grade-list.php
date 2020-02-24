<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT grade.module_id,batch_id,s_uname,grade,CONCAT(grade.module_id,' : ',module.title)AS module,
CONCAT(student.fname,' ',student.lname,' (',grade.s_uname,')')AS student FROM grade
JOIN module ON grade.module_id=module.module_id
JOIN student ON grade.s_uname=student.uname
WHERE batch_id LIKE '%$search%' OR 
grade.module_id LIKE '%$search%' OR
s_uname LIKE '%$search%' OR
grade LIKE '%$search%' OR
module.title LIKE '%$search%' OR
student.fname LIKE '%$search%' OR
student.lname LIKE '%$search%'
";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
