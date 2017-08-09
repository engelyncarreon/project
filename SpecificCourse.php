<!DOCTYPE html> 
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>NTU | Specific Course</title>

      <link href="otherFiles/styles/bootstrap.min.css" rel="stylesheet">

      <!-- All styles in homepage, specific course and courseNav -->

      <link href="otherFiles/styles/style.min.css" rel="stylesheet">

      <link href="otherFiles/styles/ribbon.css" rel="stylesheet">

      <!-- style for the class title image size and content -->

      <link href="otherFiles/styles/specificCourse.css" rel="stylesheet">

      <link href="otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <link href = "otherFiles/styles/modal2.css" rel = "stylesheet">

      <link href = "otherFiles/image/logo/ntu-logo.png" rel = "icon"/>

  </head>

   <body Style='padding-top:100px;'>

    <?php

      require('otherFiles/database/db.php');  
      session_start();
      $urlid = $_REQUEST['course_id'];
      $query2 = "Select * from courses Natural Join lessons where course_id = $urlid";
      $result2 = mysqli_query($con, $query2);
      $row2 = mysqli_fetch_assoc($result2);
        
        if(isset($_POST['submit'])){

            if(!empty($_SESSION['stud_username'])){
               
                $sess = $_SESSION['stud_username'];

                $student = "Select * from student where stud_username ='$sess'  ";
                $studcourse = mysqli_query($con, $student);
                $rowstud = mysqli_fetch_assoc($studcourse);
                
            
                $stud_id = $rowstud['student_id'];                    
                $course_id = $row2['course_id'];
                $lesson_id = $row2['lesson_id'];
               
                
                 $querycourse = "Select * from studentcourse where student_id = $stud_id and course_id = $course_id";
                $resultcourse = mysqli_query($con, $querycourse);        
                $rowcourse = mysqli_fetch_assoc($resultcourse);
                
                if(empty($rowcourse)){
                
                  $query3 = "Select * from lecture where lesson_id = $lesson_id and lecture_seq = 1";
                  $result3 = mysqli_query($con, $query3);
                  $row3 = mysqli_fetch_assoc($result3);
                  $lectu =$row3['lecture_id'];
             
                    $studentcourse = "INSERT INTO studentcourse(student_id, course_id, lesson_id) VALUES ('$stud_id','$course_id', '$lesson_id')";

                    $resultcour = mysqli_query($con,$studentcourse);
                    
                    $firstName= $rowstud['stud_firstName'];
                    $lastName= $rowstud['stud_lastName'];
            
                    $nam = $firstName." ". $lastName." has enroll";
                   
                    $noti = "INSERT into notification (message) VALUES('$nam')";
                    $resultnoti = mysqli_query($con,$noti);                    

                    $regis = "Select * from notification where message='$nam'";
                    $resregis = mysqli_query($con,$regis);
                    $rowregis = mysqli_fetch_assoc($resregis);

                    $stude =  "Select * from student where stud_lastName='$lastName' AND stud_firstName = '$firstName'";
                    $studeres = mysqli_query($con,$stude);
                    $studrow = mysqli_fetch_assoc($studeres);

                    $rowre = $studrow['student_id'];
                    $studro = $rowregis['notification_id'];

                    $inse = "INSERT into student_notification (student_id,notification_id) VALUES('$rowre','$studro')" ;
                    $reinse = mysqli_query($con, $inse);

                    header('location: student/StudentDashboard.php'); 

                }else{

        ?>

        <!-- Modal for repeating a course -->

        <div id="lo">

          <div id="mym" class="modal2">

            <div class="modal-content2">

                <span class="close2">&times;</span>

                <p style='text-align:center;'>Sorry You have already been enrolled in this course</p>

            </div>

          </div>

        </div>

       <?php

              }
                
            }else{

        ?>

          <!-- Modal For the first time student or forgot to login to their account -->

              <div id="lo">

                <div id="mym" class="modal2">

                  <div class="modal-content2">

                        <span class="close2">&times;</span>

                    <p style='text-align:center; padding-top:30px;'>

                      For the first time user. In order for you to enroll this course you need to sign up  first.

                    </p>

                    <p style='text-align:center;'>

                      <button class = "btnLink">

                        <a href = "student/studentsignup.php"><i class = 'fa fa-pencil'></i> Sign up</a>

                      </button>

                    </p>

                    <p style='text-align:center; padding-top:30px;'>

                      If you are already an existing user please login

                    </p>

                    <p style='text-align:center;'>

                      <button class = "btnLink">

                        <a href = "student/studentlogin.php"><i class = 'fa fa-sign-in'></i> Log In</a>

                      </button>

                    </p>

                </div>

              </div>

            </div>

        <?php

            }
        }

        ?>

        <?php

          include('otherFiles/navigation/courseNav.php');  

        ?>

        <div class = "row">

            <div class = "coursedetails">

                <div class = "cname text-center" >

                <h2 class = 'ribbon'>

                    <?php echo $row2['course_name']; ?>
                        
                </h2>

                </div>

                <div class = 'paragraph'>

                <img align = "right" class="img-responsive" src = "<?php echo "instructor/".$row2["course_imageurl"];?>" alt = "course-image" style = "margin-right: 100px;">

                    <p class = 'title'>Category: <?php echo $row2["course_category"];  ?></p>

                    <p class = 'title'>Duration:<?php echo $row2["course_duration"];  ?> </p>

                    <p class = 'title'>Price:<?php echo $row2["course_price"];  ?></p>

                    <p class = 'title'>Short Description: </p>

                      <p class = 'content'> <?php echo $row2["course_desc"];  ?> </p> 

                </div>

                <div class = 'paragraph'>

                    <p class = 'title'>Course Overview:</p>

                      <p class = 'content'><?php echo $row2["course_overview"];  ?> </p>

                      
                    <p class = 'title'>Learning Objective:</p> 
                    
                      <p class = 'content'><?php echo $row2["course_learning"]; ?> </p>

                </div>

            </div>

            <div class = "text-center"> 

                <form method="post" action="">

                    <input class = 'button' type="submit" name="submit" value="Enroll">

                </form>

            </div>

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

      <script src="otherFiles/jquery/jquery.min.js"></script>
      <script src="otherFiles/js/bootstrap.min.js"></script>
      <script src="otherFiles/js/jqBootstrapValidation.js"></script>
      <script src="otherFiles/js/style.min.js"></script>
      <script src="otherFiles/js/modal3.js"></script>
      <!-- <script src="otherFiles/js/modal.js"></script> -->

    </body>

</html>