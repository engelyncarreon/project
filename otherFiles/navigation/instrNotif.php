<?php

    require('../database/db.php');
    session_start();

    $instr_q = $_SESSION['instr_username'];

    $sql="UPDATE instructorsystem_noti SET notificationstatus='read' where notificationstatus='unread'";
    $result=mysqli_query($con, $sql);

    $instr = "Select * from instructor where instr_username= '$instr_q'";
    $instrquery = mysqli_query($con,$instr);
    $instrres = mysqli_fetch_assoc($instrquery);
    $instr_i = $instrres['instructor_id'];

    $sql="SELECT * FROM notification Natural Join instructorsystem_noti where instructor_id = '$instr_i' ORDER BY notification_id DESC limit 5";
    $result=mysqli_query($con, $sql);

    $response='';

    ?>

        
    <?php

            while($row=mysqli_fetch_array($result)) {

                $roww = $row['instr_noti_id']; 
   
                $response = $response . "<a href='#'><div class='notification-item'>" . 

                                            "<div class='notification-comment'>        
                                                
                                               ".$row['Message'] ."
                                            </div>" . "

                                         </div></a>
                                         <div class = 'divider'></div>";
                
            }
        ?>

    <?php
      
    if(!empty($response)) {
        print $response;
    }
      ?>

    <div class="text-center">

        <a id = 'noti' href="viewAllNotification.php">View All</a>

    </div>