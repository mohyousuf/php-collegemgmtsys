<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if(
    $_POST['isbn'] != '' &&
    $_POST['newisbn'] != '' &&
    $_POST['title'] != '' &&
    $_POST['year'] != '' &&
    $_POST['author'] != '' &&
    $_POST['qty'] != ''
    ){

    $isbn = mysqli_real_escape_string($con, $_POST['isbn']);
    $newisbn = mysqli_real_escape_string($con, $_POST['newisbn']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $qty = mysqli_real_escape_string($con, $_POST['qty']);

    //Check if new username containes whitespace
    if(preg_match('/\s/', $newisbn)){
        error('ISBN cannot have spaces!');
    }

    if(!is_numeric($qty) || $qty < 0){
        error('Please enter a valid quantity');
    }

    //Check if a new username is entered
    if($isbn != $newisbn){
        $sql = "SELECT * FROM book WHERE isbn='$newisbn';";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            error('ISBN number is not available');
        }
    }


    $sql = "UPDATE book SET isbn='$newisbn',title='$title',year='$year',author='$author',qty='$qty' WHERE isbn='$isbn'";
    ChromePhp::log($sql);
    if(mysqli_query($con, $sql)){
        success('Book updated!');
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
