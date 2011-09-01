<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?php echo($title." : ".$pageContent['title']); ?></title>
		<link href="../themes/default/stylesheets/base.css" rel="stylesheet" type="text/css" />
		<link href="stylesheet/memberStyle.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="mainContainer">
			<div id="title">
				<?php 
					require_once("../includes/title.inc.php"); 
				?>
			</div>
			<div id='navBar'>
				<?php 
					require_once("../includes/links.inc.php"); 
				?>
			</div>
			<div id='bodyContainer'>

				<div class="memberLinks">
					<?php
						require_once("includes/memberLinks.inc.php");
					?>
				</div>
			
				<div class="memberBody">
		
			  <?php

					echo("<h1>".$heading."</h1>");

					if (isset($content)) {

						echo($content);

					}

          if (isset($include)) {

						include($include);

					}

        ?>

				
				</div>

			</div>

			<div id="footer">
				<?php 
					require_once("../includes/footer.inc.php"); 
				?>
			</div>
		</div>
	</body>
</html>



