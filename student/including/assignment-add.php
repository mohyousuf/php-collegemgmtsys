<?php
include '../../including/sql_connection.php';
include 'ChromePhp.php';

if (!isset($_FILES['file'])) {
    error('Please drag and drop your assignment!');
}
if (!isset($_POST['batch_id']) || $_POST['batch_id'] == 'undefined') {
    error('Please select a batch!');
}
if (!isset($_POST['module_id']) || $_POST['module_id'] == 'undefined') {
    error('Please select a module!');
}
if (!isset($_POST['s_uname'])) {
    error('Oops! Something went wrong!');
}
if (!isset($_POST['title']) || $_POST['title'] == '') {
    error('Please enter a title!');
}

$date = date("Y-m-d");
$batch_id = $_POST['batch_id'];
$module_id = $_POST['module_id'];
$s_uname = $_POST['s_uname'];
$title = $_POST['title'];
//$fileLoc = "../../assignments/" . $batch_id . '_' . $module_id . '_' . $s_uname . '_' . $title;
$ext = explode('.', $_FILES['file']['name']);
$fileName = $batch_id . '_' . $module_id . '_' . $s_uname . '_' . $title . '.' . end($ext);
$fileLoc = "../../assignments/" . $fileName;

if (file_exists($fileLoc)) {
    error('You have already uploaded this assignment!');
}

$sql = "SELECT * FROM assignment WHERE s_uname='$s_uname' AND title='$title' AND batch_id='$batch_id' AND module_id='$module_id'";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) > 0){
    error('You have already uploaded this assignment!');
}


$sql = "INSERT INTO assignment(batch_id,module_id,s_uname,title,file, date)
VALUES ('$batch_id','$module_id','$s_uname','$title','$fileName','$date')";
ChromePhp::log($sql);
if(mysqli_query($con, $sql)){
    move_uploaded_file($_FILES['file']['tmp_name'], $fileLoc);
    success('Assignment uploaded!');
}

function error($message){
    $arr = ["error" => "$message"];
    exit(json_encode($arr));
}
function success($message){
    $arr = ["success" => "$message"];
    exit(json_encode($arr));
}
