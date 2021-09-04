<?php
    include 'assets/includes/header.php';
    if (isset($_POST['submit'])) {
       $title = $_POST['title'];
       $code = $_POST['code'];
       $level = $_POST['level'];
       $depts = $_POST['dept'];
       $date = date('Y-m-d');

       if (empty($title) OR empty($code) OR empty($level) ) {
           $e = "All Field are Required";
           echo  " <script>alert('$e');</script> ";
       }else{
           $dept = $connect2db->prepare("INSERT INTO course (title, code, level, dept, createdby, createdon)VALUES(?,?,?,?,?,?)");
           if ($dept->execute([$title,$code,$level,$depts,$uid,$date])) {
                $e = "Course successfully Created";
                echo  " <script>alert('$e');</script> ";
           }else {
                $e = "An Error Occured! Try Again";
                echo  " <script>alert('$e');</script> ";
           }
       }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = $connect2db->prepare("DELETE FROM course WHERE id = ?");
        $query->execute([$id]);
        if ($query) {
            $e = "Course successfully Deleted";
            echo  " <script>alert('$e');window.location='course';</script> ";
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
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                        <div class="col-md-9 col-sm-12 col-12">
                                            <h4>List Of Registerd Courses</h4>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-12 col-12">
                                            <a href="add-course" class="btn btn-outline-primary" data-toggle="modal" data-target="#loginModal">Add New Course</a>
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
                                                <th class="checkbox-column"> S/N </th>
                                                <th>Course Title</th>
                                                <th>Course Code</th>
                                                <th>Level</th>
                                                <th>Created By </th>
                                                <th>Created On</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                           $getdept = $connect2db->prepare("SELECT * FROM course ");
                                           $getdept->execute();
                                           $i = 0;
                                           while ($row = $getdept->fetch()) {
                                               $i = $i+1;
                                        ?>
                                            <tr>
                                                <td class="checkbox-column"> 1 </td>
                                                <td><?php echo $row->title; ?></td>
                                                <td><?php echo $row->code; ?></td>
                                                <td><?php echo $row->level; ?></td>
                                                <td><?php $adm = $row->createdby;
                                                    $getadmin = $connect2db->prepare("SELECT fname,lname FROM users WHERE id = ?");
                                                    $getadmin->execute([$adm]);
                                                    $ad = $getadmin->fetch();
                                                    echo $ad->fname." ".$ad->lname;
                                                ?></td>
                                                <td><?php echo $row->createdon; ?></td>
                                                <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                            <a class="dropdown-item" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $row->id;?>">View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                            <a onclick="return confirm('Are you Sure?')" class="dropdown-item" href="?delete=<?php echo $row->id; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php include 'assets/includes/viewCourse.php';?>
                                            </tr>
                                            <?php
                                           }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="checkbox-column"> S/N </th>
                                                <th>Course Title</th>
                                                <th>Course Code</th>
                                                <th>Level</th>
                                                <th>Created By </th>
                                                <th>Created On</th>
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
  
                <div class="modal rotateInDownLeft login-modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                          <div class="modal-header" id="loginModalLabel">
                                            <h4 class="modal-title">Add New Course</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                          </div>
                                          <div class="modal-body">
                                            <form class="mt-0" method="POST">
                                              <div class="form-group">
                                                <input type="text" name="title" class="form-control" placeholder="Course Title">
                                              </div>

                                              <div class="form-group">
                                                <input type="text" class="form-control" name="code" placeholder="Course Code">
                                              </div>

                                              <!-- <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Lecturer">
                                              </div> -->

                                              <div class="form-group">
                                              <select name="level" id="" class="form-control selectpicker" data-live-search="true">
                                                    <option value="100">100 Level</option>
                                                    <option value="200">200 Level</option>
                                                    <option value="300">300 Level</option>
                                                </select>
                                              </div>

                                              <div class="form-group">
                                                <select name="dept" id="" class="form-control">
                                                    <option value="1">Computer Science</option>
                                                    <option value="2">Mass Communication</option>
                                                    <option value="3">Computer Engineering</option>
                                                </select>
                                              </div>
                                              <button type="submit" name= "submit" class="btn btn-primary mt-2 mb-2 btn-block">Submit</button>
                                            </form>

                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
            <!-- Modal Ends Here -->
<?php include 'assets/includes/footer.php';?>