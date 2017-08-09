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

                        <li class = 'active'>

                            <a href="enroll.php"><i class="fa fa-plus"></i> Enroll</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>


                        <li>

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

                        <h1 class="page-header"><i class = 'fa fa-plus'></i> Enroll</h1>

                        

                         <?php

                            require('../otherFiles/database/db.php');
                                
                            $ques = "SELECT * FROM studentcourse natural join courses where paymentstatus = 'Not Yet Paid'";

                            $qu = $con -> query($ques);

                            if ($qu ->num_rows >0){

                                echo "<table>
                                
                                        <tr>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Course Name</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th></th>";
                                
                                $i = 0;
                            while($qur = $qu -> fetch_assoc()){
                                
                            $id = $qur['student_id'];
                                
                            $que = "SELECT * FROM student where student_id = $id";
                            $queres =mysqli_query($con, $que);
                            $querow =  mysqli_fetch_assoc($queres);

                            $id2 = $qur['student_courseid'];

                            ?>

                            <form action = 'paidornot.php' method = 'POST'>
                            <tr>

                                <td><?php echo $querow["stud_lastName"]; ?></td>
                                <td><?php  echo $querow["stud_firstName"];  ?></td>              
                                <td><?php  echo $qur["course_name"];  ?></td>
                                <td><?php  echo $qur["course_price"];  ?></td>
                                <td><?php  echo $qur["paymentStatus"];  ?></td>                      
                                <td>

                                <?php 

                                    $courid = $qur['course_id'];
                                    $coursename ="Select * from courses where course_id = '$courid'";
                                    $coursenamequery = mysqli_query($con,$coursename);
                                    $coursenameresult = mysqli_fetch_assoc($coursenamequery);
                                    
                                    ?>
                                
                                <a href="#view<?php echo $i; ?>" data-toggle="modal" >

                                <button  class="button pull-right">Paid</button>

                                </a>

                                  <div id="view<?php echo $i; ?>" role="dialog " class="modal face">

                                      <div class="modal-dialog">

                                        <div class="modal-content">

                                           <div class="modal-body">

                                                <h3 class="text-center">

                                                    Payment Proof

                                                    <button class="close" data-dismiss="modal">&times;</button>

                                                    </h3>

                                                   <p>OR number: <input type="text" name="OR" required></p>

                                                   <p>Student Name: 

                                                   <input type="text" disabled name="Name"  value=<?php echo $querow["stud_firstName"]. " ".$querow["stud_lastName"] ?>>

                                                   </p>

                                                   <p>Course Name: <input type="text" disabled name="coursename"  value=<?php echo $coursenameresult['course_name'];?>></p>

                                                   <p>Amount: <input type="text" readonly name="amount"  value=<?php  echo $qur["course_price"];  ?>></p>

                                                   <p>Payment Method: <input type="text" name="method"  required></p>

                                                    <input type="hidden"  name="studentid"  value=<?php echo $querow["student_id"]; ?>>

                                                    <input type="hidden"  name="courseid" value=<?php  echo $qur["course_id"];  ?>>

                                                    <input type='hidden' name='pad' value=<?php echo $id2; ?>>

                                                    <input class = 'button' type='submit' name='status' value='Paid'>

                                            </div>

                                        </div>

                                      </div>

                                    </div>
                                
                               </td> 

                            </tr>

                            </form><?php $i++;
                            }

                                echo "</table>";

                            } else{

                                echo "No enrollees yet";
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