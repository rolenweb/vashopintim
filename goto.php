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


if(isset($_GET['urlpar'])){
    $urlpar = trim($_GET['urlpar']);
   	$urlpar = str_replace('http:/', 'http://', $urlpar);	
    
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
			<title>Интим магазин</title>
			<meta name="description" content="Интим магазин." />
			<meta name="keywords" content= "интим магазин" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="shortcut icon" href="<? echo $htmlpath;?>image/favicon.png" type="image/x-icon">
			<link href="<? echo $htmlpath;?>" rel="canonical" />
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
				</div>

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
							<div class="goto">
								Сейчас вы будете перенаправлены по адрессу: <? echo $urlpar;?>. <p>Если перенаправление не произошло в течение <span id="time">2</span> секунд, <a href="http://<? echo $urlpar;?>">нажмите здесь</a>.
							</div>							
						</div>
					</div>
				</div>
				<script>
	<!--
        function redirectTimeOut(s) {
                document.getElementById('time').innerHTML = s;
                if (s > 0) {
                        setTimeout("redirectTimeOut(" + (--s) + ");", 1000);
                } else {
                        window.location.href = '<? echo trim($urlpar);?>';
                }
        }
        redirectTimeOut(2);
		-->
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
									<img src="<? echo $htmlpath;?>image/paypal.png" alt="Платежные системы"></p>
								</div>
							</div>
						</div>
					</div>
				</footer>

				
				

				
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