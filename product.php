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
if(isset($_GET['tovname'])){
    $tovname = trim($_GET['tovname']);
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
$curtovar = array();
for ($i=0; $i < count($tovar); $i++) { 
	if ($tovname == $tovar[$i][id]) {
		$curtovar = $tovar[$i];
		break;
	}
}

/*Related pages*/
$cur_name_massive = array();
$cur_name_massive = array_unique(explode(" ", trim($curtovar[model])));
$clear_cur_name_massive = array();
$n_words=0;
for ($i=0; $i < count($cur_name_massive); $i++) { 
	if (strlen($cur_name_massive[$i]) > 2) {
			$clear_cur_name_massive[$n_words] = $cur_name_massive[$i];
			$n_words++;
		}	
}
$related_pages = array();
$n_rel_pages = 0;
$relate_stepen = ceil(0.3*$n_words);
for ($i=0; $i < count($tovar); $i++) { 
	if ($tovar[$i][id] != $curtovar[id]) {
		$cur_relate_stepen = 0;
		for ($i2=0; $i2 < count($clear_cur_name_massive); $i2++) { 
			if (strpos(strtolower(trim($tovar[$i][model])), strtolower(trim($clear_cur_name_massive[$i2]))) != false) {
				$cur_relate_stepen++;
			}
		}
		//echo $cur_relate_stepen.":";
		if ($cur_relate_stepen > $relate_stepen) {
			$related_pages[$n_rel_pages] = $tovar[$i];
			//echo $related_pages[$n_rel_pages][model]."<br>";
			$n_rel_pages++;
			//break;
		}
	}
}

/*Related pages*/

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
<html lang="ru" class="ie8">
	<![endif]-->
	<!--[if IE 9 ]>
	<html lang="ru" class="ie9">
		<![endif]-->
		<!--[if (gt IE 9)|!(IE)]>
		<!-->
		<html lang="ru">
			<!--<![endif]-->
<head>
<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title><? echo trim($curtovar[model]);?></title>
			<meta name="description" content="<? echo trim($curtovar[model]);?>." />
			<meta name="keywords" content= "<? echo trim($curtovar[model]);?>" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="shortcut icon" href="<? echo $htmlpath;?>image/favicon.png" type="image/x-icon">
			<link href="<? echo $htmlpath.$catname;?>/<? echo $tovname;?>/" rel="canonical" />
			<link href="<? echo "$htmlpath"; ?>css/bootstrap.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/green.css" rel="stylesheet" />
			<link href="<? echo "$htmlpath"; ?>css/font.css" rel="stylesheet" />
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
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/datetimepicker/moment.js"></script>
			<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js"></script>

			<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'>

</head>
<body class="product-product-45 page-product layout-fullwidth">

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
											<a href="<? echo $htmlpath;?>">
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
								<span class="hidden-xs">
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
									<li><a href="<? echo $htmlpath; ?><? echo str_replace("--","-",TransUrl(trim($cur_cat_name))); ?>/">
											<span><? echo $cur_cat_name; ?></span>
										</a>
									</li>
	<?
	
}
									?>
									<li>
										<span><? echo $curtovar[model];?></span>
									</li>	
								</ul>
								</span>
							</div>

							<section id="sidebar-main" class="col-md-9">
								<div id="content">
									<div class="product-info">
										<div class="row">

											<div class="col-lg-5 col-sm-6 col-xs-12 image-container">
												<div id="img-detail" class="image">
<?
if ($curtovar[oldprice] != "") {
?>
													<span class="product-label-special label">Sale</span>
<?
}
			
			$cur_url_image = array();
			if (file_exists("imgurl/".trim($curtovar[id]).".txt")) {
				$cur_url_image = file("imgurl/".trim($curtovar[id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($cur_url_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$cur_url_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$cur_url_image[0] = $htmlpath."image/coming-soon.png";
			}
?>


													

														<img src="<? echo $cur_url_image[0];?>" title="<? echo $curtovar[model];?>" alt="<? echo $curtovar[model];?>" id="image"  data-zoom-image="<? echo $cur_url_image[0];?>" class="product-image-zoom img-responsive"/>
													

												</div>
<?
if (count($cur_url_image)>1) {
	

?>
												<div class="image-additional slide carousel vertical" id="image-additional">
													<div id="image-additional-carousel" class="carousel-inner">
														<div class="item">
<?
for ($i=0; $i < count($cur_url_image); $i++) { 
	if (trim($cur_url_image[$i]) != "") {
		$check_header = array();
		$check_header = get_headers(trim($cur_url_image[$i]));
		if(strpos(trim($check_header[0]),"200")) {
		}
		else{
			$cur_url_image[$i] = $htmlpath."image/coming-soon.png";
		}
			
			
?>
															<a href="<? echo trim($cur_url_image[$i]);?>" title="<? echo $curtovar[model];?>" class="imagezoom" data-zoom-image="<? echo trim($cur_url_image[$i]);?>" data-image="<? echo trim($cur_url_image[$i]);?>">
																<img src="<? echo trim($cur_url_image[$i]);?>" style="max-width:114px"  title="<? echo $curtovar[model];?>" alt="<? echo $curtovar[model];?>" data-zoom-image="<? echo trim($cur_url_image[$i]);?>" class="product-image-zoom img-responsive" />
															</a>
<?
	}
}
?>
														</div>

													</div>

													<!-- Controls -->
												</div>
<?
}
?>
												<script type="text/javascript">
        $('#image-additional .item:first').addClass('active');
        $('#image-additional').carousel({interval:false})
    </script>

											</div>

											<div class="col-md-5 col-lg-7 col-sm-6 col-xs-12">
												<h1><? echo $curtovar[model];?></h1>
												<div class="sosial">
													<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir"></div>
												</div>
												
												<ul class="list-unstyled description">
													<li>
														<span>Производитель:</span>
														<? echo $curtovar[vendor];?>
													</li>
													<li>
														<span>Код товара:</span>
														<? echo $curtovar[vendorcode];?>
													</li>
													
													
												</ul>
												

												<div class="price shop-price">
													<ul class="list-unstyled">

														<li>
<?
if ($curtovar[oldprice] != "") {
?>
															<span class="price-old"><? echo $curtovar[oldprice];?></span>
<?
}
?>

															<span class="price-new"><? echo $curtovar[price];?> руб.</span>
														</li>
														

													</ul>
													
												</div>

												<div id="product">

													<div class="product-extra but-buy">
														
														
														<a href="<? echo $htmlpath; ?>goto/http://n.actionpay.ru/click/54aecb8d8b30a8aa408b456e/7359/sh/url=<? echo trim($curtovar[url]);?>" target="_blank">
															<button type="button" id="button-cart" class="button" data-loading-text="Loading...">
																<span class="fa fa-shopping-cart icon"></span>
																<span>Купить</span>
															</button>
														</a>
													</div>

													

												</div>

											</div>
										</div>
									</div>
									<div class="tabs-group">
										<div id="tabs" class="htabs clearfix">
											<ul class="nav clearfix">
												<span class="hidden-xs">
													<li class="active">
														<a href="#tab-description" data-toggle="tab">Дополнительное описание</a>
													</li>
												</span>
												
											</ul>
										</div>

										<div class="tab-content">
											<div class="tab-pane active" id="tab-description">
												<div>
<?
if (file_exists("content/".trim($curtovar[id].".txt"))) {
	$file_descr = file("content/".trim($curtovar[id]).".txt");
	$descr_text = "";
	for ($i=0; $i < count($file_descr); $i++) { 
		$descr_text = $descr_text.$file_descr[$i];
	}
	$descr_text = str_replace("7MORE7", "Подробнее", $descr_text);
	$descr_text = str_replace("mytesturl.ru", "vashopintim.ru", $descr_text);
	$descr_text = str_replace("class=\"url-button\"", "target=\"_blank\" rel=\"nofollow\" class=\"url-button\"", $descr_text);
	echo $descr_text;
}
?>												
			
												</div>
											</div>

											
										</div>
									</div>
<?
if (count($related_pages) != 0) {
?>
									<div class="product-related box">
										<div class="box-heading">
<?
if (count($related_pages)<9) {
?>
											<span>Похожие товары(<? echo count($related_pages);?>)</span>
<?
}
else{
?>
											<span>Похожие товары(8)</span>
<?
}
?>

										</div>
										<div id="related" class="slide product-grid" data-interval="0">
<?
if (count($related_pages) > 4) {
?>
											<div class="carousel-controls">
												<a class="carousel-control left icon-angle-left" href="#related" data-slide="prev"></a>
												<a class="carousel-control right icon-angle-right" href="#related" data-slide="next"></a>
											</div>

<?
}
?>
											<div class="products-block carousel-inner">
												<div class= "item active">
													<div class="row">
<?
for ($i=0; $i < 4; $i++) { 
	if (trim($related_pages[$i][id]) != "") {
			$cur_url_image = array();
			if (file_exists("imgurl/".trim($related_pages[$i][id]).".txt")) {
				$cur_url_image = file("imgurl/".trim($related_pages[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($cur_url_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$cur_url_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$cur_url_image[0] = $htmlpath."image/coming-soon.png";
			}
?>
														<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
															<div class="product-block">
																<div class="image">
<?
		if (trim($related_pages[$i][oldprice]) != "") {
?>
																	<span class="product-label-special label">Sale</span>
<?
		}
?>
																	<a href="<? echo trim($cur_url_image[0]);?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo trim($related_pages[$i][model]); ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="../<? echo trim($related_pages[$i][id]); ?>/">
																		<img src="<? echo trim($cur_url_image[0]);?>" alt="<? echo trim($related_pages[$i][model]); ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="../<? echo trim($related_pages[$i][id]); ?>/"><? echo trim($related_pages[$i][model]); ?></a>
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
		if (trim($related_pages[$i][oldprice]) != "") {
?>
																			<span class="price-old"><? echo trim($related_pages[$i][oldprice]); ?></span>
<?
		}
?>

																			<span class="special-price"><? echo trim($related_pages[$i][price]) ;?> руб.</span>

																			<meta content="<? echo trim($related_pages[$i][price]);?>" itemprop="price">
																			<meta content="" itemprop="priceCurrency"></div>
																		<div class="cart">
																			<a href="../<? echo $related_pages[$i][id];?>/">
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
}
?>
														
														
													</div>
												</div>
												<div class= "item ">
													<div class="row">
<?
for ($i=4; $i < 8; $i++) { 
	if (trim($related_pages[$i][id]) != "") {
			$cur_url_image = array();
			if (file_exists("imgurl/".trim($related_pages[$i][id]).".txt")) {
				$cur_url_image = file("imgurl/".trim($related_pages[$i][id]).".txt");
				$check_header = array();
				$check_header = get_headers(trim($cur_url_image[0]));
				if(strpos(trim($check_header[0]),"200")) {
					
				}
				else{
					$cur_url_image[0] = $htmlpath."image/coming-soon.png";
				}
			}
			else{
				$cur_url_image[0] = $htmlpath."image/coming-soon.png";
			}

?>
														<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
															<div class="product-block">
																<div class="image">
<?
		if (trim($related_pages[$i][oldprice]) != "") {
?>
																	<span class="product-label-special label">Sale</span>
<?
		}
?>																

																	<a href="<? echo trim($cur_url_image[0]);?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo trim($related_pages[$i][model]);?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="../<? echo trim($related_pages[$i][id]); ?>/">
																		<img src="<? echo trim($cur_url_image[0]);?>" alt="<? echo trim($related_pages[$i][model]);?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="../<? echo trim($related_pages[$i][id]); ?>/"><? echo trim($related_pages[$i][model]);?></a>
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
		if (trim($related_pages[$i][oldprice]) != "") {
?>
																			<span class="price-old"><? echo trim($related_pages[$i][oldprice]); ?></span>
<?
		}
?>

																			<span class="special-price"><? echo trim($related_pages[$i][price]) ;?> руб.</span>

																			<meta content="<? echo trim($related_pages[$i][price]);?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		<div class="cart">
																			<a href="../<? echo $related_pages[$i][id];?>/">
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
}
?>


													</div>
												</div>
											</div>
										</div>
									</div>
<?
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

				
				
				<script type="text/javascript" src="<? echo "$htmlpath"; ?>javascript/jquery/elevatezoom/elevatezoom-min.js"></script>
				<script type="text/javascript">
		var zoomCollection = '#image';
		$( zoomCollection ).elevateZoom({
				zoomType        : "lens",
				lensShape : "round",
		lensSize    : 150,
		easing:true,
		gallery:'image-additional-carousel',
		cursor: 'pointer',
		galleryActiveClass: "active"
	});
 
</script>

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