<?php

    require('database/db.php');

    $pageshow = 3;

    if (isset($_GET["page"])){

        $page = $_GET["page"];

    }else{

         $page=1;
    }

    $startfrom = ($page-1) * $pageshow;
    $query = "SELECT * from courses order by course_id limit $startfrom , $pageshow " ;
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)){

        $counter = 0;
        echo '<div class="row">';

        while($row=mysqli_fetch_array($result)) {

            if($counter != 0 && $counter % 3 == 0){
                echo '</div><div class="row">';
            }
?>

        <div class="col-sm-4 text-center">

            <img src = "image/330x190.jpg">

            <h3 id = 'title'> 

                <?php echo $row["course_name"];?>
                
            </h3>

            <?php echo $row["course_desc"]; ?> <br/><br/>

            <?php echo "Instructor: ". $row["course_instr"]; ?> <br/>

            <?php echo "Category: ". $row["course_category"]; ?> <br/>

            <?php echo "Price: ". $row["course_price"]; ?> <br/>

            <form action="SpecificCourse.php" method="POST">

                <input type="hidden" name="course_id" value="<?php echo $row['course_id'];?>">

                <input type="hidden" name="course_name" value="<?php echo $row["course_name"]; ?>">

                <input type = 'submit' name = 'user_status' value = 'More Details' class = 'button'/>

            </form>

       </div>

    <?php  

        ++$counter;

    }

         echo '</div>';
    }
?>

<?php 

    $sqlquery = "SELECT COUNT(course_id) AS total from courses";
    $result = mysqli_query($con, $sqlquery);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row["total"] / $pageshow);

    for ($i=1; $i<=$total_pages;$i++){

        echo "<div class = 'pagination'>
        <a class = 'active' href = 'allcourse.php?page=".$i."'";

        if ($i==$page) 

        echo "class = 'curpage'";
        echo ">".$i."</a></div>";

    };
?>