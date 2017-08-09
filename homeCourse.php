<?php

    require('otherFiles/database/db.php');

    $pageshow = 6;

    if (isset($_GET["page"])){

        $page = $_GET["page"];

    }else{

         $page=1;
    }

    $startfrom = ($page-1) * $pageshow;
    $query = "SELECT *, concat(instr_Firstname ,' ', instr_lastName) AS instrName from courses  join instructor where course_id in( SELECT course_id from lessons) and course_instr = instructor_id group by 1  limit $startfrom , $pageshow " ;

    $result = mysqli_query($con, $query);

    // display course

    if(mysqli_num_rows($result)){

        $counter = 0;
        echo '<div class="row">';

        while($row=mysqli_fetch_array($result)) {

            $ro = $row['course_id'];
            $les1 = "SELECT * from lessons where course_id =$ro" ;
            $res1 = mysqli_query($con, $les1);
            $fet = mysqli_fetch_assoc($res1);
            if(!empty($fet)){//

            if($counter != 0 && $counter % 3 == 0){
                
                echo '</div><div class="row">';
            }
?>

        <div class="col-sm-4 text-center">

            <img class="img-responsive" src = "<?php echo "instructor/".$row["course_imageurl"];?>" alt = "course-image">

            <h3 id = 'title'>

                <?php echo $row["course_name"];?>

            </h3>
                

            <?php echo $row["course_desc"]; ?> <br/><br/>

            <?php echo "Instructor: ". $row["instrName"]; ?> <br/>

            <?php echo "Category: ". $row["course_category"]; ?> <br/>

            <?php echo "Price: ". $row["course_price"]; ?> <br/>

            <div>

             <a href="SpecificCourse.php?course_id=<?php echo $row["course_id"];?>&course_name=<?php echo $row["course_name"]; ?>" class="button">More details</a>

            </div><br/>

       </div>

       <!-- end of display -->

    <?php  

        ++$counter;

    }

    }

         echo '</div>';
    }
?>

<?php 

    $sqlquery = "Select count(course_id) as total from courses where course_id in( SELECT course_id from lessons group by 1)";
    $result = mysqli_query($con, $sqlquery);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row["total"] / $pageshow);

    for ($i=1; $i<=$total_pages;$i++){

        echo "<div class = 'pagination'>
        <a class = 'active' href = 'homepage.php?page=".$i."'";

        if ($i==$page) 

        echo "class = 'curpage'";
        echo ">".$i."</a></div>";

    };
?>