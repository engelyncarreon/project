<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Finished Course</title>

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

                        <li class = 'active'>

                            <a href="FinishedCourse.php"><i class="fa fa-flag-checkered"></i> Finished Course</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header"><i class="fa fa-flag-checkered"></i> Finished Course</h1>

                </div>

            </div>

            <div class="row">

                    <?php

                        $Finishedlesson = 'Select * from studentcourse natural join courses where lessonstatus = "Finished" AND student_id = '.$row['student_id'].'';
                        $resultfinished  = mysqli_query($con, $Finishedlesson);

                        if($resultfinished -> num_rows > 0){

                            $counter = 0;
                            echo "<div class = 'row'>";

                        while ($rowfinished = mysqli_fetch_assoc($resultfinished)){

                            if($counter != 0 && $counter % 3 == 0){

                                echo "</div>

                                <div class = 'row'>";

                        }

                    ?>


                <div class="col-sm-4 text-center">

                    <img class="img-responsive imgUp" src = "<?php echo "../instructor/".$rowfinished["course_imageurl"];?>" alt = "course-image" style = "width:330px; height:190px;">
                                
                            <h3 id = 'title'>
                            
                               <?php echo $rowfinished['course_name'];?>
                          
                            </h3>
                        
                            <div>

                                <!-- <a id = 'link' href = "LessonArea.php?c=<?php echo $rowfinished['course_id'];?>&d=<?php echo $rowfinished['current_lesson'];?>&m=<?php echo $rowfinished['lecture_id'];?>&l=<?php echo $rowfinished['lesson_id'];?>" class = 'button'>View Details
                                </a>  -->

                                <p>

                                    <a href = "#view" data-toggle = "modal"><button class = "button">Click Here</button></a>
                                    
                                </p>

                                <div  id="view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

                                  <div class="modal-dialog" >

                                    <div class="modal-content" >

                                       <div class="modal-body" >

                                        <button class="close" data-dismiss="modal">&times;</button>

                                       <h3 class="text-center"></h3>
                                    
                                        </div>

                                    </div>

                                  </div>
                                    
                                </div>

                            </div>

                    </div>

                    <?php  

                        ++$counter;

                        }

                        echo "</div>";

                    }else{

                        echo "No course done yet";
                    }                                   
                                            
                    ?>

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
