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



        $sql="SELECT notification_id FROM notification ORDER BY notification_id DESC";
        $result=mysqli_query($con, $sql);

                $response='';
        $co = 1;
?>

<ul class="dropdown-menu   dropdown-alerts list-group">
    
<?php

    while(($row=mysqli_fetch_assoc($result))&& $co<=5) {
        
        $roww = $row['notification_id'];  
        
        
        $student = "Select * from studentsystem_noti where notification_id = '$roww' AND student_id = '$student_i'";
        $studentquery = mysqli_query($con,$student);
        $studentfetch = mysqli_fetch_assoc($studentquery);

        if($studentfetch){
            $stud_noti = $student['stud_noti_id'];
            $studentun = "Select * from studentsystem_noti where stud_noti_id = '$stud_noti' and notification_status='unread'";
            $studentqueryun = mysqli_query($con,$studentun);
            $studentfetchun = mysqli_fetch_assoc($studentqueryun);
            
            $student_noti = $studentfetch['notification_id'];
            
            $noti = "SELECT * from notification where notification_id= '$student_noti' ORDER BY notification_id DESC";
            $notiquery = mysqli_query($con,$noti);
            $notifetch = mysqli_fetch_assoc($notiquery);
             
            if(!empty($studentfetchun)){
                $response = $response . "<div class='notification-item unread'>".

                                            "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .

                                         "<li class = 'divider'></li>

                                         </div>";   
                $co++;
            }else{
                 $response = $response . "<div class='notification-item '>".

                                            "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .

                                         "<li class = 'divider'></li>

                                         </div>";   
                $co++;
            }
        }        
            
            $announce = "Select * from teacherannouncement where notification_id = '$roww' AND student_id = '$student_i'";
            $announcequery = mysqli_query($con,$announce);
            $announcefetch =  mysqli_fetch_assoc($announcequery);
            
            if($announcefetch){
                $announce_noti = $announcefetch['notification_id'];
                echo $announce_noti;
                $noti = "SELECT * from notification where notification_id= '$announce_noti' ORDER BY notification_id DESC";
                $notiquery = mysqli_query($con,$noti);
                $notifetch = mysqli_fetch_assoc($notiquery);
                
                $announceun = "Select * from teacherannouncement where notification_id = '$roww' AND student_id = '$student_i' and status='unread'";
                $announcequeryun = mysqli_query($con,$announceun);
                $announcefetchun =  mysqli_fetch_assoc($announcequeryun);
                 
                if(!empty($announcefetchun)){
                    $response = $response . "<div class='unread'><div class='notification-item'>" .
                    "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .
                    "<li class = 'divider'></li></div></div>";    
                    $co++;
                }else{
                    $response = $response . "<div class='notification-item'>" .
                    "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .
                    "<li class = 'divider'></li></div>";    
                    $co++;
                }
            } 
        
            $video = "Select * from student_videonoti where notification_id = '$roww' AND student_id = '$student_i'";
            $videoquery = mysqli_query($con,$video);
            $videofetch =  mysqli_fetch_assoc($videoquery);
            
            if($videofetch){
                $video_noti = $videofetch['notification_id'];
                $video_id = $videofetch['quiz_videoid'];
                echo $video_noti;
                $noti = "SELECT * from notification where notification_id= '$video_noti' ORDER BY notification_id DESC";
                $notiquery = mysqli_query($con,$noti);
                $notifetch = mysqli_fetch_assoc($notiquery);
                 
                $videoun = "Select * from student_videonoti where notification_id = '$roww' AND student_id = '$student_i' and readstatus='unread'";
                $videoqueryun = mysqli_query($con,$videoun);
                $videofetchun =  mysqli_fetch_assoc($videoqueryun);
                
                
                if(!empty($videofetchun)){
                    $response = $response . "<a href='videoscore.php?video=$video_id'><div class='unread'><div class='notification-item'>" .
                    "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .
                    "<li class = 'divider'></li></div></div></a>";    
                    $co++;
                }else{
                    $response = $response . "<a href='videoscore.php?video=$video_id'><div class='notification-item'>" .
                    "<div class='notification-comment'> <p>".$notifetch["subject"]."</p>" . $notifetch["Message"]  . "</div>" .
                    "<li class = 'divider'></li></div></a>";    
                    $co++;
                }
                
            } 
            
            
        }
    ?>

</ul>

    <?php
  
        if(!empty($response)) {
        	print $response;
        }
  ?>
<script>
     function type() {


             $('.unread').css("background-color", "rgba(0,0,0,0.4)");

        } 
        window.onload=type();
</script>
<div class="text-center">

    <a id = 'noti' href="viewAllNotification.php">View All</a>

</div>