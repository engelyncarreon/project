<?php

require('../database/db.php');

$sql="SELECT * FROM notification ORDER BY notification_id desc";
$result=mysqli_query($con, $sql);

$response="";
$co = 1;

while(($row=mysqli_fetch_array($result)) && $co<=5) {
    
    $roww = $row['notification_id'];
    
    $subject = $row['subject'];
    
    $sqlp="SELECT * FROM adminregister_notification natural join registration where notification_id= '$roww' ";
    $resultp=mysqli_query($con, $sqlp);
    $rowp=mysqli_fetch_assoc($resultp);

    $enroll="SELECT * FROM adminenroll_notification where notification_id= '$roww'";
    $enrollquery=mysqli_query($con, $enroll);
    $enrollrow=mysqli_fetch_assoc($enrollquery);
    
    //finish course notification
    $coursef ="SELECT * FROM admin_coursefinished where notification_id= '$roww'";
    $coursefquery=mysqli_query($con, $coursef);
    $coursefetch =mysqli_fetch_assoc($coursefquery);
   
    
    if($rowp){
        $unread="SELECT * FROM adminregister_notification natural join registration where notification_id= '$roww' and status = 'unread' ";
        $unreadquery=mysqli_query($con, $unread);
        $unreadfetch=mysqli_fetch_assoc($unreadquery);

            if(!empty($unreadfetch)&&($unreadfetch['typeOfuser']=='Student')){
                $id = $unreadfetch['registration_id'];
                 $response = $response  ."<a href='student.php?id=".$id."' class='unread'><div class='notification-item '>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";     
            }else if(!empty($unreadfetch)&&($unreadfetch['typeOfuser']=='Instructor')){
                $id = $unreadfetch['registration_id'];
                 $response = $response  ."<a href='instructor.php?id=".$id."' class='unread'><div class='notification-item '>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";     
            }else {
                 $response = $response  ."<a href='' ><div class='notification-item '>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";     
            }
       
        $co++;
        
    }else if($enrollrow){
        $st_id = $enrollrow['student_id'];
        $course_id = $enrollrow['course_id'];
        
        
        $enquery=mysqli_query($con, "SELECT * FROM studentcourse natural join adminenroll_notification where student_id = '$st_id' and course_id='$course_id' and status='unread'");
        $enfetch=mysqli_fetch_assoc($enquery);
        
        $student_courseid = $enfetch['student_courseid'];
        
        if(!empty($enfetch)){
            $response = $response  ."<a href='enroll.php?id=".$student_courseid."' class='unread'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
        }else{
              $response = $response  ."<a href='#'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";            
        }
        $co++;
        
    }else if($coursefetch){
        
        
        $cquery=mysqli_query($con, "SELECT * FROM admin_coursefinished  natural join studentcourse where notification_id = '$roww' and status='unread'");
        $cfetch=mysqli_fetch_assoc($cquery);
        
        $student_courseid = $coursefetch['student_courseid'];
        
        $studentid = $cfetch['student_id'];
        $courseid = $cfetch['course_id'];
        
        if(!empty($cfetch)){
            $response = $response  ."<a href='Specificstudent.php?c=$courseid&s=$studentid&i=$roww&sc=$student_courseid' class='unread'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";
        }else{
              $response = $response  ."<a href='#'><div class='notification-item'>" . 

                                        "<div class='notification-comment'>        

                                           <p>".$subject."</p> ".$row['Message'] ."
                                        </div>" . "

                                     </div></a>
                                     <div class = 'divider'></div>";            
        }
        $co++;
        
    }
    
}

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

        <a id = 'noti' href="../admin/viewallnotification.php">View All</a>

    </div>