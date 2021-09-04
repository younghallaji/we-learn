<?php include 'includes/header.php'?>

<div id="content" class="main-content">
            <div class="layout-px-spacing">
 <div class="chat-section layout-top-spacing">
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="chat-system">
                <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                <div class="user-list-box">
                    <div class="search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="form-control" placeholder="Search" />
                    </div>
                    <div class="people">
                    	<?php
                        $getCourse = $connect2db->prepare("SELECT cr.course,c.title,c.code,c.dept,d.name,c.level,cr.class_code,cr.classtitle FROM classroom AS cr JOIN course AS c on cr.course = c.id JOIN department AS d ON c.dept = d.id WHERE cr.instructor = ? ");
                        $getCourse->execute([$uid]);
                        if ($getCourse->rowcount() < 1) {?>
                            <h5>No Classroom Created</h5>
                       <?php } else {
                            while ($row = $getCourse->fetch()) {?>

                        <div class="person" data-chat="<?php echo $row->class_code;?>">
                            <div class="user-info">
                                <div class="f-head">
                                    <img src="../assets/img/90x90.jpg" alt="avatar">
                                </div>
                                <div class="f-body">
                                    <div class="meta-info">
                                        <span class="user-name" data-name="Nia Hillyer"><?php echo $row->classtitle;?></span>
                                        <!-- <span class="user-meta-time"><?php// echo $row->class_code;?></span> -->
                                    </div>
                                    <span class="preview"><?php echo $row->title;?></span>
                                    <span class="preview" id="course_code"><?php echo $row->code;?></span>
                                </div>
                            </div>
                        </div>

                        

                     <?php  }
                        }
                        
                    ?> 

                   </div>    
                </div>
                <div class="chat-box">

                    <div class="chat-not-selected">
                        <p> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg> Select A Class To start</p>
                    </div>


                    <div class="chat-box-inner">
                        <div class="chat-meta-user">
                            <div class="current-chat-user-name"><span><img src="../assets/img/90x90.jpg" alt="dynamic-image"><span class="name"></span></span></div>

                            
                        </div>
                        <div class="chat-conversation-box" style="display:flex;flex-direction:column-reverse;">
                            <div id="chat-conversation-box-scroll" class="p-3 chat-conversation-box-scroll">
                            	<?php
                            	$chat = $connect2db->prepare("SELECT DISTINCT class_code from chatroom");
        $chat->execute();
        while ($cc = $chat->fetch()) {
            $dc = $cc->class_code;
            ?>
        
    <div class="chat" data-chat="<?php echo $dc;?>">
        <div class="conversation-start">
            <span>Today, 6:48 AM</span>
        </div>

                                
                            </div>
                            <?php
    }?>
                        </div></div>
                        <div class="chat-footer">
                            <div class="chat-input">
                                <form class="chat-form" action="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <input type="text" class="mail-write-box form-control" placeholder="Message"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include 'includes/footer.php'?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.search > input').on('keyup', function() {
  var rex = new RegExp($(this).val(), 'i');
    $('.people .person').hide();
    $('.people .person').filter(function() {
        return rex.test($(this).text());
    }).show();
});

$('.user-list-box .person').on('click', function(event) {
    if ($(this).hasClass('.active')) {
        return false;
    } else {
        var findChat = $(this).attr('data-chat');
        $('#course_code').val(findChat);
        var personName = $(this).find('.user-name').text();
        var personImage = $(this).find('img').attr('src');
        var hideTheNonSelectedContent = $(this).parents('.chat-system').find('.chat-box .chat-not-selected').hide();
        var showChatInnerContent = $(this).parents('.chat-system').find('.chat-box .chat-box-inner').show();

        if (window.innerWidth <= 767) {
          $('.chat-box .current-chat-user-name .name').html(personName.split(' ')[0]);
        } else if (window.innerWidth > 767) {
          $('.chat-box .current-chat-user-name .name').html(personName);
        }
        $('.chat-box .current-chat-user-name img').attr('src', personImage);
        $('.chat').removeClass('active-chat');
        $('.user-list-box .person').removeClass('active');
        $('.chat-box .chat-box-inner').css('height', '100%');
        $(this).addClass('active');
        $('.chat[data-chat = '+findChat+']').addClass('active-chat');
    }
    if ($(this).parents('.user-list-box').hasClass('user-list-box-show')) {
      $(this).parents('.user-list-box').removeClass('user-list-box-show');
    }
    $('.chat-meta-user').addClass('chat-active');
    $('.chat-box').css('height', 'calc(100vh - 233px)');
    $('.chat-footer').addClass('chat-active');

  const ps = new PerfectScrollbar('.chat-conversation-box', {
    suppressScrollX : true
  });

  const getScrollContainer = document.querySelector('.chat-conversation-box');
  getScrollContainer.scrollTop = 0;
});

const ps = new PerfectScrollbar('.people', {
  suppressScrollX : true
});


	function getChat(){
	var course_code = $('#course_code').val();
      if (course_code != "") {
      	$.ajax({
        method:'POST',
        data:{message:'Young Hallaji', course:course_code},
        url:'classdata.php',
        catch:false,
        success:function(data){
            $('#chat-conversation-box-scroll').html(data);
            // alert(data)
        }
        });
      }
    // alert(course_code)
    }

$('.mail-write-box').on('keydown', function(event) {
    if(event.key === 'Enter') {
        var chatInput = $(this);
        var course_code = $('#course_code').val();
        var chatMessageValue = chatInput.val();
        if (chatMessageValue === '') { return; }
        else{
          $.ajax({
            method:'POST',
            data: {message:chatMessageValue, course_code:course_code,},
            url: '../assets/js/apps/chat.php',
            success:function(){
              // getChat();
            }
          });

          $messageHtml = '<div class="bubble me">' + chatMessageValue + '</div>';
            var appendMessage = $(this).parents('.chat-system').find('.active-chat').append($messageHtml);
            const getScrollContainer = document.querySelector('.chat-conversation-box');
            getScrollContainer.scrollTop = getScrollContainer.scrollHeight;
            var clearChatInput = chatInput.val('');
        }
        
    }
});

// getChat()

		setInterval(getChat, 1000)
	})
</script>