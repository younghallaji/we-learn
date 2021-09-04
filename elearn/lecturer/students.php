<?php
    include 'includes/header.php';

if (isset($_GET['delete'])) {
    $sid = $_GET['user'];
    $cc = $_GET['code'];
    $delStd = $connect2db->prepare("UPDATE class_joined SET deleted = ? WHERE sid = ?");
    if ($delStd->execute([1, $sid])) {
        $e="Student Successfully Deleted"; 
        echo  " <script>alert('$e'); window.location='students?code=$cc'</script> ";
    }
}

if (isset($_GET['suspend'])) {
    $status = $_GET['suspend'];
    $status = ($status == 0) ? 1 : 0 ;
    $sid = $_GET['user'];
    $cc = $_GET['code'];
    $delStd = $connect2db->prepare("UPDATE class_joined SET suspend = ? WHERE sid = ?");
    if ($delStd->execute([$status, $sid])) {
        $e="Operation Successful"; 
        echo  " <script>alert('$e'); window.location='students?code=$cc'</script> ";
    }

}

if (isset($_GET['banned'])) {
    $status = $_GET['banned'];
    $status = ($status == 0) ? 1 : 0 ;
    $sid = $_GET['user'];
    $cc = $_GET['code'];
    $delStd = $connect2db->prepare("UPDATE class_joined SET banned = ? WHERE sid = ?");
    if ($delStd->execute([$status, $sid])) {
        $e="Operation Successful"; 
        echo  " <script>alert('$e'); window.location='students?code=$cc'</script> ";
    }

}

    if (isset($_GET['code']) AND $_GET['code'] != "") {
        $course_code = $_GET['code'];
        $getCourse = $connect2db->prepare("SELECT cr.course, c.title FROM classroom AS cr JOIN course AS c ON cr.course = c.id WHERE class_code = ?");
        $getCourse->execute([$course_code]);
        $course = $getCourse->fetch();
        $title = $course->title;
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
                        <h4>Registerd Students for <?php echo $title;?></h4>
                    </div>                  
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Matric No</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $status = "";
                            $getStd = $connect2db->prepare("SELECT cj.sid, cj.classcode,cj.suspend,cj.banned,cj.deleted, u.fname,u.lname,u.matric,u.level,u.department,d.name FROM class_joined AS cj JOIN users AS u ON cj.sid = u.id JOIN department AS d ON u.department = d.id WHERE classcode = ? AND deleted = ?");
                            $getStd->execute([$course_code, 0]);
                            while ($std = $getStd->fetch()) {
                                if ($std->banned == "0" AND $std->suspend == "0") {
                                    $status = "Active";
                                    $class = "outline-badge-primary";
                                }elseif($std->banned == "1" AND $std->suspend == "0") {
                                    $status = "Banned";
                                    $class = "outline-badge-danger";
                                }elseif($std->banned == "0" AND $std->suspend == "1") {
                                    $status = "Suspended";
                                    $class = "outline-badge-warning";
                                }else{
                                    $class = "badge-danger";
                                    $status = "Suspended & Banned";
                                }
                            ?>
                          
                        <tr>
                            <td><?php echo $std->fname." ".$std->lname;?></td>
                            <td style="text-transform: uppercase;">
                                <?php echo $std->matric?>
                            </td>
                            <td><?php echo $std->name?></td>
                            <td>
                                <span class="badge <?php echo $class;?>">
                                    <?php echo $status?>
                                </span>
                            </td>
                            <td class="">
                                <div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                        <?php
                                            if ($status=="Active") {?>
                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&suspend=<?php echo $std->suspend?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Suspend </a>

                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&banned=<?php echo $std->banned?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Ban </a>

                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&delete=<?php echo $std->deleted?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Delete</a>
                                        <?php   
                                            }elseif ($status =="Banned") {?>
                                               <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&suspend=<?php echo $std->suspend?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Suspend </a>
                                                
                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&banned=<?php echo $std->banned?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Lift Ban </a>
                                                
                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&delete=<?php echo $std->deleted?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Delete</a>
                                        <?php 
                                            }elseif ($status =="Suspended") {?>
                                               <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&suspend=<?php echo $std->suspend?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Unsuspend </a>

                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&banned=<?php echo $std->banned?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Ban </a>
                                                
                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&delete=<?php echo $std->deleted?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Delete</a>
                                        <?php 
                                            } else{?>
                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&suspend=<?php echo $std->suspend?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Unsuspend </a>

                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&banned=<?php echo $std->banned?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Lift Ban </a>

                                                <a class="dropdown-item" href="?code=<?php echo $std->classcode?>&delete=<?php echo $std->deleted?>&user=<?php echo $std->sid?>" onclick="return confirm('Are you Sure')">Delete</a>
                                          <?php 
                                            }
                                        ?>
                                        
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
<?php   
    }else{?>
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-spacing layout-top-spacing">
                    <a href="dashboard" class="btn btn-primary btn-lg">Back To Home</a>
                </div>
            </div>
        </div>
  <?php  }
?>