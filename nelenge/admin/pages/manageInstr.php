<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Instructor</title>

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

                        <h1 class="page-header"><i class = "fa fa-graduation-cap"></i> Instructor</h1>

                        <ol class="breadcrumb">

                            <li>

                                <a href = "adminDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                            </li>

                        </ol>

                        <?php

                            require('../database/db.php');

                            // $query = "INSERT INTO instructor (instr_lastName, instr_firstName, instr_username, instr_password , instr_email , instr_address, instr_contactno, instr_gender, instr_age, instr_status) SELECT user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, 'Activate' FROM registration where user_status = 'Accepted' and typeOfuser = 'Instructor'";

                            // $result = $con -> query($query);

                            $query1 = "SELECT * FROM instructor where instr_status in ('Activate', 'Deactivate')";

                            $result1 = $con -> query($query1);

                            if ($result1 ->num_rows > 0){

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

                                while ($row = $result1 -> fetch_assoc()){
                                    echo "<form action = 'activateDeactivateInstr.php'>
                                            <tr>
                                                <td>" . $row["instr_lastName"] . "</td>
                                                <td>" . $row["instr_firstName"] . "</td>
                                                <td>" . $row["instr_username"] . "</td>
                                                <td>" . $row["instr_email"] . "</td>
                                                <td>" . $row["instr_address"] . "</td>
                                                <td>" . $row["instr_contactno"] . "</td>
                                                <td>" . $row["instr_gender"] . "</td>
                                                <td>" . $row["instr_age"] ."</td>
                                                <td>" . $row["instr_status"] ."</td>
                                                <td>" . "<input type = 'hidden' name = 'instr_username' value = '". $row["instr_username"]."'/>" . "<input type = 'submit' name = 'instr_status' value = 'Activate' class = 'button'/>" . "<input type = 'submit' name = 'instr_status' value='Deactivate' class = 'button'/>" . "</td>
                                            </tr>";
                                }

                                echo "</form>

                                </table>";

                            }   else {

                                echo "No instructor is accepted";

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