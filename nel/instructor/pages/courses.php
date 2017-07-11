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

        <link rel = "stylesheet" href = "../styles/custom.css"/>

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

                        <h1 class="page-header"><i class = "fa fa-book"></i> Courses</h1>

                    </div>

                    <ol class="breadcrumb">

                            <li>

                                <a href = "instrDashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>

                            </li>

                        </ol>

                        <?php

                            require('../database/db.php');
                            
                             $query1 = "SELECT * FROM courses NATURAL JOIN  instructor where instr_username = '$user' and course_instr = instructor_id";
                        
                            $result = $con -> query($query1);
                                

                            if ($result ->num_rows > 0){

                                echo "<table>
                                        <tr>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Duration</th>
                                            <th>Price</th>
                                            <th>Desc</th>
                                            ";

                                while ($row1 = $result -> fetch_assoc()){
                                    echo " <tr>
                                            <td>" . $row1["course_name"] . "</td>
                                            <td>" . $row1["course_category"] . "</td>
                                            <td>" . $row1["course_duration"] . "</td>
                                            <td>" . $row1["course_price"] . "</td>
                                            <td>" . $row1["course_desc"] . "</td>
                                           </tr>";
                                }

                                echo "</table>";

                            }   else {

                                echo "No Result";

                            }

                                $con -> close();

                        ?>

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