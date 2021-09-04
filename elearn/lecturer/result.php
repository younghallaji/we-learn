<?php include 'includes/header.php';?>

<div id="content" class="main-content">
            <div class="layout-px-spacing">
<div class="bio layout-top-spacing ">
        <div class="widget-content widget-content-area">
            <h3 class="">Classrooms</h3>
            
            <div class="bio-skill-box">

                <div class="row">
                    <?php
                        $getCourse = $connect2db->prepare("SELECT ca.course, c.title,c.code,c.dept,d.name,c.level,c.id FROM course_allocation AS ca JOIN course AS c ON ca.course = c.id JOIN department AS d ON c.dept = d.id WHERE ca.lecturer = ?");
                        $getCourse->execute([$uid]);
                        if ($getCourse->rowcount() < 1) {?>
                            <h5>No Course Allocated Yet</h5>
                       <?php } else {
                            while ($row = $getCourse->fetch()) {?>
                                <div class="col-12 col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-xl-5  ">
                        
                                    <div class="d-flex b-skills">
                                        <div class="">
                                    
                                            <h5><?php echo $row->classtitle;?></h5>
                                            <p><span>Course Title: </span><?php echo $row->title;?></p>
                                            <p><span>Course Code: </span><?php echo $row->code;?></p>
                                            <p><span>Level: </span><?php echo $row->level;?> Level</p>
                                            <p><span>Department: </span><?php echo $row->name;?></p>

                                            <hr>
                                        	<div class="row">
                                        		<div class="col-sm-12">
                                        			<a href="course-result?course=<?php echo $row->id?>" class="text-primary">View Results</a>
                                        		</div>
                                        	</div>

                                        </div>


                                    </div>

                                </div>
                          <?php  }
                        }
                        
                    ?> 

            </div>

        </div>  
    </div>
</div>
<?php include 'includes/footer.php';?>
