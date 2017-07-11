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

        <link rel = "stylesheet" href = "../styles/custom.css"/>

        <link rel = "stylesheet" href = "../styles/popUp.css"/>

        <link rel = "stylesheet" href = "../styles/tabstyle.css"/>

        <link rel = "stylesheet" href = "../styles/modal.css"/>

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

     

        if(isset($_POST['submitlesson'])){
            
            $less = $_POST['lesson'];
            $lectname = $_POST['lecturename'];
            $lectdetails = $_POST['lecturedetail'];
             
            
            $insert = "INSERT INTO lessons(lesson_name,course_id) VALUES('$less','$urlid')";
            $inserresult = mysqli_query($con,$insert);
            
            
            $select = "Select * from lessons where lesson_name='$less' and course_id='$urlid'";
            $selectresult = mysqli_query($con,$select);
            $selectrow = mysqli_fetch_assoc($selectresult);
            $rowl = $selectrow['lesson_id'];
            echo $rowl;

           foreach (array_combine($lectname, $lectdetails) as $lectnam => $lectdetail) {
                 $insert1 = "INSERT INTO lecture(lesson_id,lecture_name,lecture_details) VALUES('$rowl','$lectnam','$lectdetail')";
                 $inserresult1 = mysqli_query($con,$insert1);
            }
            
        }

        $con->close();
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
                                
<!--                            </div>-->
                
     
                                <h3>Lessons</h3>
                                
                                <button id="lesson">Add Lesson</button><br/><br/>
                                <!-- The Modal -->
                                    <div id="myModal" class="modal">

                                      <!-- Modal content -->
                                      <div class="modal-content">

                                        <span class="close">&times;</span>
                                          <h4>Create Lesson</h4>

                                        <form action="coursedetails.php?course=<?php echo $urlid; ?>" method="post" class="ajax">

                                            <div id ="cours1">
                                                <p>Lesson Name:

                                                    <input type="text" name="lesson">

                                                </p>

                                                <p>Lecture Name:

                                                    <input type="text" name="lecturename[]">

                                                </p>

                                                <p>Lecture Details:</p>

                                                    <textarea class = "indent" rows="10" cols="50" name="lecturedetail[]"></textarea>

                                            </div>

                                            <button type="button" class = "button" onclick="addlecture()" name="add" class="addless"><i class = 'fa fa-plus'></i> Add Lecture</button>

                                              <button type="submit" class = "button" name="submitlesson"><i class = 'fa fa-plus'></i> Add new Lesson</button>
                                            
                                        </form>
                                      </div>
                                        
                                    </div>

                            <?php
                            
                                require('../database/db.php');
                                $less2 = "Select * from lessons where course_id = '$urlid'";
                                $less2result = mysqli_query($con,$less2);
                                    
                                
                               
                                if($less2result){
                                    
                                    while( $less2row = mysqli_fetch_assoc($less2result)){

                                        $lessid = $less2row['lesson_id'];

                                        echo "<div class = 'subtitle'>

                                                Lesson Name: ".$less2row['lesson_name']."<br/>

                                                </div>";
                                        
                                        $less3 = "Select * from lecture where lesson_id = '$lessid'";
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
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecturename[]");
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
                countname= countname+1;
            }
             
            
        </script>

    </body>

</html>