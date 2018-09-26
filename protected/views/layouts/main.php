<!--<!doctype html>-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<!--<meta charset="utf-8">-->
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
		<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
		<title>Portal Programa Mais Médicos</title>
		<style>
			#loader{transition:all .3s ease-in-out;opacity:1;visibility:visible;position:fixed;height:100vh;width:100%;background:#fff;z-index:90000}#loader.fadeOut{opacity:0;visibility:hidden}.spinner{width:40px;height:40px;position:absolute;top:calc(50% - 20px);left:calc(50% - 20px);background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
		</style>
		<link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->baseUrl; ?>/css/tokenize2.css" rel="stylesheet">
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.mask.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/highcharts.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/tokenize2.js"></script>
	</head>
	<body class="app">
		<div id="loader">
			<div class="spinner">
			</div>
		</div>
		<script>
			window.addEventListener('load', () => {
				const loader = document.getElementById('loader');
				setTimeout(() => {
					loader.classList.add('fadeOut');
				}, 300);
			});
		</script>
		<div>
			<div class="sidebar">
				<div class="sidebar-inner">
					<div class="sidebar-logo">
						<div class="peers ai-c fxw-nw">
							<div class="peer peer-greed">
								<a class="sidebar-link td-n" href="<?php echo Yii::app()->baseUrl; ?>/site/index">
									<div class="peers ai-c fxw-nw">
										<div class="peer">
											<div class="logo"><img src="<?php echo Yii::app()->baseUrl; ?>/images/mais-medicos-brasileiros.png" alt=""></div>
										</div>
										<div class="peer peer-greed">
											<h5 class="lh-1 mB-0 logo-text">PPMM</h5>
										</div>
									</div>
								</a>
							</div>
							<div class="peer">
								<div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a></div>
							</div>
						</div>
					</div>
					<ul class="sidebar-menu scrollable pos-r">
						<?php
							foreach ($this->menu as $item) {
								// Entrada normal no menu lateral
								if ($item["tipo"] == 'entrada' && $item["pertenceDropdown"] == false)
								{
									echo '<li class="nav-item"><a class="sidebar-link" href="' . $item["url"] . '"><span class="icon-holder"><i class="' . $item["icone"] . '"></i> </span><span class="title">' . $item["label"] . '</span></a></li>';
								}
								
								// Entrada de um submenu
								if ($item["tipo"] == 'entrada' && $item["pertenceDropdown"] == true)
								{
									echo '<li><a href="' . $item["url"] . '">' . $item["label"] . '</a></li>';
								}
								
								// Abertura do submenu
								if ($item["tipo"] == 'dropdown' && $item["pertenceDropdown"] == true)
								{
									echo '<li class="nav-item dropdown">';
									echo '<a class="dropdown-toggle" href="javascript:void(0);"><span class="icon-holder"><i class="' . $item["icone"] . '"></i> </span><span class="title">' . $item["label"] . '</span> <span class="arrow"><i class="ti-angle-right"></i></span></a>';
									echo '<ul class="dropdown-menu">';
								}
								
								// Fechamento do submenu
								if ($item["tipo"] == 'dropdown' && $item["pertenceDropdown"] == false)
								{
									echo '</ul>';
									echo '</li>';
								}
							}
						?>
					</ul>
				</div>
			</div>
			<div class="page-container">
				<div class="header navbar">
					<div class="header-container">
						<ul class="nav-left">
							<li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
							<li class="search-input"><input class="form-control" type="text" placeholder="Search..."></li>
						</ul>
						<ul class="nav-right">
							<li class="dropdown">
								<a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
									<div class="peer"><span class="fsz-sm c-grey-900"><?php echo isset(Yii::app()->user->NomeUsuario) ? Yii::app()->user->NomeUsuario : '' ?></span></div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<main class="main-content bgc-grey-100">
					<div id="mainContent">
						<div class="row">
							<div class="col-md-12">
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
									<?php
										$flashMessages = Yii::app()->user->getFlashes();
										if ($flashMessages) {
											foreach($flashMessages as $key => $message) {
												echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
											}
										}
										echo $content; 
									?>
								</div>
							</div>
						</div>
					</div>
				</main>
				<!-- <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600"><span>Copyright © 2017 Designed by <a href="https://colorlib.com" target="_blank" title="Colorlib">Colorlib</a>. All rights reserved.</span></footer> -->
			</div>
		</div>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/vendor.js"></script>
		<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/bundle.js"></script>
	</body>
</html>