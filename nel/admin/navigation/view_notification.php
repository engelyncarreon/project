<?php
require('../database/db.php');

$sql="UPDATE notification SET status='read' WHERE status='unread'";	
$result=mysqli_query($con, $sql);

$sql="SELECT * FROM notification ORDER BY notification_id DESC limit 5";
$result=mysqli_query($con, $sql);

$response='';


while($row=mysqli_fetch_array($result)) {
    $roww = $row['notification_id'];

    
    $sqlp="SELECT * FROM register_notification natural join registration where notification_id= '$roww' ";
    $resultp=mysqli_query($con, $sqlp);
    $rowp=mysqli_fetch_assoc($resultp);
   
         $na =  $rowp["user_firstName"]. " ". $rowp["user_lastName"];      
    
	$response = $response . "<div class='notification-item'>" .
	"<div class='notification-subject'>". $na . "</div>" . 
	"<div class='notification-comment'>" . $row["Message"]  . "</div>" .
	"<hr></div>";
}
if(!empty($response)) {
	print $response;
}


?>