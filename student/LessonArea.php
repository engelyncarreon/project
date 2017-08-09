<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Lesson Area</title>

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

                          <?php 
                            
                            $id = $row['student_id'];
                            $cid =$_GET['c'];
                            $les = $_GET['l'];
                            $seq = $_GET['m'];
                            $lessseq = $_GET['ls'];
                            
                            $studlesson = "SELECT * FROM studentcourse natural join lessons  where student_id = '$id' and course_id = '$cid'";                         
                            $studresult = mysqli_query($con, $studlesson);
                            $studrow1 = mysqli_fetch_assoc($studresult);
                        
                            $courseid = $studrow1['course_id'];                            
                            $studcourse = "Select * from lessons where course_id = '$courseid'  ";       
                            $studcourresult = mysqli_query($con, $studcourse);
                            $county = 1;
                           
                            
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

                                    $less3 = "SELECT * from lecture where lesson_id = '$lessid'  order by lecture_id";
                                    $less3result = mysqli_query($con,$less3);
                             
                                    $sam = 0;
                                   while( $less3row = mysqli_fetch_assoc($less3result)){
                                       
                                    ?>  
                                    
                                     <a href="LessonArea.php?c=<?php echo $cid; ?>&m=<?php echo $less3row['lecture_seq'];?>&l=<?php echo $studrow['lesson_id'];?>&ls=<?php echo $studrow['lesson_seq'];?>">
                                        <?php echo  $less3row['lecture_name'];?>  
                                    </a>
                                    
                                    
                                <?php

                                    $lecture_id = $less3row['lecture_id'];
//                                       echo $lecture_id;
                                    $quiz = "Select quiz_id, lecture_id from quiz_question where lecture_id = '$lecture_id'";
                                    $quizres = mysqli_query($con,$quiz);
                                    $quizrow = mysqli_fetch_assoc($quizres);
                                    $sam = $less3row['lecture_seq'];

                                        if(!empty($quizrow)){
                        
                                ?>  

                                <a href="LessonArea.php?c=<?php echo $cid; ?>&m=<?php echo $sam;?>&l=<?php echo $studrow['lesson_id'];?>&ls=<?php echo $studrow['lesson_seq'];?>&q=<?php echo $lecture_id; ?>">

                                    <?php echo  "Quiz ".$county;?>  

                                </a>

                                <?php 
                                        }
                                        
                                        $county++;
                                  
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
                $les = $_GET['l'];  //lesson id
                $seq = $_GET['m'];  //lecture seq
                $lessseq = $_GET['ls']; //lesson seq

                $cor = "Select * from lessons natural join lecture where course_id = '$cid' AND lecture_seq = '$seq' AND lesson_id = '$les' AND lesson_seq = '$lessseq'   ";              
                $cq = mysqli_query($con,$cor);
                $crow = mysqli_fetch_assoc($cq);
            
                    
            ?>

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">

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

           <div class = "col-lg-12">

                    <?php 

                        if(!empty($_REQUEST['q'])){
                        $lectidd = $_REQUEST['q'];
                        $getquiz ="SELECT * from quiz_question where lecture_id = '$lectidd'";
                        $getquizquery = mysqli_query($con,$getquiz);
                       
                        
                    ?>

                <form action="" method="POST">

                    <?php

                        $qi =1;

                        while ($getquizresult = mysqli_fetch_assoc($getquizquery)){

                            echo "<div class = 'panel panel-info'>

                                    <div class = 'panel-heading'>

                                        Question ".$qi. " :". $getquizresult['Question']."

                                    </div>

                                    <div class = 'panel-body'>";

                            $quizidd = $getquizresult['quiz_id'];

                            $quizan = "Select * from quiz_choices where quiz_id = '$quizidd'";
                            $quizanres = mysqli_query($con,$quizan);
                            $c1 = 1;
                            
                    ?>

                    <div class="control-group">
                        
                    <?php
                             if($getquizresult['quiztype'] == "video"){

                                   ?>                                 
                            
                                    <p><?php echo $getquizresult['description']; ?></p>
                                    <input type="file" name="student">
                                    <?php
                               }

                            else {

                        while($quizanrow = mysqli_fetch_assoc($quizanres)){

                            $quizanswer = $quizanrow['choices'];
                            $quizanswerid = $quizanrow['quiz_choicesid'];
                           if($getquizresult['quiztype']=='radio'){

                    ?>


                    <input type="radio"  name="answerradio[<?php echo $quizidd; ?>][]" value="<?php echo $quizanswer; ?>"><?php echo $quizanswer; ?><br>

                    <?php

                        }else if($getquizresult['quiztype']=='checkbox'){

                    ?>

                    <input type="checkbox" name="answerradio[<?php echo $quizidd; ?>][]" value="<?php echo $quizanswer; ?>">

                    <?php echo $quizanswer; ?>

                    <br>

                    <?php

                        }else if($getquizresult['quiztype']=='identification'){

                    ?>

                    <input type="text" name="answerradio[<?php echo $quizidd; ?>][]"><br>

                    <?php

                        }$c1++;

                    }
                            }

                    ?>

                    </div>
                        
                    <?php

                    echo "</div>
                            </div>";

                            $qi++;
                        }

                    ?>

                    <input type="submit" name="quiz">
                        
                    </form>

                    <?php
                    
                    }else{

                            if(empty($crow['url'])) {


                     ?>

                        <p><?php echo $crow['lecture_details']; ?></p>

                    <?php 

                        }else { 

                            $url = $crow['url'];

                            if($crow['filetype']=='Video'){ 

                    ?>                  

                        <video width='700' height="400" controls autoplay>

                            <source src="<?php echo $url ?>" type='video/mp4'>

                        </video>  

                    <?php 

                        }  else if($crow['filetype']=='image'){

                    ?>

                        <img class="img-responsive" src = "<?php echo "../instructor/".$url;?>" alt = "course-image">

                    <?php

                        }  else{ 

                    ?>

                        <a href="<?php echo $crow['url']; ?>"><?php echo $crow['urlname']; ?></a>

                    <?php

                        }

                    ?>
                        <p class = "content"><?php echo $crow['lecture_details']; ?></p>

                    <?php 

                        }
                    }
                        $net = $crow['lecture_seq']+1;
                        $netless = $crow['lesson_seq'];
                        $netlessid = $crow['lesson_id'];
                        $netlectid = $crow['lecture_id'];
                        $netid = $crow['course_id'];
                        $next = "Select * from lessons natural join lecture where lesson_id = '$netlessid' and lesson_seq = '$netless' and lecture_seq= '$net' and course_id = '$netid'";


                        $nextres = mysqli_query($con, $next);
                        $nextrow = mysqli_fetch_assoc($nextres);
                        $quiz = "Select quiz_id,lecture_id from quiz_question where lecture_id = '$netlectid'";
                        $quizres = mysqli_query($con,$quiz);
                        $quizrow = mysqli_fetch_assoc($quizres);

                        $quizid = $quizrow['quiz_id'];
                       
                        if(isset($nextrow)){
                        if(empty($_REQUEST['q'])&!empty($quizrow['quiz_id'])){                              

                    ?>    

                    <p class = "text-center">

                       <a href="LessonArea.php?c=<?php echo $cid; ?>&m=<?php echo $_REQUEST['m'];?>&l=<?php echo $_REQUEST['l'];?>&ls=<?php echo $_REQUEST['ls'];?>&q=<?php echo $quizrow['lecture_id']; ?>"> 

                            <button >Quiz</button></a>

                        </a>

                    </p>

                    <?php
                            
                        }else if(isset($nextrow)) {

                     ?>

                     <p class = "text-center">

                        <a href="LessonArea.php?c=<?php echo $cid; ?>&m=<?php echo $nextrow['lecture_seq'];?>&l=<?php echo $nextrow['lesson_id'];?>&ls=<?php echo $nextrow['lesson_seq'];?>">

                            <button >Continue</button>

                        </a>

                    </p>

                    <?php

                        }else{

                    ?>

                    <form action="finishedcode.php" method="post">

                         <input type="hidden" name="stid" value=<?php echo $id;?> >
                        <input type="hidden" name="coid" value =<?php echo  $cid;?> >
                        <input type="hidden" name="leid" value=<?php echo  $les;?> >
                        <input type="submit" name="finished" value="Finish Course">

                    </form>

                        <?php

                        }

                        }    else {

                                $crow['lecture_seq']=1;
                                $net1 = $crow['lecture_seq'];
                                $netless1 = $crow['lesson_seq']+1;
                                $netless1id = $crow['lesson_id'];

                                $next1 = "Select * from lessons natural join lecture where lesson_seq = '$netless1' and lecture_seq= '$net1' and course_id = '$netid'";
                                $nextres1 = mysqli_query($con, $next1);
                                $nextrow1 = mysqli_fetch_assoc($nextres1);
                               
                               
                                if(isset($nextrow1)) {                              

                            ?>     

                            <p class = "text-center">

                                <a href="LessonArea.php?c=<?php echo $cid; ?>&m=<?php echo $nextrow1['lecture_seq'];?>&l=<?php echo $nextrow1['lesson_id'];?>&ls=<?php echo $nextrow1['lesson_seq'];?>">

                                    <button >Continue</button>

                                </a>

                            </p>

                            <?php 

                                }else{
                               
                               
                            ?>

                            <form action="finishedcode.php" method="post">

                                <input type="hidden" name="stid" value=<?php echo $id;?> >
                                <input type="hidden" name="coid" value =<?php echo  $cid;?> >
                                <input type="hidden" name="leid" value=<?php echo  $les;?> >
                
                                <p class = "text-center">

                                    <input type="submit" name="finished" value="Finish Course">

                                </p>

                              </form>

                        <?php 
                               
                            } 

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
