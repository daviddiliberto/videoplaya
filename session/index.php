<?php 
session_start();
include "../define.php";
if(!isset($_SESSION["nick"]) || !isset($_SESSION["sno"])){
	$_SESSION["directURL"] =  $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	header("Location: ".$homepage); 
}
else{
$_SESSION["sid"] = $_SESSION["sno"];
unset($_SESSION["sno"]);
$sessionURL = "http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>BORED.TV</title>

	<link rel="icon" type="image/png" href="../res/favicon.png" >
	<link type="text/css" rel="stylesheet" href="../style/main.css" />
	<link href="../style/bootstrap.css" rel="stylesheet">
    <link href="../style/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/autocomplete.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script type="text/javascript">
		var playlistState = "ERROR_1";
		var canWebsocket = "true";
		var checkPlaylist;
		var sessionUsername = <?php print("\"".$_SESSION["nick"]."\""); ?>;
		var socket;
		var tag;
		var firstScriptTag;
	</script>

</head>
<body>

	<!-- Top navbar -->

    <!-- Sidebar -->

    	<div style="position:absolute;padding:20px;opacity:0.5;"><h1>BORED</h1></div>	
	<div id="bubble"></div>

	<div id="content">
		<div id="stuffs" class="jumbotron push_down">
			<!-- Overlay div -->
			<div id="searchStuff" style="display: none;">
				<div id="container">
					<div class="jumbotron debut_light">
						<div class="row-fluid">
							<div class="span7 offset1" ><input class="btn_padding full_width" type="text" placeholder="Search query or youtube URL here..." id="searchTerm" /></div>
							<div class="span3" ><button class="btn btn-inverse push_up_3px"id="searchThis" ><i class="icon-search icon-white"></i> Search</button></div>
							<div id="overlayClose" class="span1"> <i class="icon-remove-sign push_to_corner"></i> </p></div>
						</div>
						<hr>
						<div id="searchResultDiv">
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">				
				<!-- Video div -->
			  	<div class="span9" id="video">
					<div id="ytplayer">
					</div>
					<div class="soft_box"><h1 id="message">NOW PLAYING...<h1></div>
				
					<!-- Volume Controls -->
					
					<div id="controls" class="margin_1em row-fluid">
                        <div class="grey_text span2 offset3">
                            <h6>Current DJ </br><span id="currentDJ">&nbsp---&nbsp</span></h6>
                        </div>
                        <div class="grey_text span2">
                            <h6>Queue </br><span id="inQueue">0</span></h6>
                        </div>
						<button id="vol_down"  class="btn btn-inverse span1">&nbsp&nbsp-&nbsp&nbsp</button>
						<button id="vol_up"    class="btn btn-inverse span1">&nbsp&nbsp+&nbsp&nbsp</button>
					</div>
					
					<div id="builder"class="row-fluid">
						<button id="searchButton" class="btn btn-primary span4 offset2" onclick='searchThings();' disabled="disabled">Initalizing...</button>
						<button id="ifImTheDJ"    class="btn btn-inverse span4" onclick="skipThis();"     disabled="disabled">Skip this video</button>
					</div>
					<div>
					<!--...<br>
						Space for more stuffs<br>
						...<br>-->
                        <div>
                            <h6 class="grey_text">Room Address: <?php echo $sessionURL; ?>&nbsp&nbsp <button class="btn btn-mini" id="copy"> Copy </button></h6>
                        </div>
							
					</div>
			  	</div>
			  	<!-- Chat div -->
			  	<div class="span3" id="chat-box">
			  		<div class="row-fluid">
                        <div id="activePpl">
                            <h6>Online Now...</h6>
                            <ul id="activeUsers" class="no_bullets">
                            </ul>
                        </div>
						<div id="messageBoard">
							<form id="chatForm" name="chatForm" method="post" action="" onsubmit="return false;">
								<div id="board"><!-- Chat logs loaded here --></div>
							</form>
						</div>
					</div>
					<div>
						<textarea cols=2 class="thick_border" style="border-radius: 3px;" id="chatBox" placeholder="Write message here...." value="Connecting to chat server..." disabled="disabled" maxlength=140 /></textarea>
					</div>
				</div>
			</div> 
		</div>
	</div>

	<!-- Le javascript
	================================================== -->
	<script src="http://ec2-54-213-34-40.us-west-2.compute.amazonaws.com:8080/socket.io/socket.io.js"></script>
	<script type="text/javascript" src="ZeroClipboard.js"></script>
	<script type="text/javascript" src="../js/helper.js"></script>
	<script type="text/javascript" src="../js/ytplayerStuff.js"></script>
	<script type="text/javascript" src="../js/socket_io.js"></script>
	<script type="text/javascript" src="../js/overlay.js"></script>
	<script type="text/javascript" >
		var clip = new ZeroClipboard.Client();
		clip.setText('<?php echo $sessionURL; ?>');
		clip.glue('copy');
	</script>
			<script>
		    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		    ga('create', 'UA-42162448-1', 'sugaryasphalt.com');
		    ga('send', 'pageview');

	</script>

</body>
</html>

<?php
}
?>
