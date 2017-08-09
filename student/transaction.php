<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Transaction</title>

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

                        <li class = 'active'>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

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

                            $stud_id = $row['student_id'];
                            
                            $paid = "Select * from studentcourse natural join courses where student_id = $stud_id";
                            $paidres= mysqli_query($con,$paid);
                            
                            $paidsum = "Select Sum(course_price) as total from studentcourse natural join courses where paymentStatus = 'Paid' AND student_id = $stud_id ";
                            $paidressum= mysqli_query($con,$paidsum);
                            
                            if($paidressum){

                                $paidrowsum = mysqli_fetch_assoc($paidressum);
                                $sum = $paidrowsum['total'];

                            }else{

                                $sum = 0;
                            }
                        
                          echo "<table>
                                        <tr>

                                            <th>Course Name</th>
                                            <th>Payment Status</th>
                                            <th>Course Price</th>
                                        
                                        </tr>";
                                
                        
                        while($paidrow = mysqli_fetch_assoc($paidres)){
                            echo "<tr>

                                        <td>" . $paidrow["course_name"] . "</td>
                                        <td>" . $paidrow["paymentStatus"] ."</td> 
                                        <td>" . $paidrow["course_price"] . "</td>              
                                                        
                                    </tr>";
                            
                        }

                        echo "<tr id = 'total'> 

                                <td>Total Paid Course</td>
                                <td></td>
                                <td>".$sum."</<td>

                            </tr>
                        
                        </table>";
                        
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
        <script src="../otherFiles/js/sb-admin-2.js"></script>
        <script src="../otherFiles/js/metisMenu.min.js"></script>

    </body>

</html>