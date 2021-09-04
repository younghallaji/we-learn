<div class="modal fade bd-example-modal-sm<?php echo $row->id;?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel"><?php echo $row->title;?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    <span>Course Title:</span>
                    <?php echo $row->title;?>
                </p>

                <p class="modal-text">
                    <span>Course Code:</span>
                    <?php echo $row->code;?>
                </p>

                <p class="modal-text">
                    <span>Level:</span>
                    <?php echo $row->level;?>
                </p>

                <p class="modal-text">
                    <span>Created On:</span>
                    <?php echo $row->createdon;?>
                </p>

                <p class="modal-text">
                    <span>Created By:</span>
                    <?php $adm = $row->createdby;
                        $getadmin = $connect2db->prepare("SELECT fname,lname FROM users WHERE id = ?");
                        $getadmin->execute([$adm]);
                        $ad = $getadmin->fetch();
                        echo $ad->fname." ".$ad->lname;
                    ?>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        </div>
    </div>
</div>