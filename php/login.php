<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="external.css">
</head>
<body>
<?php
include('includes/header.php'); 
?>

<div class="content">
    <form action="" method="POST" onsubmit="return validate()">
        <div class="email">
            Email: <br><input type="text" name="email" id="email">
            <span id="userError" class="error-message"></span>
        </div>
        <br>
        <div class="password">
            Password: <br> <input type="password" name="password" id="password">
            <span id="passError" class="error-message"></span>
        </div>
        <br>
        Do not have an account? <a href="signup.php">SignUp</a>
        <br><br>
        <input class="btn" type="submit" value="login">
    </form>
</div>

<script>
    function validate() {
        var emailValue = document.getElementById('email').value;
        var passwordValue = document.getElementById('password').value;
        var valid = true;

    
        var emailPattern = /^[0-9a-zA-Z._%+-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,}$/gm;

        if (!emailValue) {
            document.getElementById('userError').innerText = 'Email is required';
            valid = false;
        } else if (!emailPattern.test(emailValue)) {
            document.getElementById('userError').innerText = 'Enter a valid email address';
            valid = false;
        } else {
            document.getElementById('userError').innerText = '';
        }

        if (!passwordValue) {
            document.getElementById('passError').innerText = 'Password is required';
            valid = false;
        } else {
            document.getElementById('passError').innerText = '';
        }

        return valid;
    }
</script>
</body>
</html>
