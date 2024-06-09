<?php
session_destroy();
session_start();
include('includes/connection.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $un = $_POST['username'];
    if (!preg_match ("/^[a-zA-z][a-zA-z0-9]+$/", $un) ) {  
        $ErrMsg = "<p style='color:red; font-size:20px;'>Username must be at least 2 characters.</p>";
        $_SESSION['error'] = $ErrMsg;
        header("Location: signup.php");
        exit();
    }
    $email = $_POST['email'];
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";  
    if (!preg_match ($pattern, $email) ){  
        $ErrMsg = "<p style='color:red; font-size:20px;'>Email is not valid.</p>";  
        $_SESSION['error'] = $ErrMsg;
        header("Location: signup.php");
        exit();
    }
    $password = $_POST['password'];
    $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/";
    if(!preg_match($pattern,$password)){  
        $ErrMsg = "<p style='color:red; font-size:20px;'>Password must be at least 4 characters and must contain a letter and a number.</p>";
        $_SESSION['error'] = $ErrMsg;
        header("Location: signup.php");
        exit();
    }
    $confirmpass = $_POST['confirmpass'];
    if($password != $confirmpass){
        $ErrMsg = "<p style='color:red; font-size:20px;'>Passwords must match.</p>";
        $_SESSION['error'] = $ErrMsg;
        header("Location: signup.php");
        exit();
    }
    $query = "SELECT * FROM users WHERE username = '$un'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $ErrMsg = "<p style='color:red; font-size:20px;'>Username already exists. Please choose a unique one.</p>";
        $_SESSION['error'] = $ErrMsg;
        header("Location: signup.php");
        exit();
    } else {
        $qry = "INSERT INTO users (username, email, password) VALUES ('$un', '$email', '$password')";
        $res = mysqli_query($conn, $qry);
        if(!$res){
            $ErrMsg = "<p style='color:red; font-size:20px;'>Cannot signup. Try again!</p>";
            $_SESSION['error'] = $ErrMsg;
            header("Location: signup.php");
            exit();
        } else {
            $success = "<p style='color:green; font-size:20px;'>Signup successful! Now login.</p>";
            $_SESSION['signupsuccess'] = $success;
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="external.css">
</head>
<body>
<?php include('includes/header.php'); ?>
<br>
<link rel="stylesheet" href="external.css">


<div class="content">
    <form action="" method="POST" onsubmit="return validateform()">
        <div class="form-group">
            Username <br><input type="text" name="username" id="uname">
            <span id="unerror" class="error-message error"></span>
        </div>
        <br>
        <div class="form-group">
            Email <br> <input type="text" name="email" id="email">
            <span id="emailerror" class="error-message error"></span>
        </div>
        <br>
        <div class="form-group">
            Password <br><input type="password" name="password" id="password">
            <span id="passworderror" class="error-message error"></span>
        </div>
        <br>
        <div class="form-group">
            Confirm Password <br><input type="password" name="confirmpass" id="confirmpass">
            <span id="confirmpasserror" class="error-message error"></span>
        </div>
        <br>
        <input class="btn" type="submit" value="signup">
    </form>
    <br>
    Already Have an Account? <a href="login.php">LogIn</a>
</div>

<script>
    function clearerrors(){
        let errors = document.getElementsByClassName("error");
        for (let items of errors){
            items.innerHTML = "";
        }
    }

    function seterrors(id, error){
        let element = document.getElementById(id);
        element.innerHTML = error;
    }

    function validateform(){
        let returnval = true;
        clearerrors();
        const unvalue = document.getElementById("uname").value;
        if(unvalue.length < 2){
            seterrors("unerror","*Username must have at least 2 characters.");
            returnval = false;
        }

        const emailvalue = document.getElementById("email").value;
        if(!emailvalue.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)){
            seterrors("emailerror","*Email is not valid.");
            returnval = false;
        }

        const passwordvalue = document.getElementById("password").value;
        if(!passwordvalue.match(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/)){
            seterrors("passworderror","*Password must contain one letter and one number.");
            returnval = false;
        }
        if(passwordvalue.length < 4){
            seterrors("passworderror","*Password must have at least 4 characters.");
            returnval = false;
        }
        const confirmpassvalue = document.getElementById("confirmpass").value;
        if(passwordvalue != confirmpassvalue){
            seterrors("confirmpasserror","*Passwords must match.");
            returnval = false;
        }

        return returnval;
    }
</script>
</body>
</html>
