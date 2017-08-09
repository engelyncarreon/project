<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTU | Dashboard</title>

        <link href="../otherFiles/styles/bootstrap.min.css" rel="stylesheet">

        <link href="../otherFiles/styles/sb-admin-2.css" rel="stylesheet">

        <link href="../otherFiles/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel = icon href = "../otherFiles/image/logo/ntu-logo.png">
        
    </head>

    <body>

        <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        <?php
        
            require('../otherFiles/database/db.php');
            include('../otherFiles/authentication/authenticationstudent.php');
            include('../otherFiles/navigation/navstud.php');   

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

                        <li class="active">

                            <a href="StudentDashboard.php"><i class="fa fa-map-marker"></i> Current Course</a>

                        </li>

                        <li>

                            <a href="FinishedCourse.php"><i class="glyphicon glyphicon-plus"></i> Finished Course</a>

                        </li>

                        <li>

                            <a href="../otherFiles/Homepage/allcourse.php"><i class="fa fa-book"></i> Courses</a>

                        </li>

                        <li>

                            <a href="feedback.php"><i class="fa fa-comments"></i> Profile</a>

                        </li>

                        <li>

                            <a href="transaction.php"><i class="fa fa-tasks"></i> Transaction</a>

                        </li>


                    </ul>

                </div>

            </div>

        </nav>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header"><i class="fa fa-dashboard"></i>Edit Profile</h1>

                </div>

            </div>

            <form>

                <label>Last Name: </label>
                <?php echo $row['stud_lastName']; ?><br>

                <label>First Name: </label>
                <?php echo $row['stud_firstName']; ?><br>
                <label>Username:</label>
                <?php echo $row['stud_username']; ?><br>

                <label>Address: </label>
                <?php echo $row['stud_address']; ?><br>

                <label>Contact No.: </label>
                <?php echo $row['stud_contactno']; ?><br>

                <label>Email: </label>
                <?php echo $row['stud_email']; ?><br>

                <label>Gender: </label>
                <?php echo $row['stud_gender']; ?><br>

                <button><a href="EditStudentProfile.php">Edit Profile</a></button> 


                </form>

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

        <script src="../otherFiles/js/jquery/jquery.min.js"></script>
        <script src="../otherFiles/js/bootstrap/bootstrap.min.js"></script>
        <script src="../otherFiles/js/sb-admin-2.js"></script>
        <script src="../otherFiles/js/metisMenu.min.js"></script>

    </body>

</html>
