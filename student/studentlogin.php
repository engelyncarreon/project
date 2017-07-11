<!DOCTYPE html>
 
<html lang="en" class="no-js">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link rel = "stylesheet" href = "styles/loginSignUp.css"/>

        <link rel = "stylesheet" href = "styles/checkError.css"/>

        <link rel = "icon" href = "image/ntu-logo.png">


    </head>

    <body>

    <?php

        require_once('database/db.php');
        session_start();

        if(isset($_POST['username'])){
            
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            if(empty($username)||empty($password )){
                echo ("Invalid username or password");

            }else{

                $query = "Select * from student where stud_username = '$username' AND stud_password = '$password'";
                $login = mysqli_query($con,$query);

                if($login){

                    $_SESSION['stud_username']= $username;
                    $_SESSION['stud_password'] = $password;//Initializing Session with value of PHP Variable 
                    header("location: pages/studentDashboard.php");

                   echo "Successful login";

                }else{

                    echo "login failed";
                    
                }
               
            }
        }
    ?>
        <div class="module login form-module">

            <div class="cta">

                <h2>Login to your account</h2>

                 <form action="studentlogin.php" method = "POST">

                    <input type="text" name="username" placeholder="Username" required />

                    <input type="password" name="password" placeholder="Password" required />

                    <input id = "button" type="submit" name="submit" value = "Login">

                </form>

                <div class="cta">Don't have an account?<a href="studentsignup.php"> Register</a> Here</div>

            </div>

        </div>

    </body>

</html>