<?php

$xhe_host ="127.0.0.1:7012";
require("D:/seo/Human Emulator3/Templates/xweb_human_emulator.php");

$xml = simplexml_load_file('yml371.xml');
$cat = array();
$i=0;
foreach ($xml->shop->categories->category as $category) {
	$cat[$i][id] = $category['id'];
	if($category['parentId'] !=""){
		$cat[$i][parentId] = $category['parentId'];
	}
	else{
		$cat[$i][parentId] = "NO";
	}
	$cat[$i][name] = trim($category);
	echo $cat[$i][id]." - ".$cat[$i][parentId]." - ".$cat[$i][name]."<br>";
	$app->pause();
	$i++;
}

// Quit
$app->quit();
?>