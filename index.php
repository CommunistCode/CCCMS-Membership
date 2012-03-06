<?php 

	require_once("includes/memberGlobal.inc.php");
	require_once("includes/checkLogin.inc.php");

  $page->set("title","Members Area");
  $page->set("heading","Members Area");

	$allContent = $pageTools->getDynamicContent($pageTools->getPageIDbyDirectLink("membership/index.php"));
	$content = $pageTools->matchTags($allContent['text']);
  
  $page->addContent($content);
  $page->render("corePage.inc.php");

?>
