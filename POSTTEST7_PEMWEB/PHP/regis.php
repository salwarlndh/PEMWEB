<?php
require 'conn.php';

if(isset($_POST['regis'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    if($password == $cpassword){
        $password = password_hash($password,PASSWORD_DEFAULT);
        $result  = mysqli_query($conn,"SELECT username from user WHERE username = '$username' ");
        if(mysqli_fetch_assoc($result)){
            echo "<script> alert('Account Already Exists');
            document.location.href='login.php';
            </script>";
        }else{
            $sql = "INSERT INTO user VALUES ('','$username','$password')";
            $result_query = mysqli_query($conn,$sql);

            if(mysqli_affected_rows($conn) > 0){
                echo "<script> alert( 'Successfully Registered');
            document.location.href='login.php';
            </script>";
            }else{
                echo "<script> alert( 'Failed Register');
                document.location.href='regis.php';
                </script>";
            }
        }
    }else{
        echo "<script> alert('Incorrect Password !!!');
        document.location.href='regis.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title> ➳ Sign Up</title>
</head>


<body>
    <div class="form">
        <img src="../assets-landpage/background.png" alt="">
        <div class="form-container">
            <h1>Sign Up</h1><br><hr>
            
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" class="textfield">
                <input type="password" name="password" placeholder="Password" class="textfield">
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" autocomplete="off" class="textfield" required>
                <button type="submit" name="regis" class="login-btn">Register</button><br>
                <h5>Already have an account?  <a href=login.php>Log In</a></h5>
            </form>
        </div>
    </div>
</body>

</html>