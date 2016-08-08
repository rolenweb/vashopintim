<?

/* include block */
include 'transurl.php';
/* include block */

$htmlpath = 'http://'.$_SERVER['HTTP_HOST']."/";

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

$bestcat = file("bestcat.txt");
$popcatalog = array();
for ($i=0; $i < count($bestcat); $i++) { 
	$cur_profile = trim($bestcat[$i]);
	preg_match_all('#\|(.*)\|(.*)\|(.*)\|(.*)\|#Uis', $cur_profile,$profile_info);
	for($i2=0;$i2<count($profile_info[1]);$i2++){
		$popcatalog[$i][numcat] = trim($profile_info[1][$i2]); 
		$popcatalog[$i][namecat] = trim($profile_info[2][$i2]); 
		$popcatalog[$i][numtov] = trim($profile_info[3][$i2]); 
		$popcatalog[$i][nametov] = trim($profile_info[3][$i2]); 
	} 
}
/* erogames load*/
$reader = new XMLReader();
$reader->open('xmltovar/444.xml');
$item = array();
$erogames = array();
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
                	$erogames[$n] = array();
					$erogames[$n] = $item; 
					
					$n++;
					
					
							
				//}
					
            }
    }
} 
/* erogames load*/
/* original vibr load*/
$reader = new XMLReader();
$reader->open('xmltovar/459.xml');
$item = array();
$origvib = array();
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
                	$origvib[$n] = array();
					$origvib[$n] = $item; 
					
					$n++;
					
					
							
				//}
					
            }
    }
} 
/* original vibr load*/
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
		<html lang="ru">
			<!--<![endif]-->
<head>
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Интим магазин</title>
			<meta name="description" content="Интим интернет магазин." />
			<meta name="keywords" content= "интим интернет магазин" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="shortcut icon" href="<? echo $htmlpath;?>image/favicon.png" type="image/x-icon">
			<link href="<? echo $htmlpath;?>" rel="canonical" />
			<link href="<? echo $htmlpath;?>css/bootstrap.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/green.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/font.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/paneltool.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/colorpicker.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/font-awesome.min.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/magnific-popup.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/pavproductcarousel.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/typo.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/pavtestimonial.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/pavblog.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/pavnewsletter.css" rel="stylesheet" />
			<link href="<? echo $htmlpath;?>css/shop.css" rel="stylesheet" />
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/jquery/jquery-2.1.1.min.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/bootstrap/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/common.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/common/common.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/jquery/colorpicker/js/colorpicker.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/layerslider/raphael-min.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/layerslider/jquery.easing.js"></script>
			<script type="text/javascript" src="<? echo $htmlpath;?>javascript/layerslider/iview.js"></script>
			<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'></head>
<body class="common-home page-common-home layout-fullwidth">
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
				<!--</div>	-->
					<!-- /header -->
					<!-- sys-notification -->
					<div id="sys-notification">
						<div class="container">
							<div id="notification"></div>
						</div>
					</div>
					<!-- /sys-notification -->

					<div class="slideshow hidden-xs hidden-sm" id="pavo-slideshow">
						<div class="container">
							<div class="row">
								<div class="col-lg-9 col-md-9  ">
									<script type="text/javascript">
								$(document).ready(function(){
									$('#iview').iView({
										pauseTime: 9000,
										directionNav: false,
										directionNavHide: false,
										controlNavNextPrev: false,
										controlNav: true,
										tooltipY: -15,
									});
								});
								</script>
									<div class="layerslider-wrapper carousel slide pavcontentslider" style="max-width:873px;">
										<div class="fix-margin-right" style="padding: 0;margin: 0;">
											<div id="iview" class="hidden-xs" style="width:100%;height:580px; " >
												<div data-iview-thumbnail="<? echo $htmlpath ;?>image/layer-slider-1.jpg" data-iview-image="<? echo $htmlpath ;?>image/layer-slider-1.jpg" data-iview-transition="slice-top-fade,slice-right-fade">
													
													
												</div>
												<div data-iview-thumbnail="<? echo $htmlpath ;?>image/layer-slider-2.jpg" data-iview-image="<? echo $htmlpath ;?>image/layer-slider-2.jpg" data-iview-transition="slice-top-fade,slice-right-fade">
													
												</div>
												<div data-iview-thumbnail="<? echo $htmlpath ;?>image/layer-slider-3.jpg" data-iview-image="<? echo $htmlpath ;?>image/layer-slider-3.jpg" data-iview-transition="slice-top-fade,slice-right-fade">
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-3">
									<div class="box-product pink horizontal box productcarousel" id="module1400671741">
										<div class="box-heading">
											<span>Популярные категории</span>
										</div>
										<div class="box-content" >
											<div class="box-products slide" id="catcarousel">
												<div class="carousel-controls">
													<a class="carousel-control left center" href="#catcarousel"   data-slide="prev">&lsaquo;</a>
													<a class="carousel-control right center" href="#catcarousel"  data-slide="next">&rsaquo;</a>
												</div>
												<div class="carousel-inner product-grid">
												<?
for ($i=0; $i < count($popcatalog); $i++) {
	$fileimg = file("imgurl/".$popcatalog[$i][nametov].".txt");
	 if ($i == 3) {
	 
	?>
													<div class="item active products-block">
													<? 
}
else{
?>
													<div class="item products-block">
<?

}
													 ?>
														<div class="row box-product last">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
																		<a href="<? echo trim($fileimg[0]);?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo trim($popcatalog[$i][namecat]);?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo TransUrl(trim($popcatalog[$i][namecat]));?>/">
																			<img src="<? echo trim($fileimg[0]);?>" alt="<? echo trim($popcatalog[$i][namecat]);?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo TransUrl(trim($popcatalog[$i][namecat]));?>/"><? echo trim($popcatalog[$i][namecat]);?></a>
																		</div>
																		
																		
																	</div>
																	
																</div>
															</div>
															
														</div>
													</div>
	<?
	
}
												?>
													
													
												</div>
											</div>
										</div>
									</div>
									<script type="text/javascript"><!--
								$('#catcarousel').carousel({interval:false,auto:false,pause:'hover'});
						--></script>
								</div>
							</div>
						</div>
					</div>
					<div class="showcase " id="pavo-showcase">
						<div class="container">
							<div class="row">
								
								<div class="col-lg-12 col-md-12 col-sm-12 ">
									<div class="box-product pink horizontal box productcarousel" id="module1400671741">
										<div class="box-heading">
											<span>Незабываемые эротические игры</span>
										</div>
										<div class="box-content" >
											<div class="box-products slide" id="productcarousel1400671741">
												<div class="carousel-controls">
													<a class="carousel-control left center" href="#productcarousel1400671741"   data-slide="prev">&lsaquo;</a>
													<a class="carousel-control right center" href="#productcarousel1400671741"  data-slide="next">&rsaquo;</a>
												</div>
												<div class="carousel-inner product-grid">
													<div class="item active products-block">
														<div class="row box-product last">
														<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "4900") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">SaleS</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм медсестры</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "4897") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм стюардессы</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "5975") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм секретарши</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "4922") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм полиция</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
													<div class="item  products-block">
														<div class="row box-product last">
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "4926") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм милитари</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "4932") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм монашки</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "3298") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм горничной</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
																		</div>
																	</div>
																	
																</div>
															</div>
															<?
$curtovar = array();														
for ($i=0; $i < count($erogames); $i++) { 
	if ($erogames[$i][id] == "3122") {
		$curtovar[0][model] = trim($erogames[$i][model]);
		$curtovar[0][id] = trim($erogames[$i][id]);
		$curtovar[0][price] = trim($erogames[$i][price]);
		$curtovar[0][oldprice] = trim($erogames[$i][oldprice]);
	}
}

$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
														?>
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
																<div class="product-block">
																	<div class="image">
<?
if ($curtovar[0][oldprice] != "") {
?>
																		<span class="product-label-special label">Sale</span>
<?
}
?>
																		<a href="<? echo $curfileimage[0];?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																			<span class="fa fa-search-plus"></span>
																		</a>
																		<a class="img" href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">
																			<img src="<? echo $curfileimage[0];?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																		</a>
																		
																		<div class="img-overlay"></div>
																	</div>
																	<div class="product-meta">
																		<div class="name">
																			<a href="<? echo $htmlpath;?>igrovie-kostyumi/<? echo $curtovar[0][id]; ?>/">Костюм дяволицы</a>
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
if ($curtovar[0][oldprice] != "") {
	?>
																				<span class="price-old"><? echo $curtovar[0][oldprice];?></span>
	<?
}
																				?>
																				<span class="price-new"><? echo $curtovar[0][price];?> руб.</span>
																				<meta content="<? echo $curtovar[0][price];?>" itemprop="price">
																				<meta content="Рубль" itemprop="priceCurrency"></div>
																			
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
									<script type="text/javascript"><!--
								$('#productcarousel1400671741').carousel({interval:false,auto:false,pause:'hover'});
						--></script>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row">

							<div id="sidebar-main" class="col-md-12">
								<div id="content">
									<div class="nopadding">
										<div class="box-content">
											<div class="clearfix ">

												<div class="box pts-container " >
													<div class="pts-inner">

														<div class="row row-level-1">
															<div class="row-inner  clearfix">
																<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
																	<div class="col-inner">
																		<div class="banner-wrapper">
																		<!--
																			<a href="#">
																				<img src="image/adv.png" alt="" class="img-responsive">
																			</a>
																		-->
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
									<div class="box-product yellow horizontal box productcarousel" id="module1437452147">
										<div class="box-heading">
											<span>Оригинальные вибраторы</span>
										</div>
										<div class="box-content" >
											<div class="box-products slide" id="productcarousel1437452147">
												<!-- 						<div class="box-description">
												<p>
													<br></p>
											</div>
											-->
											<div class="carousel-controls">
												<a class="carousel-control left center" href="#productcarousel1437452147"   data-slide="prev">&lsaquo;</a>
												<a class="carousel-control right center" href="#productcarousel1437452147"  data-slide="next">&rsaquo;</a>
											</div>
											<div class="carousel-inner product-grid">

												<div class="item active products-block">
													<div class="row box-product last">
<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "4593") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">ZINI SEED</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "5236") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">Fresh by LEAF</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "6440") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">Sqweel Go Purple</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														
														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "6502") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">MINI VIBE Classic</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

													</div>
												</div>
												<div class="item  products-block">
													<div class="row box-product last">
														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "1852453") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">Smart Wand Medium</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "6591") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">EMBRACE  BODY WAND</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "7032") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">Danae Ultra Powerful</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
																	</div>
																</div>
																
															</div>

														</div>

														<?
$curtovar = array();														
for ($i=0; $i < count($origvib); $i++) { 
	if ($origvib[$i][id] == "5163") {
		$curtovar[0][model] = trim($origvib[$i][model]);
		$curtovar[0][id] = trim($origvib[$i][id]);
		$curtovar[0][price] = trim($origvib[$i][price]);
		$curtovar[0][oldprice] = trim($origvib[$i][oldprice]);
	}
}
$curfileimage = file("imgurl/".$curtovar[0][id].".txt");
?>
														<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
															<div class="product-block">
																<div class="image">
<?
if ($curtovar[0][oldprice] != ""){
?>
																	<span class="product-label-special label">Sale</span>
<?
}
?>
																	
																	<a href="<? echo $curfileimage[0]; ?>" class="info-view colorbox product-zoom hidden-sm hidden-xs cboxElement" title="<? echo $curtovar[0][model]; ?>">
																		<span class="fa fa-search-plus"></span>
																	</a>
																	<a class="img" href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">
																		<img src="<? echo $curfileimage[0]; ?>" alt="<? echo $curtovar[0][model]; ?>" class="img-responsive" />
																	</a>

																	
																	<div class="img-overlay"></div>
																</div>
																<div class="product-meta">
																	<div class="name">
																		<a href="<? echo $htmlpath; ?>originaljnie-vibratori/<? echo $curtovar[0][id]; ?>/">LOVE LIPS</a>
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
if ($curtovar[0][oldprice] != ""){
?>
																			<span class="price-old"><? echo $curtovar[0][oldprice]; ?></span>
<?
}
?>
																			<span class="price-new"><? echo $curtovar[0][price]; ?> руб.</span>

																			<meta content="<? echo $curtovar[0][price]; ?>" itemprop="price">

																			<meta content="" itemprop="priceCurrency"></div>
																		
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
								<script type="text/javascript"><!--
	$('#productcarousel1437452147').carousel({interval:false,auto:false,pause:'hover'});
--></script>
							</div>
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