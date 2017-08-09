<?php 

    require('../otherFiles/database/db.php');
    session_start();
    $user =  $_SESSION['stud_username'];

    $query = "Select * from student where stud_username = '$user' ";
    $result = mysqli_query($con , $query);
    $row = mysqli_fetch_assoc($result);

    if(isset($_POST['quiz'])){

        $user_id = $row['student_id'];

    if(!empty($_FILES['upfile']['name'])){

        $upfile = $_FILES['upfile']['name'];
        include('videouploader.php');  

        $realname =$_FILES['upfile']['name'];
        $quiz_id = $_POST['quiz_id'];

        $inse = "INSERT INTO quiz_video(quiz_id,student_id,video_name,videourl) VALUES ('$quiz_id','$user_id','$realname','$sha')";
        $insert = mysqli_query($con,$inse);

        if($insert){

            echo "Success";

        }else{

            echo "failed";

        }

    }else if(isset($_POST['answerradio'])){

        $po = $_POST['answerradio'];
        $overall = 0;
        $duplicateanswer ='';

        foreach ($po as $key=>$val) {

        //echo "Quiz id: ". $key ."<br>"; 

        $sa = "Select * from quiz_choices where quiz_id = '$key' and answer='correct'";//get answer
        $sam = mysqli_query($con,$sa);
        $correctanswer = mysqli_num_rows($sam);
        //echo "<br>".$correctanswer."<br>";

        $point ="Select * from quiz_question where quiz_id = '$key'"; //get points
        $points = mysqli_query($con,$point);
        $pointfetch = mysqli_fetch_assoc($points);

        $pointget = $pointfetch['points'];

        //echo "Points: ".$pointget."<br>";

        if($correctanswer!=0){  //Points divided by the correct answer

            //echo  "POints each correct: ".($pointget/$correctanswer)."<br>";
            $eachcorrect = ($pointget/$correctanswer);

        }else{

            $eachcorrect=$pointget;

        }

            $duplicate = "SELECT * from quiz_studentanswer where quiz_id = '$key'";
            $duplicatequery = mysqli_query($con,$duplicate);
            $duplicatefetch = mysqli_num_rows($duplicatequery); 

        if($duplicatefetch==0){

            foreach ($val as $samp1) {

            $ins = "INSERT INTO quiz_studentanswer(quiz_id,student_id,student_answer) VALUES ('$key','$user_id','$samp1')";
            $insert = mysqli_query($con,$ins);

            }

        }

        while($safetch =mysqli_fetch_assoc($sam)){  

        //echo "<br>".

            $question_id = $safetch['quiz_id'];
            $stud = "Select * from quiz_studentanswer where quiz_id = '$question_id'";
            $stud_query = mysqli_query($con,$stud);

        while($stud_fetch = mysqli_fetch_assoc($stud_query)){

            echo "Student id: ".$stud_fetch['quiz_scoreid']."<br>";

            $scid = $stud_fetch['quiz_scoreid'];
            $samp = $stud_fetch['student_answer'];

            if($duplicateanswer != $samp){

                if($safetch['choices'] == $samp){

                    $overall = $overall + $eachcorrect;
                    $updscore = "UPDATE quiz_studentanswer set score = '$eachcorrect' where quiz_scoreid = '$scid' ";
                    $updquery = mysqli_query($con,$updscore);
                    echo "Your answer:". $samp ." is correct<br>"; 

                }

            }else{

                echo "Your answer is duplicated<br>";
                $duplicateanswer= '';

            }

        }

            echo "Choice ID: ".$safetch['choices']."<br>";

        }
        //echo "Overall Score: ".$overall;
        //echo "<br><br>";
        }

    }

    }

?>                     