<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | Sign Up</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

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

                  $query= "INSERT INTO student(stud_lastName, stud_firstName, stud_username, stud_password, stud_address, stud_email, stud_contactno,stud_gender,stud_age) VALUES ('$lastname','$firstname','$username','$password','$address',' $email','$contact','$gender','$age')"; 

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

  <div class="module form-module register">

    <div class="cta">

    <h2>Create an account</h2>

      <form action = "studentsignup.php" method = "post">

        <input type="text" name = "lastname" placeholder="Lastname" required />

        <input type = "text" name = "firstname" placeholder = "Firstname" required/>

        <input type="text" name="username" placeholder="Username" required />

        <input type="password" name="password" placeholder="Password" required />

        <input type="password" name="conpswd" placeholder="Confirm Password" required />

        <input type = "email" name = "email" placeholder = "Email Address" required/>

        <input type = "address" name="address" type="text" placeholder = "Complete Home Address" required/>

        <input type = "tel" name = "contact" placeholder = "Contact Number"/>

        <input name = "gender" type = "radio" value = "Female" required>Female

        <input name = "gender" type = "radio" value="Male" required>Male

        <input type = "age" name = "age" placeholder = "Age" required/>

        <input id = "button" type="submit" name="submit" value = "Register">

      </form>

    </div>

    <div class="cta">Have an account?<a href="studentlogin.php"> Login</a> Here</div>

  </div>

  <?php } ?>

    </body>

</html>