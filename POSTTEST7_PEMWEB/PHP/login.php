<?php
session_start();
require 'conn.php'; 
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result  = mysqli_query($conn,"SELECT * from user WHERE username = '$username' ");
    if(mysqli_num_rows($result) > 0){
        $row  = mysqli_fetch_assoc($result);
        
        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            header("location:dashboard.php");
            exit;   
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>➳ Login Page</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="form">
        <img src="../assets-landpage/background.png" alt="">
        <div class="form-container">
            <h1>Log In</h1><br><hr>
            <?php
            if(isset($error)){
                echo "<p style='color:red';> Incorrect username or password </p>";
            }?>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username" class="textfield" required>
                <input type="password" name="password" placeholder="Password" class="textfield" required><br>
                <div class="remember">
                    <input type="checkbox" name="remember" value="true">
                    <label for="remember">Remember This Username</label>
                </div>
                <input type="submit" name="login" value="Masuk" class="login-btn">
            </form>
        </div>
    </div>
</body>
</html>