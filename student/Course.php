<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Course</title>

        <link href="../otherFiles/styles/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/dashboard.css" rel="stylesheet">

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../otherFiles/image/logo/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php

            include('../otherFiles/authentication/studAuth.php');
            include('../otherFiles/navigation/studNav.php');

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

                        <li>

                            <a href="StudentDashboard.php"><i class="fa fa-map-marker"></i> Current Course</a>

                        </li>

                        <li>

                            <a href="FinishedCourse.php"><i class="fa fa-flag-checkered"></i> Finished Course</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>

                        <li >

                            <a href="feedback.php"><i class="fa fa-comments-o"></i> Feedback</a>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

            
            <?php 

                $c = $_REQUEST['c'];
                $student_id = $row['student_id'];
                $course = "SELECT * from courses natural join lessons where course_id = '$c'";
                $course_query = mysqli_query($con,$course);
                $course_row = mysqli_fetch_assoc($course_query);

            ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header"><i class = "fa fa-book"></i><?php echo $course_row['course_name'] ;?></h1>

                          <div class = 'paragraph'>

                            <p class = 'title'>Category: <?php echo $course_row["course_category"];  ?></p>

                            <img align = "right" class="img-responsive" src = "<?php echo "../instructor/".$course_row["course_imageurl"];?>" width = "500px" height= "500px" alt = "course-image" style = "margin-right: 100px;">

                            <p class = 'title'>Duration:<?php echo $course_row["course_duration"];  ?> </p>

                            <p class = 'title'>Price:<?php echo $course_row["course_price"];  ?></p>

                            <p class = 'title'>Short Description: </p>

                              <p class = 'content'> <?php echo $course_row["course_desc"];  ?> </p> 

                        </div>

                        <div class = 'paragraph'>

                            <p class = 'title'>Course Overview:</p>

                              <p class = 'content'><?php echo $course_row["course_overview"];  ?> </p>


                            <p class = 'title'>Learning Objective:</p> 

                              <p class = 'content'><?php echo $course_row["course_learning"]; ?> </p>

                        </div>
                        
                    <nav class="navbar navbar-inverse nav-bar" >

                      <ul class="nav navbar-nav">

                        <li><a id = "navLink" href="Course?c=<?php echo $c; ?>">Course Content</a></li>

                        <li><a id = "navLink" href="Announcement?c=<?php echo $c; ?>">Announcement</a></li>

                        <li><a id = "navLink" href="QuestionAndAnswer.php?c=<?php echo $c; ?>">Q&A</a></li>

                      </ul>
                     
                    </nav>
                        <?php 
                            $lect = "Select * from lecture where lesson_id =".$course_row['lesson_id']." and lecture_seq = 1";
                            $lect_query = mysqli_query($con,$lect);
                            $lect_fetch = mysqli_fetch_assoc($lect_query);
                            $countquiz = 0;
                        ?>
                     <a href = "LessonArea.php?c=<?php echo $course_row['course_id'];?>&m=1&l=<?php echo $course_row['lesson_id'];?>&ls=1&lec=<?php echo $lect_fetch['lecture_id'];?>"><button><i class = "fa fa-eye"></i> View Details</button>
                        </a><br>
                    <h3>Course Content</h3>


                    <?php 

                        require('../otherFiles/database/db.php');

                        $pre = "Select * from lessons natural join lecture where course_id = '$c' and lesson_seq = 1 ";
                        
                        $prev = mysqli_query($con,$pre);
                        $prevlesson = mysqli_fetch_assoc($prev);

                        $less2 = "Select * from lessons where course_id = '$c'";
                        $less2result = mysqli_query($con,$less2); 

                        if($less2result){

                    ?>

                    <div class="panel panel-info">

                    <?php
                                
                            while( $less2row = mysqli_fetch_assoc($less2result)){
                                
                                    
                                $lessid = $less2row['lesson_id'];
                                $less3 = "Select * from lecture where lesson_id = '$lessid' Order by lecture_id";
                                $less3result = mysqli_query($con,$less3);
                                
                                
                                
                                

                    ?>

                    <div class='panel-heading'>

                        

                    <?php
                        $num = mysqli_num_rows($less3result);      
                                $lesson_is = $less2row['lesson_id'];
                                    $lecturestatuss= "Select * from student_lessonchecker  natural join lecture where student_id = '$student_id' and lesson_id = '$lesson_is' and lecture_status = 'Finished' ";
                                    $lecturestatus_queryy=mysqli_query($con,$lecturestatuss);
                                    $countfinished = mysqli_num_rows($lecturestatus_queryy);
                                    
                                
                        
                        ?>
                        <div class="row">
                            <div class="col-lg-9">
                            Lesson Name: <?php echo $less2row['lesson_name']; ?> 
                            </div>
                            <div class="col-lg-3 text-right">
                                <?php 
                                    echo $countfinished."/".$num;   
                                ?>

                            </div>
                        </div>
                       
                        </div>

                    <?php

                        while( $less3row = mysqli_fetch_assoc($less3result)){
                            
                                    $lectureid = $less3row['lecture_id'];

                                    $lecturestatus = "Select * from student_lessonchecker where student_id = '$student_id' and lecture_id = '$lectureid' ";
                                    $lecturestatus_query=mysqli_query($con,$lecturestatus);

                                    $lecturestatus_fetch = mysqli_fetch_assoc($lecturestatus_query);                                    

                    ?>

                    <div class = "panel-body">
                    <div class="row">
                        <div class="col-lg-9">
                            
                        <a href = "LessonArea.php?c=<?php echo $course_row['course_id'];?>&m=<?php echo $less3row['lecture_seq']; ?>&l=<?php echo $less2row['lesson_id'];?>&ls=<?php echo $less2row['lesson_seq'];?>&lec=<?php echo $less3row['lecture_id'];?>">
                            Lecture Name: <?php echo $less3row['lecture_name']; ?> 
                        </a>
                        
                        </div>
                        <div class="col-lg-3 text-right">
                            <?php 
                                if($lecturestatus_fetch['lecture_status']=="Finished"){
                                    ?><i class="fa fa-check"></i><?php
                                }else{
                                    ?><i class="fa fa-times"></i><?php
                                }?>
                            
                        </div>
                    </div>

                <?php
                $m = $less3row['lecture_id'];
                $quiz = "SELECT * from quiz_question where lecture_id = '$m' group by lecture_id";
                $quiz_query = mysqli_query($con,$quiz);
                
                if($quiz_query){    
                    $quiz_fetch = mysqli_fetch_assoc($quiz_query);
                    $quiz_id =  $quiz_fetch['quiz_id'];
                    $countquiz++;
                        ?>
                     <div class="row">
                            <div class="col-lg-9">

                            <a href = "LessonArea.php?c=<?php echo $course_row['course_id'];?>&m=<?php echo $less3row['lecture_seq']; ?>&l=<?php echo $less2row['lesson_id'];?>&ls=<?php echo $less2row['lesson_seq'];?>&q=<?php echo $m;?>">
                                Quiz <?php echo $countquiz; ?> 
                            </a>

                            </div>
                            <div class="col-lg-3 text-right">
                                <?php 
                                    $quizcon = "SELECT * from quiz_studentanswer where quiz_id = '$quiz_id' group by quiz_id" ;
                                    $quizcon_query = mysqli_query($con,$quizcon);
                                    if($quizcon_query){
                                        $quizcon_fetch = mysqli_num_rows($quizcon_query);
                                        
                                         if($quizcon_fetch>0){
                                            ?><i class="fa fa-check"></i><?php
                                        }else{
                                            ?><i class="fa fa-times"></i><?php
                                        }
                                    }
                                ?>

                            </div>
                        </div> 
                        <?php 
                }
                        
                
              
                ?>
                    </div>

            <?php

                        }

                    }

            ?>

                    </div>   

            <?php  

                }
               

            ?>

             <br><br>

                
                        
                       
                    </div>
                </div>

            </div>

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

        <script src="../otherFiles/jquery/jquery.min.js"></script>
        <script src="../otherFiles/js/bootstrap.min.js"></script>
        <script src="../otherFiles/js/sb-admin-2.js"></script>
        <script src="../otherFiles/js/metisMenu.min.js"></script>

    </body>

</html>