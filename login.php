<?php
ini_set('display_errors', 'On');
error_reporting(E_ERROR | E_PARSE);
include_once("config.php");
$titSecao = $secao = "Login";
//
if(isset($_GET['logout'])){
	setcookie ("cookieCms", "");
	$Session->deletaUsuario();
}

?>
<!DOCTYPE html>
<html lang="pt_br">
	<!--begin::Head-->
	<head><base href="">
		<title>Studio Export - BS </title>
		<meta charset="utf-8" />
		<meta name="description" content="Sistema de Gerenciamento e CRM voltado à Exportações" />
		<meta name="keywords" content="BS, Exportacao, Vendas, CRM, Gerenciador" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Studio Export - BS" />
		<meta property="og:url" content="https://www.bsimportexpoet.com.br/studio" />
		<meta property="og:site_name" content="Studio Export | BS" />
		<link rel="canonical" href="https://www.bsimportexpoet.com.br/studio" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/dozzy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="http://www.bsimportexport.com.br" class="mb-12">
						<img alt="Logo" src="assets/media/logos/demo3.svg" class="h-40px" />
					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Entrar no Studio Export by BS</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Novo aqui?
								<a href="sign-up.php" class="link-primary fw-bolder">Solicitar Acesso</a></div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="text" name="email" id="email" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Senha</label>
									<!--end::Label-->
									<!--begin::Link-->
									<a href="password-reset.php" class="link-primary fs-6 fw-bolder">Esqueceu sua Senha?</a>
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" />
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continuar</span>
									<span class="indicator-progress">Por favor espere...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
								<!--end::Submit button-->
							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="d-flex flex-center flex-column-auto p-10">
					<!--begin::Links-->
					<div class="d-flex align-items-center fw-bold fs-6">
						<a href="https://www.bsimportexport.com.br" class="text-muted text-hover-primary px-2">Sobre</a>
						<a href="mailto:contato@bsimportexport.com.br" class="text-muted text-hover-primary px-2">Contato</a>
					</div>
					<!--end::Links-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="assets/js/custom/authentication/sign-in/general.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
<?php include("layout/_end.php") ?>