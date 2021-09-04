<?php include'includes/header.php';?>
<div id="content" class="main-content">
	<div class="layout-px-spacing">
<div class="row layout-top-spacing">
	<div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>List of Courses For <?php echo($level." Level, ".$department);?> Department</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area vertical-line-pill">
                
                <div class="row mb-4 mt-3">
                    <div class="col-sm-3 col-12">
                        <div class="nav flex-column nav-pills mb-sm-0 mb-3 text-center mx-auto" id="v-line-pills-tab" role="tablist" aria-orientation="vertical">
                        	<?php
                        	$courseid = "";
                        		$getCourse = $connect2db->prepare("SELECT id, code FROM course WHERE level = ? AND dept = ?");
                        		$getCourse->execute([$level, $dept]);
                        		$i = 0;
                        		while ($row = $getCourse->fetch()) {
                        			$i++;
                        			$courseid = $row->id;
                        		?>
                        			<a class="nav-link  mb-3  text-center <?php ($i==1) ? print"active" : print "";?>" id="v-line-pills-profile-tab" data-toggle="pill" href="#home<?php echo $courseid;?>" role="tab" aria-controls="<?php echo $courseid;?>" aria-selected="false">
                        				<?php echo $row->code;?>
                        			</a>
                        	<?php
                        		}
                        	?>
                          
                        </div>
                    </div>

                    <div class="col-sm-9 col-12">
                        <div class="tab-content" id="v-line-pills-tabContent">
                        	<?php
                        	$courseid = "";
                        		$getCourse = $connect2db->prepare("SELECT id, code, title FROM course WHERE level = ? AND dept = ?");
                        		$getCourse->execute([$level, $dept]);
                        		$i = 0;
                        		while ($row = $getCourse->fetch()) {
                        			$i++;
                        			$courseid = $row->id;

                                $getdone = $connect2db->prepare("SELECT courseid FROM results WHERE courseid = ?");
                                $getdone->execute([$courseid]);
                                        if ($getdone->rowcount()>0) {
                                            $estatus = "disabled";
                                            $text = "Already Taken";
                                        }else{
                                            $estatus = "";
                                            $text ="Start Exam";
                                        }
                        		?>
                        			
                          <div class="tab-pane <?php ($i==1) ? print"show active" : print "";?> fade" id="home<?php echo $courseid;?>" role="tabpanel" aria-labelledby="v-line-pills-profile-tab">

                            <div class="media"><!-- 
                                <img class="mr-3 rounded-circle" src="../assets/img/90x90.jpg" alt="Generic placeholder image"> -->
                                <div class="media-body">
                                   
                                    <h5 class="mt-0 mb-3"><?php echo $row->title?></h5>
                                    
                                    <a class="btn btn-primary <?php echo $estatus;?>" href="start-exam.php?course=<?php echo $courseid;?>">
                                        <?php echo $text;?>
                                    </a>
                                </div>
                            </div>

                          </div>
                        	<?php
                        		}
                        	?>
                          
                          

                        </div>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
	</div>
</div>
<?php include'includes/footer.php';?>