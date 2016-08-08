<?
/* include block */
include 'transurl.php';
/* include block */

$htmlpath = 'http://'.$_SERVER['HTTP_HOST']."/";
$cur_url = $_SERVER['REQUEST_URI'];

$filecat = file("catlist.txt");
$catalog = array();
for ($i=0; $i < count($filecat); $i++) { 
	$cur_profile = trim($filecat[$i]);
	preg_match_all('#\|(.*)\|(.*)\|(.*)\|#Uis', $cur_profile,$profile_info);
	for($i2=0;$i2<count($profile_info[1]);$i2++){
		$catalog[$i][num] = trim($profile_info[1][$i2]); 
		$catalog[$i][par] = trim($profile_info[2][$i2]); 
		$catalog[$i][name] = trim($profile_info[3][$i2]); 
	} 
}


if(isset($_GET['catname'])){
    $catname = trim($_GET['catname']);
}
if(isset($_GET['limit'])){
    $limit = (int)trim($_GET['limit']);
}
else{
	$limit = 12;	
}
if(isset($_GET['page'])){
    $page = (int)trim($_GET['page']);
}
else{
	$page = 1;	
}
if(isset($_GET['order'])){
    $order = trim($_GET['order']);
}
else{
	$order = "def";
}
$cur_cat_par = "";
$cur_cat_name = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($catname == str_replace("--","-",TransUrl(trim($catalog[$i][name])))) {
		$cur_cat_name = trim($catalog[$i][name]);
		$cur_cat_num = trim($catalog[$i][num]);

		if ($catalog[$i][par] !="NO") {
			$cur_cat_par = $catalog[$i][par];
		}
		break;
	}
}
$cur_cat_par_name = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par == $catalog[$i][num]) {
		$cur_cat_par_name = $catalog[$i][name];
	}
}
$cur_cat_par2 = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par == $catalog[$i][num]) {
		if ($catalog[$i][par] !="NO") {
			$cur_cat_par2 = $catalog[$i][par];
		}
	}
}
$cur_cat_par_name2 = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par2 == $catalog[$i][num]) {
		$cur_cat_par_name2 = $catalog[$i][name];
	}
}
$cur_cat_par3 = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par2 == $catalog[$i][num]) {
		if ($catalog[$i][par] !="NO") {
			$cur_cat_par3 = $catalog[$i][par];
		}
	}
}
$cur_cat_par_name3 = "";
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par3 == $catalog[$i][num]) {
		$cur_cat_par_name3 = $catalog[$i][name];
	}
}
/*Load curent products*/
$path_cat = "xmltovar/".$cur_cat_num.".xml";
if (file_exists($path_cat)) {
$reader = new XMLReader();
$reader->open($path_cat);
$item = array();
$tovar = array();
$n=0;//
while ($reader->read()) {
    switch ($reader->nodeType) {
        case (XMLReader::ELEMENT):
	        if ($reader->localName == 'offer') {
				//if($reader->getAttribute('available') == "true"){
			        $item = array();
            	    while ($reader->read()){
                	    if ($reader->nodeType == XMLReader::ELEMENT) {
                    	    $name = strtolower($reader->localName);
								
                        	while ($reader->moveToNextAttribute()){

                            	$item[$name]['__attribs'][$reader->localName] = $reader->value;
                        	}
                        	$reader->read();
                        	if (isset($item[$name]) && is_array($item[$name])){
                            	$item[$name]['value'] = $reader->value;
                        	}else
                            	$item[$name] = $reader->value;
 
                    	}
                    	if ($reader->nodeType == XMLReader::END_ELEMENT && $reader->localName == 'offer')
                        	break;
                	}
                	$tovar[$n] = array();
					$tovar[$n] = $item; 
					
					$n++;
					
					
							
				//}
					
            }
    }
} 
}
/*Load curent products*/
if ($order == "min") {
	usort($tovar, "cmp");


}
if ($order == "max") {
	usort($tovar, "cmp2");


}
function cmp($a, $b)
{
   return ($a['price'] <= $b['price']) ? -1 : 1;
}
function cmp2($a, $b)
{
   return ($a['price'] > $b['price']) ? -1 : 1;
}
?>
<!DOCTYPE html>
<!--[if IE]>
<![endif]-->
<!--[if IE 8 ]>
<html dir="ltr" lang="en" class="ie8">
	<![endif]-->
	<!--[if IE 9 ]>
	<html dir="ltr" lang="en" class="ie9">
		<![endif]-->
		<!--[if (gt IE 9)|!(IE)]>
		<!-->
		<html dir="ltr" class="ltr" lang="en">
			<!--<![endif]-->
<head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><? echo $cur_cat_name;?></title>
			<meta name="description" content="<? echo $cur_cat_name;?>." />
			<meta name="keywords" content= "<? echo $cur_cat_name;?>" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="shortcut icon" href="<? echo $htmlpath;?>image/favicon.png" type="image/x-icon">
			<link href="<? echo $htmlpath.$catname;?>/" rel="canonical" />
			<link href="<? echo "$htmlpath"; ?>css/bootstrap.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/green.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/paneltool.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/colorpicker.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/font-awesome.min.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/magnific-popup.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/pavproductcarousel.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/typo.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/pavtestimonial.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/pavblog.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/pavnewsletter.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/shop.css" rel="stylesheet" />
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/jquery-2.1.1.min.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/bootstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/common.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/common/common.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/colorpicker/js/colorpicker.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/layerslider/raphael-min.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/layerslider/jquery.easing.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/layerslider/iview.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body class="product-category-20 page-category layout-fullwidth">

			<div  class="row-offcanvas row-offcanvas-left">

				<div id="page">

					<!-- header -->
					<div id="header">
						<div id="topbar" class="">
							<div class="container">
								<div class="topbar"></div>
							</div>
						</div>
						<div id="header-main">
							<div class="container">
								<div class="header-wrap">
									<div class="pull-left wrap-logo">
										<div  id="logo-theme" class="logo-store">
											<a href="<? echo $htmlpath; ?>">
												<span>Интим интернет магазин</span>
											</a>
										</div>
									</div>
									<div class="pull-left wrap-menu">
										<section id="pav-mainnav">
											<div class="navbar-inverse">
												<div class="pav-megamenu hidden-sm hidden-xs">
													<div class="navbar navbar-default">
														<div id="mainmenutop" class="megamenu" role="navigation">
															<div class="navbar-header">
																<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
																	<span class="icon-bar"></span>
																	<span class="icon-bar"></span>
																	<span class="icon-bar"></span>
																</a>
																<div class="collapse navbar-collapse navbar-ex1-collapse">
																	<ul class="nav navbar-nav megamenu">
																		
																		<li class="parent dropdown  aligned-left" >
																			<a class="dropdown-toggle" data-toggle="dropdown" href="">
																				<span class="menu-title shop-head-menu">Эротическое белье и одежда</span> <b class="caret"></b>
																			</a>
																			<div class="dropdown-menu level1"  style="width:730px" >
																				<div class="dropdown-menu-inner">
																					<!--<div class="row">-->
																						<?
																						for ($i=0; $i < count($catalog); $i++) { 
																							if ($catalog[$i][par] == "570") {
																								if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
																						?>
																						<div class="mega-col col-xs-12 col-sm-12 col-md-4"  >
																							<div class="mega-col-inner">
																								<div class="pavo-widget" id="pavowid-10">
																									<div class="pavo-widget" id="pavowid-906185432">
																										<div class="widget-html box   ">
																											<h3 class="widget-heading menu-title">
																												<!-- <? echo $catalog[$i][num] ;?>  -->
																												<a href="<? echo $htmlpath;?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/"><span class="menu-title"><? echo trim($catalog[$i][name]);?></span></a>
																											</h3>
																											<div class="widget-inner box-content clearfix">
																												<ul class="list">
																						<?
																						for ($i2=0; $i2 < count($catalog); $i2++) { 
																							if (trim($catalog[$i2][par]) == trim($catalog[$i][num])) {
																								if(file_exists("xmltovar/".trim($catalog[$i2][num]).".xml")){
																						?>


																													<li class="first">
																														<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i2][name]))); ?>/"><? echo $catalog[$i2][name];?></a>
																													</li>
																						<?

																								}
																							}
																						}
																						?>
																													
																												</ul>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<?
																								}
																							}
																						}
																						?>
																					
																						
																						
																						
																					<!--</div>-->
																				</div>
																			</div>
																		</li>
																		<li class="parent dropdown  aligned-left" >
																			<a class="dropdown-toggle" data-toggle="dropdown" href="">
																				<span class="menu-title shop-head-menu">Секс игрушки</span> <b class="caret"></b>
																			</a>
																			<div class="dropdown-menu level1"  style="width:730px" >
																				<div class="dropdown-menu-inner">
																					<!--<div class="row">-->
																						<?
																						for ($i=0; $i < count($catalog); $i++) { 
																							if ($catalog[$i][par] == "571") {
																								if(trim($catalog[$i][num]) != "539"){
																									if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
																						?>
																						<div class="mega-col col-xs-12 col-sm-12 col-md-4"  >
																							<div class="mega-col-inner">
																								<div class="pavo-widget" id="pavowid-10">
																									<div class="pavo-widget" id="pavowid-906185432">
																										<div class="widget-html box   ">
																											<h3 class="widget-heading menu-title">
																												<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/"><span class="menu-title"><? echo trim($catalog[$i][name]);?></span></a>
																											</h3>
																											<div class="widget-inner box-content clearfix">
																												<ul class="list">
																						<?
																						for ($i2=0; $i2 < count($catalog); $i2++) { 
																							if (trim($catalog[$i2][par]) == trim($catalog[$i][num])) {
																								if(file_exists("xmltovar/".trim($catalog[$i2][num]).".xml")){
																						?>


																													<li class="first">
																														<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i2][name]))); ?>/"><? echo $catalog[$i2][name];?></a>
																													</li>
																						<?
																								}
																							}
																						}
																						?>
																													
																												</ul>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<?
																									}
																								}
																								else{
																						?>
																						<div class="mega-col col-xs-12 col-sm-12 col-md-4"  >
																							<div class="mega-col-inner">
																								<div class="pavo-widget" id="pavowid-10">
																									<div class="pavo-widget" id="pavowid-906185432">
																										<div class="widget-html box   ">
																											<h3 class="widget-heading menu-title">
																												<span class="menu-title"><? echo trim($catalog[$i][name]);?></span>
																											</h3>
																											<div class="widget-inner box-content clearfix">
																												<ul class="list">
																						<?
																						for ($i2=0; $i2 < count($catalog); $i2++) { 
																							if (trim($catalog[$i2][par]) == trim($catalog[$i][num])) {
																								if(file_exists("xmltovar/".trim($catalog[$i2][num]).".xml")){
																						?>


																													<li class="first">
																														<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i2][name]))); ?>/"><? echo $catalog[$i2][name];?></a>
																													</li>
																						<?
																								}
																							}
																						}
																						?>
																													
																												</ul>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<?
																								}
																							}
																						}
																						?>
																					
																						
																						
																						
																					<!--</div>-->
																				</div>
																			</div>
																		</li>
																		<li class="parent dropdown  aligned-left" >
																			<a class="dropdown-toggle" data-toggle="dropdown" href="">
																				<span class="menu-title shop-head-menu">Смазки и все для секса</span> <b class="caret"></b>
																			</a>
																			<div class="dropdown-menu level1"  style="width:730px" >
																				<div class="dropdown-menu-inner">
																					<!--<div class="row">-->
																						<?
																						for ($i=0; $i < count($catalog); $i++) { 
																							if ($catalog[$i][par] == "569") {
																								if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
																						?>
																						<div class="mega-col col-xs-12 col-sm-12 col-md-4"  >
																							<div class="mega-col-inner">
																								<div class="pavo-widget" id="pavowid-10">
																									<div class="pavo-widget" id="pavowid-906185432">
																										<div class="widget-html box   ">
																											<h3 class="widget-heading menu-title">
																												<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/"><span class="menu-title"><? echo trim($catalog[$i][name]);?></span></a>
																											</h3>
																											<div class="widget-inner box-content clearfix">
																												<ul class="list">
																						<?
																						for ($i2=0; $i2 < count($catalog); $i2++) { 
																							if (trim($catalog[$i2][par]) == trim($catalog[$i][num])) {
																								if(file_exists("xmltovar/".trim($catalog[$i2][num]).".xml")){
																						?>


																													<li class="first">
																														<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i2][name]))); ?>/"><? echo $catalog[$i2][name];?></a>
																													</li>
																						<?
																								}
																							}
																						}
																						?>
																													
																												</ul>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<?
																								}
																							}
																						}
																						?>
																					
																						
																						
																						
																					<!--</div>-->
																				</div>
																			</div>
																		</li>

																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
									<button data-toggle="offcanvas" class="btn button dropdown-toggle hidden-lg hidden-md pull-left" type="button">
										<span class="fa fa-bars"></span>
										Меню
									</button>
									<div class="mini-access visible-xs pull-right">
										<ul>

											<li>
												<a href="" title="Корзина" class="mini_cart">
													<span class="fa fa-shopping-cart"></span>
												</a>
											</li>

										</ul>
									</div>
									<div class="header-right pull-right wrap-cart hidden-xs ">
										<div class="cart-top pull-right">
											<div id="cart">
												<span class="icon fa fa-shopping-cart"></span>
												<div data-toggle="dropdown" data-loading-text="Loading..." class="media-body heading dropdown-toggle">
													<h4>Корзина</h4>
													<a>
														<span id="cart-total">0 товар(ов) - 0.00 руб.</span>
													</a>
												</div>
												<ul class="dropdown-menu">
													<li>
														<p class="empty">Ваша корзина пуста!</p>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!--</div>-->

				<!-- /header -->
				<!-- sys-notification -->
				<div id="sys-notification">
					<div class="container">
						<div id="notification"></div>
					</div>
				</div>
				<!-- /sys-notification -->

				<div class="container">
					<div class="wrap-container">

						<div class="row">
							<div id="breadcrumb">
								<ul class="breadcrumb container">
									<li>
										<a href="<? echo $htmlpath;?>">
											<span>
												<i class="fa fa-home"></i>
											</span>
										</a>
									</li>
									<?
if ($cur_cat_par_name3 != "") {
	?>
									<li>
										
											<span><? echo $cur_cat_par_name3; ?></span>
										
									</li>
	<?
	
}
									?>
									<?
if ($cur_cat_par_name2 != "") {
	?>
									<li>
										
											<span><? echo $cur_cat_par_name2; ?></span>
										
									</li>
	<?
	
}
									?>
									<?
if ($cur_cat_par_name != "") {
	?>
									<li>
										
											<span><? echo $cur_cat_par_name; ?></span>
										
									</li>
	<?
	
}
									?>
									<?
if ($cur_cat_name != "") {
	?>
									<li>
										<span><? echo $cur_cat_name; ?></span>
										
									</li>
	<?
	
}
									?>
	
								</ul>
							</div>
							<section id="sidebar-main" class="col-md-9">

								<div id="content">
									<h1 class="heading_title">
										<span><? echo $cur_cat_name; ?></span>
									</h1>
								
<?
if (count($tovar) !=0) {
?>


									<div class="product-filter clearfix">
										<div class="display">
											<span>Вид</span>
											<button type="button" id="list-view" class="btn-switch list fa fa-th-list" data-toggle="tooltip" title="Список"></button>
											<button type="button" id="grid-view" class="btn-switch grid fa fa-th" data-toggle="tooltip" title="Сетка"></button>
										</div>

									
										<div class="limit">
											<span>Показывать по:</span>
											<select id="input-limit" class="" onchange="location = this.value;">
<?

if ($page == 1 && $order == "def") {
?>
												<option value="<? echo $htmlpath.$catname;?>/?limit=12" <?if ($limit == 12) {?>selected="selected"<?}?>>12</option>
<?
}
if($page != 1 && $order =="def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?page=<? echo $page;?>&amp;limit=12" <?if ($limit == 12) {?>selected="selected"<?}?>>12</option>
<?
}
if($page == 1 && $order !="def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;limit=12" <?if ($limit == 12) {?>selected="selected"<?}?>>12</option>
<?
}
if($page != 1 && $order !="def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;page=<? echo $page;?>&amp;limit=12" <?if ($limit == 12) {?>selected="selected"<?}?>>12</option>
<?
}
if ($page == 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?limit=24" <?if ($limit == 24) {?>selected="selected"<?}?>>24</option>
<?
}
if ($page != 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?page=<? echo $page;?>&amp;limit=24" <?if ($limit == 24) {?>selected="selected"<?}?>>24</option>
<?
}
if ($page == 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;limit=24" <?if ($limit == 24) {?>selected="selected"<?}?>>24</option>
<?
}
if ($page != 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;page=<? echo $page;?>&amp;limit=24" <?if ($limit == 24) {?>selected="selected"<?}?>>24</option>
<?
}
if ($page == 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?limit=48" <?if ($limit == 48) {?>selected="selected"<?}?>>48</option>
<?
}
if ($page != 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?page=<? echo $page;?>&amp;limit=48" <?if ($limit == 48) {?>selected="selected"<?}?>>48</option>
<?
}
if ($page == 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;limit=48" <?if ($limit == 48) {?>selected="selected"<?}?>>48</option>
<?
}
if ($page != 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;page=<? echo $page;?>&amp;limit=48" <?if ($limit == 48) {?>selected="selected"<?}?>>48</option>
<?
}																													
if ($page == 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?limit=72" <?if ($limit == 72) {?>selected="selected"<?}?>>72</option>
<?
}
if ($page != 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?page=<? echo $page;?>&amp;limit=72" <?if ($limit == 72) {?>selected="selected"<?}?>>72</option>
<?
}
if ($page == 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;limit=72" <?if ($limit == 72) {?>selected="selected"<?}?>>72</option>
<?
}
if ($page != 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;page=<? echo $page;?>&amp;limit=72" <?if ($limit == 72) {?>selected="selected"<?}?>>72</option>
<?
}
if ($page == 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?limit=96" <?if ($limit == 96) {?>selected="selected"<?}?>>96</option>
<?
}
if ($page != 1 && $order == "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?page=<? echo $page;?>&amp;limit=96" <?if ($limit == 96) {?>selected="selected"<?}?>>96</option>
<?
}
if ($page == 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;limit=96" <?if ($limit == 96) {?>selected="selected"<?}?>>96</option>
<?
}
if ($page != 1 && $order != "def"){
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=<? echo $order;?>&amp;page=<? echo $page;?>&amp;limit=96" <?if ($limit == 96) {?>selected="selected"<?}?>>96</option>
<?
}
?>																						
												
											</select>
										</div>

										<div class="sort">
											<span>Отсортировать:</span>
											<select id="input-sort" class="" onchange="location = this.value;">
<?
if ($page == 1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=def" <? if($order == "def"){?>selected="selected"<?}?>>Дефолт</option>
<?
}
if ($page !=1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=def&amp;page=<? echo $page;?>" <? if($order == "def"){?>selected="selected"<?}?>>Дефолт</option>
<?
}
if ($page ==1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=def&amp;limit=<? echo $limit;?>" <? if($order == "def"){?>selected="selected"<?}?>>Дефолт</option>
<?
}
if ($page !=1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=def&amp;limit=<? echo $limit;?>&amp;page=<? echo $page;?>" <? if($order == "def"){?>selected="selected"<?}?>>Дефолт</option>
<?
}
if ($page == 1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=min" <? if($order == "min"){?>selected="selected"<?}?>>Цена (Низкая &gt; Высокая)</option>
<?
}
if ($page !=1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=min&amp;page=<? echo $page;?>" <? if($order == "min"){?>selected="selected"<?}?>>Цена (Низкая &gt; Высокая)</option>
<?	
}
if ($page ==1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=min&amp;limit=<? echo $limit;?>" <? if($order == "min"){?>selected="selected"<?}?>>Цена (Низкая &gt; Высокая)</option>
<?
}
if ($page !=1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=min&amp;limit=<? echo $limit;?>&amp;page=<? echo $page;?>" <? if($order == "min"){?>selected="selected"<?}?>>Цена (Низкая &gt; Высокая)</option>
<?
}
if ($page == 1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=max" <? if($order == "max"){?>selected="selected"<?}?>>Цена (Высокая &gt; Низкая)</option>
<?
}
if ($page !=1 && $limit == 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=max&amp;page=<? echo $page;?>" <? if($order == "max"){?>selected="selected"<?}?>>Цена (Высокая &gt; Низкая)</option>
<?
}
if ($page ==1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=max&amp;limit=<? echo $limit;?>" <? if($order == "max"){?>selected="selected"<?}?>>Цена (Высокая &gt; Низкая)</option>
<?
}
if ($page !=1 && $limit != 12) {
?>
												<option value="<? echo $htmlpath.$catname;?>/?order=max&amp;limit=<? echo $limit;?>&amp;page=<? echo $page;?>" <? if($order == "max"){?>selected="selected"<?}?>>Цена (Высокая &gt; Низкая)</option>
<?
}
?>
												
									
												
												
											</select>
										</div>

									</div>

									<div id="products" class="product-grid">
										<div class="products-block">
<?
	$i_start = ($page-1)*$limit;
	$i_finish =$page*$limit;
	for ($i=$i_start; $i < $i_finish; $i++) { 
?>


											<div class="row products-row">
<?
		if ($tovar[$i][id] != "") {
			$file_cur_image = array();
			if (file_exists("imgurl/".trim($tovar[$i][id]).".txt")) {
				$file_cur_image = file("imgurl/".trim($tovar[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($file_cur_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$file_cur_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$file_cur_image[0] = $htmlpath."image/coming-soon.png";
			}
			

			
			
?>


												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-xs-12 col-fullwidth">
													<div class="product-block">
														<div class="image">
<?
			if ($tovar[$i][oldprice] != "") {
?>


															<span class="product-label-special label">Sale</span>
<?
			}
?>
															<a href="<? echo $file_cur_image[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $tovar[$i][model];?>">
																<span class="fa fa-search-plus"></span>
															</a>
															<a class="img" href="<? echo $tovar[$i][id];?>/">
																<img src="<? echo $file_cur_image[0]; ?>" alt="<? echo $tovar[$i][model];?>" class="img-responsive" />
															</a>

															
															<div class="img-overlay"></div>
														</div>
														<div class="product-meta">
															<div class="name">
																<a href="<? echo $tovar[$i][id];?>/"><? echo $tovar[$i][model];?></a>
															</div>

															<div class="rating">
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
															</div>

															
															<div class="group-item">
																<div class="price" itemtype="http://schema.org/Offer" itemscope>
<?
			if ($tovar[$i][oldprice] != "") {
?>			
																	<span class="price-old"><? echo $tovar[$i][oldprice]; ?></span>
<?
			}
?>
																	<span class="price-new"><? echo $tovar[$i][price]; ?> руб.</span>

																	<meta content="<? echo $tovar[$i][price]; ?>" itemprop="price">

																	<meta content="Рубль" itemprop="priceCurrency">
																	

																</div>
																<div class="cart">
																	<a href="<? echo $tovar[$i][id];?>/">
																		<button class="button" type="button">
																			<span>Смотреть детали</span>
																		</button>
																	</a>
																</div>

																
															</div>
														</div>
														
													</div>

												</div>
<?
		}
		$i++;
?>
<?
		if ($tovar[$i][id] != "") {
			$file_cur_image = array();
			if (file_exists("imgurl/".trim($tovar[$i][id]).".txt")) {
				$file_cur_image = file("imgurl/".trim($tovar[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($file_cur_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$file_cur_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$file_cur_image[0] = $htmlpath."image/coming-soon.png";
			}
			
?>


												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-xs-12 col-fullwidth">
													<div class="product-block">
														<div class="image">
<?
			if ($tovar[$i][oldprice] != "") {
?>


															<span class="product-label-special label">Sale</span>
<?
			}
?>
															<a href="<? echo $file_cur_image[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $tovar[$i][model];?>">
																<span class="fa fa-search-plus"></span>
															</a>
															<a class="img" href="<? echo $tovar[$i][id];?>/">
																<img src="<? echo $file_cur_image[0]; ?>" alt="<? echo $tovar[$i][model];?>" class="img-responsive" />
															</a>

															
															<div class="img-overlay"></div>
														</div>
														<div class="product-meta">
															<div class="name">
																<a href="<? echo $tovar[$i][id];?>/"><? echo $tovar[$i][model];?></a>
															</div>

															<div class="rating">
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
															</div>

															
															<div class="group-item">
																<div class="price" itemtype="http://schema.org/Offer" itemscope>
<?
			if ($tovar[$i][oldprice] != "") {
?>			
																	<span class="price-old"><? echo $tovar[$i][oldprice]; ?></span>
<?
			}
?>
																	<span class="price-new"><? echo $tovar[$i][price]; ?> руб.</span>

																	<meta content="<? echo $tovar[$i][price]; ?>" itemprop="price">

																	<meta content="Рубль" itemprop="priceCurrency">

																</div>
																<div class="cart">
																	<a href="<? echo $tovar[$i][id];?>/">
																		<button class="button" type="button">
																			<span>Смотреть детали</span>
																		</button>
																	</a>
																</div>
															</div>
														</div>
														
													</div>

												</div>
<?
		}
		$i++;
?>
<?
		if ($tovar[$i][id] != "") {
			$file_cur_image = array();
			if (file_exists("imgurl/".trim($tovar[$i][id]).".txt")) {
				$file_cur_image = file("imgurl/".trim($tovar[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($file_cur_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$file_cur_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$file_cur_image[0] = $htmlpath."image/coming-soon.png";
			}
			
?>


												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-xs-12 col-fullwidth">
													<div class="product-block">
														<div class="image">
<?
			if ($tovar[$i][oldprice] != "") {
?>


															<span class="product-label-special label">Sale</span>
<?
			}
?>
															<a href="<? echo $file_cur_image[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $tovar[$i][model];?>">
																<span class="fa fa-search-plus"></span>
															</a>
															<a class="img" href="<? echo $tovar[$i][id];?>/">
																<img src="<? echo $file_cur_image[0]; ?>" alt="<? echo $tovar[$i][model];?>" class="img-responsive" />
															</a>

															
															<div class="img-overlay"></div>
														</div>
														<div class="product-meta">
															<div class="name">
																<a href="<? echo $tovar[$i][id];?>/"><? echo $tovar[$i][model];?></a>
															</div>

															<div class="rating">
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
															</div>

															
															<div class="group-item">
																<div class="price" itemtype="http://schema.org/Offer" itemscope>
<?
			if ($tovar[$i][oldprice] != "") {
?>			
																	<span class="price-old"><? echo $tovar[$i][oldprice]; ?></span>
<?
			}
?>
																	<span class="price-new"><? echo $tovar[$i][price]; ?> руб.</span>

																	<meta content="<? echo $tovar[$i][price]; ?>" itemprop="price">

																	<meta content="Рубль" itemprop="priceCurrency">
																</div>
																<div class="cart">
																	<a href="<? echo $tovar[$i][id];?>/">
																		<button class="button" type="button">
																			<span>Смотреть детали</span>
																		</button>
																	</a>
																</div>
																
															</div>
														</div>
														
													</div>

												</div>
<?
		}
		$i++;
?>
<?
		if ($tovar[$i][id] != "") {
			$file_cur_image = array();
			if (file_exists("imgurl/".trim($tovar[$i][id]).".txt")) {
				$file_cur_image = file("imgurl/".trim($tovar[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($file_cur_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$file_cur_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$file_cur_image[0] = $htmlpath."image/coming-soon.png";
			}
			
?>


												<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 col-xs-12 col-fullwidth">
													<div class="product-block">
														<div class="image">
<?
			if ($tovar[$i][oldprice] != "") {
?>


															<span class="product-label-special label">Sale</span>
<?
			}
?>
															<a href="<? echo $file_cur_image[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $tovar[$i][model];?>">
																<span class="fa fa-search-plus"></span>
															</a>
															<a class="img" href="<? echo $tovar[$i][id];?>/">
																<img src="<? echo $file_cur_image[0]; ?>" alt="<? echo $tovar[$i][model];?>" class="img-responsive" />
															</a>

															
															<div class="img-overlay"></div>
														</div>
														<div class="product-meta">
															<div class="name">
																<a href="<? echo $tovar[$i][id];?>/"><? echo $tovar[$i][model];?></a>
															</div>

															<div class="rating">
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
																<span class="fa fa-stack">
																	<i class="fa fa-star-o fa-stack-1x"></i>
																</span>
															</div>

															
															<div class="group-item">
																<div class="price" itemtype="http://schema.org/Offer" itemscope>
<?
			if ($tovar[$i][oldprice] != "") {
?>			
																	<span class="price-old"><? echo $tovar[$i][oldprice]; ?></span>
<?
			}
?>
																	<span class="price-new"><? echo $tovar[$i][price]; ?> руб.</span>

																	<meta content="<? echo $tovar[$i][price]; ?>" itemprop="price">

																	<meta content="Рубль" itemprop="priceCurrency">
																</div>
																<div class="cart">
																	<a href="<? echo $tovar[$i][id];?>/">
																		<button class="button" type="button">
																			<span>Смотреть детали</span>
																		</button>
																	</a>
																</div>
																
															</div>
														</div>
														
													</div>

												</div>
<?
		}

?>
											</div>
<?
	}

?>
											

										</div>
									</div>
<?
	$n_page = ceil(count($tovar)/$limit);
	
	if ($n_page != 1) {
?>


									<div class="pagination clearfix">
										<div class="pull-left">
											<ul class="pagination">

<?
	if ($page != 1) {
		if ($limit == 12 && $order == "def") {
			
		
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/">|&lt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page-1;?>">&lt;</a>
												</li>
												
<?
		}
		if ($limit != 12 && $order == "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=1&amp;limit=<? echo $limit; ?>">|&lt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page-1;?>&amp;limit=<? echo $limit; ?>">&lt;</a>
												</li>
<?

		}
		if ($limit == 12 && $order != "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=1&amp;order=<? echo $order; ?>">|&lt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page-1;?>&amp;order=<? echo $order; ?>">&lt;</a>
												</li>
<?
		}
		if ($limit != 12 && $order != "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=1&amp;order=<? echo $order; ?>&amp;limit=<? echo $limit; ?>">|&lt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page-1;?>&amp;order=<? echo $order; ?>&amp;limit=<? echo $limit; ?>">&lt;</a>
												</li>
<?
		}
	}
	$i_start_nav = $page-5;
	$i_finish_nav =  $page+5;
	if ($i_start_nav < 1) {
		$i_start_nav = 1;
	}
	if ($i_finish_nav > $n_page) {
		$i_finish_nav = $n_page;
	}
	
	for ($i=$i_start_nav; $i <= $i_finish_nav; $i++) { 
		if ($limit == 12 && $order == "def") {
			
?>


												<li <? if ($i == $page) {?>class="active"<?}?>>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $i;?>"><span><? echo $i;?></span></a>
												</li>
<?
		}
		if ($limit != 12 && $order == "def") {
?>
												<li <? if ($i == $page) {?>class="active"<?}?>>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $i;?>&amp;limit=<? echo $limit; ?>"><span><? echo $i;?></span></a>
												</li>
<?
		}
		if ($limit == 12 && $order != "def") {
?>
												<li <? if ($i == $page) {?>class="active"<?}?>>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $i;?>&amp;order=<? echo $order; ?>"><span><? echo $i;?></span></a>
												</li>
<?
		}
		if ($limit != 12 && $order != "def") {
?>
												<li <? if ($i == $page) {?>class="active"<?}?>>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $i;?>&amp;order=<? echo $order; ?>&amp;limit=<? echo $limit; ?>"><span><? echo $i;?></span></a>
												</li>
<?
		}
	}
	if ($page != $n_page) {
		
		if ($limit == 12 && $order == "def") {
?>


												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page+1;?>">&gt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $n_page;?>">&gt;|</a>
												</li>
<?
		}
		if ($limit != 12 && $order == "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page+1;?>&amp;limit=<? echo $limit; ?>">&gt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $n_page;?>&amp;limit=<? echo $limit; ?>">&gt;|</a>
												</li>						
<?			
		}
		if ($limit == 12 && $order != "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page+1;?>&amp;order=<? echo $order; ?>">&gt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $n_page;?>&amp;order=<? echo $order; ?>">&gt;|</a>
												</li>						
<?
		}
		if ($limit != 12 && $order != "def") {
?>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $page+1;?>&amp;order=<? echo $order; ?>&amp;limit=<? echo $limit; ?>">&gt;</a>
												</li>
												<li>
													<a href="<? echo $htmlpath.$catname;?>/?page=<? echo $n_page;?>&amp;order=<? echo $order; ?>&amp;limit=<? echo $limit; ?>">&gt;|</a>
												</li>						
<?
		}
	}
?>
											</ul>
										</div>
										<div class="results">Показыны товары c <? echo $i_start;?> по <? echo $i_finish;?> из <? echo count($tovar);?></div>
									</div>
<?
	}

}
?>
								</div>
							</section>
							<aside id="sidebar-right" class="col-md-3">
								<div id="column-right" class="hidden-xs sidebar">
									<div class="box category highlights">
										<div class="box-heading">
											<span>Каталог</span>
										</div>
										<div class="box-content">
											<ul class="box-category">
<?
for ($i=0; $i < count($catalog); $i++) { 
	if ($cur_cat_par == $catalog[$i][par]) {
		if(file_exists("xmltovar/".$catalog[$i][num].".xml")){
?>
												<li class="haschild">
													<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/">
														<i class="fa fa-asterisk"></i>
														<? echo $catalog[$i][name]; ?>
													</a>
												</li>
<?
		}
	}
}
?>

												
											</ul>
										</div>
									</div>
									<script type="text/javascript">
    $(document).ready(function(){
        var active = $('.collapse.in').attr('id');
        $('span[data-target=#'+active+']').html("-");

        $('.collapse').on('show.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("-");
        });
        $('.collapse').on('hide.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("+");
        });
    });
</script>

									
								</div>
							</aside>
						</div>
					</div>
				</div>
				<!-- 
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>
				span number ), example array( 1=> 3 )[value from 1->12]
 -->
				<footer id="footer">
					<div class="footer-top">
						<div class="container">
							<div class="wrap-fcenter">
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<div class="box cusblock">
											<div class="box-module-pavreassurances  box-content">
												<div class="row quickaccess">
													<div class="col-lg-3 col-md-3">
														<i class="icon-name fa fa-tags"></i>

														<a href="<? echo $htmlpath;?>oplata/"><h3>Оплата</h3></a>
														
														<div class="mask" style="display:none;">
														
														</div>
													</div>
												
													<div class="col-lg-3 col-md-3">
														<i class="icon-name fa fa-gift"></i>

														<a href="<? echo $htmlpath;?>dostavka/"><h3>Доставка</h3></a>
													
														<div class="mask" style="display:none;">
														</div>
													</div>
													<div class="col-lg-3 col-md-3">
														<i class="icon-name fa fa-lock"></i>
														<a href="<? echo $htmlpath;?>privacy/"><h3>Конфиденциальность</h3></a>
														<div class="mask" style="display:none;">
														</div>
													</div>
													<div class="col-lg-3 col-md-3">
														<i class="icon-name fa fa-calendar"></i>
														<a href="<? echo $htmlpath;?>contact/"><h3>Поддержка 24/7</h3></a>
														<div class="mask" style="display:none;">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					
					<div id="powered">
		<div class="container">
			<div class="powered">
				<div class="copyright pull-left">
					Интим магазин &copy; 2015.
				</div>

				<div class="paypal pull-right">
					<p>
						<img src="<? echo $htmlpath;?>image/paypal.png" alt="Платежные системы"></p>
				</div>
			</div>
		</div>
					</div>
				</footer>

				
			</div>
		<?/**/?>
<div class="sidebar-offcanvas  visible-xs visible-sm">
				<div class="offcanvas-inner panel-offcanvas">
					<div class="offcanvas-heading panel-heading">
						
					</div>
					<div class="offcanvas-body panel-body">
						<div class="box category highlights">
							<div class="box-heading">
								<span>Эротическое белье</span>
							</div>
							<div class="box-content">
								<ul class="box-category">
<?
for ($i=0; $i < count($catalog); $i++) { 
	if ($catalog[$i][par] == "570") {
		if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
?>
									<li class="haschild">
										<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/">
											<i class="fa fa-asterisk"></i>
											<? echo trim($catalog[$i][name]);?>
										</a>
									</li>
<?
		}
	}
}
?>									
								</ul>
							</div>
							<div class="box-heading">
								<span>Секс игрушки</span>
							</div>
							<div class="box-content">
								<ul class="box-category">
<?
for ($i=0; $i < count($catalog); $i++) { 
	if ($catalog[$i][par] == "571") {
		if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
?>
									<li class="haschild">
										<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/">
											<i class="fa fa-asterisk"></i>
											<? echo trim($catalog[$i][name]);?>
										</a>
									</li>
<?
		}
	}
}
?>									
								</ul>
							</div>
							<div class="box-heading">
								<span>Смазки для секса</span>
							</div>
							<div class="box-content">
								<ul class="box-category">
<?
for ($i=0; $i < count($catalog); $i++) { 
	if ($catalog[$i][par] == "569") {
		if(file_exists("xmltovar/".trim($catalog[$i][num]).".xml")){
?>
									<li class="haschild">
										<a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($catalog[$i][name]))); ?>/">
											<i class="fa fa-asterisk"></i>
											<? echo trim($catalog[$i][name]);?>
										</a>
									</li>
<?
		}
	}
}
?>									
								</ul>
							</div>
						</div>
						<script type="text/javascript">
    $(document).ready(function(){
        var active = $('.collapse.in').attr('id');
        $('span[data-target=#'+active+']').html("-");

        $('.collapse').on('show.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("-");
        });
        $('.collapse').on('hide.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("+");
        });
    });
</script>

					</div>
				</div>
			</div>
<?/**/?>
		</div>
		<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter30093179 = new Ya.Metrika({id:30093179,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/30093179" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
	</html>