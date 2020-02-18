<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/res/cpe/site/img/favicon.ico" type="image/x-icon">
	<title>CPE</title>

	<!-- Google Fonts -->
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' type='text/css'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' type='text/css'>
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Raleway:400,100' type='text/css'>

	<!-- Bootstrap v3.2.0 -->
	<link rel="stylesheet" href="/res/cpe/site/css/bootstrap.min.css">

	<!-- Font Awesome Free v4.2.0 -->
	<link rel="stylesheet" href="/res/cpe/site/css/font-awesome.min.css">

	<!-- CSS v3.0.0 -->
	<link rel="stylesheet" href="/res/cpe/site/css/style.css">

	<!-- Theme style -->
	<script src="/res/cpe/site/js/core.min.js"></script>
	<link rel="stylesheet" href="/res/cpe/site/css/AdminLTE.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9] -->
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body>
	<header class="section page-header">
		<!--RD Navbar-->
		<div class="rd-navbar-wrap">
			<nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="170px" data-xl-stick-up-offset="170px" data-xxl-stick-up-offset="170px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
				<div class="rd-navbar-aside-outer">
					<div class="rd-navbar-aside">
						<!--RD Navbar Panel-->
						<div class="rd-navbar-panel">
							<!--RD Navbar Toggle-->
							<button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
							<!--RD Navbar Brand-->
							<div class="rd-navbar-brand">
								<!--Brand--><a class="brand" href="/"><img class="brand-logo-dark" src="/res/cpe/site/img/logo.png" alt="" width="336" height="51"/></a>
							</div>
							<div class="alignright text-red">
								<div id="aguarde" style="display:none;">
									<h4>Aguarde 60 segundos!</h4>
								</div>
							</div>
							<div class="alignright text-red">
								<div id="pesquisa" style="display:none;">
									<h4>Escolha um mês e um ano!</h4>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="rd-navbar-main-outer">
					<div class="rd-navbar-main">
						<div class="rd-navbar-nav-wrap">
							<ul class="rd-navbar-nav">
								<li class="rd-nav-item active"><a class="rd-nav-link" href="/">Home</a></li>
								<li class="rd-nav-item"><a class="rd-nav-link" href="/plans">Planos</a></li>
								<li class="rd-nav-item"><a class="rd-nav-link" href="/payments">Pagamentos</a></li>
								<li class="rd-nav-item"><a class="rd-nav-link" href="/statistics">Estatísticas</a></li>
								<li class="rd-nav-item"><a class="rd-nav-link" href="/about">Sobre</a></li>
								<?php if( checkPage() ){ ?>
									<form role="form" action="/" method="post" enctype="multipart/form-data">
								<?php }else{ ?>
									<form role="form" action="/statistics" method="post" enctype="multipart/form-data">
								<?php } ?>
									<div class="rd-nav-item">
										<select class="form-control" name="month" id="month">
											<option value="00">Mês</option>
											<option value="01">Jan</option>
											<option value="02">Fev</option>
											<option value="03">Mar</option>
											<option value="04">Abr</option>
											<option value="05">Mai</option>
											<option value="06">Jun</option>
											<option value="07">Jul</option>
											<option value="08">Ago</option>
											<option value="09">Set</option>
											<option value="10">Out</option>
											<option value="11">Nov</option>
											<option value="12">Dez</option>
										</select>
									</div>
									<div class="rd-nav-item">
										<select class="form-control" name="year" id="year">
											<option value="0000">Ano</option>
											<option value="2019">2019</option>
											<option value="2018">2018</option>
											<option value="2017">2017</option>
											<option value="2016">2016</option>
											<option value="2015">2015</option>
										</select>
									</div>
									<div class="rd-nav-item">
										<input type="submit" class="btn btn-success" value="ok">
									</div>
								</form>

							</ul>
						</div>
					</div>
				</div>

			</nav>
		</div>
	</header>


	<!-- ##############################################     BELOW BODY     ############################################# -->