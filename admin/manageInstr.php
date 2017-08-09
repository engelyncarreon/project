<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Instructor</title>

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

                                    <a href="student.php"><i class = "fa fa-user"></i> Student</a>

                                </li>

                                <li>

                                    <a href="instructor.php"><i class = "fa fa-graduation-cap"></i> Instructor</a>

                                </li>

                            </ul>

                        </li>

                        <li>

                            <a href="#"><i class="fa fa-edit"></i> User Management<span class="fa arrow"></span></a>

                            <ul class="nav nav-second-level">

                                <li>

                                    <a href="manageStud.php"><i class = "fa fa-user"></i> Student</a>

                                </li>

                                <li class = 'active'>

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

                        <h1 class="page-header"><i class = "fa fa-graduation-cap"></i> Instructor</h1>

                        

                        <?php

                            require('../otherFiles/database/db.php');

                            $pageshow = 6;

                            if (isset($_GET["page"])){

                                $page = $_GET["page"];

                            }else{

                                 $page=1;
                            }

                            $startfrom = ($page-1) * $pageshow;

                            $query1 = "SELECT * FROM instructor where instr_status in ('Activate', 'Deactivate') limit $startfrom, $pageshow";

                            $result1 = $con -> query($query1);

                            if ($result1 ->num_rows > 0){

                                echo "<table>
                                        <tr>
                                            <th class = 'text-center'>Lastname</th>
                                            <th class = 'text-center'>Firstname</th>
                                            <th class = 'text-center'>Username</th>
                                            <th class = 'text-center'>Email</th>
                                            <th class = 'text-center'>Address</th>
                                            <th class = 'text-center'>Contact No.</th>
                                            <th class = 'text-center'>Gender</th>
                                            <th class = 'text-center'>Age</th>
                                            <th class = 'text-center'>Status</th>
                                            <th class = 'text-center'>Activate | Deactivate</th>";

                                while ($row = $result1 -> fetch_assoc()){
                                    echo "<form action = 'activateDeactivateInstr.php'>
                                            <tr>
                                                <td class = 'text-center'>" . $row["instr_lastName"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_firstName"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_username"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_email"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_address"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_contactno"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_gender"] . "</td>
                                                <td class = 'text-center'>" . $row["instr_age"] ."</td>
                                                <td class = 'text-center'>" . $row["instr_status"] ."</td>
                                                <td class = 'text-center'>" . "<input type = 'hidden' name = 'instr_username' value = '". $row["instr_username"]."'/>" . "<button class = 'ok' type = 'submit' name = 'instr_status' value = 'Activate'></button>" . "<button class = 'no' type = 'submit' name = 'instr_status' value='Deactivate'></button>" . "</td>
                                            </tr>
                                            </form>";
                                }

                                echo "
                                    
                                </table>";

                            }   else {

                                echo "No instructor is accepted";

                            }

                        ?>

                        <?php 

                            $sqlquery = "Select count(instructor_id) as total from instructor";
                            $result = mysqli_query($con, $sqlquery);
                            $row = mysqli_fetch_assoc($result);
                            $total_pages = ceil($row["total"] / $pageshow);

                            for ($i=1; $i<=$total_pages;$i++){

                                echo "<div class = 'pagination'>
                                <a class = 'active' href = 'manageInstr.php?page=".$i."'";

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