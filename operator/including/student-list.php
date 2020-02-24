<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT * FROM student WHERE uname LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $uname = mysqli_real_escape_string($con, $row['uname']);
    $sql = "SELECT * FROM batch_student WHERE s_uname='$uname'";
    $batchResult = mysqli_query($con, $sql);
    $allBatch = array();
    while($batchRow = mysqli_fetch_assoc($batchResult)){
        $allBatch[] = mysqli_real_escape_string($con, $batchRow['batch_id']);
    }
    $row['batch'] = $allBatch;
    $arr[] = $row;
}

exit(json_encode($arr));
