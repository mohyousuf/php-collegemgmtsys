<?php
$host='';
$username='root';
$password='';
$dbname='cms';
$con = mysqli_connect($host,$username,$password,$dbname);
if(!$con){
    die(mysqli_connect_error());
}
