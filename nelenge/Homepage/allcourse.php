<!DOCTYPE html>
<html lang="en">

<head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>NTU | Course</title>

      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <link href="styles/style.min.css" rel="stylesheet">

      <link href = "styles/modal.css" rel = "stylesheet">

      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

      <link href = "image/ntu-logo.png" rel = "icon"/>

  </head>

    <body>

      <?php

        require('database/db.php');
        session_start();
        $query = "Select * from courses Natural join instructor";
        $result = mysqli_query($con , $query);

        ?>

        <?php include('navigation/nav1.php'); ?>

        <section id = "courses">

          <div class = "container">

                <div class = "row">

                    <div class = "col-lg-12 text-center">

                        <h3>Courses Offered</h3>
                        <br/></br/>

                    </div>

                </div>

                <div>

                <?php

                  include('viewMore/homeCourse.php');

                  ?>

                </div>

          </div>

           </section>

           <!-- Footer -->

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

      <script src="jquery/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jqBootstrapValidation.js"></script>
      <script src="js/style.min.js"></script>
      <script src="js/modal.js"></script>

    </body>

</html>
