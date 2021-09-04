<?php
	include 'includes/header.php';

	if (isset($_POST['classroom'])) {
        $class_code = "CUC-".rand(00000,99999);
		$ccode = $_POST['course'];
		$addedon = date('Y-m-d');
        $title = $_POST['title'];

		$duration = $_POST['duraion'];
		$time = $_POST['time'];
        $day = $_POST['day'];


		$insertQuestion = $connect2db->prepare("INSERT INTO classroom (class_code, classtitle, duration, time, instructor, createdon,course,day) VALUES (?,?,?,?,?,?,?,?)");
		if ($insertQuestion->execute([$class_code,$title,$duration,$time,$uid,$addedon,$ccode,$day])) {
			$e = "Classroom Successfully Created. Class Code is:".$class_code;
            echo  " <script>alert('$e');</script> ";
		}else{
            $e = "Error: Error Creating Class!";
            echo  " <script>alert('$e');</script> ";
        }
	}
?>
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                

<div class="row layout-top-spacing">
    <div id="flFormsGrid" class="col-md-8 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class=" col-md-8 col-sm-12 col-12">
                        <h2>Create New Class</h2>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST">
                    <div class="form-row mb-4">
                    	<div class="form-group col-sm-12">
                    		<label>Select Course</label>
                    		<select class="form-control" name="course">
                    			<option selected disabled>.....</option>
                    			<?php
                    				$getCourse = $connect2db->prepare("SELECT ca.course,c.title,c.code,c.dept,d.name,c.level,c.id FROM course_allocation AS ca JOIN course AS c on ca.course = c.id JOIN department AS d ON c.dept = d.id WHERE ca.lecturer = ? ");
                                        $getCourse->execute([$uid]);
                                         if ($getCourse->rowcount() < 1) {?>
                                                <h5>No Course Allocated Yet</h5>
                                         <?php } else {
                                            while ($row = $getCourse->fetch()) {
                                ?>
                    			 <option value="<?php echo $row->id?>">
                    			 	<?php echo $row->title?>
                    			 </option>
                    			 <?php  
                    				}
                                  }       
                                ?> 
                    		</select>
                    	</div>
                    	
                        <div class="form-group col-md-6">
                            <label for="option1">Class Title</label>
                            <input type="text" name="title" class="form-control" >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option1">Select Day</label>
                            <select name="day" class="form-control">
                                <option selected disabled>-----</option>
                                <option>Monday</option>
                                <option>Tuesday</option>
                                <option>Wednesday</option>
                                <option>Thursday</option>
                                <option>Friday</option>
                                <option>Saturday</option>

                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option2">Duration</label>
                            <input type="number" name="duration" class="form-control mb-2"  >
                            <small class="badge badge-danger">Mentioned in Hour(s)</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option3">Time</label>
                            <input type="time" name="time" class="form-control" >
                        </div>

                    </div>

                   
                    
                  <button type="submit" name="classroom" class="btn btn-primary mt-3">Submit</button>
                </form>

                	
            </div>
        </div>
    </div>
    <!-- <div id="flFormsGrid" class="col-md-4 col-sm-12 layout-spacing card">
    	<h3>Upload Multiple question with csv file</h3>
    	<div class="form-group">
    		<input type="file" name="csv_file" class="form-control">
    	</div>
    </div> -->
</div>
<?php
	include 'includes/footer.php';
?>
