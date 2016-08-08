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
			<title>Конфиденциальность при покупке интим товаров</title>
			<meta name="description" content="Конфиденциальность при покупке интим товаров." />
			<meta name="keywords" content= "конфиденциальность интим товар" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="shortcut icon" href="<? echo $htmlpath;?>image/favicon.png" type="image/x-icon">
			<link href="<? echo $htmlpath;?>privacy/" rel="canonical" />
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
				<!--</div> -->

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
							

							<section id="sidebar-main" class="col-md-12">
								<div id="content">
									<div class="product-info">
										<div class="row">
										<div class="col-md-12">
											<div class="privacy">
												<h2>Грантируем конфиденциальность</h2>
												<p>
													При любом способе доставки и самовывозе вы не взаимодействуете с сотрудниками нашего магазина. Менеджеры транспортной компании, курьеры, которые привозят вам заказ и сотрудники почты не имеют отношения к нашему магазину. <span class="up-strong-w">Они не знают, из какого магазина вы получаете заказ и что находится в упаковке</span>.
												</p>
												<p class = "up-w">
													Упаковка всегда закрыта, защищена от несанкционированного вскрытия и не содержит надписей, которые могут указывать на содержимое заказа.
												</p>
											</div>
										</div>
										</div>
									</div>
									

								</div>
							</section>
							
						</div>
					</div>
				</div>

				
				
				

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