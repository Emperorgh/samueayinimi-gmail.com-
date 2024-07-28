<?php 
include "config/config.php";
$con = Database::getConnection();

session_start();

if(!empty($_SESSION['recip'])){
 $userid = $_SESSION['recip'];
 $sql = $con->query("select * from contacttb where contact='$userid'");
 $row = $sql->fetch_array();

}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>SMS System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assetss/css/main.css" />
		<noscript><link rel="stylesheet" href="assetss/css/noscript.css" /></noscript>
		 <!-- Toastr -->
    	<link href="assets/css/lib/toastr/toastr.min.css" rel="stylesheet">
    	<!-- Sweet Alert -->
    	<link href="assets/css/lib/sweetalert/sweetalert.css" rel="stylesheet">
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-envelope"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>SMS System</h1>
								<h2 style="color: green;"><?php if(!empty($row['cname'])){ echo $row['cname']; } ?></h2>
								<p>Read your messages and reply here, locate them on the tabs below. Thank you</p>
							
							<?php if(empty($userid)){ ?><div class="col-lg-4" id="cont_form"></div><?php } ?>
							<div class="col-lg-2" id="verification">
								<input type="text" name="verify" id="verify" onkeyup="verifications()" class="form-control" placeholder="Your verification code" style="text-align: center;"/>
							</div>
							<h1 id="userid"><?php if(!empty($userid)){ echo $userid; } ?></h1>
							<input type="hidden" name="connum" id="connum">
							</div>
						</div>
						<?php 
							if(!empty($userid)){
						?>
						<nav>
							<ul>
								<li><a href="#intro">Reply</a></li>
								<li><a href="#work">Messages</a></li>
								<li><a href="#about">About</a></li>
								<li><a href="#contact" onclick="log_out()">Logout</a></li>
								<!--<li><a href="#elements">Elements</a></li>-->
							</ul>
						</nav>
					<?php } ?>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Intro -->
							<article id="intro">
								<h2 class="major">Reply New SMS</h2>
									
								<p>
									<div id="dis_messages"></div>
								</p>

								<p>
									<form id="messfields">
									<div class="field">
										<label for="message">Message</label>
										<input type="hidden" name="contact" id="contact" value="<?php if(!empty($userid)){ echo $userid; }  ?>">
										<textarea name="message" id="message" rows="4" placeholder="Type your message here"></textarea>
									</div>
									<ul class="actions">
										<li><input type="button" onclick="messfields()" value="Send Message" class="special" /></li>
										<li><input type="reset" value="Reset" /></li>
									</ul>
								</form>
								</p>
							</article>

							<article id="work">
								<h2 class="major">Messges</h2>
								 <?php 
								 	$nsqls = $con->query("select distinct message from singlesms where sender !='' and recipient='$userid'");
								 	while($nrows=$nsqls->fetch_array()){
								 		?>
								 			<p style="background: darkgreen; color: white; padding: 10px 10px;"><?php if(!empty($nrows['message'])){ echo $nrows['message']; } ?></p>
								 		<?php
								 	}
								 ?>
							</article>
						<!-- Contact -->
							


					</div>

				<!-- Footer -->
					<footer id="footer">
						<p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assetss/js/jquery.min.js"></script>
			<script src="assetss/js/skel.min.js"></script>
			<script src="assetss/js/util.js"></script>
			<script src="assetss/js/main.js"></script>
			<script src="pages/contform/contform.js"></script>
			
		<!-- Toastr -->
    <script src="assets/js/lib/toastr/toastr.min.js"></script>
    <script src="assets/js/lib/toastr/toastr.init.js"></script>
 <!-- Sweet Alert -->
    <script src="assets/js/lib/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/lib/sweetalert/sweetalert.init.js"></script>

	<script type="text/javascript">
		(function($){
			$("#verification").hide();
			$("#cont_form").load("pages/contform/contform.php");
		})(jQuery);
	</script>
	<script type="text/javascript">
		function messfields(){
			let messfields = $("#messfields").serialize();
			
			$.ajax({
				url: 'pages/singlesms/conn.php',
				type: 'POST',
				data: messfields,
				dataType: 'JSON',
				success: function(feedback){
					
				}
			})
		}
	</script>

	<script type="text/javascript">
		(function($){
			
			setInterval(function(){
				dis_messages();
			},1000);

		})(jQuery);

		function dis_messages(argument) {
			// body...
			$("#dis_messages").load("pages/singlesms/dismessage.php");
		}
	</script>


	<script type="text/javascript">
		
		function log_out(){
			$.ajax({
				url: 'pages/contform/connect.php?question=logout',
				type: 'POST',
				data: {},
				success: function(){
					window.location="replysms.php";
				}
			})
		}
	</script>

	</body>
</html>
