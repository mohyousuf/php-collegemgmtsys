<?php
session_start();
$path = explode('/', $_SERVER['PHP_SELF']);
$root = $path[count($path) - 2];

if(isset($_SESSION['student_username']) && $root != 'student'){
  Header("Location: ../index.php");
}
else if(isset($_SESSION['operator_username']) && $root != 'operator'){
  Header("Location: ../index.php");
}
else if(isset($_SESSION['lecturer_username']) && $root != 'lecturer'){
  Header("Location: ../index.php");
}


if(isset($_GET['signout']))
{
  unset($_SESSION['student_username']);
  unset($_SESSION['operator_username']);
  unset($_SESSION['lecturer_username']);
  session_destroy();
}
if(isset($_SESSION['student_username']) ||
isset($_SESSION['operator_username'])  ||
isset($_SESSION['lecturer_username'])){
  
}
else
{
  Header("Location: ../index.php");
}

//Returning from updating personal details
if(isset($_GET['updated']))
{
  unset($_SESSION['student_username']);
  unset($_SESSION['operator_username']);
  unset($_SESSION['lecturer_username']);
  session_destroy();
  Header("Location: ../index.php?updated");
}


