<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Enroll</title>

        <link href="../styles/bootstrap.min.css" rel="stylesheet">

        <link href="../styles/metisMenu/metisMenu.min.css" rel="stylesheet">

        <link href="../styles/sb-admin-2.css" rel="stylesheet">

        <link href="../styles/morrisjs/morris.css" rel="stylesheet">

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link href="../styles/table.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../image/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php

            include('../authentication/auth.php');
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

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>
                        <li>

                            <a href="enroll.php"><i class="fa fa-user-plus"></i> Enroll</a>

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

                        <h1 class="page-header"><i class = 'fa fa-user-plus'></i> Enroll</h1>

                        <ol class="breadcrumb">

                            <li>

                                <a href = "adminDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                            </li>

                        </ol>

                         <?php

                            require('../database/db.php');

                            $query = "SELECT * FROM studentcourse natural join courses where paymentstatus = 'Not Yet Paid'";

                            $queryres =mysqli_query($con, $query);
                            $quroq =  mysqli_fetch_assoc($queryres);

                            if($quroq){

                                $id = $quroq['student_id'];
                                
                            $que = "SELECT * FROM student where student_id = $id";
                            $queres =mysqli_query($con, $que);
                            $querow =  mysqli_fetch_assoc($queres);
                            
                             echo "<table>
                                        <tr>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>";
                                
                            $ques = "SELECT * FROM studentcourse natural join courses where paymentstatus = 'Not Yet Paid'";

                            $qu =mysqli_query($con, $ques);
                                
                            while($qur =  mysqli_fetch_assoc($qu)){
                                
                                $id2 = $qur['student_courseid'];

                                echo "<form action = 'paidornot.php' method = 'POST'>
                                        <tr>

                                            <td>" . $querow["stud_lastName"] . "</td>
                                            <td>" . $querow["stud_firstName"] . "</td>              
                                            <td>" . $qur["course_price"] ."</td>
                                            <td>" . $qur["paymentStatus"] ."</td>                      
                                            <td>
                                            <input type='hidden' name='pad' value='". $id2."'/>".
                                            "<input type='submit' name='status' value='Paid'/>
                                           </td>                         
                                        </tr>";
                            }

                                echo "</form>
                                    </table>";

                            }else{

                                echo "No enrollees yet.";
                            }

                            $con -> close();
                                
                                
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