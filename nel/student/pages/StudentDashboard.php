<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Dashboard</title>

        <link href="../styles/bootstrap.min.css" rel="stylesheet">

        <link href="../styles/metisMenu/metisMenu.min.css" rel="stylesheet">

        <link href="../styles/dashboard.css" rel="stylesheet">

        <link href="../styles/morrisjs/morris.css" rel="stylesheet">

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../image/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php

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

                            <a href="FinishedCourse.php"><i class="fa fa-flag-checkered"></i> Finished Course</a>

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

                    <h1 class="page-header"><i class="fa fa-map-marker"></i> Current Course</h1>

                </div>

            </div>

            <div class="row">
                 <?php

                    $Ongoinglesson = 'Select * from studentcourse natural join courses where lessonstatus = "Ongoing" AND student_id = '.$row['student_id'].'';
                    $resultongoing  = mysqli_query($con, $Ongoinglesson);
                    
                    while ($rowongoing = mysqli_fetch_assoc($resultongoing)){

                ?>
                
                <div class="col-lg-3 col-md-6">
                   
                    <div class="panel panel-student">

                        <div class="panel-heading">

                            <div class="row">

                                <div class="col-xs-12">

                                
                                    <div>

                                       <?php echo "<p>". $rowongoing['course_name']. "</p>";?>
                                  
                                    </div>

                                </div>

                            </div>

                        </div>

                       <!--  <form action = "LessonArea.php" method = "POST">

                            <input type = "hidden" name = "course_id" value = "<?php echo $rowongoing['course_id'];?>">

                            <input type = "hidden" name = "current_lesson" value = "<?php echo $rowongoing['current_lesson'];?>">

                            <input type = "hidden" name = "lecture_seq" value = "<?php echo $rowongoing['lecture_seq'];?>">

                            <input type = "hidden" name = "lecture_id" value = "<?php echo $rowongoing['lesson_id'];?>"> -->

                            <a href = "LessonArea.php?c=<?php echo $rowongoing['course_id'];?>&d=<?php echo $rowongoing['current_lesson'];?>&m=<?php echo $rowongoing['lecture_seq'];?>&l=<?php echo $rowongoing['lesson_id'];?>">

                            <div class="panel-footer">

                               <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>

                            </div>

                        </a> 

                    </div>

                </div>
                <?php  }                                   
                                    
                                    
                                    ?>

            </div>

            </div>
 
           

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
