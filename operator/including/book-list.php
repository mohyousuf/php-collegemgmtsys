<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$search = mysqli_real_escape_string($con, $_POST['search']);
$sql = "SELECT * FROM book WHERE isbn LIKE '%$search%' OR title LIKE '%$search%' OR year LIKE '%$search%' OR author LIKE '%$search%'";
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $isbn = mysqli_real_escape_string($con, $row['isbn']);
    $sql = "SELECT * FROM student_book WHERE isbn='$isbn'";
    $borrowResult = mysqli_query($con, $sql);
    while($borrowRow = mysqli_fetch_assoc($borrowResult)){
        $row['borrowers'][] = $borrowRow;
    }
    $arr[] = $row;
}

exit(json_encode($arr));
