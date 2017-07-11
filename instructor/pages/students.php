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

        <link rel = "stylesheet" href = "../styles/table.css"/>

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

<?php
    require('../database/db.php');
    $id = $_POST['idd'];
    ?>
    
        <a href='Coursedetails?course=<?php echo $id; ?>'><button>Back</button></a>
    <?php
    $stud = "Select * from studentcourse where course_id = '$id' ";
    $studres = mysqli_query($con, $stud);
    ?>
    <table>
        <tr>
            <th>Name</th>
            <th>Status</th>
        </tr><?php
    while($studrow = mysqli_fetch_assoc($studres)){
        $studd = $studrow['student_id'];
        $studdet = "Select * from student natural join studentcourse where student_id = $studd ";
        $studdres= mysqli_query($con, $studdet);
        $studdrow = mysqli_fetch_assoc($studdres);
        $first = $studdrow['stud_firstName'];
        $last = $studdrow['stud_lastName'];
        $stat = $studdrow['lessonstatus'];
        ?><form action="Specificstudent.php" method="POST">
            <tr>
                <input type = "hidden" name="spec" value =<?php echo $studd; ?>>
                <td>
                    <a><input style=" border:none; 
    background-color:transparent;" type=submit value ="<?php echo "$first" . " ". "$last";?>"  name=speci></a>
                </td>
                <td><?php echo "$stat";?></td>
                
            </tr>
             </form>
          <?php  
       
        
    }
    ?>
            </table>
           <?php
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