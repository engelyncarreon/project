<?php

        require('../database/db.php');
        session_start();

        $stud_q = $_SESSION['stud_username'];

        $stud = "Select * from student where stud_username= '$stud_q'";
        $studquery = mysqli_query($con,$stud);
        $studres = mysqli_fetch_assoc($studquery);
        $student_i = $studres['student_id'];

        $sql="UPDATE studentsystem_noti SET notification_status='read' WHERE student_id = '$student_i' AND notification_status='unread'";	
        $result1=mysqli_query($con, $sql);

        $sql="UPDATE teacherannouncement SET status='read' WHERE student_id = '$student_i' AND status='unread'";	
        $result1=mysqli_query($con, $sql);



        $sql="SELECT notification_id FROM notification ORDER BY notification_id DESC limit 5";
        $result=mysqli_query($con, $sql);

                $response='';

?>

<ul class="dropdown-menu   dropdown-alerts list-group">
    
<?php

    while($row=mysqli_fetch_assoc($result)) {
        
        $roww = $row['notification_id'];  
       
        
        $student = "Select * from studentsystem_noti where notification_id = '$roww' AND student_id = '$student_i'";
        $studentquery = mysqli_query($con,$student);
        $studentfetch = mysqli_fetch_assoc($studentquery);

        if($studentfetch){
            $student_noti = $studentfetch['notification_id'];
            
            $noti = "SELECT * from notification where notification_id= '$student_noti'";
            $notiquery = mysqli_query($con,$noti);
            $notifetch = mysqli_fetch_assoc($notiquery);
             
            
            $response = $response . "<div class='notification-item'>" . 

                                        "<div class='notification-comment'>" . $notifetch["Message"]  . "</div>" .

                                     "<li class = 'divider'></li>

                                     </div>";   
            
        }        
            
            $announce = "Select * from teacherannouncement where notification_id = '$roww' AND student_id = '$student_i'";
            $announcequery = mysqli_query($con,$announce);
            $announcefetch =  mysqli_fetch_assoc($announcequery);
            
            if($announcefetch){
                $announce_noti = $announcefetch['notification_id'];
                echo $announce_noti;
                $noti = "SELECT * from notification where notification_id= '$announce_noti'";
                $notiquery = mysqli_query($con,$noti);
                $notifetch = mysqli_fetch_assoc($notiquery);
                 
                
                $response = $response . "<div class='notification-item'>" .
                "<div class='notification-comment'>" . $notifetch["Message"]  . "</div>" .
                "<li class = 'divider'></li></div>";    
                
            } 
            
            
        }
    ?>

</ul>

    <?php
  
        if(!empty($response)) {
        	print $response;
        }
  ?>

<div class="text-center">

    <a id = 'noti' href="viewAllNotification.php">View All</a>

</div>