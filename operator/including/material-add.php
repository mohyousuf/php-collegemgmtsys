<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if (!isset($_FILES['file'])) {
    error('Please drag and drop the material!');
}
if (!isset($_POST['module_id']) || $_POST['module_id'] == 'undefined') {
    error('Please select a module!');
}
if (!isset($_POST['title']) || $_POST['title'] == '') {
    error('Please enter a title!');
}


$module_id = $_POST['module_id'];
$title = $_POST['title'];

$ext = explode('.', $_FILES['file']['name']);
$fileName = $module_id . '_' . $title . '.' . end($ext);
$fileLoc = "../../materials/" . $fileName;

if (file_exists($fileLoc)) {
    error('Material already exists!');
}

$sql = "SELECT * FROM material WHERE title='$title' AND module_id='$module_id'";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) > 0){
    error('Material already exists!');
}


$sql = "INSERT INTO material(module_id,title,file)
VALUES ('$module_id','$title','$fileName')";
if(mysqli_query($con, $sql)){
    move_uploaded_file($_FILES['file']['tmp_name'], $fileLoc);
    success('success');
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}
