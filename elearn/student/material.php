<?php include 'includes/header.php';
    if (isset($_GET['code'])) {
        $cid = $_GET['code'];

        $getData = $connect2db->prepare("SELECT m.title,m.link,c.title FROM material AS m JOIN course AS c ON m.course = c.id WHERE m.course = ?");
        $getData->execute([$cid]);
        $data = $getData->fetch();
        $title = $data->title;
        $htitle = "Uploaded Material FOR ".$data->title;

        $sql = "SELECT m.title AS mtitle,m.link,m.id,c.title,m.type FROM material AS m JOIN course AS c ON m.course = c.id WHERE m.course = '$cid' ";

    }else{
        $htitle = "All Material Uploaded";
        $sql = "SELECT m.title AS mtitle,m.link,m.id,m.type,c.title FROM material AS m JOIN course AS c ON m.course = c.id WHERE c.level= '$level' ";

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
                        <h4><?php echo $htitle ?> </h4>
                    </div>                  
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                <table class="multi-table table table-striped table-bordered table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Course</th>
                            <th class="text-center">Topic</th>
                            <th class="text-center">Download</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $status = "";
                            $getStd = $connect2db->prepare($sql);
                            $getStd->execute();
                            while ($std = $getStd->fetch()) {
                        ?>

                            
                          
                        <tr class="">
                            <td class="text-center">
                                <?php echo $std->title?>
                            </td>

                            <td class="text-center"><?php echo $std->mtitle?></td>

                            <td class="text-center">
                                <?php 
                                    if ($std->type==1) {?>
                                        <a target="_blank" href="../lecturer/<?php echo $std->link?>" class="text-success">
                                            <i data-feather="download"></i>
                                        </a>
                                  <?php  
                                    } 
                                    else {
                                    ?>
                                        <a id="yt-video-link" class="text-success yt-video-link" data-link=<?php echo $std->link?>>
                                            <i data-feather="video"></i>
                                        </a>
                                    <?php 
                                        }
                                    ?>
                                
                            </td>
                            <td class="text-center">
                                <?php if ($std->type == 1) {?>
                                    <span class="badge badge-warning">PDF file</span>
                               <?php }else {?>
                                    <span class="badge badge-info">Youtube Video</span>
                                <?php
                                    }
                                ?>
                            </td>

                            <td class="text-center">
                                 <div class="dropdown custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                       
                                                <a class="dropdown-item" href="material?edit=<?php echo $std->id?>">Edit</a>

                                            

                                                <a class="dropdown-item" href="?delete=<?php echo $std->id?>" onclick="return confirm('Are you Sure')">Delete</a>
                                       
                                    </div>
                                </div>
                            </td>
                        </tr>

                <div class="modal fade" id="videoMedia1" tabindex="-1" role="dialog" aria-labelledby="videoMedia1Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" id="videoMedia1Label">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="video-container">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<script type="text/javascript">
    $('.yt-video-link').each(function () {
            $(this).on('click', function(){
                var src = $(this).attr('data-link');
            $('#videoMedia1').modal('show');
            $('<iframe>').attr({
                'src': src,
                'width': '800',
                'height': '320',
                'allow': 'encrypted-media'
            }).css('border', '0').appendTo('#videoMedia1 .video-container');
            })
        });
</script>