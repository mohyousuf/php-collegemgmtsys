<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $sql = "SELECT student_book.isbn,student_book.s_uname,CONCAT(book.title,' (',student_book.isbn,')')AS book, CONCAT(student.fname,' ',student.lname,' (',student_book.s_uname,')') AS student, student_book.date FROM student_book
    INNER JOIN book ON student_book.isbn = book.isbn
    INNER JOIN student ON student_book.s_uname = student.uname
    WHERE student_book.isbn LIKE '%$search%' OR s_uname LIKE '%$search%' OR date LIKE '%$search%'
    OR student.fname LIKE '%$search%' OR student.lname LIKE '%$search%' OR book.title LIKE '%$search%'";
}
if(isset($_POST['isbn'])){
    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $sql = "SELECT student_book.isbn,student_book.s_uname,CONCAT(book.title,' (',student_book.isbn,')')AS book, CONCAT(student.fname,' ',student.lname,' (',student_book.s_uname,')') AS student, student_book.date FROM student_book
    INNER JOIN book ON student_book.isbn = book.isbn
    INNER JOIN student ON student_book.s_uname = student.uname
    WHERE student_book.isbn = '$isbn'";
}

$result = mysqli_query($con, $sql);

$arr = array();
while($row = mysqli_fetch_assoc($result))
{
    $arr[] = $row;
}

exit(json_encode($arr));
