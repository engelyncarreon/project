
              <div class="navbar-header navbar-custom">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                </button>

                  <img id = "logo" src = "../otherFiles/image/logo/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" id = "ntui" href="instrDashboard.php">NTU Training Institute</a>

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
                  
                $instr = $row['instructor_id'];

                $count=0;
                $sql2="SELECT * FROM instructorsystem_noti WHERE notificationstatus = 'unread' AND instructor_id = '$instr' ";
                $result=mysqli_query($con, $sql2);
                $count1=mysqli_num_rows($result);
                $sql2="SELECT * FROM instructor_videonoti WHERE readstatus = 'unread' AND instructor = '$instr' ";
                $result=mysqli_query($con, $sql2);
                $count2=mysqli_num_rows($result);

                $count = $count1+$count2;

            ?>

             <ul class="nav navbar-top-links navbar-right">

               <div class="dropdown">
                  <button class="dropbtn" id="notification-icon" name="button" onclick="myFunction2()">
                      
                     <span id="notification-count">

                            <?php 

                                if($count>0) {

                                    echo $count; 

                                 } 

                            ?>
                                     
                        </span>

                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>

                        <script src="../otherFiles/js/noti.js"></script>
                     </button>
                  <div class="dropdown-content">
                    <div id = "notification-latest">
                      </div>
                  </div>
                </div>
                 
                <li class="dropdown">

                    <a class="dropdown-toggle user" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i> 

                        <?php

                          echo $row['instr_firstName'] . ' ' . $row['instr_lastName'];

                        ?> 

                        <i class="fa fa-caret-down"></i>
                        
                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li><a id = "link" href="userProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>

                        <li class="divider"></li>

                        <li><a id = "link" href=" instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>

                </li>

            </ul>

            <div class = "navbar-custom">