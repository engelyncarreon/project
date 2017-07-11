<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Sign Up</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="../homepage/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="../homepage/styles/style.min.css" rel="stylesheet">

        <link rel="stylesheet" href="styles/loginSignUp.css">

        <link rel="stylesheet" href="styles/checkError.css">

        <link rel = "icon" href = "image/ntu-logo.png">

    </head>

    <body>

        <?php
            require('database/db.php');
            session_start();

            if(isset($_POST['submit'])){

                $lastName = stripslashes($_REQUEST['lastName']);
                $lastName = mysqli_real_escape_string($con,$lastName);
                $firstName = stripslashes($_REQUEST['firstName']);
                $firstName = mysqli_real_escape_string($con,$firstName);
                $username = stripslashes($_REQUEST['username']);
                $username = mysqli_real_escape_string($con,$username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con,$password);
                $confirm = stripslashes($_REQUEST['confirm']);
                $email = stripslashes($_REQUEST['email']);
                $email = mysqli_real_escape_string($con,$email);
                $address = stripslashes($_REQUEST['address']);
                $address = mysqli_real_escape_string($con,$address);
                $contactno = stripslashes($_REQUEST['contactno']);
                $contactno = mysqli_real_escape_string($con,$contactno);
                $gender = stripslashes($_REQUEST['gender']);
                $gender = mysqli_real_escape_string($con,$gender);
                $age = stripslashes($_REQUEST['age']);
                $age = mysqli_real_escape_string($con,$age);

                if($password == $confirm){

                  $query1 = "SELECT * FROM instructor where (instr_email = '$email')";
                  $sql1 = mysqli_query($con,$query1);
                  $rows = mysqli_num_rows($sql1);

                  if($rows > 0){

                    echo "Email is already in use";

                  }else{

                    $query = "INSERT into `registration` (user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, user_status, typeOfuser) VALUES ('$lastName', '$firstName', '$username', '".md5($password)."', '$email', '$address', '$contactno', '$gender', '$age', 'Pending', 'Instructor')";

                      $result = mysqli_query($con,$query);

                        if($result){

                            echo "<div class = 'ban'>

                                    <div class = 'success'>

                                        <i class = 'fa fa-check-circle fa-5x'></i>

                                    </div>

                                    Registration Successfully<br/>Click here to <a href = 'instrLogin.php'>Login</a>

                                    </div>";

                        }else{

                            echo "<div class = 'ban'>

                                    <div class = 'icon'>

                                        <i class = 'fa fa-times-circle fa-5x'></i>

                                    </div>

                                    Registration Failed<br/>Click here to <a href = 'instrSignUp.php'>Register</a> again

                                    </div>";

                        }
                    }

                }else{

                  echo "Password and confirm password does not match";

                } 

            }else{

        ?>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">

          <div class="container">

              <div class="navbar-header page-scroll">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                      <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                  </button>

                  <img id = "logo" src = "image/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                  <ul class="nav navbar-nav ">

                      <li class="page-scroll">

                          <a href="../homepage/homepage.php">Home</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage/homepage#courses">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage/homepage#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('database/db.php');                                    
                    
                    if(!empty( $_SESSION['instr_username'])){  
                        $user =  $_SESSION['instr_username'];
                        $pass = md5($_SESSION['instr_password']);
                        $query = "Select * from instructor where instr_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);
                          ?>   
                        <ul class="nav navbar-nav navbar-rstight">
                        <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="../instrent/instrentDashboard.php">

                                    <i class="fa fa-user fa-fw"></i> 

                                     <?php

                                    echo $row['instr_firstName'] . ' ' . $row['instr_lastName'];

                                    ?> 

                                    <i class="fa fa-caret-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-user">

                                  <li><a href ="../instructor/pages/instrDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                  </li>

                                    <li><a href="../instructor/instrProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li><a href="../instructor/instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>

                                </ul>
                        </li>
                        </ul>

                   <?php 

                    } else { 

                    ?>

                    <ul class="nav navbar-nav navbar-right">                                   
                    <li><a href="../instructor/instrLogin.php">Log-in</a></li>
                    <li><a href="../instructor/instrSignUp.php">Sign up</a></li>
                   
                    <?php 

                      }

                     ?>

                    </ul>

              </div>

          </div>

      </nav>
        
  <div class="module form-module register">

    <div class="cta">

    <h2>Create an account</h2>

      <form action = "instrSignUp.php" method = "post">

        <div class = 'left'>

        <input class = "input" type="text" name = "lastname" placeholder="Lastname" required />

        <input class = "input" type = "text" name = "firstname" placeholder = "Firstname" required/>

        <input class = "input" type="text" name="username" placeholder="Username" required />

        <input class = "input" type="password" name="password" placeholder="Password" required />

        <input class = "input" type="password" name="conpswd" placeholder="Confirm Password" required />

        </div>

        <div class = 'right'>

        <input class = "input" type = "email" name = "email" placeholder = "Email Address" required/>

        <input class = "input" type = "address" name="address" type="text" placeholder = "Complete Home Address" required/>

        <input class = "input" type = "tel" name = "contact" placeholder = "Contact Number"/>

        <input name = "gender" type = "radio" value = "Female" required>Female

        <input name = "gender" type = "radio" value="Male" required>Male

        <br/><br/><br/>

        <input class = "input" type = "age" name = "age" placeholder = "Age" required/>

        </div>

        <input id = "button" type="submit" name="submit" value = "Register">

      </form>

    </div>

    <div class="cta">Have an account?<a href="instrlogin.php"> Login</a> Here</div>

  </div>


        <?php } ?>

    </body>

</html>