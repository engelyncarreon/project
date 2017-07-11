<?php
  include('../authentication/auth.php');
?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8" />

        <title>NTU | User Profile</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="../styles/style.css">

        <link rel="stylesheet" href="../styles/checkError.css">

        <link rel = "icon" href = "../image/ntu-logo.png">

    </head>

    <body>

        <?php
            require('../database/db.php');

            if(isset($_POST['submit'])){

                $lastName = stripslashes($_REQUEST['lastName']);
                $lastName = mysqli_real_escape_string($con,$lastName);
                $firstName = stripslashes($_REQUEST['firstName']);
                $firstName = mysqli_real_escape_string($con,$firstName);
                $username = stripslashes($_REQUEST['username']);
                $username = mysqli_real_escape_string($con,$username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con,$password);
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

                $query = "";

                $result = mysqli_query($con,$query);

                if($result){

                    echo "<div class = 'ban'>

                            <div class = 'success'>

                                <i class = 'fa fa-check-circle fa-5x'></i>

                            </div>

                            Updated Profile Successfully<br/>Click here to <a href = 'instrDashboard.php'>Login</a>

                            </div>";

                }else{

                    echo "<div class = 'ban'>

                            <div class = 'icon'>

                                <i class = 'fa fa-times-circle fa-5x'></i>

                            </div>

                            Update Failed<br/>Click here to <a href = 'instrProfile.php'>Update</a> again

                            </div>";

                }

            }else{
        ?>
        
        <div class="module form-module">

      <div class="cta">

        <h2>Update Account</h2>

        <form action = "instrProfile.php" method = "post">

          <input type="text" name = "lastName" placeholder="Lastname" />

          <input type = "text" name = "firstName" placeholder = "Firstname"/>

          <input type="text" name="username" placeholder="Username" required />

          <input type="password" name="password" placeholder="Password"/>

          <input type = "email" name = "email" placeholder = "Email Address"/>

          <input type = "address" name="address" type="text" placeholder = "Home address"/>

          <input type = "tel" name = "contactno" placeholder = "Contact Number"/>

          <!-- <input name = "gender" type = "radio" value = "Female" required>Female

          <input name = "gender" type = "radio" value="Male" required>Male -->

          <input type = "age" name = "age" placeholder = "Age"/>

          <input id = "button" type="submit" name="submit" value = "Update">

        </form>

      </div>

      <!-- <div class="cta">Have an account?<a href="instrLogin.php"> Login</a> Here
  </div> -->
      
    </div>


        <?php } ?>

    </body>

</html>