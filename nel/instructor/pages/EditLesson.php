<form action="" method="post">
    <input type="hidden" name="r" value='<?php echo $r; ?>'>
    <a  data-toggle="modal" data-target="#iModal"><input type="submit"  class="pull-right"  value="Edit Lesson" ></a>

</form>

  <!-- Modal -->
  <div class="modal fade " id="iModal" >

    
      <!-- Modal content-->
      <div class="modal-content">
         <button type="button" class="close " data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Lesson</h4>
        <form action="coursedetails.php?course=<?php echo $urlid; ?>" method="post" class="ajax" enctype="multipart/form-data">
            
                <div id ="editcours1">
                   
                    
                    <p>Lesson Name: <input type='text' id='' name='editlesson' required></p>
                    <p id=lessonname></p>
                    
                    
                    <?php  
                        echo $r;
                       
                        $idm =$less2row['lesson_id'];
                        $less4 = "Select * from lecture where lesson_id = '$nam' Order by lecture_id";
                        $less4result = mysqli_query($con,$less4); 
                        while($less4row = mysqli_fetch_assoc($less4result)){
                    ?>
                    
                    
                    <p>Lecture Name:<input type="text" name="editlecturename[]" value="<?php echo $less4row['lecture_name'];?>" required>       </p>
                    
                    <p>Lecture Details:</p><textarea rows="10" cols="50" name="editlecturedetail[]"  required  ><?php echo $less4row['lecture_details'];?></textarea>
                    
                  <?php  if(!empty($less4row['urlname'])){?>
                    <input type="file" name="editupfile[]" id="upfile" style="color:transparent;" onchange="this.style.color = 'black';" /><p><?php echo $less4row['urlname'];?></p>
                    
                    <?php }else{?>
                             <input type="file" name="editupfile[]" ?></p>
                    <?php }
                        }?>

                </div>
                <button type="button" onclick="addlecture()" name="add" class="addless">Add Lecture</button>
                  <input type="submit" name="submitlesson" value="submit"></br>

            </form>
      </div>
      
    
  </div>