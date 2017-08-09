<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Enroll</title>

        <link href="../otherFiles/styles/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/dashboard.css" rel="stylesheet">

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

         <link href="../otherFiles/styles/custom.css" rel="stylesheet" type="text/css">

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

                                    <a href="manageStud.php"><i class = 'fa fa-user'></i> Student</a>

                                </li>

                                <li>

                                    <a href="manageInstr.php"><i class = 'fa fa-graduation-cap'></i> Instructor</a>

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


                        <li>

                            <a href="announcement.php"><i class="fa fa-newspaper-o"></i> Announcements</a>

                        </li>

                        <li>

                            <a href="Evaluation%20Setting.php"><i class="fa fa-newspaper-o"></i> Evaluation Setting</a>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-12">

                        <h1 class="page-header">Evaluation Setting</h1>
                        <form method="post" action = "">
                            Criteria <input type="text" name="criteria">
                            <input type="submit" name="submit">
                        </form>
                        
                        <?php 
                            if(isset($_POST['submit'])){
                                $criteria = $_POST['criteria'];
                                $criteria_query = mysqli_query($con,"Insert into instructor_evaluationcriteria(criteria) VALUES('$criteria')");
                            }
                        
                           
                        
                            $crit = mysqli_query($con,"SELECT * from instructor_evaluationcriteria where subcategories='0'");
                            $i = 0;
                        
                            while($critfetch = mysqli_fetch_assoc($crit)){
                                ?>
                                <ul style="list-style-type:none">
                               <li>
                                <?php 
                                
                                 
                                $critid= $critfetch['evaluation_id'];
                                echo $critid;
                                  ?> 
                                    
                                     <form method="post" action="">
                                         <?php

                                            echo $critfetch['criteria'];
                                            echo $critfetch['evaluation_id'];
                                         ?>
                                        Sub Criteria:<input type="text" name="criteria2">
                                        <input type="hidden" name="subcriteriaid" value="<?php echo $critid;?>">
                                        <input type="submit" name="submit2">

                                    </form>
                                            
                                <?php
                                
                                $subcat = mysqli_query($con,"SELECT * from instructor_evaluationcriteria where subcategories='$critid'");
                                
                                
                                while($subcatfetch =mysqli_fetch_assoc($subcat)){
                                    echo $critid;
                        
                                    ?>
                                    <ul style="list-style-type:none">
                                        <li>
                                     <form method="post" action="">
                                      
                                         <?php
                                            echo $subcatfetch['criteria'];
                                            echo $subcatfetch['evaluation_id']; 
                                         ?>
                                        Sub Criteria:<input type="text" name="criteria2">
                                        <input type="hidden" name="subcriteriaid" value="<?php echo $subcatfetch['evaluation_id'];?>">
                                        <input type="submit" name="submit2">
                                    
                                    </form>
                                     </li>
                                   </ul>
                                <?php
                                    }?></li>
                            </ul>
                               

                        <?php
                               
                            
                            }
                        
                        
                            if(isset($_POST['submit2'])){
                                $criteria = $_POST['criteria2'];
                                $criteriaid = $_POST['subcriteriaid'];
                                $criteria_query = mysqli_query($con,"Insert into instructor_evaluationcriteria(criteria,subcategories) VALUES('$criteria','$criteriaid')");
                                 if($criteria_query){
                                     echo "Success";
                                 }else{
                                     echo "Failed";
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