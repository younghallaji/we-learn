<?php
    include 'assets/includes/header.php';
      if (isset($_GET['delete'])) {
        $cc = $_GET['delete'];
        $del = $connect2db->prepare("DELETE FROM question WHERE id = ?");
        $del->execute([$cc]);
        if ($del) {
            $e="Question Deleted"; 
            echo  " <script>alert('$e'); window.location='exam_ques'</script> ";
        }else{
            $e="Unable to delete"; 
            echo  " <script>alert('$e'); window.location='exam_ques'</script> ";
        }

    }
?>



        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-spacing layout-top-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-md-9 col-sm-12 col-12">
                                        <h4>List Of Registerd Lecturers</h4>
                                    </div>
                                
                                    <div class="col-md-3 col-sm-12 col-12">
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rotateleftModal"> Add New Lecturer</a>
                                    </div>                
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive mb-4">
                                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Correct Answer</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           $getdept = $connect2db->prepare("SELECT * FROM question ORDER BY coursecode");
                                           $getdept->execute();
                                           $i = 0;
                                           while ($row = $getdept->fetch()) {
                                               $i = $i+1;
                                        ?>
                                        
                                        <tr>
                                            <td>
                                                <?php 
                                                    echo $row->question;
                                                ?>
                                            </td>
                                            <td>
                                                <?php $lid = $row->id;
                                                $gd = $connect2db->prepare("SELECT options FROM answers WHERE qid = ?");
                                                $gd->execute([$lid]);
                                                while ($rw = $gd->fetch()) {?>
                                                    <span class="badge badge-secondary mb-2">
                                                        <?php echo $rw->options;?>
                                                    </span>
                                              <?php 
                                               }
                                                ?>
                                            </td>
                                            <td><?php $lid = $row->id;
                                                $gd = $connect2db->prepare("SELECT options FROM answers WHERE qid = ? AND answer = 1");
                                                $gd->execute([$lid]);?>
                                                <span class="badge badge-success">
                                                <?php echo $gd->fetch()->options;
                                            ?></span></td>
                                            <td>
                                                <?php $did = $row->coursecode;
                                                $gd = $connect2db->prepare("SELECT code FROM course WHERE id = ?");
                                                $gd->execute([$did]);
                                                 echo $gd->fetch()->code;?>
                                            </td>

                                            <td class="text-center">
                                                <div class="dropdown custom-dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink9">
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#rotateleftModal<?php echo $row->id?>">Edit</a>
                                                        <a onclick="return confirm('Are you Sure?')" class="dropdown-item" href="?delete=<?php echo $row->id?>">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

            <div id="rotateleftModal<?php echo $row->id?>" class="modal animated rotateInDownLeft custo-rotateInDownLeft" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="" method="POST">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Question</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea name="question" class="form-control col-sm-12" rows="4"><?php echo $row->question?></textarea>
                                </div>

                                <?php $lid = $row->id;
                                    $gd = $connect2db->prepare("SELECT options FROM answers WHERE qid = ?");
                                    $gd->execute([$lid]);
                                    while ($rw = $gd->fetch()) {?>
                                <div class="form-group">
                                    <input type="text" name="lname" class="form-control" value="<?php echo $rw->options?>">
                                </div>
                                  <?php 
                                   }
                                    ?>

                            </div>
                            <div class="modal-footer md-button">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                            </div>
                        
                        </form>
                        </div>
                    </div>
                </div>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Question</th>
                                            <th>Options</th>
                                            <th>Correct Answer</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
</div>
            <!-- Modal Ends Here -->
  

            
<?php include 'assets/includes/footer.php';?>