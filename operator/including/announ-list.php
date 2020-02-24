<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT * FROM announcement WHERE id LIKE '%$search%' OR title LIKE '%$search%' OR msg LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
