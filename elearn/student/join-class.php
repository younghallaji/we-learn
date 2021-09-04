<?php
	include 'includes/header.php';

	if (isset($_POST['classroom'])) {
        $class_code = $_POST['code'];
		
        $validateClass = $connect2db->prepare("SELECT * FROM classroom WHERE class_code = ?");
        $validateClass->execute([$class_code]);
        if ($validateClass->rowcount()>0) {
            $ifexist = $connect2db->prepare("SELECT * FROM class_joined WHERE sid = ? AND classcode = ?");
            $ifexist->execute([$uid, $class_code]);
            if ($ifexist->rowcount()>0) {
                $e = "You Already Joined The class";
                echo  " <script>alert('$e');window.location='classroom';</script> ";
            } else {
                $joinClass = $connect2db->prepare("INSERT INTO class_joined (classcode, sid) VALUES (?,?)");
                if ($joinClass->execute([$class_code, $uid])) {
                    $e = "Successfully Joined The class";
                    echo  " <script>alert('$e');window.location='classroom';</script> ";
                }
            }
            
        }else{
            $e = "Invalid Class Code! Try Again!!!";
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
                        <h2>Join Classroom</h2>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST">
                    <div class="form-row mb-4">
                    	
                    	
                        <div class="form-group col-md-12">
                            <label for="option1">Class Code</label>
                            <input type="text" name="code" class="form-control" >
                        </div>
                        

                    </div>

                   
                    
                  <button type="submit" name="classroom" class="btn btn-primary">Submit</button>
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
