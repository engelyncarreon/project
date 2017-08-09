<?php
require('../otherFiles/database/db.php');
if(isset($_POST['reply'])){
    
    $cour = $_POST['course_idd'];
    $student_id = $_POST['student_idd'];
    $comment_id=$_POST['reply_to'];
    


    $question = $_POST['question'];
    
    $q = "Select * from comment where course_id = '$cour'";
    $qquery = mysqli_query($con,$q);
    $fetchquery = mysqli_num_rows($qquery)+1;

//    if(empty($qquery)){
        $quest = "INSERT INTO comment(comment,course_id,reply_to,count,timestamp) Values('$question','$cour','$comment_id','$fetchquery',now())";
        $questquery = mysqli_query($con,$quest);

        $stud = "Select * from comment where comment = '$question' and course_id = '$cour'";
        $studquery = mysqli_query($con,$stud);
        $studfetch = mysqli_fetch_assoc($studquery);
        $studcomment = $studfetch['comment_id'];


        $student_comment ="INSERT INTO student_comment(student_id,comment_id) VALUES('$student_id','$studcomment')";
        $student_query = mysqli_query($con,$student_comment);
        header('Location: QuestionAndAnswer?c='.$cour);  
//    }else{
//        $qfetch = mysqli_fetch_assoc($qquery);
//        $studcomment = $qfetch['comment_id'];
//
//        $student_comment ="INSERT INTO student_comment(student_id,comment_id) VALUES('$student_id','$studcomment')";
//        $student_query = mysqli_query($con,$student_comment);
//    }
}
?>