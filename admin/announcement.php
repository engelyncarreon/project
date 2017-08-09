<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Announcements</title>

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

                                    <a href="student.php"><i class = 'fa fa-user'></i> Student</a>

                                </li>

                                <li>

                                    <a href="instructor.php"><i class = 'fa fa-graduation-cap'></i> Instructor</a>

                                </li>

                            </ul>

                        </li>

                        <li>

                            <a href="#"><i class="fa fa-edit"></i> User Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">

                                <li>

                                    <a href="manageStud.php"><i class = "fa fa-user"></i> Student</a>

                                </li>

                                <li>

                                    <a href="manageInstr.php"><i class = "fa fa-graduation-cap"></i> Instructor</a>

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


                        <li class = 'active'>

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

                        <h1 class="page-header"><i class = "fa fa-newspaper-o"></i>  Announcements</h1>

                        <?php

                            require('../otherFiles/database/db.php');   
                        ?>

                <div class = "row">

                    <div class = "col-lg-12">

                    <p>

                        <a href="#view" data-toggle="modal" >

                            <button>Make an Announcement</button>

                        </a>

                    </p>

                    </div>

                </div>

            <div id="view" role="dialog " class="modal fade">

              <div class="modal-dialog  modal-md">

                <div class="modal-content">

                    <div class="modal-header text-center">

                          <h3>Announcement 

                            <button class="close" data-dismiss="modal">&times;</button>

                        </h3>

                    </div>
                    
                   <div class="modal-body">
                     
                       <div class="row">

                           <div class="col-lg-12">

                                <form method="post" action="">

                                    <p>

                                        <input type="checkbox" value="instructor" name="instr">Instructor

                                        <input type="checkbox" value="student" name="stud">Student

                                    </p>

                                    <p>Subject:

                                        <input type="text" name="sub">

                                    </p>

                                    <p>Announcement:

                                        <textarea row=7 cols=65 name="ann"> </textarea>

                                    </p>

                                    <div class="text-center"><input type="submit" name="announce" class="center" value="Add Announcement"></div>

                               </form>

                           </div>

                        </div>

                    </div>

                </div>

              </div>

            </div> 

                <?php

                    $pageshow = 5;

                    if (isset($_GET["page"])){

                        $page = $_GET["page"];

                    }else{

                         $page=1;
                    }

                    $startfrom = ($page-1) * $pageshow;

                    if(isset($_POST['announce'])){

                        $message = $_POST['ann'];
                        $subject = $_POST['sub'];
                        $not = "INSERT into notification(Message,subject) values ('$message','$subject')";
                        $notquery = mysqli_query($con,$not);
                        
                        $notsel = "Select * from notification where Message='$message' and subject = '$subject'";
                        $notselquery = mysqli_query($con,$notsel);
                        $notresult = mysqli_fetch_assoc($notselquery);
                        
                        $noti_id = $notresult['notification_id'];
                        
                        $admini = $row['id_admin'];

                        if(isset($_POST['stud'])&&isset($_POST['instr'])){

                            $admin = "INSERT into admin_announcement(admin_id,notification_id,student,instructor) VALUES('$admini','$noti_id','Yes','Yes')";
                            $adminquery = mysqli_query($con,$admin);
                            
                            $query = "SELECT * FROM student";
                            $studquery = mysqli_query($con,$query);

                            while($studresult = mysqli_fetch_assoc($studquery)){

                                $student_id = $studresult['student_id'];

                                $notstud = "INSERT into studentsystem_noti(student_id,notification_id,admin_id) values ('$student_id','$noti_id','$admini')";

                                $notstudquery = mysqli_query($con,$notstud);
                              
                                
                            }
                            
                            $query = "SELECT * FROM instructor";
                            $instrquery = mysqli_query($con,$query);
                            
                            while($instrresult = mysqli_fetch_assoc($instrquery)){

                                $instructor_id = $instrresult['instructor_id'];
                                
                                $notinstr = "INSERT into instructorsystem_noti(instructor_id,notification_id,admin_id) values ('$instructor_id','$noti_id','$admini')";
                                $notstudquery = mysqli_query($con,$notinstr);
                              
                                
                            }

                        }else if(isset($_POST['stud'])&!isset($_POST['instr'])){

                            $admin = "INSERT into admin_announcement(admin_id,notification_id,student) VALUES('$admini','$noti_id','Yes')";
                            $adminquery = mysqli_query($con,$admin);
                            
                            $query = "SELECT * FROM student";
                            $studquery = mysqli_query($con,$query);

                            while($studresult = mysqli_fetch_assoc($studquery)){

                                $student_id = $studresult['student_id'];

                                $notstud = "INSERT into studentsystem_noti(student_id,notification_id,admin_id) values ('$student_id','$noti_id','$admini')";

                                $notstudquery = mysqli_query($con,$notstud);
                              
                                
                            }
                            
                            
                        } else if(isset($_POST['instr'])&!isset($_POST['stud'])){

                            $admin = "INSERT into admin_announcement(admin_id,notification_id,instructor) VALUES('$admini','$noti_id','Yes')";
                            $adminquery = mysqli_query($con,$admin);
                            
                            $query = "SELECT * FROM instructor";
                            $instrquery = mysqli_query($con,$query);
                            
                            while($instrresult = mysqli_fetch_assoc($instrquery)){

                                $instructor_id = $instrresult['instructor_id'];
                                
                                $notinstr = "INSERT into instructorsystem_noti(instructor_id,notification_id,admin_id) values ('$instructor_id','$noti_id','$admini')";
                                $notstudquery = mysqli_query($con,$notinstr);

                            }
                            
                        }
                        
                    }
                        
                        $announ = "Select * from  admin_announcement";
                        $queryannoun = mysqli_query($con,$announ);
                        
                        if($queryannoun){

                            while($resultannoun = mysqli_fetch_assoc($queryannoun)){

                                $student = $resultannoun['student'];
                                $instr = $resultannoun['instructor'];
                                $mid = $resultannoun['notification_id'];
                                
                                $mess = "Select * from notification where notification_id =$mid ";
                                $mesquery = mysqli_query($con,$mess);
                                $mesresult = mysqli_fetch_assoc($mesquery);
                                $message = $mesresult['Message'];
                                $sub = $mesresult['subject'];
                                
                                ?> 

                                <div class = "panel panel-info">

                                 <div class = "panel-heading">

                                    <p>Subject: <?php echo $sub?></p>

                                </div>

                                    <div class = "panel-body">

                                        <p>Message: <?php echo $message?></p>
                                        <p>Announcement for 
                                
                                        <?php

                                            if ($student =='Yes' ){
                                                echo "Student ";
                                            }if($instr == 'Yes'){
                                                echo "Instructor<br><br>";
                                            }

                                        ?>
                                
                                        </p>

                                    </div>

                                     </div>

                                <?php


                            }
                        }
                        
                     ?>
                    
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
        <script src="../otherFiles/js/metisMenu.min.js"></script>
        <script src="../otherFiles/js/sb-admin-2.js"></script>

    </body>

</html>