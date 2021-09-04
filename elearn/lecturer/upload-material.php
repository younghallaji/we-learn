<?php
	include 'includes/header.php';

	if (isset($_POST['upload'])) {
		$course = $_POST['course'];
        $title = $_POST['title'];
        $type = $_POST['type'];
        $link = ($type==1) ? $_FILES['file']['name']  : $_POST['link'];

        if (empty($course) OR empty($title) OR empty($link) ) {
            $e="All Fields Are Required"; 
            echo  " <script>alert('$e');</script> ";
        }else{
            if ($type==2) {
                $insLink = $connect2db->prepare("INSERT INTO material (course, title, addedby, link, type) VALUES (?,?,?,?,?)");
                if ($insLink->execute([$course, $title, $uid, $link, $type])) {
                    $e="Successfully Added"; 
                    echo  " <script>alert('$e');</script> ";
                } else {
                    $e="An Error Occured: Pls Try Again"; 
                    echo  " <script>alert('$e');</script> ";
                }
                
            }else{
                $filename = $_FILES['file']['name'];
                $tmp_dir = $_FILES['file']['tmp_name'];
                $filesize = $_FILES['file']['size'];

                $fileExt = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                $upload_dir = 'materials/'; // upload directory
                $proImage = rand(1000,1000000).".".$fileExt; //new file name
                $dest = $upload_dir.$proImage;

                if ($fileExt == 'pdf') {
                    if (move_uploaded_file($tmp_dir, $dest)) {
                        $insLink = $connect2db->prepare("INSERT INTO material (course, title, addedby, link, type) VALUES (?,?,?,?,?)");
                            if ($insLink->execute([$course, $title, $uid, $dest, $type])) {
                                $e="Successfully Added"; 
                                echo  " <script>alert('$e');</script> ";
                            } else {
                                $e="An Error Occured: Pls Try Again"; 
                                echo  " <script>alert('$e');</script> ";
                            }
                    } else {
                        $e="An Error Occured: Pls Try Again"; 
                        echo  " <script>alert('$e');</script> ";
                    }
                    
                } else {
                    $e="Invalid File Format, Pls Upload PDF only"; 
                    echo  " <script>alert('$filename');</script> ";
                }
                

                // $e="An Error Occured: Pls Try Again"; 
                //     echo  " <script>alert('$filename');</script> ";
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
                        <h2>Add Material</h2>
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
                    		<label>Title/Topic</label>
                    		<input type="text" name="title" class="form-control" id="option1" >
                    	</div>

                        <div class="form-group col-md-12">
                            <label for="option4">Material Type</label>
                            <select id="mtype" name="type" class="form-control" >
                                <option selected disabled="">------</option>
                                <option value="1">Upload PDF</option>
                                <option value="2">Youtube Video Link</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-12" style="display:none;" id="file">
                            <label for="option4">File</label>
                            <input type="file" name="file" class="form-control" id="option4" >
                            <span class="badge mt-2 badge-danger">Support PDF only</span>
                        </div>

                        <div class="form-group col-md-12" style="display:none;" id="link">
                            <label for="option4">Link</label>
                            <input type="link" name="link" class="form-control" id="option4" >
                            <span class="mt-2 badge badge-danger">Make sure its Youtube embeded link. E.g:</span>
                            <span class="badge mt-2 badge-danger">https://www.youtube.com/<strong>embed</strong>/1iWhGJQ5eF8</span>

                        </div>
                    </div>

                    
                    
                  <button type="submit" name="upload" class="btn btn-primary mt-3">Submit</button>
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