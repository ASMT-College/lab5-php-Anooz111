<?php
include 'includes/connection.php';
session_start();
if(isset($_SESSION['signupsuccess'])){
    echo "<p>" . $_SESSION['signupsuccess'] . "</p>";
    unset($_SESSION['signupsuccess']);
}
if(isset($_SESSION['loginerror'])){
    echo "<p>" . $_SESSION['loginerror'] . "</p>";
    unset($_SESSION['loginerror']);
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    header("Location: ./dashboard.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $un = $_POST['username'];
    $pass = $_POST['password'];
    $query = "SELECT * FROM users WHERE username='$un' AND password='$pass'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $_SESSION['login'] = 1;
        header("Location: dashboard.php");
        exit();
    }else{
        $ErrMsg = "Enter a valid username or password";
        $_SESSION['loginerror'] = $ErrMsg;
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="stylesheet" href="external.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content">
        <form action="" method="POST" onsubmit="return validate()">
            <div class="username">
                Username: <br><input type="text" name="username" id="username">
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
            <input class="btn" type="submit" value="login" name="login_submit">
        </form>
    </div>

    <script>
        function validate() {
            var usernameValue = document.getElementById('username').value;
            var passwordValue = document.getElementById('password').value;
            var valid = true;

            if (!usernameValue) {
                document.getElementById('userError').innerText = 'Username is required';
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
