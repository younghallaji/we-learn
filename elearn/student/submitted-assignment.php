<?php include 'includes/header.php';?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
<div class="row layout-spacing layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>List of Submitted Assignments</h4>
                    </div>                  
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Matric No</th>
                            <th class="text-center">Date & Time</th>
                            <th class="text-center">Download</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $status = "";
                            $getStd = $connect2db->prepare("SELECT sa.datatime,sa.file,u.matric,sa.status,sa.score,sa.sid FROM s_assignment AS sa JOIN users AS u ON sa.sid = u.id WHERE sa.cid = ? AND sa.sid = ?");
                            $getStd->execute([$_GET['id'], $uid]);
                            while ($std = $getStd->fetch()) {
                                // $subon = $std->datatime;

                                // $start_date = strtotime($sub_date);
                                // $end_date = strtotime($subon);
                                // $difference = ($start_date - $end_date )/60/60/24;
                                ?>

                            
                          
                        <tr class="">
                            <td class="text-center" style="text-transform: uppercase;">
                                <?php echo $std->matric?>
                            </td>

                            <td class="text-center"><?php echo $std->datatime?></td>

                            <td class="text-center">
                                <a target="_blank" href="../lecturer/<?php echo $std->file?>" class="text-success">
                                    <i data-feather="download"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <?php if ($std->status == 1) {?>
                                    <span class="badge badge-success">Graded</span>
                               <?php }elseif ($std->status == 2) {?>
                                    <span class="badge badge-danger">Declined</span>
                                <?php
                                    }else{
                                ?>
                                    <span class="badge badge-warning">Pending</span>
                               <?php 
                                    }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $std->score?></td>
                        </tr>


    <?php  
        }
    ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                           <th class="text-center">Matric No</th>
                            <th class="text-center">Date & Time</th>
                            <th class="text-center">Download</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Score</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php';?>