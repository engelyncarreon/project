<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Course Details</title>

        <link href="../otherFiles/styles/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/dashboard.css" rel="stylesheet">

         <link href="../otherFiles/styles/custom.css" rel="stylesheet">

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../otherFiles/image/logo/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php

            include('../otherFiles/authentication/adminAuth.php');
            include('../otherFiles/navigation/adminNav.php');
            
            require('../otherFiles/database/db.php');

            $urlid = $_REQUEST['course'];
            $querycourse = "Select * from courses where course_id = '$urlid'";
            $resultcourse = mysqli_query($con, $querycourse);
            $rowcourse = mysqli_fetch_assoc($resultcourse);

            $con->close();

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

                            <a href="adminDashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>

                        </li>

                        <li>

                            <a href="#"><i class="fa fa-thumbs-up"></i> User Approval<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">

                                <li>

                                    <a href="student.php"><i class = ' fa fa-user'></i> Student</a>

                                </li>

                                <li>

                                    <a href="instructor.php"><i class = 'fa fa-graduation-cap'></i> Instructor</a>

                                </li>

                            </ul>

                        </li>

                        <li>

                            <a href="#"><i class="fa fa-edit fa-fw"></i> User Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">

                                <li>

                                    <a href="manageStud.php"><i class = ' fa fa-user'></i> Student</a>

                                </li>

                                <li>

                                    <a href="manageInstr.php"><i class = 'fa fa-graduation-cap'></i> Instructor</a>

                                </li>

                            </ul>

                        </li>

                        <li>

                            <a href="courses.php"><i class="fa fa-book"></i> Courses</a>

                        </li>

                        <li>

                            <a href="enroll.php"><i class="fa fa-plus"></i> Enroll</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>


                        <li>

                            <a href="announcement.php"><i class="fa fa-newspaper-o"></i> Announcements</a>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

      
        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h2 class="page-header"> 

                            <?php echo $rowcourse['course_name']; ?>
                                
                        </h2>

                    </div>

                    <p class = "title">Category: <?php echo $rowcourse['course_category']; ?></p>

                    <p class = "title">Price:<?php echo $rowcourse['course_price']; ?></p> 

                    <p class = "title">Duration: <?php echo $rowcourse['course_duration']; ?>

                        <img align = "right" class="img-responsive" src = "<?php echo "../instructor/" . $rowcourse["course_imageurl"];?>" alt = "course-image">
                    </p>
                
                    <p class = "title">Course Description: </p>

                    <p class = "content"> <?php echo $rowcourse['course_desc']; ?></p>
                    
                    <p class = "title">Course Overview: </p>

                    <p class = "content"> <?php echo $rowcourse['course_overview']; ?></p>
                    
                    <p class = "title">Course Learning Objective: </p>

                    <p class = "content"> <?php echo $rowcourse['course_learning']; ?></p>
                    
                    <p class = "title">Requirement: </p>

                    <p class = "content"><?php echo $rowcourse['course_requirement']; ?></p>

                    <nav class="navbar navbar-inverse nav-bar" >

                      <ul class="nav navbar-nav">

                        <li><a id = "navLink" href="Coursedetails?course=<?php echo $urlid; ?>">Lesson</a></li>

                        <li><a id = "navLink" href="#">Student</a></li>

                        <li><a id = "navLink" href="Announcement?course=<?php echo $urlid; ?>">Announcement</a></li>

                        <li><a id = "navLink" href="#">Q&A</a></li>

                      </ul>
                     
                    </nav>
                
                    <h3>Lessons</h3>

                      <?php
                    
                        require('../otherFiles/database/db.php');

                        $less2 = "Select * from lessons where course_id = '$urlid'";
                        $less2result = mysqli_query($con,$less2);

                        if($less2result){

                        ?>

                        <div class = "panel panel-info">

                            <div class = "panel-heading">

                        <?php
                            
                            while( $less2row = mysqli_fetch_assoc($less2result)){

                                $lessid = $less2row['lesson_id'];

                                echo "<div class = 'subtitle'>

                                        Lesson Name: ".$less2row['lesson_name']."<br/>

                                        </div>";
                                
                                $less3 = "Select * from lecture where lesson_id = '$lessid'";
                                $less3result = mysqli_query($con,$less3);

                            ?>

                            </div>

                            <?php
                        
                                while( $less3row = mysqli_fetch_assoc($less3result)){

                            ?>

                            <div class = "panel-body">

                            <details>

                                <summary>

                            <?php

                                    echo "Lecture Name: ".$less3row['lecture_name']."<br>";

                            ?>

                                </summary>

                                <div class = 'panel-heading'>

                           <?php

                               echo "Lecture Details: ";

                            ?>

                            <p class = 'content'> <?php echo $less3row['lecture_details']; ?> </p>

                                </div>

                            </details>

                                </div>

                            <?php

                                }

                            }

                            ?>

                                </div>

                        <?php     
                           
                        }else{

                            echo "No lesson has been added";

                        }
                       
                        $con->close();
                    ?>        

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
        <script src="../otherFiles/js/metisMenu.min.js"></script>
        <script src="../otherFiles/js/sb-admin-2.js"></script>

    </body>

</html>
