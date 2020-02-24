<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['isbn'] != '' &&
    $_POST['title'] != '' &&
    $_POST['year'] != '' &&
    $_POST['author'] != '' &&
    $_POST['qty'] != ''
    ){

    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);

    if(preg_match('/\s/', $isbn)){
        error('ISBN cannot have spaces!');
    }

    if(!is_numeric($qty) || $qty < 0){
        error('Please enter a valid quantity');
    }

    $sql = "SELECT * FROM book WHERE isbn='$isbn';";
    $query = mysqli_query($con, $sql);
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        ChromePhp::log($row['isbn']);
        error('ISBN number is not available');
    }


    $sql = "INSERT INTO book(isbn, title, author, year, qty) VALUES ('$isbn','$title','$author','$year','$qty');";
    if(mysqli_query($con, $sql)){
        success('Book created!');
    }
    else
    {
        error(mysqli_error($con));
    }
}
else
{
    error('You must fill all the required fields...');
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}

?>
