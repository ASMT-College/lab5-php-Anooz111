<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="external.css">
</head>
<body>
<?php
 include('includes/header.php'); 
 ?>
<br>

<div class="content">
    <form action="" method="POST" onsubmit="return validate()">
        <div class="form-group">
            Username <br><input type="text" name="username" id="username">
            <span id="userError" class="error-message"></span>
        </div>
        <br>
        <div class="form-group">
            Email <br> <input type="text" name="email" id="email">
            <span id="emailError" class="error-message"></span>
        </div>
        <br>
        <div class="form-group">
            Password <br><input type="password" name="password" id="password">
            <span id="passError" class="error-message"></span>
        </div>
        <br>
        <div class="form-group">
            DOB <br><input type="date" name="dob" id="dob">
            <span id="dobError" class="error-message"></span>
        </div>
        <br>
        <input class="btn" type="submit" value="signup">
    </form>
    <br>
    Already Have an Account? <a href="login.php">LogIn</a>
</div>

<script>
    function validate() {
        var usernameValue = document.getElementById('username').value;
        var emailValue = document.getElementById('email').value;
        var passwordValue = document.getElementById('password').value;
        var dobValue = document.getElementById('dob').value;
        var valid = true;

        // Email regex pattern
        var emailPattern = /^[0-9a-zA-Z._%+-]+@[0-9a-zA-Z.-]+\.[a-zA-Z]{2,}$/gm;

        if (!usernameValue) {
            document.getElementById('userError').innerText = 'Username is required';
            valid = false;
        } else if (usernameValue.length < 4) {
            document.getElementById('userError').innerText = 'Username must be at least 4 characters';
            valid = false;
        } else {
            document.getElementById('userError').innerText = '';
        }

        if (!emailValue) {
            document.getElementById('emailError').innerText = 'Email is required';
            valid = false;
        } else if (!emailPattern.test(emailValue)) {
            document.getElementById('emailError').innerText = 'Enter a valid email address';
            valid = false;
        } else {
            document.getElementById('emailError').innerText = '';
        }

        if (!passwordValue) {
            document.getElementById('passError').innerText = 'Password is required';
            valid = false;
        } else {
            document.getElementById('passError').innerText = '';
        }

        if (!dobValue) {
            document.getElementById('dobError').innerText = 'DOB is required';
            valid = false;
        } else {
            document.getElementById('dobError').innerText = '';
        }

        return valid;
    }
</script>
</body>
</html>
