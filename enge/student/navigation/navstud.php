
            
              <div class="navbar-header page-scroll">

                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                      <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>

                  </button>

                  <img id = "logo" src = "../image/ntu-logo.png" width="50" height="50">

                  <a class="navbar-brand" href="#page-top">NTU Training Institute</a>

              </div>

              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                  <ul class="nav navbar-nav ">

                      <li class="page-scroll">

                          <a href="../../Homepage/homepage">Home</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../../Homepage/homepage#courses">Courses</a>

                      </li>

                      <li class="page-scroll">

                          <a href="../../Homepage/homepage#about">About</a>

                      </li>

                  </ul>
                  
            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-alerts">

                        <li>

                            <a href="#">

                                <div>

                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>

                                </div>

                            </a>

                        </li>

                        <li class="divider"></li>

                        <li>

                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>

                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>View All</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                        <i class="fa fa-user fa-fw"></i> 

                         <?php

                        echo $row['stud_firstName'] . ' ' . $row['stud_lastName'];

                        ?> 

                        <i class="fa fa-caret-down"></i>
                        
                    </a>

                    <ul class="dropdown-menu dropdown-user">

                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>

                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>

                        <li class="divider"></li>

                        <li><a href="../studentLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>

                </li>

            </ul>