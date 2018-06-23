<?php

require('../database/db.php');
session_start();

$instr_q = $_SESSION['instr_username'];


$instr = "Select * from instructor where instr_username= '$instr_q'";
$instrquery = mysqli_query($con,$instr);
$instrres = mysqli_fetch_assoc($instrquery);
$instr_i = $instrres['instructor_id'];


$sql="Select * from notification ORDER BY notification_id DESC";
$result=mysqli_query($con, $sql);

$response='';
$co = 1;

    while(($row=mysqli_fetch_array($result))&& $co<=5) {
        $noti_id = $row['notification_id'];
        $subject = $row['subject'];
       
        $sqlvideo="SELECT * FROM  instructor_videonoti where instructor = '$instr_i' and notification = '$noti_id'";
        $resultvideo=mysqli_query($con, $sqlvideo );
        $fetchvideo = mysqli_fetch_assoc($resultvideo);
        
        $noti="SELECT * FROM  instructorsystem_noti where instructor_id = '$instr_i' and notification_id = '$noti_id'";
        $resultnoti=mysqli_query($con, $noti );
        $fetchnoti = mysqli_fetch_assoc($resultnoti);

        if($fetchnoti){
            $noti="SELECT * FROM  instructorsystem_noti where instructor_id = '$instr_i' and notification_id = '$noti_id' and notificationstatus='unread' ";
            $resultnoti=mysqli_query($con, $noti );
            $fetchnoti = mysqli_fetch_assoc($resultnoti);
            if($fetchvideo){
                $response = $response . "<a href='#' class='unread'>" . 

                                        "<div class='notification-comment'>        

                                            <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
                $co++;   
            }else{
                $response = $response . "<a href='#'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                            <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
                $co++;
            }
            
        }else if($fetchvideo){
            $sqlvi="SELECT * FROM  instructor_videonoti where instructor = '$instr_i' and notification = '$noti_id' and readstatus='unread'";
            $resultvi=mysqli_query($con, $sqlvi);
            $fetchvideo = mysqli_fetch_assoc($resultvi);
            $quiz_videoid = $fetchvideo["quiz_videoid"];      
                $student = $fetchvideo["student"];  
        

            if($fetchvideo){
                $response = $response . "<a href='videochecker.php?vid=$quiz_videoid&id=$student' class='unread'>" . 

                                        "<div class='notification-comment'>        

                                            <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
                $co++;   
            }else{
                $response = $response . "<a href='#'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                            <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
                $co++;
            }
            
        }
    }

$sql="UPDATE instructorsystem_noti SET notificationstatus='read' where notificationstatus='unread'";
$result=mysqli_query($con, $sql); 


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