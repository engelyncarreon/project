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
                            $nam = $firstName." ". $lastName." has sign-up as an instructor";
                   
                            $noti = "INSERT into notification (message) VALUES('$nam')";
                            $resultnoti = mysqli_query($con,$noti);                    

                            $regis = "Select * from notification where message='$nam'";
                            $resregis = mysqli_query($con,$regis);
                            $rowregis = mysqli_fetch_assoc($resregis);

                            $stude =  "Select * from registration where user_lastName='$lastName' AND user_firstName = '$firstName'";
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
        
        <div class="module form-module register">

      <div class="cta">

        <h2>Create an account</h2>

        <form action = "instrSignUp.php" method = "post">

          <input type="text" name = "lastName" placeholder="Lastname" required />

          <input type = "text" name = "firstName" placeholder = "Firstname" required/>

          <input type="text" name="username" placeholder="Username" required />

          <input type="password" name="password" placeholder="Password" required />

          <input type="password" name="confirm" placeholder="Confirm Password" required />

          <input type = "email" name = "email" placeholder = "Email Address" required/>

          <input type = "address" name="address" type="text" placeholder = "Complete Home address" required/>

          <input type = "tel" name = "contactno" placeholder = "Contact Number"/>

          <input name = "gender" type = "radio" value = "Female" required>Female

          <input name = "gender" type = "radio" value="Male" required>Male

          <input type = "age" name = "age" placeholder = "Age" required/>

          <input id = "button" type="submit" name="submit" value = "Register">

        </form>

      </div>

      <div class="cta">Have an account?<a href="instrLogin.php"> Login</a> Here
  </div>
      
    </div>


        <?php } ?>

    </body>

</html>