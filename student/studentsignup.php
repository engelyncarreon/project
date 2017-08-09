<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Sign Up</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link href="../otherFiles/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/style.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/modal.css" rel="stylesheet">

        <link rel="stylesheet" href="../otherFiles/styles/loginSignUp.css">

        <link rel="stylesheet" href="../otherFiles/styles/checkError.css">

        <link rel = "icon" href = "../otherFiles/image/logo/ntu-logo.png">

    </head>

    <body>

    <?php

      require('../otherFiles/database/db.php');
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
            $question = $_POST['question'];
            $answer = $_POST['answer'];


          if($password == $conpswd){

            $username = mysqli_real_escape_string($con,$username);
            $firstname = mysqli_real_escape_string($con,$firstname);
            $lastname  = mysqli_real_escape_string($con,$lastname); 
            $password = mysqli_real_escape_string($con,$password);
            $address = mysqli_real_escape_string($con,$address);
            $contact = mysqli_real_escape_string($con,$contact);
            $email = mysqli_real_escape_string($con,$email);
            $gender = mysqli_real_escape_string($con,$gender);
            $age = mysqli_real_escape_string($con,$age);


            $dupesql = "SELECT * FROM student where (stud_email = '$email')";
            $duperaw = mysqli_query($con,$dupesql); 
            $rows = mysqli_num_rows($duperaw);


                if ($rows >0){

                  echo "<div class = 'contentfs'>

                            <div>

                                <i class = 'fa fa-times-circle fa-5x fail'></i>

                            </div>

                            Email is already in use<br>

                            Click here to go <a href = 'studentsignup'>Sign Up</a> again

                            </div>";

                }else{

                $dupes = "SELECT * FROM student where (stud_username = '$username')";
                $duper = mysqli_query($con,$dupes); 
                $rows2= mysqli_num_rows($duper);

                if ($rows2> 0){

                  echo "<div class = 'contentfs'>

                          <div>

                              <i class = 'fa fa-times-circle fa-5x fail'></i>

                          </div>

                          Email is already in use<br>

                          Click here to go <a href = 'studentsignup'>Sign Up</a> again

                      </div>";

                }else{

                  $query = "INSERT into `registration` (user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, user_status, typeOfuser) VALUES ('$lastname', '$firstname', '$username', '".md5($password)."', '$email', '$address', '$contact', '$gender', '$age', 'Pending', 'Student')";

                  $result = mysqli_query($con,$query);

                if ($result){

                    $nam = $firstname." ". $lastname." has sign-up as a student";
                   
                    $noti = "INSERT into notification (message) VALUES('$nam')";
                    $resultnoti = mysqli_query($con,$noti);                    

                    $regis = "Select * from notification where message='$nam'";
                    $resregis = mysqli_query($con,$regis);
                    $rowregis = mysqli_fetch_assoc($resregis);

                    $stude =  "Select * from registration where user_lastName='$lastname' AND user_firstName = '$firstname'";
                    $studeres = mysqli_query($con,$stude);
                    $studrow = mysqli_fetch_assoc($studeres);

                    $rowre = $studrow['registration_id'];
                    $studro = $rowregis['notification_id'];

                    $inse = "INSERT into register_notification (register_id,notification_id) VALUES('$rowre','$studro')" ;
                    $reinse = mysqli_query($con, $inse);
                    
                    $id = $studrow['registration_id'];

                        for($i = 0 ; $i< sizeof($question) ;$i++){
                            $ins = "INSERT INTO registrationquestion(registration_id, question_id,answer) VALUES ('$id', '$question[$i]','$answer[$i]')";
                            $insre = mysqli_query($con,$ins);
                    }
                         

                  echo "<div class = 'contentfs'>

                        <div>

                          <i class = 'fa fa-check-circle fa-5x success'></i>

                        </div>

                          Registration Successfully<br>

                          Please wait for the admin to accept you registration<br>

                          Click here to go to the <a href = '../homepage.php' class = 'success'>Homepage</a>

                        </div>";

                }else{

                  echo "<div class = 'contentfs'>

                        <div>

                          <i class = 'fa fa-times-circle fa-5x fail'></i>

                        </div>

                          Registration Failed<br/>Click here to <a href = 'studentsignup.php' class = 'fail'>Register</a> again

                        </div>";
                }

              }  

            }

        }else{

            echo "<div class = 'contentfs'>

                    <div>

                      <i class = 'fa fa-times-circle fa-5x fail'></i>

                    </div>

                      Password and confirm password did not match<br/>Click here to <a href = 'studentsignup.php' class = 'fail'>Register</a> again

                    </div>";

        }

        }else{

    ?>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">

          <div class="container">

              <div class="navbar-header page-scroll">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                      <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                  </button>

                  <img id = "logo" src = "../otherFiles/image/logo/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                  <ul class="nav navbar-nav ">

                      <li class="page-scroll">

                          <a href="../homepage.php">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../homepage#about">About</a>

                      </li>

                  </ul>

                  <?php 

                    require('../otherFiles/database/db.php');                                    
                    
                    if(!empty( $_SESSION['stud_username'])){  

                        $user =  $_SESSION['stud_username'];
                        $pass = md5($_SESSION['stud_password']);
                        $query = "Select * from student where stud_username = '$user' ";
                        $result = mysqli_query($con , $query);
                        $row = mysqli_fetch_assoc($result);

                    ?>   

                    <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">

                      <a class="dropdown-toggle user" data-toggle="dropdown" href="Student/StudentDashboard.php">

                          <i class="fa fa-user fa-fw"></i>

                           <?php

                           
                            echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                          ?> 

                          <i class="fa fa-caret-down"></i>

                      </a>

                  <ul class="dropdown-menu dropdown-user">

                    <li><a id = "link" href ="student/StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                    </li>

                    <li><a id = "link" href="student/StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>

                    <li class="divider"></li>

                    <li><a id = "link" href="student/studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>

                  </ul>

                </li>

                </ul>

                   <?php  
                    } else { 

                    ?>

                <ul class="nav navbar-nav navbar-right">             
                            
                  <li><a href="#view1" data-toggle="modal" >Login</a></li>


                  <li><a href="#view" data-toggle="modal" >Sign Up</a></li>
       
                </ul>

                <?php

                  }

                ?>

                </div>

              </div>

            </nav>

          <div  id="view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

          <div class="modal-dialog" >

            <div class="modal-content" >

               <div class="modal-body" >

                   <button class="close" data-dismiss="modal">&times;</button>

               <h3 class="text-center">Sign Up As</h3>

            <form action="" method="post" class="ajax">
                
                <div class="row">

                  <div class="col-lg-6 text-center">

                      <div class="card">

                          <a href = "studentsignup.php">
                              
                              <div class="card-block">

                                   <div class="card-title fa fa-user fa-5x">

                                    <p class = 'studInstr'>Student</p>

                                  </div>

                              </div>

                          </a>

                      </div>
               
                    </div>

                    <div class="col-lg-6 text-center">

                        <div class="card">

                            <a href = "../instructor/instrSignUp.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-graduation-cap fa-5x"> 

                                    <p class = 'studInstr'>Instructor</p>

                                  </div>

                              </div>

                              </a>

                      </div>
                     
                       
                    </div>

                </div>
                
            </form>
            
            </div>

          </div>

        </div>
            
        </div>

        <div  id="view1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

          <!-- Modal content -->
          <div class="modal-dialog" >

            <div class="modal-content" >

               <div class="modal-body" >

                <button class="close" data-dismiss="modal">&times;</button>

              <h3 class="text-center">Login As</h3>

            <form action="" method="post" class="ajax">

               <div class="row">

                  <div class="col-lg-6 text-center">

                      <div class="card">

                          <a href = "studentlogin.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-user fa-5x">

                                    <p class = 'studInstr'>Student</p>

                                  </div>

                              </div>

                            </a>

                      </div>
               
                    </div>

                    <div class="col-lg-6 text-center">

                        <div class="card">

                          <a href = "../instructor/instrLogin.php">
                              
                              <div class="card-block">

                                  <div class="card-title fa fa-graduation-cap fa-5x"> 

                                    <p class = 'studInstr'>Instructor</p>

                                  </div>

                              </div>

                          </a>

                        </div>
                     
                    </div>

                </div>
                
            </form>
            
            </div>

          </div>

        </div>
            
      </div>

  <div class="module form-module register">

    <div class="cta">

    <i class = 'fa fa-user fa-5x'></i>

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

        <input class = "input" type = "tel" name = "contact" minlegth = "11" maxlength="11" placeholder = "Contact Number"/>

        <input name = "gender" type = "radio" value = "Female" required>Female

        <input name = "gender" type = "radio" value="Male" required>Male

        <br/><br/><br/>

        <input class = "input" type = "number" name = "age" min = "13" max = "200" placeholder = "Age" required/>

        </div>

        <select name=question[]>

        <?php 

          $quest = "Select * from questions where quest_id limit 3";
          $questres = mysqli_query($con,$quest);

            while($questrow= mysqli_fetch_assoc($questres)){

        ?>

            <option value=<?php echo $questrow['quest_id']; ?>>
                <?php echo $questrow['questions']; ?>
            </option><br><br>

          <?php 

            }

          ?>

        </select>

          <br><br>

          <input type="text" name="answer[]">

          <br><br>

        <input id = "button" type="submit" name="submit" value = "Register">

      </form>

    </div>

    <div class="cta">Have an account?<a href="studentlogin.php"> Login</a> Here</div>

  </div>

  <footer class="text-center"> 

            <div class="footer-below">

                <div class="container">

                    <div class="row">

                        <div>

                            Copyright &copy; NTU Training Institute 2017

                        </div>

                    </div>

                </div>

            </div>

          </footer>

  <?php 

    } 

  ?>

    <script src = "../otherFiles/jquery/jquery.min.js"></script>
    <script src = "../otherFiles/js/bootstrap.min.js"></script>
    <script src = "../otherFiles/js/modal.js"></script>

    </body>

</html>