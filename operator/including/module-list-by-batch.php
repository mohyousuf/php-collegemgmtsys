<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$batch = mysqli_real_escape_string($con, $_POST['batch']);
$sql = "SELECT DISTINCT * FROM `module` INNER JOIN course_module ON course_module.module_id=module.module_id INNER JOIN batch ON course_module.course_id=batch.course_id WHERE batch.batch_id='$batch'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
