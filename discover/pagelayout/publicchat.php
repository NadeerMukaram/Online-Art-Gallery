<style>

#chatbox {
    text-align:left;
    margin:0 auto;
    padding:10px;
    background:#fff;
    height:570px;
    max-width:100%;
	border-radius:6px;
    overflow:auto; 
	}

</style>


<div id="wrapper">
	<div id="menu">
    
	<div style="clear: both"></div>
	</div>
    <p class="welcome"><b>HI - <a><?php echo $_SESSION['username']; ?></a></b></p>
	<div id="chatbox">
	<?php
		if (file_exists ( "../../home/log.html" ) && filesize ( "../../home/log.html" ) > 0) {
		$handle = fopen ( "../../home/log.html", "r" );
		$contents = fread ( $handle, filesize ( "../../home/log.html" ) );
		fclose ( $handle );

		echo $contents;
		}
	?>
	</div>
	
	
  <link rel="stylesheet" type="text/css" href="../view/dist/emojionearea.min.css" media="screen">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript" src="../view/dist/emojionearea.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>

<form username="message" action="">
	<textarea username="usermsg" style="resize: none;" class="form-control mt-2 mb-2" type="text" id="usermsg" placeholder="Send a message!" /></textarea>
	<input username="submitmsg" class="btn btn-dark" type="submit" id="submitmsg" value="Send" />
</form>
</div>




<script type="text/javascript">


$("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("../../home/post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog;
    return false;
});
function loadLog(){    
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
    $.ajax({
        url: "../../home/log.html",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html);       
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal');
            }              
        },
    });
}
setInterval (loadLog, 2500);



</script>

