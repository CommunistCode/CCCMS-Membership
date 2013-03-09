<html>
	
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title><?php echo(SITE_NAME." : ".$_title); ?></title>
		
		<link href="../base/themes/<?php echo($_pageTools->getTheme("base")); ?>/stylesheets/cssReset.css" rel="stylesheet" />
		<link href="../base/themes/<?php echo($_pageTools->getTheme("base")); ?>/stylesheets/base.css" rel="stylesheet" />
		<link href="themes/<?php echo($_pageTools->getTheme("membership")); ?>/stylesheets/memberStyle.css" rel="stylesheet" />
	
	</head>
	
	<body>
		
		<div id="mainContainer">
		
			<div id="title">
		
				<?php 
					require_once(FULL_PATH."/base/themes/".$_pageTools->getTheme("base")."/templates/title.inc.php"); 
				?>
			
			</div>
			
			<div id='navBar'>
				
				<?php 
					require_once(FULL_PATH."/base/themes/".$_pageTools->getTheme("base")."/templates/links.inc.php"); 
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

					echo("<h1>".$_heading."</h1>");

					if (isset($_content)) {

						echo($_content);

					}

          if (isset($_include)) {

						include($_include);

					}

        ?>

				</div>
			</div>
		</div>	
		
		<div id="footer">
			
			<?php 
				require_once(FULL_PATH."/base/themes/".$_pageTools->getTheme("base")."/templates/footer.inc.php"); 
			?>
			
		</div>
	</body>
</html>



