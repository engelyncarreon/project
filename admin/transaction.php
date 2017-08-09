<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Transaction</title>

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

                        <li class = 'active'>

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

                        <h1 class="page-header"><i class = 'fa fa-tasks'></i> Transaction</h1>
                        
                <?php 

                $pageshow = 10;

                if (isset($_GET["page"])){

                    $page = $_GET["page"];

                }else{

                     $page=1;
                }

                $startfrom = ($page-1) * $pageshow;

                $instr_id = $row['id_admin'];
                
                $paid = "Select course_id, course_name, course_price, instr_firstName, instr_lastName from instructor natural join courses where instructor_id = course_instr limit $startfrom, $pageshow";
                $paidres= mysqli_query($con,$paid);

                if($paidres -> num_rows > 0){
                
                  echo "<table>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Instructor</th>
                                <th class = 'text-center'>Course Price</th>
                                <th class = 'text-center'>Student Enrolled</th>
                                <th class = 'text-center'>Total Earned by Course</th>
                                
                            </tr>";

                        $sum = 0;
                
                while($paidrow = mysqli_fetch_assoc($paidres)){

                    $coid = $paidrow['course_id'];
                    $pay  = "Select count(course_id) as count from studentcourse where paymentStatus = 'Paid' AND course_id = $coid ";
                    $payres =mysqli_query($con,$pay);
                    $payro = mysqli_fetch_assoc($payres);
                    
                    echo "<tr>

                            <td>" . $paidrow["course_name"] . "</td>
                            <td>" . $paidrow["instr_firstName"] . " ". $paidrow['instr_lastName'] . "</td>
                            <td class = 'text-center'>" . $paidrow["course_price"] . "</td>              
                            <td class = 'text-center'>" . $payro['count'] . "</td>                                 
                            <td class = 'text-center'>" . $payro['count'] *  $paidrow["course_price"] . "</td>                                       
                                                    
                            </tr>";

                    $sum = $sum+($payro['count'] *  $paidrow["course_price"]);
                    
                }

                    echo "<tr id = 'total'> 

                            <td>Total Paid Course</td>
                            <td></td><td></td><td></td>
                            <td class = 'text-center'>".$sum."</<td>

                            </tr>
                
                        </table>";

                }else{

                    echo "No transaction";

                }
                
                ?>

                <?php 

                    $sqlquery = "Select count(course_id) as total from courses where course_id in( SELECT course_id from lessons group by 1)";
                    $result = mysqli_query($con, $sqlquery);
                    $row = mysqli_fetch_assoc($result);
                    $total_pages = ceil($row["total"] / $pageshow);

                    for ($i=1; $i<=$total_pages;$i++){

                        echo "<div class = 'pagination'>
                        <a class = 'active' href = 'transaction.php?page=".$i."'";

                        if ($i==$page) 

                        echo "class = 'curpage'";
                        echo ">".$i."</a></div>";

                    };
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