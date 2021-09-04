<?php
	include 'includes/header.php';

	if (isset($_POST['submit'])) {
		$course = $_POST['course'];
        $question = $_POST['question'];
        $assign_no = $_POST['assign_no'];
        $sub_date =  $_POST['sub_date'];

        if (empty($course) OR empty($question) OR empty($assign_no) OR empty($sub_date) ) {
            $e="All Fields Are Required"; 
            echo  " <script>alert('$e');</script> ";
        }else{
            $insLink = $connect2db->prepare("INSERT INTO assignment (course, question, assign_no, sub_date, addedby) VALUES (?,?,?,?,?)");
            if ($insLink->execute([$course,$question,$assign_no,$sub_date,$uid])) {
                $e="Successfully Added"; 
                echo  " <script>alert('$e');</script> ";
            } else {
                $e="An Error Occured: Pls Try Again"; 
                echo  " <script>alert('$e');</script> ";
            }
                
            
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
                        <h2>Add Assignment</h2>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" enctype="multipart/form-data">
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
                    	<div class="form-group col-sm-12">
                    		<label>Question</label>
                    		<textarea name="question" class="form-control col-sm-12" rows="3" ></textarea>
                    	</div>

                        <div class="form-group col-md-12">
                            <label for="option4">Assignment Number</label>
                            <select id="assign_no" name="assign_no" class="form-control" >
                                <option selected disabled="">------</option>
                                <?php 
                                    for ($i=1; $i <= 10; $i++) { ?>
                                        <option value="<?php echo $i?>">
                                            <?php echo "Assignment ".$i?>
                                        </option>
                                <?php  
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-12" id="file">
                            <label for="option4">Submission Date</label>
                            <input id="" class="form-control" type="datetime-local" name="sub_date">
                        </div>

                        
                    </div>

                    
                    
                  <button type="submit" name="submit" class="btn btn-primary mt-3">Submit</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#mtype').on('change', function(){
            var val = $('#mtype').find(':selected').val();
            if(val == 1){
                $('#file').show();
                $('#link').hide();
            }else{
                $('#file').hide();
                $('#link').show();
            }
        })
    })
</script>