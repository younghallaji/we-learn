<?php
    include 'assets/includes/header.php';
    if (isset($_POST['save'])) {
       $name = $_POST['name'];
       $hod = $_POST['hod'];
       $date = date('Y-m-d');

       if (empty($name) OR empty($hod) ) {
           $e = "All Field are Required";
           echo  " <script>alert('$e');</script> ";
       }else{
           $dept = $connect2db->prepare("INSERT INTO department (name, hod, createdby, createdon)VALUES(?,?,?,?)");
           if ($dept->execute([$name,$hod,$uid,$date])) {
                $e = "Department successfully Created";
                echo  " <script>alert('$e');</script> ";
           }else {
                $e = "An Error Occured! Try Again";
                echo  " <script>alert('$e');</script> ";
           }
       }
    }
?>

 <!-- Button trigger modal -->
 <!-- <button type="button" class="btn btn-dark mb-2 mr-2" data-toggle="modal" data-target="#loginModal">
                                      Login
                                    </button> -->

                                    <!-- Modal -->
                                    

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-spacing layout-top-spacing">
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-12 col-12">
                                                <h4>List Of Registerd Department</h4>
                                            </div>
                                        
                                            <div class="col-md-3 col-sm-12 col-12">
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rotateleftModal"> Add New Department</a>
                                            </div>
                                        </div>
                                    </div>                  
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive mb-4">
                                    <table id="column-filter" class="table">
                                        <thead>
                                            <tr>
                                                <th> S/N </th>
                                                <th>Department Name</th>
                                                <th>Head of Department</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $getdept = $connect2db->prepare("SELECT * FROM department ");
                                           $getdept->execute();
                                           $i = 0;
                                           while ($row = $getdept->fetch()) {
                                               $i = $i+1;
                                        ?>
                                        
                                            <tr>
                                            <td><?php echo $i; ?></td>
                                                <td><?php echo $row->name?></td>
                                                <td>
                                                    <?php 
                                                        $hodid = $row->hod;
                                                        $names = $connect2db->prepare("SELECT fname, lname FROM users WHERE id = ?");
                                                        $names->execute([$hodid]);
                                                        $hn = $names->fetch();
                                                        echo $hn->lname." ".$hn->fname;

                                                     ?>
                                                </td>
                                                <td><?php echo $row->createdon?></td>
                                                <td>
                                                <?php 
                                                        $hodid = $row->createdby;
                                                        $names = $connect2db->prepare("SELECT fname, lname FROM users WHERE id = ?");
                                                        $names->execute([$hodid]);
                                                        $hn = $names->fetch();
                                                        echo $hn->lname." ".$hn->fname;

                                                     ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                            <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                              }
                                            ?>
                                            
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                                <th class="checkbox-column"> S/N </th>
                                                <th>Department Name</th>
                                                <th>Head of Department</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Start Here -->
  
                <div id="rotateleftModal" class="modal animated rotateInDownLeft custo-rotateInDownLeft" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add New Department</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" name="name" class="form-control" placeholder="Department Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <select name="hod" id="" class="form-control selectpicker" data-live-search="true">
                                                                <option value="" selected disabled>Select Head of Department</option>
                                                                <?php
                                                                    $lecturer = $connect2db->prepare("SELECT id,fname,lname FROM users WHERE role = ?");
                                                                    $lecturer->execute([2]);
                                                                    while ($data = $lecturer->fetch()) {
                                                                ?>
                                                                    <option value="<?php echo $data->id;?>"> 
                                                                        <?php echo $data->fname." ".$data->lname;?> 
                                                                    </option>
                                                                 <?php
                                                                    }
                                                                    
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                                                    </div>
                                                
                                                </form>
                                                </div>
                                            </div>
                                        </div>
            <!-- Modal Ends Here -->
<?php include 'assets/includes/footer.php';?>