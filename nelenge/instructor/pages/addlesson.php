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
       
        <link rel = icon href = "../image/ntu-logo.png">
        
    </head>

    <body>

    <?php

        require('../database/db.php');
        include('../authentication/auth.php');
        $urlid = $_REQUEST['course'];
        $querycourse = "Select * from courses Natural Join lessons where course_id = $urlid";
        $resultcourse = mysqli_query($con, $querycourse);
        $rowcourse = mysqli_fetch_assoc($resultcourse);
        
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

                   

                        <!-- <img src = "../image/guide.png"/> -->
                        <div class="tab">
                          <button class="tablinks" onclick="openCity(event, 'Step1')" id="defaultOpen">Step 1</button>
                          <button class="tablinks" onclick="openCity(event, 'Step2')">Step 2</button>
                          <button class="tablinks" onclick="openCity(event, 'Step3')">Step 3</button>
                        </div>

                        <form action = "addCourse.php" class = "course" method ="post" enctype="multipart/form-data">
                            <div id="Step1" class="tabcontent">
                                <p>Course</p>                               
                                <input type = "text" name = "coursename">           
                                <p>Category</p>
                                <input type = "text" name = "category">
                                <p>Price</p>
                                <input type = "number" name = "price">    
                                <p>Duration</p>
                                <input type = "number" name = "duration">
                                <button ><a href="#Step2"> Next Step</a></button>
                            </div>
                            
                            <div id="Step2" class="tabcontent">
                                <p>Course Description</p>
                                <textarea rows="4" cols="50" name = "coursedesc"></textarea>
                                <p>Course Overview</p>
                                <textarea rows="4" cols="50" name = "courseover"></textarea>
                                <p>Course Learning Objective</p>
                                <textarea rows="4" cols="50" name = "courselearn"></textarea>
                                <p>Requirement</p>
                                <textarea rows="4" cols="50" name = "requirement"></textarea>
                                <input type="submit" name="coursesubmit"><a href ="#Step3">Create Lesson</a></button>
                            </div>
                    </form>
                    
                            <div id="Step3" class="tabcontent">
                                <form action=
                                <div id = "cours1" name="all[]">
                                    <p >Lesson 1 Name</p>
                                    <div id= "lecture">
                                    <textarea rows="1" cols="50"  name="lesson[]"></textarea>
                                    <p >Lecture 1 Name</p>
                                    <textarea rows="4" cols="50" id="samp"  name="lecturename0[]"></textarea>
                                    
                                    <p >Lecture 1 Details</p>
                                    <textarea rows="4" cols="50"  name="lecture0[]"></textarea>
                                        <button type="button" id="lesson1" onclick="lecture()"><i class = 'fa fa-plus'></i> Add lecture</button>
                                    </div>
                                     <button type="button"  onclick="lesson()"><i class = 'fa fa-plus'></i> Add lesson</button>
                                
                                    <input type = "submit" name="submit">
                                </div>
                                <p id="demo"></p>
                                
                               
                            </div>
                            

                        </form>

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

        <script type="text/javascript">

            function myFunction() {
                var x = document.getElementById("lesson1").previousSibling.innerHTML; 
                console.log(x);
            }    
            var count = 0;
            var countlesson = 0;
            
            var countname=2;
            function lecture(){
                
   
                //lecture  name
                
                var l =  document.getElementsById("lesson1").previousSibling.innerHTML;
                console.log(l);
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+(countname)  +" Name");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecturename"+count+"[]");
                area.rows = 1;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
                
                //lesson details
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+ (countname)  +" Details");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecture"+count+"[]");
                area.rows = 4;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
                countname= countname+1;
            }
             countlesson= 1;
            function lesson(){

                count =count +1;
               
                countnam = 1;
   
                //lesson name
                var lab = document.createElement("p");
                var text = document.createTextNode("Lesson "+(countlesson+1)  +" Name");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lesson[]");
                area.rows = 1;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
                
                //lesson name
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+(count)  +" Name");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecturename"+count+"[]");
                area.rows = 1;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
                
                //lesson details
                var lab = document.createElement("p");
                var text = document.createTextNode("Lecture "+ (count)  +" Details");
                lab.appendChild(text);                
                var br= document.createElement("br");
                lab.appendChild(br);
                document.getElementById("cours1").appendChild(lab);
                
                var area = document.createElement("textarea");
                area.setAttribute("name","lecture"+count+"[]");
                area.rows = 4;
                area.cols = 50;
                document.getElementById("cours1").appendChild(area);
                
               countlesson= countlesson+1;
            }
            
        </script>

        <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("submit");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
    </script>

    </body>

</html>