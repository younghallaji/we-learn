<?php include 'includes/header.php';?>

<div id="content" class="main-content">
            <div class="layout-px-spacing">
<div class="bio layout-top-spacing ">
        <div class="widget-content widget-content-area">
            <h3 class="">Classrooms</h3>
            
            <div class="bio-skill-box">

                <div class="row">
                    <?php
                        $getCourse = $connect2db->prepare("SELECT cj.classcode, cr.course, cr.instructor, u.fname, u.lname, u.id, c.title, c.code, c.dept FROM class_joined AS cj JOIN classroom AS cr ON cj.classcode = cr.class_code JOIN course AS c ON cr.course = c.id JOIN users AS u ON cr.instructor = u.id  WHERE sid = ?");
                        $getCourse->execute([$uid]);
                        if ($getCourse->rowcount() < 1) {?>
                            <h5>No Course Allocated Yet</h5>
                       <?php } else {
                            while ($row = $getCourse->fetch()) {?>
                                <div class="col-12 col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-xl-5  ">
                        
                                    <div class="d-flex b-skills">
                                        <div class="">
                                    
                                            <h5><?php echo $row->title;?></h5>
                                            <p><span>Lecturer: </span><?php echo $row->fname." ".$row->lname;?></p>
                                            <p><span>Class Code: </span><?php echo $row->classcode;?></p>
                                            <p><span>Course Code: </span><?php echo $row->code;?></p>
                                            

                                            <hr>
                                        	<div class="row">
                                        		<div class="col-sm-7">
                                        			<a href="class" class="text-primary">Go to Class</a>
                                        		</div>

                                                <div class="col-sm-5">
                                                    <a href="material?course=<?php echo $row->course?>" class="text-primary">Materials</a>
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
