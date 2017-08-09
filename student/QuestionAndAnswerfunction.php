    <?php
    
        
   

    function getComments($commentfetch) {
        require('../otherFiles/database/db.php');
        $user =  $_SESSION['stud_username'];
        $query = "Select * from student where stud_username = '$user' ";
        
        $result = mysqli_query($con , $query);
        $row = mysqli_fetch_assoc($result);
        
        $comment_id = $commentfetch['comment_id'];
        $timestamp = $commentfetch['timestamp'];
        
        $commentstud = "SELECT * from student_comment natural join student where comment_id = '$comment_id' ";
        $commentstudquery = mysqli_query($con,$commentstud);
        $comment_fetch  = mysqli_fetch_assoc($commentstudquery);
        
         $commentinstr = "SELECT * from instructor_comment natural join instructor where comment_id = '$comment_id' ";
            $commentinstrquery = mysqli_query($con,$commentinstr);
            $comment_fetch1  = mysqli_fetch_assoc($commentinstrquery);
        
        if($comment_fetch){
            $name = $comment_fetch['stud_username'];
        }else if ($comment_fetch1){
            
            $name = $comment_fetch1['instr_username'];
            
        }
        
        
        ?>
        <li class='list-group-item'>
            <?php
               $course_id = $_REQUEST['c'];
                $student_id = $row['student_id'];
        $date = $date = date('F, d Y  h:i', strtotime($timestamp)); 
                
              ?>
                <div class="row">
                    <div class="col-lg-6"><?php echo $name;?><?php echo $date;?></div>
                    <div class="col-lg-6">
                      <div class="text-right">
                          <a href='#view<?php echo $comment_id;?>' class="reply" data-toggle="modal" >Reply</a>
                    </div>
                    </div>
            </div>
               <div id="view<?php echo $comment_id;?>" role="dialog " class="modal face">
              <!-- Modal content -->
              <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                   <div class="modal-body">
                        <h4><?php echo $commentfetch['comment'];?></h4>
                        <form action="replyfunction.php" method="post">
                            <div class="col-lg-12">
                            <textarea class="form-control" name="question" placeholder="Make a question"></textarea>
                            </div>
                            <input type="hidden" name="course_idd" value="<?php echo $course_id; ?>" >                        
                            <input type="hidden" name="student_idd" value="<?php echo $student_id; ?>" >                        
                            <input type="hidden" name="reply_to" value="<?php echo $comment_id;?>" >                        
                            <input type="submit" name="reply">

                        </form>

                    </div>
                    </div>
              </div>
            </div>

            <?php echo $commentfetch['comment']?>


    <?php
                
                            

         /* The following sql checks whether there's any reply for the comment */
         $q = "SELECT * from comment where course_id = ". $commentfetch['course_id']." and reply_to = ".$comment_id."";
         $r = mysqli_query($con,$q);
         if(mysqli_num_rows($r)>0) // there is at least reply
          {
          while($commentfetch = mysqli_fetch_assoc($r)) {
              echo '<ul class="list-group">';
           getComments($commentfetch);
              echo '</ul>';
          }

          }

        }
    

        ?>