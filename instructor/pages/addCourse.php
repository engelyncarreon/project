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

        <link rel = icon href = "../image/ntu-logo.png">

        <!-- <script>

            function steps(evt, stepNo) {
                var i, tabcontent, tablinks;
                
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }

                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(stepNo).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
            
            </script>
 -->
        
    </head>

    <body>

        <?php

            require('../database/db.php');
            include('../authentication/auth.php');

            if(isset($_POST['submit'])){
                $coursename = $_POST['coursename'];
                $category = $_POST['category'];
                $price = $_POST['price'];
                $duration = $_POST['duration'];
                $instr = $row['instructor_id'];
                $coursedesc = $_POST['coursedesc'];
                $courseover = $_POST['courseover'];
                $courselearn =  $_POST['courselearn'];
                $requirement =  $_POST['requirement'];
                
                $query1= "INSERT INTO courses(course_name, course_instr, course_category, course_price, course_overview,course_learning,course_desc,course_duration, course_requirement) VALUES (  '$coursename','$instr','$category ','$price', '$courseover', '$courselearn', '$coursedesc', '$duration', '$requirement' )";  
            
                        
                $results = mysqli_query($con,$query1); 
                $ques = "SELECT * from courses where course_name ='$coursename' and course_instr = '$instr'";
                $res = mysqli_query($con,$ques); 
                $rowm =  mysqli_fetch_assoc($res);
                
                $count = 0;
            
                if ($result){

                    header('Location: Coursedetails.php?course='.$rowm["course_id"].'');

                    $con->close();
        

                } else{

                    echo "<div class = 'alert warning'>

                            <span class='closebtn'>&times;</span> 

                            <div id = 'failed'>

                            <i class = 'fa fa-times-circle fa-5x'></i>

                            </div>

                                <strong>Adding Failed!</strong><br/>
                                Click here to <a href = 'addCourse.php' class = 'link'>Add Course</a> again.

                            </div>";
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

                        <h1 class="page-header"><i class = "glyphicon glyphicon-plus"></i> Add Course</h1>

                    </div>

                    <ol class="breadcrumb">

                            <li>

                                <a href = "instrDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                            </li>

                        </ol>

                        <!-- <img src = "../image/guide.png"/> -->

                       <!--  <div class="tab">

                          <button class="tablinks" onclick="steps(event, 'Step1')" id="defaultOpen">Step 1</button>

                          <button class="tablinks" onclick="steps(event, 'Step2')">Step 2</button>

                        </div> -->

                        <form action = "addCourse.php" class = "course" method ="post" enctype="multipart/form-data">

                            <div id="Step1" class="">

                            <div id = "left">
                                <p>Course</p>                               
                                <input type = "text" name = "coursename" required/>           
                                <p>Category</p>
                                <input type = "text" name = "category" required/>
                                <p>Price</p>
                                <input type = "number" name = "price">    
                                <p>Duration</p>
                                <input type = "number" name = "duration" required/><br/><br/>
                                <p>Course Description</p>
                                <textarea rows="4" cols="50" name = "coursedesc" required/></textarea>
                            </div>
                            <div id = "Step2">
                                <p>Course Overview</p>
                                <textarea rows="4" cols="50" name = "courseover" required/></textarea>

                                <p>Course Learning Objective</p>
                                <textarea rows="4" cols="50" name = "courselearn" required/></textarea>

                                <p>Requirement</p>
                                <textarea rows="4" cols="50" name = "requirement" required/></textarea><br/><br/>

                                <button class = "button link" name = "submit" type = "submit"><i class = 'fa fa-plus'></i> Add new course</button>
                               <!--  <input class = "button link" type = "submit" name="submit" value = "Add new course"></input> -->
                            </div>

                            </div>
                            
                        </form>
                        
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

            <script>

            var close = document.getElementsByClassName("closebtn");
            var i;

            for (i = 0; i < close.length; i++) {

                close[i].onclick = function(){
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function(){ div.style.display = "none"; }, 600);
                }
            }
            
            </script>

    </body>

</html>