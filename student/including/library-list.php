<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT * FROM book
WHERE (book.isbn LIKE '%$search%' OR
book.year LIKE '%$search%' OR
book.title LIKE '%$search%' OR
book.author LIKE '%$search%' OR
book.qty LIKE '%$search%')";

ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
