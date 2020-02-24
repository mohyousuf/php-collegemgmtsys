<?php
session_start();
if(isset($_SESSION['student_username'])){
    Header('Location: student/dashboard.php');
}
else if(isset($_SESSION['lecturer_username'])){
    Header('Location: lecturer/dashboard.php');
}
else if(isset($_SESSION['operator_username'])){
    Header('Location: operator/dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="favicon.png" />
    <title>College Management System</title>
    <style>
        *
        {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        section
        {
            border-radius: 10px;
            box-shadow: 0px 0px 41px -2px #e4e4e4;
            max-width: 400px;
            width: 60%;
            margin: 0;
            overflow: hidden;
            padding: 50px;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-40%);
        }
        span
        {
            text-align: center;
            width: 100%;
            display: block;
        }
        label
        {
            display: block;
            font-size: 13px;
            font-weight: 500;
        }
        input
        {
            padding: 12px 16px;
            outline: 0;
            border: 0;
        }
        input[type=text],input[type=password]
        {
            all: unset;
            padding: 12px 16px;
            font-size: 13px;
            border-bottom: 3px solid #eeeeee;
            border-radius: 2px;
            transition: border-bottom .3s;
            width: 100%;
            box-sizing: border-box;
        }
        input[type=text]:focus,input[type=password]:focus
        {
            border-bottom: 3px solid rgb(9, 205, 240);
        }

        input[type=radio]
        {
            appearance: none;
            -webkit-appearance: none;
            border-radius: 10px;
            font-weight: 500;
            background: rgb(233, 233, 233);
            padding: 8px 14px;
            transition: background .3s;
        }
        input[type=radio]::before
        {
            transition: color .3s;
        }   
        input[type=radio]:hover
        {
            background: rgb(201, 201, 201);
        }
        input[type=radio]:checked::before
        {
            color: white;
        }
        input[type=radio]:checked
        {
            background:rgb(9, 205, 240);
        }
        #student::before
        {
            content: 'STUDENT';
        }
        #lecturer::before
        {
            content: 'LECTURER';
        }
        #operator::before
        {
            content: 'OPERATOR';
        }
        button
        {
            width: 100%;
            outline: 0;
            border: 0;
            background: rgb(43, 43, 43);
            padding: 18px;
            font-size: 15px;
            font-weight: 800;
            position: absolute;
            bottom: 0;
            left: 0;
            color: white;
            cursor: pointer;
            transition: background .3s;
        }
        button:hover
        {
            background:rgb(9, 205, 240);

        }
        #logo
        {
           height: 65px;
           padding-top: 35px;
           display: block;
           margin: auto;
        }
    </style>
</head>
<body>

    <div class="message-wrapper">
        
    </div>

    <br>
    <img id='logo' src="logo.png">
          
    <section>
        <label for="un">USERNAME</label>
        <input type="text" id='un' name='username'>
        <br><br><br>
        <label for="pw">PASSWORD</label>
        <input type="password" id='pw' name='password'>
        <br><br><br>
        <span>
            <input type="radio" checked name="choice" id="student">
            <input type="radio" name="choice" id="lecturer">
            <input type="radio" name="choice" id="operator">
        </span>
        <br><br><br>
        <button>LOGIN</button>
    </section>

    <script >



    function sqlQuery(url, values, onload){
        let request = new XMLHttpRequest();
        request.open('POST',url,true);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        let sendString = '';
        for(let x = 0; x < Object.keys(values).length; x++){
            sendString += Object.keys(values)[x] + '=' + values[Object.keys(values)[x]];
            if(x != Object.keys(values).length - 1)
            {
            sendString += '&';
            }
        }
        request.send(sendString);
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
            response = JSON.parse(request.response);
            onload();
            }
        }
        this.response;
    }

    function showError(message) {
        var wrapper = document.querySelector('.message-wrapper');
        var panel = document.createElement('div');
        panel.textContent = message;
        panel.className = 'error';
        panel.addEventListener('animationend', function(event){
            event.target.remove();
        });
        wrapper.appendChild(panel);
    }

    function showSuccess(message) {
        var wrapper = document.querySelector('.message-wrapper');
        var panel = document.createElement('div');
        panel.textContent = message;
        panel.className = 'success';
        panel.addEventListener('animationend', function(event){
            event.target.remove();
        });
        wrapper.appendChild(panel);
    }

    document.querySelector('button').onclick = login;

    document.querySelectorAll('[name=username],[name=password],[name=choice]').forEach(item =>{
        item.onkeydown = e => {
            if(e.keyCode == 13){
                login();
            }
        }
    });


    function login(){
        ob = {
            username: document.querySelector('[name=username]').value,
            password: document.querySelector('[name=password]').value,
            choice: document.querySelector('[name=choice]:checked').id
        }

        sqlQuery('including/login.php', ob,()=>{
            if(response.error){
                showError(response.error);
            }else if(response.success)
            {
                switch(response.success){
                    case 'student': location.assign('student/dashboard.php'); break;
                    case 'lecturer': location.assign('lecturer/dashboard.php'); break;
                    case 'operator': location.assign('operator/dashboard.php'); break;
                }
            }
        });
    }

    </script>
</body>
</html>


<?php
    if(isset($_GET['updated'])){
        echo '<script>showSuccess("Your details have been updated, please login again.")</script>';
    }
?>
