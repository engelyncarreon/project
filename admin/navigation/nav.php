
            <div class="navbar-header">

                <img src = "../image/ntu-logo.png" width = "50" height = "50">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="adminDashboard.php">NTU Training Institute</a>

            </div>

            <?php 

                $count=0;
                $sql2="SELECT * FROM notification WHERE status = 'unread'";
                $result=mysqli_query($con, $sql2);
                $count=mysqli_num_rows($result);

            ?>

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="notification-icon" name="button" onclick="myFunction1()">

                    <span id="notification-count">

                            <?php 

                                if($count>0) {

                                    echo $count; 

                                 } 

                            ?>
                                     
                        </span>

                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>

                        <script src="../js/noti.js"></script>

                    </a>

                    <ul class="dropdown-menu dropdown-alerts">

                        <li>

                            <a href="#">

                                <div id = "notification-latest">

                                </div>

                            </a>

                        </li>

                        <li class="divider"></li>

                    </ul>

                </li>

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i> <?php

                        echo $row['username'];

                        ?> <i class="fa fa-caret-down"></i>
                        
                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>

                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>

                        <li class="divider"></li>

                        <li><a href="../adminLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>

                </li>

            </ul>