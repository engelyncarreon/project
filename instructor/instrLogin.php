<!DOCTYPE html>
<html lang="en">

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

        require('database/db.php');
        session_start();

        if(isset($_POST['submit'])){

            $username = stripslashes($_POST['username']);
            $username = mysqli_real_escape_string($con,$username); 
            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($con,$password);

            $query = "SELECT instr_username, instr_password, instr_status FROM instructor WHERE instr_username = '$username' and instr_password = '".md5($password)."'";

            $result = mysqli_query($con,$query) or die (mysql_error());
            $rows = mysqli_num_rows($result);

            $resultStat = mysqli_query($con,$query);
            $result2 = mysqli_fetch_assoc($resultStat);
            $status = $result2 ['instr_status'];

            if($rows == 1 && $status == 'Activate'){

                $_SESSION['instr_username'] = $username;
                $_SESSION['instr_password'] = $password;
                header("Location:pages/instrDashboard.php");

            }else if ($rows==1 && $status=='Deactivate'){

                echo "<div class = 'ban'>

                        <div class = 'icon'> 

                            <i class = 'fa fa-times-circle-o fa-5x'></i>

                        </div>

                        Your account has been deactivated by the admin. <br/>

                        <a href = 'instrLogin.php'><i class = 'fa fa-arrow-circle-left'></i>Back</a>

                      </div>";
                

                }else{

                    echo "<div class = 'ban'>

                            <div class = 'icon'> 

                                <i class = 'fa fa-times-circle fa-5x'></i>

                            </div>

                            Your username and password is incorrect.</h3><br/>Click here to <a href = 'instrLogin.php'><i class = 'fa fa-sign-in'></i> Login</a> again

                            </div>";

                }

        }else{

        ?>

        <div class="module login form-module">

            <div class="cta">

                <h2>Login to your account</h2>

                 <form action="instrLogin.php" method = "POST">

                    <input type="text" name="username" placeholder="Username" required />

                    <input type="password" name="password" placeholder="Password" required />

                    <input id = "button" type="submit" name="submit" value = "Login">

                </form>

                <div class="cta">Don't have an account?<a href="instrSignUp.php"> Register</a> Here</div>

            </div>

        </div>

        <?php } ?>

    </body>

</html>