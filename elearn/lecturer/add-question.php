<?php
	include 'includes/header.php';

	if (isset($_POST['submit_question'])) {
		$question = $_POST['question'];
		$ccode = $_POST['course'];
		$addedon = date('Y-m-d');

		$option1 = $_POST['option1'];
		$option2 = $_POST['option2'];
		$option3 = $_POST['option3'];
		$option4 = $_POST['option4'];

		$answer = $_POST['answer'];

		$answer1 = ($option1 === $answer) ? 1 : 0 ;
		$answer2 = ($option2 === $answer) ? 1 : 0 ;
		$answer3 = ($option3 === $answer) ? 1 : 0 ;
		$answer4 = ($option4 === $answer) ? 1 : 0 ;


		$insertQuestion = $connect2db->prepare("INSERT INTO question (question, coursecode, addedby, addedon) VALUES (?,?,?,?)");
		if ($insertQuestion->execute([$question,$ccode,$uid,$addedon])) {
			$qid = $connect2db->lastInsertId();
            // $sql = "";
			$sql = "INSERT INTO answers (qid, options, answer) VALUES ('$qid','$option1','$answer1'),('$qid','$option2','$answer2'),('$qid','$option3','$answer3'), ('$qid','$option4','$answer4')";

			// $sql .="INSERT INTO answers (qid, options, answer) VALUES ";
			// $sql .="INSERT INTO answers (qid, options, answer) VALUES ('$qid','$option3','3')";
			// $sql .="INSERT INTO answers (qid, options, answer) VALUES ('$qid','$option3','4')";

			
			$qans = $connect2db->prepare($sql);
			$qans->execute();


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
                        <h2>Add New Question</h2>
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
                    	<div class="form-group col-sm-12">
                    		<label>Question</label>
                    		<textarea class="form-control" name="question" rows="4" style="width:100%;"></textarea>
                    	</div>
                        <div class="form-group col-md-6">
                            <label for="option1">Option 1</label>
                            <input type="text" name="option1" class="form-control" id="option1" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option2">Option 2</label>
                            <input type="text" name="option2" class="form-control" id="option2" >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option3">Option 3</label>
                            <input type="text" name="option3" class="form-control" id="option3" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option4">Option 4</label>
                            <input type="text" name="option4" class="form-control" id="option4" >
                        </div>
                    </div>

                    <div class="" id="correctOption" style="display:none;">
                        <div class="custom-control custom-radio" id="div1"></div>
                        <div class="custom-control custom-radio" id="div2"></div>
                        <div class="custom-control custom-radio" id="div3"></div>
                        <div class="custom-control custom-radio" id="div4"></div>

                    </div>
                    
                  <button type="submit" name="submit_question" class="btn btn-primary mt-3">Submit</button>
                </form>

                	
            </div>
        </div>
    </div>
    <div id="flFormsGrid" class="col-md-4 col-sm-12 layout-spacing card">
    	<h3>Upload Multiple question with csv file</h3>
    	<div class="form-group">
    		<input type="file" name="csv_file" class="form-control">
    	</div>
    </div>
</div>
<?php
	include 'includes/footer.php';
?>
