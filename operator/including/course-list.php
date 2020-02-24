<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT * FROM course WHERE course_id LIKE '%$search%' OR title LIKE '%$search%' OR duration LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $row['module'] = array();
    $course_id = mysqli_real_escape_string($con, $row['course_id']);
    $sql = "SELECT * FROM course_module INNER JOIN module ON course_module.module_id=module.module_id WHERE course_id='$course_id'";
    $result2 = mysqli_query($con, $sql);
    while($row2 = mysqli_fetch_assoc($result2)){
        $row['module'][] = $row2;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
