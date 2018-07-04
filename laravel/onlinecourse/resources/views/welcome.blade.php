<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>NTU Training Institute</title>

        <!-- css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ribbon.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css')}}">

        <link rel = icon href = "{{asset('assets/img/logo/ntu-logo.png')}}">
    </head>

      <body id="page-top" class="index">
      <!-- Start Navigitaion -->
        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span><i class="fa fa-bars"></i>
                    </button>
                    <img id = "logo" src = "otherFiles/image/logo/ntu-logo.png" width="50" height="50">
                    <a class="navbar-brand" href="#page-top">NTU Training Institute</a>
                </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">
                <li class="page-scroll">
                    <a href="#page-top">Courses</a>
                </li>
                <li class="page-scroll">
                    <a href="#about">About</a>
                </li>
            </ul> 
                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a class="dropdown-toggle user" data-toggle="dropdown" href="Student/StudentDashboard.php">
                              <i class="fa fa-user fa-fw"></i>
                              <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                                <li><a id = "link" href ="student/StudentDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                                </li>
                                <li><a id = "link" href="student/StudentProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
                                <li class="divider"></li>
                                <li><a id = "link" href="student/studentlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                          </ul>
                      </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                          <a class="dropdown-toggle user" data-toggle="dropdown" href="Student/StudentDashboard.php">
                              <i class="fa fa-user fa-fw"></i>
                              <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                            <li><a id = "link" href ="instructor/instrDashboard.php"><i class = 'fa fa-dashboard'></i> Dashboard</a>
                            </li>
                            <li><a id = "link" href="instructor/userProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a id = "link" href="instructor/instrLogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                          </ul>
                  </li>
                  </ul>
              <ul class="nav navbar-nav navbar-right">                                   
                <li ><a href="#view1" data-toggle="modal" >Login</a></li>
                  <li ><a href="#view" data-toggle="modal" >Sign Up</a></li>
              </ul>
            </div>
            </div>
    </nav>
    <div  id="view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >
          <div class="modal-dialog" >
            <div class="modal-content" >
               <div class="modal-body" >
                  <button class="close" data-dismiss="modal">&times;</button>
               <h3 class="text-center">Sign Up As</h3>
            <form action="" method="post" class="ajax">
                <div class="row">
                  <div class="col-lg-6 text-center">
                      <div class="card">
                          <a id = 'card-link' href = "Student/studentsignup.php">
                              <div class="card-block">
                                  <div class="card-title fa fa-user fa-5x">
                                    <p class = 'studInstr'>Student</p>
                                  </div>
                              </div>
                          </a>
                      </div>
                    </div>
                    <div class="col-lg-6 text-center">
                      <div class="card">
                          <a id = 'card-link' href = "instructor/instrSignUp.php">
                            <div class="card-block">
                                <div class="card-title fa fa-graduation-cap fa-5x">
                                  <p class = 'studInstr'>Instructor</p>
                                </div>
                            </div>
                          </a>
                      </div>
                    </div>
                </div>
              </form>
                </div>
            </div>
          </div>
        </div>
        <div  id="view1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="view1Label" aria-hidden="true" >

          <!-- Modal content -->
          <div class="modal-dialog" >
            <div class="modal-content" >
               <div class="modal-body" >
                <button class="close" data-dismiss="modal">&times;</button>
              <h3 class="text-center">Login As</h3>
            <form action="" method="post" class="ajax">
               <div class="row">
                  <div class="col-lg-6 text-center">
                      <div class="card">
                          <a id = 'card-link' href = "student/studentlogin.php">
                              <div class="card-block">
                                  <div class="card-title fa fa-user fa-5x">
                                    <p class = 'studInstr'>Student</p>
                                  </div>
                              </div>
                            </a>
                      </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="card">
                          <a id = 'card-link' href = "instructor/instrLogin.php">
                              <div class="card-block">
                                  <div class="card-title fa fa-graduation-cap fa-5x"> 
                                    <p class = 'studInstr'>Instructor</p>
                                  </div>
                              </div>
                          </a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>

      <!-- End of Nav -->

      <!-- Header -->
      <section>
        <div class="item active">
          <div class = "container">
            <div class = "row">
              <div class = "text-center">
                  <h3 class = 'ribbon'>
                    <strong class = "ribbon-content">Courses Offered</strong>
                  </h3>
              </div>
            </div>
<!-- homecourse -->
          </div>
        </div>
      </section>
      <footer class="text-center" id = 'about'>
          <div class="footer-above">
              <div class="container">
                  <div class="row">
                      <div class="footer-col col-md-4">
                          <h3>Location</h3>
                          <p>Loakan Road, Baguio City Economic Zone, PEZA
                              <br>Baguio City, PH 2600</p>
                      </div>
                      <div class="footer-col col-md-4">
                          <h3>Contact Us</h3>
                          <p>
                            <i class = 'fa fa-phone'></i> Phone: +63 (74) 444 8118 <br>
                            <i class = 'fa fa-envelope-o'></i> Email us: marketing@ntu-nobletrends.com
                          </p>
                      </div>
                      <div class="footer-col col-md-4">
                          <h3>About NTU Training Institute</h3>
                          <p>The access to success, the Noble Trends Unbound Training Institute was established to be the organization's center for skills enhancement and professional development.</p>
                      </div>
                  </div>
              </div>
          </div>
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

      <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
      <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
          <a class="btn btn-primary" href="#page-top">
              <i class="fa fa-chevron-up fa-5x"></i>
          </a>
      </div>

      <script src = "{{asset('assets/jquery/jquery.min.js')}}"></script>
      <script src = "{{asset('assets/js/bootstrap.min.js')}}"></script>
      <script src = "{{asset('assets/js/jqBootstrapValidation.js')}}"></script>
      <script src = "{{asset('assets/js/style.min.js')}}"></script>
  </body>
</html>
