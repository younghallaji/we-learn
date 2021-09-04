<?php include 'assets/includes/header.php';
    if (isset($_GET['course'])) {
        $cid = $_GET['course'];

        $getData = $connect2db->prepare("SELECT c.title,c.level,d.name FROM course AS c JOIN department as d ON c.dept = d.id WHERE c.id = ?");
        $getData->execute([$cid]);
        $data = $getData->fetch();

        $title = $data->title;
        $level = $data->level."Level";
        $dept = $data->name." Department";

   }
    
?>
<title>Result For <?php echo $title.", ".$level.", ".$dept?></title>
<div id="content" class="main-content">
    <div class="layout-px-spacing">
<div class="row layout-spacing layout-top-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <center>
                            <h3>
                                Result For <?php echo $title.", ".$level.", ".$dept?>
                            </h3>
                        </center>
                    </div>                  
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                <table class="table table-hover non-hover" style="width:100%" id="html5-extension" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Matric Number</th>
                            <th class="text-center">Score</th>
                            <th class="text-center">Total Question Answered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT SUM(result) as score, COUNT(questionid) as total, u.matric FROM `results` JOIN users AS u ON studentid = u.id  WHERE courseid = ? GROUP BY studentid ";
                            $getStd = $connect2db->prepare($sql);
                            $getStd->execute([$cid]);
                            while ($std = $getStd->fetch()) {
                        ?>

                            
                          
                        <tr class="">
                            <td class="text-center">
                                <?php echo $std->matric?>
                            </td>

                            <td class="text-center"><?php echo $std->score?></td>

                            <td class="text-center">
                                <?php echo $std->total ?>
                            </td>

                            
                        </tr>

    <?php  
        }
    ?>
                        
                    </tbody>
                    <tfoot>
                       <tr>
                            <th class="text-center">Matric Number</th>
                            <th class="text-center">Score</th>
                            <th class="text-center">Total Question Answered</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'assets/includes/footer.php';?>
