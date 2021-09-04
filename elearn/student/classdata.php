<?php 
session_start();
$uid = $_SESSION['id'];
include 'includes/connection.php';
// $_POST['message'] = "h";
if (isset($_POST['course']) AND $_POST['course']!="") {
// $dc = "CUC-61174";
    $dc = $_POST['course'];
        
            $gchat = $connect2db->prepare("SELECT * FROM chatroom WHERE class_code = ? ");
            $gchat->execute([$dc]);
            while ($ac = $gchat->fetch()) {
                $by = ($ac->sender==$uid) ? "bubble me" : "bubble you" ;?>
                <div class="<?php echo $by?>">
                    <?php echo $ac->message;?>
                </div>
        <?php  
        
    }
}                              
?>
