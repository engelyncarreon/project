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

    ?>

    <?php 

        while($row = mysqli_fetch_assoc($result))

        { 
    ?>

    <div id = "content">

        <div class = "line">

            <div class = "margin">

                <div class = "s-12 m-6 l-4">

                    <img src = "image/330x190.jpg">

                    <h3 id = 'title'> 

                        <?php echo $row["course_name"];?>
                        
                    </h3>

                <div>

                    <div>

                        <?php echo $row["course_desc"]; ?>
                        <br/><br/>

                    </div>

                    <div>

                        <?php echo "Instructor: ". $row["course_instr"]; ?> 

                    
                    </div>

                        <?php echo "Category: ". $row["course_category"]; ?>

                    <div>

                        <?php echo "Price: ". $row["course_price"]; ?> <br/>

                    </div>

                    <div>

                     <a id = 'link' href="SpecificCourse.php?course_id=<?php echo $row["course_id"];?>&course_name=<?php echo $row["course_name"]; ?>" class="button">More details</a>

                    </div><br/>

                    <?php }

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

                </div>

                </div>

            </div>

        </div>

    </div>