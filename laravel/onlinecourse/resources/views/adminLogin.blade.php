<?php 
        require('../../public/otherFiles/database/db.php');
         ob_start();
        session_start();

?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="UTF-8">

        <title>NTU | Admin Login</title>

        <Link rel = "stylesheet" href = "../../public/otherFiles/styles/loginAdmin.css" />

        <link rel = "stylesheet" href = "../../public/otherFiles/styles/checkError.css"/>

        <link href="../../public/otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../../public/otherFiles/image/logo/ntu-logo.png">

    </head>

    <body>

    <?php
    

        if(isset($_POST['submit'])){

            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($con,$username); 
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con,$password);

            $query = "SELECT username, password FROM `adminlogin` WHERE username = '$username' and password = '".md5($password)."'";

            $result = mysqli_query($con,$query) or die (mysql_error());
            $rows = mysqli_num_rows($result);

            if($rows == 1){

                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;

                header("Location: adminDashboard.php");

    
            } else{

                    echo "<div class = 'contentfs'>

                            <div> 

                                <i class = 'fa fa-times-circle-o fa-5x fail'></i>

                            </div>

                            Your username and password is incorrect.</h3><br/>Click here to <a href = 'adminLogin.php' class = 'fail'>Login</a> again

                            </div>";

                }

        }else{

    ?>

        <div class="logo"></div>

            <div class="login-page">

                <div class = 'form'>

                <h1>Login</h1>

                <form class = "login-form" action = "adminLogin.php" method = "POST">

                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />

                    <input id = "button" type="submit" name="submit" value = "Login">

                </form>

                </div>

            </div>

        <?php 

        } 

        ?>

    </body>

</html>