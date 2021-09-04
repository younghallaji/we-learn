<?php 
session_start();
$uid = $_SESSION['id'];
$role = $_SESSION['role'];
include 'includes/connection.php';
// $_POST['message'] = "h";
if (isset($_POST['course']) AND $_POST['course']!="") {
// $dc = "CUC-61174";
    $dc = $_POST['course'];
        
            $gchat = $connect2db->prepare("SELECT cr.message,cr.sender,u.matric,u.role FROM chatroom AS cr JOIN users AS u ON cr.sender = u.id WHERE class_code = ?");
            $gchat->execute([$dc]);
            while ($ac = $gchat->fetch()) {
                $by = ($ac->sender==$uid) ? "bubble me" : "bubble you" ;
                if ($role != 2) {?>
                    <div class="<?php echo $by?>">
                        <?php echo $ac->message;?>
                    </div>
               <?php 
                    }else{?>
                        <div class="<?php echo $by?>">
                            <?php echo $ac->message;?><br>
                            <small class="text-danger"><i><?php echo $ac->matric;?></i></small>
                        </div>
                 <?php 
                   }
                ?>
                
        <?php  
        
    }
}                              
?>
