<?php

require('../database/db.php');

$sql="SELECT * FROM notification ORDER BY notification_id";
$result=mysqli_query($con, $sql);

$response="";
$co = 1;

while(($row=mysqli_fetch_array($result)) && $co<=5) {

    $roww = $row['notification_id'];
    
    $sqlp="SELECT * FROM adminregister_notification natural join registration where notification_id= '$roww' limit 5";
    $resultp=mysqli_query($con, $sqlp);
    $rowp=mysqli_fetch_assoc($resultp);

    $enroll="SELECT * FROM adminenroll_notification where notification_id= '$roww' limit 5";
    $enrollquery=mysqli_query($con, $enroll);
    $enrollrow=mysqli_fetch_assoc($enrollquery);
   
    if($rowp||$enrollrow){
        $response = $response . "<a href='#'><div class='notification-item'>" . 

                    "<div class='notification-comment'>        

                       ".$row['Message'] ."
                    </div>" .

                 "<div class = 'divider'></div>

                 </div></a>";
        $co++;
        
    }
    
}

	if(!empty($response)) {
		print $response;
	}


?>

 <div class="text-center">

        <a id = 'noti' href="../admin/viewallnotification.php">View All</a>

    </div>