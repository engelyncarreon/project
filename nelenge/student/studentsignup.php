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

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $conpswd = $_POST['conpswd'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];


          if($password == $conpswd){

            $username = mysqli_real_escape_string($con,$username);
            $firstname = mysqli_real_escape_string($con,$firstname);
            $lastname  = mysqli_real_escape_string($con,$lastname); 
            $password = md5(mysqli_real_escape_string($con,$password));
            $address = mysqli_real_escape_string($con,$address);
            $contact = mysqli_real_escape_string($con,$contact);
            $email = mysqli_real_escape_string($con,$email);
            $gender = mysqli_real_escape_string($con,$gender);
            $age = mysqli_real_escape_string($con,$age);


            $dupesql = "SELECT * FROM student where (stud_email = '$email')";
            $duperaw = mysqli_query($con,$dupesql); 
            $rows = mysqli_num_rows($duperaw);


                if ($rows >0){

                  echo "Email is already in use";

                }else{

                $dupes = "SELECT * FROM student where (stud_username = '$username')";
                $duper = mysqli_query($con,$dupes); 
                $rows2= mysqli_num_rows($duper);

                if ($rows2> 0){

                  echo "Your username is already in use";

                }else{

                  $query = "INSERT into `registration` (user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, user_status, typeOfuser) VALUES ('$lastname', '$firstname', '$username', '".md5($password)."', '$email', '$address', '$contact', '$gender', '$age', 'Pending', 'Student')";

                  $result = mysqli_query($con,$query);

                if ($result){

                  echo "<div class = 'ban'>

                        <div class = 'success'>

                          <i class = 'fa fa-check-circle fa-5x'></i>

                        </div>

                          Registration Successfully<br/>Click here to <a href = 'studentLogin.php'>Login</a>

                        </div>";

                }else{

                  echo "<div class = 'ban'>

                        <div class = 'icon'>

                          <i class = 'fa fa-times-circle fa-5x'></i>

                        </div>

                          Registration Failed<br/>Click here to <a href = 'studentsignup.php'>Register</a> again

                        </div>";
                }

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
                    
                    if(!empty( $_SESSION['stud_username'])){  
                        $user =  $_SESSION['stud_username'];
                        $pass = md5($_SESSION['stud_password']);
                        $query = "Select * from student where stud_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);
                          ?>   
                        <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="../Student/StudentDashboard.php">

                                    <i class="fa fa-user fa-fw"></i> 

                                     <?php

                                    echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                                    ?> 

                                    <i class="fa fa-caret-down"></i>

                                </a>

                                <ul class="dropdown-menu dropdown-user">

                                  <li><a href ="../student/pages/StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                  </li>

                                    <li><a href="../Student/StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li><a href="../Student/studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                    </li>

                                </ul>
                        </li>
                        </ul>

                   <?php  
                    } else { 

                    ?>

                    <ul class="nav navbar-nav navbar-right">                                   
                    <li><a href="../Student/studentlogin.php">Log-in</a></li>
                    <li><a href="../Student/studentsignup.php">Sign up</a></li>
                   
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

      <form action = "studentsignup.php" method = "post">

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

    <div class="cta">Have an account?<a href="studentlogin.php"> Login</a> Here</div>

  </div>

  <?php } ?>

    </body>

</html>