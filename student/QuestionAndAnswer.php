<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Q&A</title>

        <link href="../otherFiles/styles/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/dashboard.css" rel="stylesheet">

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../otherFiles/image/logo/ntu-logo.png">

        <script type='text/javascript'>

            $(function(){
                $("a.reply").click(function() {
                    var id = $(this).attr("id");
                    $("#parent_id").attr("value", id);
                    $("#name").focus();
                });
            });
            
        </script>
        
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

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header"><i class = "fa fa-comments-o"></i> Q&A</h1>

                        <?php

                                require('../otherFiles/database/db.php');
                                $course_id = $_REQUEST['c'];
                            $student_id = $row['student_id'];
                            include('QuestionAndAnswerfunction.php');

                            ?>
                        <div class="row">
                        <form action="" method="post">
                            <div class="col-lg-12">

                            <p>
                            <textarea class="form-control" name="question" placeholder="Make a question"></textarea>
                            </p>

                            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" >                        
                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>" >                        
                            <input type="submit" name="question-submit" value = "Post Question"><br>

                            </div>
                            
                        </form>
                        </div>
                        
                        <?php
                            if(isset($_POST['question-submit'])){
                                $cour = $_POST['course_id'];
                                $student_id = $_POST['student_id'];
                                $comment_id = 0;
                                
                             
                                
                                $question = $_POST['question'];
                                $q = "Select * from comment where course_id = '$cour'";
                                $qquery = mysqli_query($con,$q);
                                $fetchquery = mysqli_num_rows($qquery)+1;
//                                
//                                if(empty($qquery)){
                                    $quest = "INSERT INTO comment(comment,course_id,reply_to,count,timestamp) Values('$question','$cour','$comment_id','$fetchquery',now())";
                                    $questquery = mysqli_query($con,$quest);

                                    $stud = "Select * from comment where comment = '$question' and course_id = '$cour' and count = '$fetchquery'";
                                    $studquery = mysqli_query($con,$stud);
                                    $studfetch = mysqli_fetch_assoc($studquery);
                                    $studcomment = $studfetch['comment_id'];
                               

                                    $student_comment ="INSERT INTO student_comment(student_id,comment_id) VALUES('$student_id','$studcomment')";
                                    $student_query = mysqli_query($con,$student_comment);
                                    
//                                }else{
//                                    $qfetch = mysqli_fetch_assoc($qquery);
//                                    $studcomment = $qfetch['comment_id'];
//
//                                    $student_comment ="INSERT INTO student_comment(student_id,comment_id) VALUES('$student_id','$studcomment')";
//                                    $student_query = mysqli_query($con,$student_comment);
//                                }
                            }
                            
//                        
                            $comment = "SELECT * from comment where course_id = '$course_id' and reply_to='0' ORDER BY timestamp DESC";
                            $commentquery = mysqli_query($con,$comment);
                            ?>
                            <ul class="list-group">
                            <?php 
                            while($commentfetch = mysqli_fetch_assoc($commentquery)){
                                        getComments($commentfetch);
                      
                            }
                        
                        
                        
                      

                                           ?></ul>
                        
                        
                        
                        
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

    </body>

</html>