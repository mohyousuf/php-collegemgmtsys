<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT material.*,
CONCAT(material.module_id,' : ',module.title)AS module
FROM material
JOIN module ON material.module_id=module.module_id
WHERE material.title LIKE '%$search%' OR
material.module_id LIKE '%$search%' OR
module.title LIKE '%$search%'";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
