<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Courses</title>

        <link href="../styles/bootstrap.min.css" rel="stylesheet">

        <link href="../styles/metisMenu/metisMenu.min.css" rel="stylesheet">

        <link href="../styles/dashboard.css" rel="stylesheet">

        <link href="../styles/morrisjs/morris.css" rel="stylesheet">

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = "stylesheet" href = "../styles/table.css"/>

        <link rel = "stylesheet" href = "../styles/popUp.css"/>

        <link rel = "stylesheet" href = "../styles/alert.css"/>

        <link rel = "stylesheet" href = "../styles/tabstyle.css"/>

        <link rel = "stylesheet" href = "../styles/modal.css"/>
        <link rel = "stylesheet" href = "../styles/editlesson.css"/>
        

       
        <link rel = icon href = "../image/ntu-logo.png">
        
    </head>

    <body>

    <?php
    require('../database/db.php');
    include('../authentication/auth.php');
    $urlid = $_REQUEST['course'];
    $querycourse = "Select * from courses where course_id = '$urlid'";
    $resultcourse = mysqli_query($con, $querycourse);
    $rowcourse = mysqli_fetch_assoc($resultcourse);
    $count = array();
    
        
// Check if image file is a actual image or fake image

    if(isset($_POST['submitlesson'])){
       $sel = "Select Count(*) as total from lessons where course_id = '$urlid' ";
        $quer = mysqli_query($con,$sel);
        $r = mysqli_fetch_assoc($quer);
       
     
        $coun = $r['total']+1;

        $less = $_POST['lesson'];
        $lectname = $_POST['lecturename'];
        $lectdetails = $_POST['lecturedetail'];
        $upfile = $_FILES['upfile']['name'];
        $insert = "INSERT INTO lessons(lesson_name,course_id,lesson_seq) VALUES('$less','$urlid','$coun')";
        $inserresult = mysqli_query($con,$insert);

        
        $select = "Select * from lessons where lesson_name='$less' and course_id='$urlid'";
        $selectresult = mysqli_query($con,$select);
        $selectrow = mysqli_fetch_assoc($selectresult);
        $rowl = $selectrow['lesson_id'];

        
        for ($i=0; $i<count($lectname); $i++){
           
            $sele = "Select Count(*) as total from lecture natural join lessons where course_id ='$urlid' and lesson_name =  '$less'  ";
            $que = mysqli_query($con,$sele);
            $re = mysqli_fetch_assoc($que);
           
         
             $counr = $re['total']+1;
            
            
            $lectnam = $lectname[$i];
            $lectdetail = $lectdetails[$i];
            
            if (empty($_FILES['upfile']['name'][$i])){
             
                  $insert1 = "INSERT INTO lecture(lesson_id,lecture_name,lecture_details,lecture_seq) VALUES('$rowl','$lectnam','$lectdetail','$counr')";
                    $inserresult1 = mysqli_query($con,$insert1);
               
            }else{
          
                
                include('imageuploader.php');  
                
                $realname =$_FILES['upfile']['name'][$i];

                 $insert1 = "INSERT INTO lecture(lesson_id,lecture_name,lecture_details,url,urlname,lecture_seq,filetype) VALUES('$rowl','$lectnam','$lectdetail','$sha','$realname','$counr','$type')";
                $inserresult1 = mysqli_query($con,$insert1);
                
            }
            
           
        }
        
               
        unset($_POST['submitlesson']);

        $con->close();
    }

    
?>
        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php

            include('../navigation/nav.php');

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

                            <a href="instrDashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>

                        </li>

                        <li>

                            <a href="addCourse.php"><i class="glyphicon glyphicon-plus"></i> Add Course</a>

                        </li>


                        <li>

                            <a href="courses.php"><i class="fa fa-book"></i> Courses</a>

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

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h2 class="page-header"> 

                            <?php echo $rowcourse['course_name']; ?>
                                
                        </h2>

                    </div>

                        <!-- <img src = "../image/guide.png"/> -->
<!--
                        <div class="tab">
                          <button class="tablinks" onclick="openCity(event, 'coursedetails')" id="defaultOpen">Course Details</button>
                          <button class="tablinks" onclick="openCity(event, 'Lesson')">Lessons</button>
                          <button class="tablinks" onclick="openCity(event, 'Students')">Students</button>
                        </div>
-->

                        
<!--                            <div id="coursedetails" class="tabcontent">-->
                                <p>Category: <?php echo $rowcourse['course_category']; ?></p>

                                <p>Price:<?php echo $rowcourse['course_price']; ?></p> 

                                <p>Duration: <?php echo $rowcourse['course_duration']; ?></p>
                            
                                <p>Course Description:<?php echo $rowcourse['course_desc']; ?></p>
                                
                                <p>Course Overview:<?php echo $rowcourse['course_overview']; ?></p>
                                
                                <p>Course Learning Objective:<?php echo $rowcourse['course_learning']; ?></p>
                                
                                <p>Requirement: <?php echo $rowcourse['course_requirement']; ?></p>
                    
                                <form action="students.php" method="post">

                                    <input type="hidden" name="idd" value="<?php echo $urlid;?>"/>
                                    <input type="submit" name="students" value="View all Students"/>
                                    
                                </form>
<!--                            </div>-->
                
     
                                <h3>Lessons</h3>
                                
                                <button id="lesson">Add Lesson</button>
                    <?php 
                            $pre = "Select * from lessons natural join lecture where course_id = '$urlid' and lesson_seq = 1 ";
                            $prev = mysqli_query($con,$pre);
                            $prevlesson = mysqli_fetch_assoc($prev);
                    ?>
                    
                        <a href = "LessonArea.php?c=<?php echo $prevlesson['course_id'];?>&m=<?php echo $prevlesson['lecture_id'];?>&l=<?php echo $prevlesson['lesson_id'];?>">

                                <button >Preview Lesson</button></a>
                                <!-- The Modal -->
                                    <div id="myModal" class="modal">

                                      <!-- Modal content -->
                                      <div class="modal-content">
                                        <span class="close">&times;</span>
                                          <h4>Create Lesson</h4>
                                        <form action="coursedetails.php?course=<?php echo $urlid; ?>" method="post" class="ajax" enctype="multipart/form-data">
                                            <div id ="cours1">
                                                <p>Lesson Name:<input type="text" name="lesson" required></p>
                                                <p>Lecture Name:<input type="text" name="lecturename[]" required</p>
                                                <p>Lecture Details:</p><textarea rows="10" cols="50" name="lecturedetail[]" required></textarea>
                                               <label for="file"><span>Filename:</span></label>
                                                <input type="File" name="upfile[]" id="upfile[]" />
                                                
                                                
                                            </div>
                                            <button type="button" onclick="addlecture()" name="add" class="addless">Add Lecture</button>
                                              <input type="submit" name="submitlesson" value="submit"></br>
                                            
                                        </form>
                                      </div>
                                        
                                    </div><hr>

                            <?php
                            
                                require('../database/db.php');
                                $less2 = "Select * from lessons where course_id = '$urlid'";
                                $less2result = mysqli_query($con,$less2);
                                    
                                
                               
                                if($less2result){
                                    
                                    while( $less2row = mysqli_fetch_assoc($less2result)){?>
                                        
                                        <?php
                                        $r =  $less2row['lesson_id'];
                                    
                                        $lessid = $less2row['lesson_id'];
                                         include("Editlesson.php");
                                        echo "Lesson Name: ".$less2row['lesson_name']."<br>";
                                        
                                        $less3 = "Select * from lecture where lesson_id = '$lessid' Order by lecture_id";
                                        $less3result = mysqli_query($con,$less3);
                                
                                        while( $less3row = mysqli_fetch_assoc($less3result)){
                                            echo "Lecture Name: ".$less3row['lecture_name']."<br>";
                                            echo "Lecture Details: ".$less3row['lecture_details']."<br>";
                                        }
                                        echo "<hr>";
                                    }     
                                   
                                }
                                else{
                                    echo "No lesson has been added";
                                }
                               
                                
                                
                                $con->close();
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
        <script src="../js/modal.js"></script>
<!--        <script src="../js/editlesson.js"></script>-->
        

        <script type="text/javascript">
            
            var countname=2;
            function addlecture(){
                
   
                //lecture  name
   
                var lab = document.createElement("hr");
                document.getElementById("cours1").appendChild(lab);
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+(countname)  +" Name");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("input");
                area.setAttribute("name","lecturename[]");
                area.setAttribute("type","text");
                area.setAttribute("required","true");
                area.rows = 1;
                document.getElementById("cours1").appendChild(area);
                
                //lesson details
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+ (countname)  +" Details");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecturedetail[]");
                area.rows = 10;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
            
                
                var area = document.createElement("input");
                area.setAttribute("type","file");
                area.setAttribute("name","upfile[]");
                area.setAttribute("required","true");
                document.getElementById("cours1").appendChild(area);
                countname= countname+1;
            }
             
            
        </script>
        <script>
            var nam=0;
        $(document).on("click", ".output", function fan() {
             nam = $(this).data('id');
             // As pointed out in comments, 
             // it is superfluous to have to manually call the modal.
             // $('#addBookDialog').modal('show');
        });
      
    </script>

    </body>

</html>