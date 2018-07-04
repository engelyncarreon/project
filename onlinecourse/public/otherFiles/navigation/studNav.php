
              <div class="navbar-header navbar-custom">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                </button>

                  <img id = "logo" src = "../otherFiles/image/logo/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" id = "ntui" href="studentDashboard.php">NTU Training Institute</a>

              </div>

              <ul class="nav navbar-nav navbar-custom collapse navbar-collapse">

                      <li class="page-scroll dropdown">

                          <a id = 'ntui' href="../index.php">Courses</a>

                      </li>

                      <li class="page-scroll dropdown">

                          <a id = 'ntui' href="../index.php#about">About</a>

                      </li>

                  </ul>

            <?php 

                $count=0;
                $stud = $row['student_id'];
                $sql2="SELECT * FROM studentsystem_noti WHERE notification_status = 'unread' and student_id = '$stud'";
                $result=mysqli_query($con, $sql2);
                $count1=mysqli_num_rows($result);

                $video = "Select * from student_videonoti where  readstatus = 'unread' AND  student_id = '$stud'";
                $videoquery = mysqli_query($con,$video);
                $videofetch =  mysqli_num_rows($videoquery);
    
                $announce = "Select * from teacherannouncement where  status = 'unread' AND  student_id = '$stud'";
                $announcequery = mysqli_query($con,$announce);
                $announcefetch =  mysqli_num_rows($announcequery);

                $count=$count1+$videofetch+$announcefetch;

            ?>

             <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="notification-icon" name="button" onclick="myFunction3()">

                        <span id="notification-count">

                            <?php 

                                if($count>0) {

                                    echo $count; 

                                 } 

                            ?>
                                     
                        </span>

                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>

                        <script src="../otherFiles/js/noti.js"></script>

                    </a>

                    <ul class="dropdown-menu dropdown-alerts noti">

                        <li>

                            <li>

                                <div id = "notification-latest">

                                </div>

                            </li>
                    </ul>

                </li>

                <li class="dropdown">

                    <a class="dropdown-toggle user" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i> 

                        <?php

                          echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                        ?>   

                        <i class="fa fa-caret-down"></i>
                        
                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li><a id = "link" href="EditStudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>

                        <li class="divider"></li>

                        <li><a id = "link" href=" studentLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>

                </li>

            </ul>

            <div class = "navbar-custom">