<?php
    include 'assets/includes/header.php';
    if (isset($_POST['save'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password= password_hash("password", PASSWORD_BCRYPT);
        $role = 3;
        $level = $_POST['level'];
        $dept = $_POST['dept'];
        $phone = $_POST['phone'];
        $matric = $_POST['matric'];

        $validate = $connect2db->prepare("SELECT email FROM users WHERE email = ? OR matric = ?");
        $validate->execute([$email, $matric]);

        if ($validate->rowcount()) {
            $e = "Student Already Available";
            echo  " <script>alert('$e');</script> ";
        }else {
            $insert = $connect2db->prepare("INSERT INTO users (fname,lname,email,password,role,department,phone,level,matric) 
            VALUES (?,?,?,?,?,?,?,?,?)");
            $insert->execute([$fname,$lname,$email,$password,$role,$dept,$phone,$level,$matric]);
            if ($insert) {
                $e = "Student Successfully Added";
                echo  " <script>alert('$e');</script> ";
            }else {
                $e = "An Error Occured! Try again";
                echo  " <script>alert('$e');</script> ";
            }
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
                                        <h4>List Of Registerd Students</h4>
                                    </div>
                                
                                    <div class="col-md-3 col-sm-12 col-12">
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#rotateleftModal"> Add New Student</a>
                                    </div>                
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="table-responsive mb-4">
                                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Matric no</th>
                                            <th>Level</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                           $getdept = $connect2db->prepare("SELECT * FROM users WHERE role = ?");
                                           $getdept->execute([3]);
                                           $i = 0;
                                           while ($row = $getdept->fetch()) {
                                               $i = $i+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $row->fname." ".$row->lname?></td>
                                            <td><?php echo $row->email?></td>
                                            <td><?php echo $row->matric?></td>
                                            <td><?php echo $row->level?></td>
                                            <td>
                                                <?php 
                                                    $dept = $row->department;
                                                    $dp = $connect2db->prepare("SELECT name FROM department WHERE id = ?");
                                                    $dp->execute([$dept]);
                                                    $d = $dp->fetch();
                                                    echo $d->name;
                                            
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
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Matric no</th>
                                            <th>Level</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
                <div id="rotateleftModal" class="modal animated rotateInDownLeft custo-rotateInDownLeft" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add New Student</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" name="fname" class="form-control" placeholder="First Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" name="lname" class="form-control" placeholder="Last Name">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" name="matric" class="form-control" placeholder="Matric Number">
                                                        </div>

                                                        <div class="form-group">
                                                            <select name="level" id="" class="form-control selectpicker" data-live-search="true">
                                                                <option value="" selected disabled>Select Level</option>
                                                                <option value="">100 Level</option>
                                                                <option value="">200 Level</option>
                                                                <option value="">300 Level</option>
                                                                <option value="">400 Level</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <select name="dept" id="" class="form-control selectpicker" data-live-search="true">
                                                                <option value="" selected disabled>Select Department</option>
                                                                <?php
                                                                    $lecturer = $connect2db->prepare("SELECT id,name FROM department");
                                                                    $lecturer->execute();
                                                                    while ($data = $lecturer->fetch()) {
                                                                ?>
                                                                    <option value="<?php echo $data->id;?>"> 
                                                                        <?php echo $data->name;?> 
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