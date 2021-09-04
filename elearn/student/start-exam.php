<?php 
	if (isset($_GET['course'])) {
		include'includes/quiz-header.php';
		$courseid = $_GET['course'];
		$getData = $connect2db->prepare("SELECT * FROM course WHERE id = ?");
		$getData->execute([$courseid]);
		if ($getData->rowcount() > 0) {
			$data = $getData->fetch();
			$coursename = $data->title;
			$_SESSION['time']="";
			if ($_SESSION['min']=="") {
				$_SESSION['min'] = "5";
				$_SESSION['sec'] = "0";
			}
		}else{
			$e="Invalid Course ID"; 
        	echo  " <script>alert('$e'); window.location='logout'</script> ";
		}

		if (isset($_POST['finish'])) {
			$_SESSION['min']="";
			$_SESSION['sec']="";
			$uid = $_SESSION['id'];
		$question = $_POST['questionid'];
		$courseid = $_POST['courseid'];
		$answer = $_POST['answer'];


		$validateAnswer = $connect2db->prepare("SELECT answer FROM answers WHERE qid = ? AND options = ?");
		$validateAnswer->execute([$question, $answer]);
		$option = $validateAnswer->fetch();
		$output = $option->answer;
		// echo $output;

		$submitAnswer = $connect2db->prepare("SELECT * FROM results WHERE questionid = ? AND courseid = ? AND studentid = ?");
		$submitAnswer->execute([$question, $courseid, $uid]);
		if ($submitAnswer->rowcount() > 0) {
			$updResult = $connect2db->prepare("UPDATE results SET result = ?, answer = ? WHERE questionid = ? AND courseid = ? AND studentid = ?");
			$updResult->execute([$output, $answer, $question, $courseid, $uid]);
		} else {
			// Insert
			$insertResult = $connect2db->prepare("INSERT INTO results (questionid, courseid, studentid, result, answer) VALUES (?,?,?,?,?)");
			$insertResult->execute([$question,$courseid, $uid,$output,$answer]);
		}
			echo  " <script>window.location='take-exam'</script> ";

		}

		

		if (isset($_POST['time'])) {
			$time = explode(":", $_POST['time']);
			$min = $time[0];
			$sec = $time[1];

			$_SESSION['min'] = $min;
			$_SESSION['sec'] = $sec;
			// echo $time;
		}


?>

<div id="content" class="main-content">
	<div class="layout-px-spacing">

		<div class="row layout-top-spacing">
    <div id="flFormsGrid" class="col-md-9 col-sm-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class=" col-md-8 col-sm-12 col-12">
                        <h2><?php echo $coursename?></h2>
                    </div>
                     <div class=" col-md-4 col-sm-12 col-12">
                        <h2 class="text-danger text-right" id="timerText"><?php //echo $_SESSION['time']?></h2>
                    </div>                                                                        
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <?php
                	if (isset($_GET['pageno'])) {
			            $pageno = $_GET['pageno'];
			        } else {
			            $pageno = 1;
			        }
			        $no_of_records_per_page = 1;
					$offset = ($pageno-1) * $no_of_records_per_page;

					$totalPage = $connect2db->prepare("SELECT COUNT(*) AS id FROM question WHERE coursecode =? ");
					$totalPage->execute([$courseid]);
					$ftp = $totalPage->fetch();
					$total_rows = $ftp->id;
					$total_pages = ceil($total_rows / $no_of_records_per_page);

					$question = $connect2db->prepare("SELECT * FROM question WHERE coursecode = ? LIMIT $offset, $no_of_records_per_page");
					$question->execute([$courseid]);
					while ($ques = $question->fetch()) {
						$quesid = $ques->id;
						?>
						<p>Q<?php echo $pageno;?></p>
						<h3><?php echo $ques->question ?></h3>
						<form class="pb-4">
							<div>
                        		
							<?php 
								$getOption = $connect2db->prepare("SELECT * FROM answers WHERE qid = ?");
								$getOption->execute([$quesid]);
								while ($opt = $getOption->fetch()) {
									$getExtRst = $connect2db->prepare("SELECT answer FROM results WHERE questionid = ? AND courseid = ? AND studentid = ?");
									$getExtRst->execute([$quesid,$courseid,$uid]);
									$extRst = $getExtRst->fetch();
									$rst = $extRst->answer;
									$checked = ($opt->options==$rst) ? "checked" : "" ;
									?>
									<div class="custom-control custom-radio">
									<input type="radio" id="<?php echo $opt->id?>" name="answer" <?php echo $checked?> class="custom-control-input" value="<?php echo $opt->options?>" ><label class="custom-control-label" for="<?php echo $opt->id?>"><?php echo $opt->options?></label>
								</div>
                        					
                        				
							<?php
								}
							?>
							</div>
						</form>
					<?php
					}

					$getdone = $connect2db->prepare("SELECT questionid FROM results WHERE questionid = ?");
					$getdone->execute([$quesid]);
					if ($getdone->rowcount()>0) {
						$estatus = "bg-success";
					}
                ?>

                <div class="paginating-container pagination-default pt-4">

                <ul class="pagination">
                    <li><a href="?course=<?php echo $courseid?>&pageno=1" class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>
                    <?php
                    	for ($i=1; $i < $total_rows+1; $i++) { 
                    		$active = ($i == $pageno) ? "active" : "" ;
                    		?>
                    		<li class="<?php echo $active?>">
                    			<a class=" submit" href="?course=<?php echo $courseid?>&pageno=<?php echo $i?>"><?php echo $i;?></a>
                    		</li>
                    <?php	
                		}
                    ?>
                    
                    
                    <li><a href="?course=<?php echo $courseid?>&pageno=<?php echo $pageno+1?>" class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>
                </ul>

                <form method="POST">
                	<input type="submit" value="Submit" class="form-control btn btn-success" name="finish" id="Finish" onclick="return confirm('Are you Sure?')">

                	
                </form>

            </div>
                	<a id="timeupSubmit" class="btn"> </a>
            </div>
        </div>
    </div>
    <div id="flFormsGrid" class="col-md-3 col-sm-12 layout-spacing card">
    	 <h3>Upload Multiple question with csv file</h3>
    	<div class="form-group">
    		<input type="file" name="csv_file" class="form-control">
    	</div> 
    </div>
</div>
<?php include'includes/footer.php';?>
<?php	
	}else{
		$e="Error Occured"; 
    	echo  " <script>alert('$e'); window.location='logout'</script> ";
	}
?>

<script type="text/javascript">
$(document).ready(function(){

	function cur_time(){
			var time = $('#timerText').html();
			$.ajax({
				method:'POST',
				data:{time:time},
			});
		}
	// Timer Starts

$('#timeupSubmit').on('click', function(){
	var questionid = <?php echo $quesid?>;
	var courseid = <?php echo $courseid?>;
	$.ajax({
		method:'POST',
		data:{finishid:questionid, courseid:courseid},
		url:'submit.php',
		success:function(response){
			window.location="take-exam";
		}

	});

	// alert(questionid +" "+courseid)
});

		// Config
var mins = <?php echo $_SESSION['min']?>; // Min test time
var secs = <?php echo $_SESSION['sec']?>; // Seconds (In addition to min) test time
var timerDisplay = $('#timerText');

//Globals: 
var timeExpired = false;

// Test time in seconds
var totalTime = secs + (mins * 60);

// This sourced from: http://stackoverflow.com/questions/532553/javascript-countdown
var countDown = function (callback) {
    var interval;
    interval = setInterval(function () {
        if (secs === 0) {
            if (mins === 0) {
                timerDisplay.text('0:00');
                clearInterval(interval);
                callback();
                return;
            } else {
                mins--;
                secs = 60;
            }
        }
        var minute_text;
        if (mins > 0) {
            minute_text = mins;
        } else {
            minute_text = '0';
        }
        var second_text = secs < 10 ? ('0' + secs) : secs;

        timerDisplay.text(minute_text + ':' + second_text);
        secs--;
    }, 1000, timeUp);
};

var timeUp = function () {
        alert("Time's Up!");
        timeExpired = true;
        $('#timeupSubmit').trigger('click');
    };

    countDown(timeUp);

	// Timert Ends

	$(".submit").each(function(){
		$(this).click(()=>{
			var questionid = <?php echo $quesid?>;
			var courseid = <?php echo $courseid?>;
			var answer = $("input[type='radio'][name='answer']:checked").val();
			$.ajax({
				method:'POST',
				data:{questionid:questionid, courseid:courseid, answer:answer},
				url:'submit.php',
				success:function(response){
					// console.log(response);
					// alert(response);
				}

			});
			// alert(questionid +" "+courseid+" "+answer+" "+time)
		});
		
	});

	$('.sidebarCollapse').trigger('click');
	setInterval(cur_time, 1000);

});
</script>