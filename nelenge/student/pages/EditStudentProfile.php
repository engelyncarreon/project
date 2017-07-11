<?php
    require('../database/db.php');
    
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Dashboard</title>

        <link href="../styles/bootstrap.min.css" rel="stylesheet">

        <link href="../styles/metisMenu/metisMenu.min.css" rel="stylesheet">

        <link href="../styles/sb-admin-2.css" rel="stylesheet">

        <link href="../styles/morrisjs/morris.css" rel="stylesheet">

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../image/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php
            require('../database/db.php');
            include('../authentication/authenticationstudent.php');
            include('../navigation/navstud.php');
            

        ?>

            <div class="navbar-default sidebar" role="navigation">

                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">

                        <!-- <li class="sidebar-search">

                            <div class="input-group custom-search-form">

                                <input type="text" class="form-control" placeholder="Search...">

                            <span class="input-group-btn">

                                <button class="btn btn-default" type="button">

                                    <i class="fa fa-search"></i>

                                </button>

                            </span>

                            </div>

                        </li> -->

                        <li class="active">

                            <a href="StudentDashboard.php"><i class="fa fa-map-marker"></i> Current Course</a>

                        </li>

                        <li>

                            <a href="FinishedCourse.php"><i class="glyphicon glyphicon-plus"></i> Finished Course</a>

                        </li>

                        <li>

                            <a href="../Homepage/allcourse.php"><i class="fa fa-book"></i> Courses</a>

                        </li>

                        <li>

                            <a href="StudentProfile.php"><i class="fa fa-comments"></i> Profile</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>

                        <li>

                            <a href="feedback.php"><i class="fa fa-comments-o"></i> Feedback</a>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header"><i class="fa fa-dashboard"></i>Edit Profile</h1>

                </div>

            </div>
            <form action="EditStudentProfile.php" method="post">

                <label>Username</label>
                <input id="username" type="text" name="username"><br>

                <label>New Password</label>
                <input id="password" name="newpassword" type="password"><br>

                <label>Confirm New Password</label>
                <input id="confirmpassword" name="newconfirmpassword" type="password"><br>

                
                <label>First Name</label>
                <input id="firstname" name="firstname" type="text"><br>

                <label>Last Name</label>
                <input id="lastname" name="lastname" type="text"><br> 

                <label> Address</label>
                <input id="address" name="address" type="text"> <br>

                <label>Contact No.</label>
                <input id="contact" name="contact" type="number"><br>

                <label>Email</label>
                <input id="email" name="email" type="email"><br>

                <label>Age:</label>
                <input id="age" name="age" type = "number"><br><br>
                
                <p>Please enter your password to make changes</p>
                <label>Password</label>
                <input id="password" name="password" type="password"><br>


                
                <input type="submit" name="submit" value = "Save Changes">


            </form>
            
            <?php
               
                if(isset($_POST['submit'])){
    
                  $firstname = $_POST['firstname'];
                  $lastname = $_POST['lastname'];
                  $username = $_POST['username'];
                  $password = $_POST['password'];
                    
                    $newpassword = $_POST['newpassword'];
                    $newconpswd = $_POST['newconfirmpassword'];
                    
                  $address = $_POST['address'];
                  $contact = $_POST['contact'];
                  $email = $_POST['email'];
                  $age = $_POST['age'];


                if(!empty($password)){
                    if($newpassword === $newconpswd){
                      $username = mysqli_real_escape_string($con,$username);
                      $firstname = mysqli_real_escape_string($con,$firstname);
                      $lastname  = mysqli_real_escape_string($con,$lastname); 
                      $newpassword = md5(mysqli_real_escape_string($con,$newpassword));
                      $address = mysqli_real_escape_string($con,$address);
                      $contact = mysqli_real_escape_string($con,$contact);
                      $email = mysqli_real_escape_string($con,$email);
                      $age = mysqli_real_escape_string($con,$age);
                      $age = mysqli_real_escape_string($con,$age);


                        $dupesql = "SELECT * FROM student where (stud_email = '$email')";
                        $duperaw = mysqli_query($con,$dupesql); 
                        $rows = mysqli_num_rows($duperaw);


                        if ($rows >0){
                            echo "Email is already in use";
                        }
                        
                        else{
                              $id = $row['student_id'];
                            $dupes = "SELECT * FROM student where (stud_username =  $id)";
                            $duper = mysqli_query($con,$dupes); 
                            $rows2= mysqli_num_rows($duper);
                           

                        
                               $query= "UPDATE student SET stud_lastName = '$lastname', stud_firstName = '$firstname', stud_username = '$username', stud_password = '$newpassword', stud_address = '$address', stud_email = '$email', stud_contactno = '$contact' ,stud_age = '$age' where student_id = $id "; 

                                $result = mysqli_query($con,$query);

                                if ($result){
                                    echo "<div class = 'ban'>

                                        <div class = 'success'>

                                            <i class = 'fa fa-check-circle fa-5x'></i>

                                        </div>

                                        Profile has been changed

                                        </div>";
                                }
                                else{
                                    echo "<div class = 'ban'>

                                        <div class = 'icon'>

                                            <i class = 'fa fa-times-circle fa-5x'></i>

                                        </div>

                                        Changing profile failed

                                        </div>";
                                    
                                }
                             

                        }
                    }else{
                        echo "<div class = 'ban'>

                                        <div class = 'icon'>

                                            <i class = 'fa fa-times-circle fa-5x'></i>

                                        </div>

                                        New password and confirm password does not match
                                        </div>";
                        
                    }
                    
                }elseif(empty($password) ){
                    echo "<div class = 'ban'>

                                        <div class = 'icon'>

                                            <i class = 'fa fa-times-circle fa-5x'></i>

                                        </div>

                                       Please enter your  password to edit your profile
                                        </div>";
                    
                    
                }else{
                    echo "<div class = 'ban'>

                                        <div class = 'icon'>

                                            <i class = 'fa fa-times-circle fa-5x'></i>

                                        </div>

                                       Wrong password
                                        </div>";
                    
                }





                }

            
            ?>
           

            </div>

        </div>

        <script src="../js/jquery/jquery.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/metisMenu/metisMenu.min.js"></script>
        <script src="../js/raphael/raphael.min.js"></script>
        <script src="../js/morrisjs/morris.min.js"></script>
        <script src="../js/data/morris-data.js"></script>
        <script src="../js/sb-admin-2.js"></script>

    </body>

</html>
