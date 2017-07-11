<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Users</title>

        <link href="../styles/bootstrap.min.css" rel="stylesheet">

        <link href="../styles/metisMenu/metisMenu.min.css" rel="stylesheet">

        <link href="../styles/sb-admin-2.css" rel="stylesheet">

        <link href="../styles/morrisjs/morris.css" rel="stylesheet">

        <link href="../styles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

         <link href="../styles/table.css" rel="stylesheet" type="text/css">

         <link href="../styles/button.css" rel="stylesheet" type="text/css">

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

                                <li>

                                    <a href="manageInstr.php"><i class = "fa fa-graduation-cap"></i> Instructor</a>

                                </li>

                            </ul>

                        </li>

                        <li>

                            <a href="courses.php"><i class="fa fa-book"></i> Courses</a>

                        </li>

                        <li>

                            <a href="enroll.php"><i class="fa fa-user-plus"></i> Enroll</a>

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

                        <h1 class="page-header"><i class = "fa fa-graduation-cap"></i> Student<small> Approval</small></h1>

                        <ol class="breadcrumb">

                            <li>

                                <a href = "adminDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                            </li>

                        </ol>

                        <?php

                            require('../database/db.php');

                            $query = "SELECT * FROM registration where typeOfuser = 'Student' and user_status in ('Pending','Declined')";

                            $result = $con -> query($query);

                            if ($result ->num_rows > 0){

                                echo "<table>
                                        <tr>
                                            <th>Lastname</th>
                                            <th>Firstname</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Contact No.</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>Status</th>";

                                while ($row = $result -> fetch_assoc()){
                                    echo "<form action = 'acceptDeclineStud.php'>
                                            <tr>
                                                <td>" . $row["user_lastName"] . "</td>
                                                <td>" . $row["user_firstName"] . "</td>
                                                <td>" . $row["user_username"] . "</td>
                                                <td>" . $row["user_email"] . "</td>
                                                <td>" . $row["user_address"] . "</td>
                                                <td>" . $row["user_contactno"] . "</td>
                                                <td>" . $row["user_gender"] . "</td>
                                                <td>" . $row["user_age"] ."</td>
                                                <td>" . $row["user_status"] ."</td>
                                                <td>" . "<input type = 'hidden' name = 'user_username' value = '". $row["user_username"]."'/>" . "<input type = 'submit' name = 'user_status' value = 'Accepted' class = 'button'/>" . "<input type = 'submit' name = 'user_status' value='Declined' class = 'button'/>" . "</td>
                                            </tr>";
                                }

                                echo "
                                    </form>
                                </table>";

                            }   else {

                                echo "No one registered";

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