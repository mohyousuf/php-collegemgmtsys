<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

$uname = mysqli_real_escape_string($con, $_POST['uname']);
$search = mysqli_real_escape_string($con, $_POST['search']);

$sql = "SELECT *
FROM student_book
JOIN book ON student_book.isbn=book.isbn
WHERE student_book.s_uname='$uname'AND
(book.isbn LIKE '%$search%' OR
book.title LIKE '%$search%' OR
student_book.date LIKE '%$search%')
";
//ChromePhp::log($sql);
$result = mysqli_query($con, $sql);
$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
