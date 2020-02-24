<?php
include './../including/session_check.php';
include './../including/sql_connection.php';

$iuname = $_SESSION['operator_username'];
$sql = "SELECT * FROM operator WHERE uname='$iuname'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);
$name = $row['fname'] . ' ' . $row['lname'];
echo '<script>document.username="'.$iuname.'"</script>';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>College Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../favicon.png" />
  <link rel="stylesheet" type="text/css" media="screen" href="./../style.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./../including/asap/stylesheet.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./../including/fontawesome/css/all.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./../including/select/select.css">
  <script defer src="./../including/select/select.js"></script>
</head>

<body>

<nav>
    <ul>
      <li><a href="dashboard.php">
          <span id="dashboard">DASHBOARD</span>
      </a></li>
      <li><a href="students.php">
          <span id="students">STUDENTS</span>
      </a></li>
      <li><a href="lecturers.php">
          <span id="lecturers">LECTURERS</span>
      </a></li>
      <li><a href="books.php">
        <span id="books">BOOKS</span>
      </a></li>
      <li><a href="library.php">
        <span id="mybooks">LIBRARY</span>
      </a></li>
      <li><a href="courses.php">
          <span id="courses">COURSES</span>
      </a></li>
      <li><a href="modules.php">
        <span id="modules">MODULES</span>
      </a></li>
      <li><a href="batches.php">
        <span id="batches">BATCHES</span>
      </a></li>
      <li><a href="class-schedules.php">
          <span id="classschedules">CLASS SCHEDULES</span> 
      </a></li>
      <li><a href="results.php">
        <span id="markgrades">RESULTS</span>
      </a></li>
      <li><a href="announcements.php">
        <span id="nav-announcements">ANNOUNCEMENTS</span>
      </a></li>
      <li><a href="assignments.php">
        <span id="assignments">ASSIGNMENTS</span>
      </a></li>
      <li><a href="materials.php">
        <span id="materials">MATERIALS</span>
      </a></li>
    </ul>
    <form method="GET">
      <button class="btn-light" name='signout'>SIGN OUT</button>
    </form>
</nav>

<div class="my-details-container">
  <div class="my-details-card">
    <span class="my-details-card-header">
      <?php echo $name ?>
    </span>
    <br>
    <span class="my-details-card-text">
    <?php echo $iuname ?>
    </span>
  </div>
</div>

<div id="myslider" class="slider hide">
  <div class="slider-controls">
    <h1></h1>
    <h1>EDIT MY DETAILS</h1>
    <i class="far fa-times-circle editclose"></i>
  </div>
  <div>
    <input id='fn' label='FIRST NAME' placeholder='' name="ifname" type="text" class="textbox4" placeholder="First Name">
    <input id='ln' label='LAST NAME' placeholder='' name="ilname" type="text" class="textbox4" placeholder="Last Name">
    <input id='dob' label='DATE OF BIRTH' placeholder='' name="idob" type="date" class="textbox4" placeholder="Date of Birth">
    <input id='add' label='ADDRESS' placeholder='' name="iaddress" type="text" class="textbox4" placeholder="Address">
    <input id='em' label='EMAIL' placeholder='' name="iemail" type="email" class="textbox4" placeholder="Email">
    <input id='ip' label='PHONE' placeholder='' name="iphone" type="text" class="textbox4" placeholder="Phone Number">
    <input id='un' label='USERNAME' placeholder='' name="iuname" type="text" class="textbox4" placeholder="Username">
    <input id='pas' label='PASSWORD' placeholder='' name="ipassword" type="password" class="textbox4" placeholder="Password">
  </div>
  <div>
    <button class="btn-light" name='saveme' style='width:100%'>SAVE</button>
  </div>
</div>

<script>
    var nav = document.querySelector('nav');
    var current = window.location.pathname.toString().split('/');
    current = current[current.length - 1];
    switch(current)
    {
        case 'dashboard.php': nav.childNodes[1].childNodes[1].childNodes[0].setAttribute('class','selected');
        break;
        case 'students.php': nav.childNodes[1].childNodes[3].childNodes[0].setAttribute('class','selected');
        break;
        case 'lecturers.php': nav.childNodes[1].childNodes[5].childNodes[0].setAttribute('class','selected');
        break;
        case 'books.php': nav.childNodes[1].childNodes[7].childNodes[0].setAttribute('class','selected');
        break;
        case 'library.php': nav.childNodes[1].childNodes[9].childNodes[0].setAttribute('class','selected');
        break;
        case 'courses.php': nav.childNodes[1].childNodes[11].childNodes[0].setAttribute('class','selected');
        break;
        case 'modules.php': nav.childNodes[1].childNodes[13].childNodes[0].setAttribute('class','selected');
        break;
        case 'batches.php': nav.childNodes[1].childNodes[15].childNodes[0].setAttribute('class','selected');
        break;
        case 'class-schedules.php': nav.childNodes[1].childNodes[17].childNodes[0].setAttribute('class','selected');
        break;
        case 'results.php': nav.childNodes[1].childNodes[19].childNodes[0].setAttribute('class','selected');
        break;
        case 'announcements.php': nav.childNodes[1].childNodes[21].childNodes[0].setAttribute('class','selected');
        break;
        case 'assignments.php': nav.childNodes[1].childNodes[23].childNodes[0].setAttribute('class','selected');
        break;
        case 'materials.php': nav.childNodes[1].childNodes[25].childNodes[0].setAttribute('class','selected');
        break;
    }
    document.querySelector('nav > ul').scrollTop = document.querySelector('.selected').offsetTop - 100;

    document.querySelector('[name=saveme]').onclick = () => {
      let slider = document.querySelector('.slider');
      var ob = {
        fname : document.querySelector('[name=ifname]').value,
        lname : document.querySelector('[name=ilname]').value,
        dob : document.querySelector('[name=idob]').value,
        address : document.querySelector('[name=iaddress]').value,
        email : document.querySelector('[name=iemail]').value,
        phone : document.querySelector('[name=iphone]').value,
        uname : document.username,
        newuname : document.querySelector('[name=iuname]').value,
        pass : document.querySelector('[name=ipassword').value
      };

      console.log(ob);
      sqlQuery('including/operator-update.php', ob, ()=>{
        if(response.success)
        {
          location.search = 'updated';
        }
        else if(response.error)
        {
          showError(response.error);
        }
      });
    };
</script>

