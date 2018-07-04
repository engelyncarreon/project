
              <div class="navbar-header navbar-custom">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                </button>

                  <img id = "logo" src = "../otherFiles/image/logo/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" id = "ntui" href="adminDashboard.php">NTU Training Institute</a>

              </div>

            <?php 

                $count1=0;
                $sql2="SELECT * FROM adminenroll_notification WHERE status = 'unread'";
                $result=mysqli_query($con, $sql2);
                $count1=mysqli_num_rows($result);
                $sq="SELECT * FROM adminregister_notification WHERE status = 'unread'";
                $res=mysqli_query($con, $sq);
                $count2=mysqli_num_rows($res)+$count1;
                
                $fin="SELECT * FROM admin_coursefinished WHERE status = 'unread'";
                $finq=mysqli_query($con, $fin);
                $count=mysqli_num_rows($finq)+$count2;

            ?>

             <ul class="nav navbar-top-links navbar-right">

                  <div class="dropdown">
                  <button class="dropbtn" id="notification-icon" name="button" onclick="myFunction1()">
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

                       echo $row['username'];

                        ?> 

                        <i class="fa fa-caret-down"></i>
                        
                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li><a id = "link" href=" adminLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>

                </li>

            </ul>

            <div class = "navbar-custom">