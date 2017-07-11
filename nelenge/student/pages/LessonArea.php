<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Lesson Area</title>

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

                        <?php 
                            
                            $id = $row['student_id'];
                            $cid =$_GET['c'];
                            $lec = $_GET['d'];
                            $les = $_GET['l'];
                            $seq = $_GET['m'];
                            
                            $studlesson = "SELECT * FROM studentcourse natural join lessons  where student_id = '$id' and course_id = '$cid'";                         
                            $studresult = mysqli_query($con, $studlesson);
                            $studrow1 = mysqli_fetch_assoc($studresult);
                        
                            $courseid = $studrow1['course_id'];                            
                            $studcourse = "Select * from lessons where course_id = '$courseid'  ";       
                            $studcourresult = mysqli_query($con, $studcourse);
                           
                            
                            while( $studrow = mysqli_fetch_assoc($studcourresult)){
                                
                        ?>

                        <li>

                            <a href="#"><i class="fa fa-book"></i> 

                                <?php 

                                    echo $studrow['lesson_name'];

                                ?>

                                <span class="fa arrow"></span>

                            </a>

                            <ul class="nav nav-second-level">

                                <li>

                                <?php 

                                    $lessid = $studrow['lesson_id'];

                                    $less3 = "SELECT * from lecture where lesson_id = '$lessid'";
                                    $less3result = mysqli_query($con,$less3);
                                ?>

                                    
                                <?php

                                    while( $less3row = mysqli_fetch_assoc($less3result)){

                                    ?>  

                                    <a href="LessonArea.php?c=<?php echo $cid; ?>&d=<?php echo $studrow['lesson_seq'];?>&m=<?php echo $less3row['lecture_seq'];?>&l=<?php echo $studrow['lesson_id'];?>">
                                        <?php echo  $less3row['lecture_name'];?>
                                    </a>

                                <?php
                                   
                                    }
                   
                                ?>

                                </li>

                            </ul>

                            <?php
                                   
                                }
                   
                            ?>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <div id="page-wrapper">

            <?php 
                
                $cid = $_GET['c']; //course_id
                $lec = $_GET['d']; //current lesson
                $les = $_GET['l'];  //lecture id
                $seq = $_GET['m'];  //lecture seq
                                
            
                $cor = "SELECT * from lessons natural join lecture where course_id = '$cid'AND lecture_seq = '$seq' AND lesson_id = '$les'  ";              
                $cq = mysqli_query($con,$cor);
                $crow = mysqli_fetch_assoc($cq);
            
                        
            ?>

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">

                        <i class="fa fa-book"></i> 

                        <?php echo $crow['lecture_name']; ?>

                    </h1>

                    <ol class="breadcrumb">

                        <li>

                            <a href = "StudentDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                        </li>

                    </ol>

                </div>

            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6">

                    <?php 

                        if(empty($crow['url'])) { 

                    ?>
                        
                        <p>

                            <?php echo $crow['lecture_details']; 

                    ?>  </p>

                    <?php 

                        }else { 

                        $url = $crow['url'];
                        if($crow['filetype']=='Video')

                        { 

                    ?>             

                        <video width='700' height="400" controls autoplay> <source src="<?php echo $url ?>" type='video/mp4'></source></video>               
                    <?php 

                            }  else if($crow['filetype']=='image'){
                                ?><object data="<?php echo $url ?>" width='700' height='400' ></object>

                    <?php

                            }  else{ 

                    ?>

                        <a href="#"><?php echo $crow['urlname']; ?></a>

                    <?php
                            }

                    ?>

                        <p><?php echo $crow['lecture_details']; ?></p>

                       <?php 

                        }

                        $net = $crow['lecture_id']+1;
                        $netless = $crow['lesson_id'];
                        $netid = $crow['course_id'];
                        $next = "Select * from lessons natural join lecture where lesson_id = '$netless' and lecture_id= '$net' and course_id = $netid";
                       $nextres = mysqli_query($con, $next);
                       $nextrow = mysqli_fetch_assoc($nextres);

                       if(isset($nextrow)){
                        ?>

                        <a href="LessonArea.php?c=<?php echo $cid; ?>&d=<?php echo $nextrow['lesson_seq'];?>&m=<?php echo $nextrow['lecture_id'];?>&l=<?php echo $nextrow['lesson_id'];?>">

                            <button >Next Lecture</button>

                        </a>

                        <?php

                            } else {

                            $net1 = $crow['lecture_id']+1;

                            $netless1 = $crow['lesson_id']+1;

                            $next1 = "Select * from lessons natural join lecture where lesson_id = '$netless1' and lecture_id= '$net1' and course_id = '$netid'";

                           $nextres1 = mysqli_query($con, $next1);
                           $nextrow1 = mysqli_fetch_assoc($nextres1);

                           if(isset($nextrow1)){

                                ?>

                                <a href="LessonArea.php?c=<?php echo $cid; ?>&d=<?php echo $nextrow1['lesson_seq'];?>&m=<?php echo $nextrow1['lecture_id'];?>&l=<?php echo $nextrow1['lesson_id'];?>">
                                
                                <button >Next Lecture</button>

                                </a>

                                <?php
                               }

                            else{   

                                echo $studrow1['student_id'];
                                echo $studrow1['course_id'];

                            ?> 

                            <form action = "finishedcode.php" method="POST">

                                <input type="hidden" value=<?php echo $studrow1['student_id']; ?> name ="stid" >
                                <input type="hidden" value=<?php echo $studrow1['course_id']; ?> name="coid" >
                                <input type="hidden" value=<?php echo $studrow1['lesson_id']; ?>  name = "leid">
                                <input type="submit" value="Finished" name="finished">

                            </form>

                                <?php 
                            }

                       }


                    ?>

                    </div>

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
