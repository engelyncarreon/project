<?php 

    require('../otherFiles/database/db.php');
    if($_POST['status'] == "Paid"){
           
        $padid = $_POST['pad'];
        $course_id = $_POST['courseid'];
        $student_id = $_POST['studentid'];
        
         $up = "Update studentcourse SET paymentStatus = 'Paid' where student_courseid = '$padid' ";        
        $update = mysqli_query($con,$up);
       
        $course_lesson = "SELECT * from lessons where course_id = '$course_id'";
        $course_lessonquery = mysqli_query($con,$course_lesson);
        
        while($course_lessonfetch = mysqli_fetch_assoc($course_lessonquery)){
           
            $lesson_id = $course_lessonfetch['lesson_id'];
            $course_lecture = "SELECT * from lecture where lesson_id = '$lesson_id'";
            $course_lecturequery = mysqli_query($con,$course_lecture);
            while($course_lecturefetch = mysqli_fetch_assoc($course_lecturequery)){
                $lecture_id = $course_lecturefetch['lecture_id'];


                $insertchecker = "INSERT INTO student_lessonchecker(lecture_id,student_id) VALUES ('$lecture_id','$student_id')";
                $insertchecker_query = mysqli_query($con,$insertchecker);
            }
        }
        
        header("Location: enroll.php");
    }

?>