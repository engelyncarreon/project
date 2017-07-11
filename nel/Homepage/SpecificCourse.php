<!DOCTYPE html> 
<html lang="en">

  <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>NTU | Course</title>

      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <link href="styles/style.min.css" rel="stylesheet">

      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <link href = "image/ntu-logo.png" rel = "icon"/>

  </head>

   <body Style='padding-top:100px;'>

    <?php

        require('database/db.php');  
        session_start();
        $urlid = $_REQUEST['course_id'];
        $query2 = "Select * from courses Natural Join lessons where course_id = $urlid";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        
        
        if(isset($_POST['submit'])){

            if(!empty($_SESSION['stud_username'])){
                $querycourse = "Select * from studentcourse";
                $resultcourse = mysqli_query($con, $querycourse);        
                $rowcourse = mysqli_fetch_assoc($resultcourse);
                $rowcourse1 = mysqli_fetch_row($resultcourse);

                $sess = $_SESSION['stud_username'];

                $student = "Select * from student where stud_username ='$sess'  ";
                $studcourse = mysqli_query($con, $student);
                $rowstud = mysqli_fetch_assoc($studcourse);

                $stud_id = $rowstud['student_id'];                    
                $course_id = $row2['course_id'];
                $lesson_id = $row2['lesson_id'];
                
                $query3 = "Select * from lecture where lesson_id = $lesson_id and lecture_seq = 1";
                $result3 = mysqli_query($con, $query3);
                $row3 = mysqli_fetch_assoc($result3);
                $lectu =$row3['lecture_id'];
             
                    $studentcourse = "INSERT INTO studentcourse(student_id, course_id, lesson_id, current_lesson, lecture_id, lecture_seq) VALUES ('$stud_id','$course_id', '$lesson_id', '1', '$lectu','1')";

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

                
            }else{

                header('location:../Student/studentlogin.php');
                
            }
        }

        
    ?>

        <?php

        include('navigation/nav1.php');  

        ?>

        <div class="row">

            <div class = "coursedetails">

                <div class = "cname col-lg-12 text-center" >

                <h2 id = 'title'>

                    <?php echo $row2['course_name']; ?>
                        
                </h2>

                <hr>    

                </div>

                <div class = 'paragraph'>

                    <p>Category: <?php echo $row2["course_category"];  ?></p>
                    <p>Duration:<?php echo $row2["course_duration"];  ?> </p>
                    <p>Price:<?php echo $row2["course_price"];  ?></p>
                    <p>Short Description: <?php echo $row2["course_desc"];  ?> </p>                                             
                </div>

                <div class = 'paragraph'>

                    <p>Course Overview: <?php echo $row2["course_overview"];  ?> </p>
                    <p>Learning Objective: <?php echo $row2["course_learning"]; ?> </p>

                </div>

            </div>

         </div>

            <div class = "text-center"> 

                <form method="post" action="">

                    <input id = 'link' class = 'button' type="submit" name="submit" value="Enroll">

                </form>

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

      <script src="jquery/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/style.min.js"></script>

    </body>

</html>