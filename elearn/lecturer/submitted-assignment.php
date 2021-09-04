<?php include 'includes/header.php';
	if (isset($_GET['id'])) {
        $aid = $_GET['id'];

        $getData = $connect2db->prepare("SELECT a.assign_no,c.title,a.sub_date FROM assignment AS a JOIN course AS c ON a.course = c.id WHERE a.id = ?");
        $getData->execute([$aid]);
        $data = $getData->fetch();
        $title = $data->title;
        $assign_no = "Assignment".$data->assign_no;
        $sub_date = $data->sub_date;


        if (isset($_POST['sid'])) {
            $sid = $_POST['sid'];
            $score = $_POST['score'];

            $updAss = $connect2db->prepare("UPDATE s_assignment SET score = ?, status = 1 WHERE sid = ? AND aid = ?");
            $updAss->execute([$score, $sid, $aid]);

        }

        if (isset($_GET['decline'])) {
            $sid = $_GET['decline'];
            $updAss = $connect2db->prepare("UPDATE s_assignment SET status = 2 WHERE sid = ? AND aid = ?");
            if ($updAss->execute([$sid, $aid])) {
                echo "<script>window.location='submitted-assignment?id=$aid';</script>";
            }
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
                        <h4>List of <?php echo $assign_no ?> On <?php echo $title?></h4>
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
                            <th class="text-center">Decline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $status = "";
                            $getStd = $connect2db->prepare("SELECT sa.datatime,sa.file,u.matric,sa.status,sa.score,sa.sid FROM s_assignment AS sa JOIN users AS u ON sa.sid = u.id WHERE sa.aid = ?");
                            $getStd->execute([$aid]);
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
                                <a href="<?php echo $std->file?>" class="text-success">
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
                                    <center>
                                        <form method="POST">
                                            <input type="hidden" value="<?php echo $std->sid?>" name="sid">
                                            <input type="text" class="form-control" name="score" placeholder="Score" style="width:60%">
                                        </form>
                                    </center>
                               <?php 
                                    }
                                ?>
                            </td>
                            <td class="text-center"><?php echo $std->score?></td>
                            <td class="text-center">
                                <a class="text-danger <?php if(
                                $std->status!=0){echo "disabled";}?>" href="?decline=<?php echo $std->sid;?>&id=<?php echo $aid?>">
                                    <i data-feather="phone-off"></i>
                                </a>
                            </td>
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
                            <th class="text-center">Decline</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php';?>