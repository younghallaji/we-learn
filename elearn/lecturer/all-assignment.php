<?php include 'includes/header.php';
	if (isset($_POST['submit'])) {
		$filename = $_FILES['ass']['name'];
		$tmp_dir = $_FILES['ass']['tmp_name'];
        $filesize = $_FILES['ass']['size'];
        $aid = $_POST['aid'];

        $fileExt = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $upload_dir = '../lecturer/assignments/'; // upload directory
        $proImage = rand(1000,1000000).".".$fileExt; //new file name
        $dest = $upload_dir.$proImage;
        $valid_extensions = array('doc', 'docx', 'pdf');
        $ldest = "assignments/".$proImage;
        
        if (in_array($fileExt, $valid_extensions)) {
        	if (move_uploaded_file($tmp_dir, $dest)) {
	                $insLink = $connect2db->prepare("INSERT INTO s_assignment (aid,sid,file) VALUES (?,?,?)");
	                    if ($insLink->execute([$aid, $uid, $ldest])) {
	                        $e="Successfully Submitted"; 
	                        echo  " <script>alert('$e');</script> ";
	                    } else {
	                        $e="An Error Occured: Pls Try Again"; 
	                        echo  " <script>alert('$e');</script> ";
	                    }
	            } else {
	                $e="Error Uploading: Pls Try Again"; 
	                echo  " <script>alert('$e');</script> ";
	            }
	            
	        } else {
	            $e="Invalid File Format, Pls Upload PDF only"; 
	            echo  " <script>alert('$e');</script> ";
	        }
                
        }

        if (isset($_GET['delete'])) {
            $aid = $_GET['delete'];

            $delass = $connect2db->prepare("DELETE FROM assignment WHERE id = ?");
            if ($delass->execute([$aid])) {
                $e="Deleted"; 
                echo  " <script>alert('$e');</script> ";
            }
        }

	
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
<div class="row layout-spacing layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>List of Assignments</h4>
                    </div>                  
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Date Added</th>
                            <th>Assignment No</th>
                            <th>Date of Submission</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $status = "";
                            $getStd = $connect2db->prepare("SELECT a.course,a.assign_no,a.question,a.sub_date,a.addedon,a.id, c.level,c.title FROM assignment AS a JOIN course AS c ON a.course = c.id WHERE a.addedby = ?");
                            $getStd->execute([$uid]);
                            while ($std = $getStd->fetch()) {
                            ?>
                          
                        <tr>
                            <td><?php echo $std->question?></td>
                            <td style="text-transform: uppercase;">
                                <?php echo $std->addedon?>
                            </td>
                            <td><?php echo "Assignment ".$std->assign_no?></td>
                            <td>
                                <span class="badge badge-danger">
                                    <?php echo $std->sub_date?>
                                </span>
                            </td>
                            <td><?php echo $std->title?></td>
                            <td class="">
                                <div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                       
                                                <a class="dropdown-item" href="submitted-assignment?id=<?php echo $std->id?>">View & Grade </a>

                                            

                                                <a class="dropdown-item" href="?delete=<?php echo $std->id?>" onclick="return confirm('Are you Sure')">Delete</a>
                                       
                                    </div>
                                </div>
                            </td>
                        </tr>

<div class="modal fade" id="exampleModalCenter<?php echo $std->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Submit Assignment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="row">
	                       <form method="POST" enctype="multipart/form-data">
	                       	<div class="col-sm-12 form-group">
	                       		<label>Upload Assignment</label>
	                       		<input type="file" class="form-control" name="ass">
	                       		<input type="hidden" value="<?php echo $std->id?>" name="aid">
	                       	</div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>

	                </form>
                </div>
            </div>
        </div>
    <?php  
        }
    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Matric No</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- <td><td>
                            <td></td>
                            
                             -->
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php';?>