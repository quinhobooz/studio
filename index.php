<?php
$temPHP8 = true;
include("config.php");
$codSecao = 1;
$dadosSecao = retornaDadosSecao($codSecao);

//Inicializa Bibliotecas JS
//$temMorris = true;
$_GoogleCharts = true;
$_temAmCharts = true;
$_temDateRangePicker = true;
$temDataTable = true;
$_temTimeline = true;


$titSecao = $secao = $dadosSecao['tl_secao'];
$nomeArquivo = $dadosSecao['tl_arquivo'];

if(isset($_GET['codFabrica'])){
	$codFabrica = $_GET['codFabrica'];
}

$ano = date('Y');
if(isset($_GET['ano'])){ $ano = $_GET['ano'];}



?>
<?php include("layout/_head.php") ?>
<?php 
$totalParesAno = retornaParesTotalAno($ano, $codFabrica);
$totalBolsasAno = retornaBolsasTotalAno($ano, $codFabrica);
$totalPecasAno = retornaPecasTotalAno($ano, $codFabrica);
$totalValorAno = retornaValorTotalAnoPecas($ano, $codFabrica);
$totalValorFaturadoAno = retornaValorFaturadoTotalAnoPecas($ano, $codFabrica);
$totalReaisAno = retornaReaisTotalAnoPecas($ano, $codFabrica);
$metaParesAnual = retornaMetaParesAnual($ano, $codFabrica);
$metaBolsasAnual = retornaMetaBolsasAnual($ano, $codFabrica);
//
$percentMetaParesAnual = number_format(($totalParesAno * 100) / $metaParesAnual, 0, ',', '.');
$percentMetaBolsasAnual = number_format(($totalBolsasAno * 100) / $metaBolsasAnual, 0, ',', '.');
$metaFaturamentoAnual = retornaMetaFaturamentoAnual($ano, $codFabrica);
$percentMetaFaturamentoAnual = number_format(($totalValorAno * 100) / $metaFaturamentoAnual, 0, ',', '.');
//
$metaFaturamentoAnualReais = retornaMetaFaturamentoReaisAnual($ano, $codFabrica);
$percentMetaReaisAnual = number_format(($totalReaisAno * 100) / $metaFaturamentoAnualReais, 0, ',', '.');

$cotacaoMediaAnual = number_format($totalReaisAno / $totalValorFaturadoAno, 3, ',', '.');


?>	
<?php include("layout/_loader.php") ?>		
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<?php include("layout/aside/_base.php") ?>					
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					
					<?php include("layout/header/_base.php") ?>						
					
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Container-->
						<div class=" container-fluid " id="kt_content_container">
							<!--begin::Row-->
							<div class="row gy-5 g-xl-10">
								<!--begin::Col-->
								<div class="col-xxl-6 mb-lg-10 mb-xl-5 mb-xxl-10">
									<div class="row g-5 g-lg-10">
										<div class="col-md-6 col-xl-6 mb-md-5 mb-xxl-10">
											<!--begin::Card widget 8-->
											<div class="card overflow-hidden h-md-50 mb-5 mb-lg-10">
												<!--begin::Card body-->
												<?php 
												$percentDiffSaleAnual = retornaDiferencaVendaComparadaComAnoAnterior($ano, $codFabrica);
												if($percentDiffSaleAnual < 0) {
													$backgroundColorVendaTotal = "bg-danger";
												} else {
													$backgroundColorVendaTotal = "bg-success";
												}
												?>
												<div class="card-body d-flex <?=$backgroundColorVendaTotal?> justify-content-between flex-column px-0 pb-0">
													<!--begin::Statistics-->
													<div class="mb-4 px-9">
														<!--begin::Info-->
														<div class="d-flex align-items-center mb-2">
															<!--begin::Currency-->
															<span class="fs-4 fw-semibold text-white align-self-start me-1&gt;">$</span>
															<!--end::Currency-->
															<!--begin::Value-->
															<?php 
															$valorFormatado = number_format($totalValorAno, 2, ',', '.');
															if(strlen($valorFormatado) >= 10) {$classeTamanhoValor = "qx";} else { $classeTamanhoValor = "hx"; }
															?>
															<span class="fs-2hx fw-bold text-white me-2 lh-1"><?=$valorFormatado?></span>
															<!--end::Value-->
															<!--begin::Label-->
															<?php 
															
															if($percentDiffSaleAnual < 0) {
															?>
															<span class="badge badge-light-danger fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																	<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
																</svg>
															</span>
															<?php
															} else {
															?>
															<span class="badge badge-light-success fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
																</svg>
															</span>
															<?php	
															}
															?>
															
															<!--end::Svg Icon--><?=abs($percentDiffSaleAnual)?>%</span>
															<!--end::Label-->
														</div>
														<!--end::Info-->
														<!--begin::Description-->
														<span class="fs-6 fw-semibold text-white">Venda Total No Ano</span>
														<!--end::Description-->
													</div>
													<!--end::Statistics-->
													<!--begin::Chart-->
													<div id="kt_grafico_vendas_anual" class="min-h-auto" style="height: 125px"></div>
													<!--end::Chart-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 8-->
											<!--begin::Card widget 7-->
											<div class="card card-flush h-md-50 mb-lg-10">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<div class="d-flex align-items-center">
															<!--begin::Amount-->
															<?php $clientesNovosAno = retornaTotalClientesNovosAno($ano); ?>
															<span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2"><?=$clientesNovosAno?></span>
															<!--end::Amount-->
															<!--begin::Label-->
															<?php 
															$percentDiffSaleAnual = retornaDiferencaClientesNovosComparadaComAnoAnterior($ano, $codFabrica);
															if($percentDiffSaleAnual != 0){
															if($percentDiffSaleAnual < 0) {
															?>
															<span class="badge badge-light-danger fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																	<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
																</svg>
															</span>
															<?php
															} else {
															?>
															<span class="badge badge-light-success fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
																</svg>
															</span>
															<?php	
															}
															?>
															
															<!--end::Svg Icon--><?=abs($percentDiffSaleAnual)?></span>
															<?php } ?>
															<!--end::Label-->
														</div>
														
														<!--begin::Subtitle-->
														<span class="fs-6 fw-semibold text-gray-400"><?php if($clientesNovosAno == 1) { echo "Novo Cliente"; } else { echo "Novos Clientes"; } ?></span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex flex-column justify-content-end">
													<!--begin::Title-->
													<span class="fs-6 fw-bold text-gray-800 d-block mb-2">Últimos Clientes Cadastrados</span>
													<!--end::Title-->
													<!--begin::Users group-->
													<div class="symbol-group symbol-hover">
														<?php
														if($codFabrica){
															$result = $conexao->sql("SELECT cli.* FROM sys_cliente cli, sys_cliente_fabrica f WHERE cli.cd_cliente = f.cd_cliente AND f.cd_fabrica = $codFabrica ORDER BY dt_cadastro DESC LIMIT 6");
															
														} else {
															$result = $conexao->sql("SELECT * FROM `sys_cliente` $where ORDER BY dt_cadastro DESC LIMIT 6");
														}
														
														while ($dadosCliente = mysql_fetch_assoc($result)) {
															$codCliente = $dadosCliente['cd_cliente'];
															$nomeCliente = myStripSlashes($dadosCliente['tl_fantasia']);
															$fotoClientePerfil = $dadosCliente['fl_foto_perfil'];
															$urlPerfilCliente = "images/clientes/perfil_".$codCliente."p.jpg";
															$arrayClasse = array("primary", "info", "warning", "danger");
															$classeAleatoria = array_rand($arrayClasse);
														?>													
														<a href="apps/clientes/clientePerfil.php?codCliente=<?=$codCliente?>" class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?=$nomeCliente?>">
															<?php if($fotoClientePerfil == 1){?>
															<img alt="Pic" src="<?=$urlPerfilCliente?>" />
															<?php } else { ?>
															<span class="symbol-label bg-<?=$arrayClasse[$classeAleatoria]?> text-inverse-<?=$arrayClasse[$classeAleatoria]?> fw-bold"><?=$nomeCliente[0]?></span>
															<?php } ?>	
														</a>
														
														<?php } ?>
														<a href="apps/clientes/cliente.php" class="symbol symbol-35px symbol-circle">
															<span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+<?=retornaTotalClientes($codFabrica)-6?></span>
														</a>
													</div>
													<!--end::Users group-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 7-->
										</div>
										<div class="col-md-6 col-xl-6 mb-md-5 mb-xxl-10">
										<?php 
											$percentDiffSaleAnual = retornaDiferencaParesComparadaComAnoAnterior($ano, $codFabrica);
											if($percentDiffSaleAnual < 0) {
												$backgroundColorParesTotal = "bg-danger";
											} else {
												$backgroundColorParesTotal = "bg-success";
											}
											?>
										
											<!--begin::Card widget 9-->
											<div class="card overflow-hidden h-md-50 mb-5 mb-lg-10">
												<!--begin::Card body-->
												<div class="card-body d-flex <?=$backgroundColorParesTotal?> justify-content-between flex-column px-0 pb-0">
													<!--begin::Statistics-->
													<div class="mb-4 px-9">
														<!--begin::Statistics-->
														<div class="d-flex align-items-center mb-2">
															<!--begin::Currency-->
															
															<!--end::Currency-->
															<!--begin::Value-->
															<span class="fs-2hx fw-bold text-white me-2 lh-1"><?=number_format($totalParesAno, 0, ',', '.')?></span>
															<!--end::Value-->
															<!--begin::Label-->
															<?php 
															if($percentDiffSaleAnual < 0) {
															?>
															<span class="badge badge-light-danger fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																	<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
																</svg>
															</span>
															<?php } else { ?>
															<span class="badge badge-light-success fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
																</svg>
															</span>
															<?php } ?>
															
															<!--end::Svg Icon--><?=abs($percentDiffSaleAnual)?>%</span>
															<!--end::Label-->
														</div>
														<!--end::Statistics-->
														<!--begin::Description-->
														<span class="fs-6 fw-semibold text-white">Total de Pares Vendidos</span>
														<!--end::Description-->
													</div>
													<!--end::Statistics-->
													<!--begin::Chart-->
													<div id="kt_grafico_pares_anual" class="min-h-auto" style="height: 125px"></div>
													<!--end::Chart-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 9-->
											<!--begin::Card widget 7-->
											<div class="card card-flush h-md-50 mb-lg-10">
												<!--begin::Header-->
												<div class="card-header pt-5">
													<!--begin::Title-->
													<div class="card-title d-flex flex-column">
														<div class="d-flex align-items-center">
															<!--begin::Amount-->
															<?php $contatosNovosAno = retornaTotalContatoNovosAno($ano, $codFabrica); ?>
															<span class="fs-2hx fw-bold text-dark me-2 lh-1"><?=$contatosNovosAno?></span>
															<!--end::Amount-->
															<!--begin::Label-->
															<?php 
															$percentDiffSaleAnual = retornaDiferencaContatosNovosComparadaComAnoAnterior($ano, $codFabrica);
															if($percentDiffSaleAnual != 0){
															if($percentDiffSaleAnual < 0) {
															?>
															<span class="badge badge-light-danger fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																	<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
																</svg>
															</span>
															<?php
															} else {
															?>
															<span class="badge badge-light-success fs-base">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr067.svg-->
															<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor"></rect>
																	<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor"></path>
																</svg>
															</span>
															<?php	
															}
															?>
															
															<!--end::Svg Icon--><?=abs($percentDiffSaleAnual)?></span>
															<?php } ?>
															<!--end::Label-->
														</div>
														
														<!--begin::Subtitle-->
														<span class="text-gray-400 pt-1 fw-bold fs-6"><?php if($contatosNovosAno == 1) { echo "Novo Contato"; } else { echo "Novos Contatos"; } ?></span>
														<!--end::Subtitle-->
													</div>
													<!--end::Title-->
												</div>
												<!--end::Header-->
												<!--begin::Card body-->
												<div class="card-body d-flex flex-column justify-content-end">
													<!--begin::Title-->
													<span class="fs-6 fw-bold text-gray-800 d-block mb-2">Últimos Contatos Cadastrados</span>
													<!--end::Title-->
													<!--begin::Users group-->
													<div class="symbol-group symbol-hover">
														<?php
														if($codFabrica){
															$result = $conexao->sql("SELECT con.* FROM sys_contato con, sys_contato_fabrica f WHERE con.cd_contato = f.cd_contato AND f.cd_fabrica = $codFabrica ORDER BY dt_cadastro DESC LIMIT 6");
														} else {
															$result = $conexao->sql("SELECT * FROM `sys_contato` ORDER BY dt_cadastro DESC LIMIT 6");
														}
														while ($dadosContato = mysql_fetch_assoc($result)) {
															$codContato = $dadosContato['cd_contato'];
															$nomeContato = myStripSlashes($dadosContato['tl_contato'])." ".myStripSlashes($dadosContato['tl_sobrenome']);
															$iniciaisContato = $dadosContato['tl_contato'][0].$dadosContato['tl_sobrenome'][0];
															$arrayClasse = array("primary", "info", "warning", "danger");
															$classeAleatoria = array_rand($arrayClasse);

															$fl_foto_perfil_contato = $dadosContato['fl_foto_perfil'];
															if($fl_foto_perfil_contato == 1){
																//Verifica se tem arquivo salvo no servidor:
																$imagem = URL_PATH.'/images/contatos/perfil_'.$dadosContato['cd_contato'].'g.jpg';
																if(@getimagesize($imagem)){
																	$imagem = 'images/contatos/perfil_'.$dadosContato['cd_contato'].'g.jpg';
																} else if(strlen($dadosContato['ds_foto_perfil_url']) != 0){
																	$imagem = $dadosContato['ds_foto_perfil_url'];
																} else {
																	$imagem = 'assets/media/icons/duotune/general/gen006.svg';
																}
															} 
														?>													
														<a href="apps/contatos/contatoPerfil.php?codContato=<?=$codContato?>" class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="<?=$nomeContato?>">
															<?php if($fl_foto_perfil_contato == 1){?>
															<img alt="Pic" src="<?=$imagem?>" />
															<?php } else { ?>
															<span class="symbol-label bg-<?=$arrayClasse[$classeAleatoria]?> text-inverse-<?=$arrayClasse[$classeAleatoria]?> fw-bold"><?=$iniciaisContato?></span>
															<?php } ?>	
														</a>
														
														<?php } ?>
														<a href="apps/contatos/contato.php" class="symbol symbol-35px symbol-circle">
															<span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+<?=retornaTotalContatos($codFabrica)-6?></span>
														</a>
													</div>
													<!--end::Users group-->
												</div>
												<!--end::Card body-->
											</div>
											<!--end::Card widget 7-->
										</div>
									</div>
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-6 mb-5 mb-lg-10">
									<!--begin::Maps widget 1-->
									<div class="card card-flush h-md-100">
										<!--begin::Header-->
										<div class="card-header pt-7">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-dark">Cobertura de Vendas</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">Países Atendidos</span>
											</h3>
											<!--end::Title-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body d-flex flex-center">
											<!--begin::Map container-->
											<div id="kt_maps_widget_1_map" class="w-100 h-350px"></div>
											<!--end::Map container-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Maps widget 1-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
							<!--begin::Row-->
							<div class="row gy-5 g-xl-10">
								<!--begin::Col-->
								<div class="col-xl-4 mb-5 mb-xl-10">
									<!--begin::List widget 8-->
									<div class="card card-flush h-xl-100">
										<!--begin::Header-->
										<div class="card-header pt-7 mb-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-800">Top 6 Clientes</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">Melhor Performance no ano.</span>
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<a href="#" class="btn btn-sm btn-light">Ver Todos</a>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-0">
											<!--begin::Item-->
											<?php
											if($codFabrica != ''){
												$resultTopClientes = $conexao->sql("SELECT cli.cd_cliente as cliente, cli.tl_razao, cli.tl_fantasia, cli.fl_foto_perfil, (SELECT sum(pp.qt_itens) as totalPares from sys_processo_pedido_pedido pp, sys_processo_pedido pr WHERE pp.cd_processo_pedido = pr.cd_processo_pedido AND YEAR(pr.dt_entrega) = $ano AND pr.cd_cliente = cliente AND pr.cd_fabrica = $codFabrica) as totalPares FROM sys_cliente cli, sys_cliente_fabrica f WHERE cli.cd_cliente = f.cd_cliente AND f.cd_fabrica = $codFabrica ORDER BY totalPares DESC LIMIT 6", $codSecao, $secao);
											} else {
												$resultTopClientes = $conexao->sql("SELECT cd_cliente as cliente, tl_razao, tl_fantasia, fl_foto_perfil, (SELECT sum(pp.qt_itens) as totalPares from sys_processo_pedido_pedido pp, sys_processo_pedido pr WHERE pp.cd_processo_pedido = pr.cd_processo_pedido AND YEAR(pr.dt_entrega) = $ano AND pr.cd_cliente = cliente) as totalPares FROM sys_cliente ORDER BY totalPares DESC LIMIT 6", $codSecao, $secao);
											}
											$rowIdTopClientes = 6;
											while ($dadosTopClientes = mysql_fetch_assoc($resultTopClientes)) {
												$rowIdTopClientes = $rowIdTopClientes - 1;
												if($dadosTopClientes['totalPares'] != ''){
											?>
											<div class="d-flex flex-stack">
												<!--begin::Section-->
												<div class="d-flex align-items-center me-5">
													<!--begin::Flag-->
													<?php if($dadosTopClientes['fl_foto_perfil'] == 1){?>
													<img src="images/clientes/perfil_<?=$dadosTopClientes['cliente']?>p.jpg" class="me-4 w-25px" style="border-radius: 4px" alt="" />
													<?php } else { ?>
													<div class="symbol symbol-25px me-4">
													<div class="symbol-label fs-2 fw-bold text-success"><?=$dadosTopClientes['tl_fantasia'][0]?></div>
													</div>
													<?php } ?>
													<!--end::Flag-->
													<!--begin::Content-->
													<div class="me-5">
														<!--begin::Title-->
														<a href="apps/clientes/clientePerfil.php?codCliente=<?=$dadosTopClientes['cliente']?>" class="text-gray-800 fw-bold text-hover-primary fs-6"><?=$dadosTopClientes['tl_fantasia']?></a>
														<!--end::Title-->
														<!--begin::Desc-->
														<span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0"><?=retornaNomePais(retornaPaisDoCliente($dadosTopClientes['cliente']))?></span>
														<!--end::Desc-->
													</div>
													<!--end::Content-->
												</div>
												<!--end::Section-->
												<!--begin::Wrapper-->
												<div class="d-flex align-items-center">
													<!--begin::Number-->
													<span class="text-gray-800 fw-bold fs-6 me-3"><?=number_format($dadosTopClientes['totalPares'], 0, ',', '.')?></span>
													<!--end::Number-->
													<!--begin::Info-->
													<div class="">
														<!--begin::Label-->
														<?php 
														$percentDiffSaleAnualCliente = retornaDiferencaParesComparadaComAnoAnteriorPorCliente($ano, $dadosTopClientes['cliente'],$codFabrica);
														if($percentDiffSaleAnualCliente != 0){
															if($percentDiffSaleAnualCliente == -100){
																$percentDiffSaleAnualCliente = "NOVO";
														?>
														<span class="badge badge-light-success fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->	
														<?	} else if($percentDiffSaleAnualCliente < 0) {
																$percentDiffSaleAnualCliente = abs($percentDiffSaleAnualCliente)."%";
														?>
														<span class="badge badge-light-danger fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-danger ms-n1">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
																<path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
															</svg>
														</span>
														<!--end::Svg Icon-->
														<?php
														} else {
															$percentDiffSaleAnualCliente = abs($percentDiffSaleAnualCliente)."%";
														?>
														<span class="badge badge-light-success fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
															</svg>
														</span>
														<?php	
														}
														?>
														<!--end::Svg Icon--><?=$percentDiffSaleAnualCliente?></span>
														<?php } ?>
														<!--end::Label-->
													</div>
													<!--end::Info-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Item-->
											<?php 
												
											if($rowIdTopClientes != 0){?>
											<!--begin::Separator-->
											<div class="separator separator-dashed my-3"></div>
											<?php } } }?>
											<!--end::Separator-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::LIst widget 8-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-4 mb-5 mb-xl-10">
									<!--begin::List widget 9-->
									<div class="card card-flush h-xl-100">
										<!--begin::Header-->
										<div class="card-header pt-7">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-800">Próximos Embarques</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">Atrasados e Próximos</span>
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<a href="#" class="btn btn-sm btn-light">Ver Todos</a>
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-5">
											<?php 
												$where = ($codFabrica) ? "AND p.cd_fabrica = '".$codFabrica."'" : '';
												$resultProcesso = $conexao->sql("SELECT p.*, c.tl_razao, s.tl_status, t.ds_tipo_pagto, c.fl_foto_perfil
																					FROM sys_processo_pedido p
																					JOIN sys_cliente c ON p.cd_cliente = c.cd_cliente
																					JOIN sys_processo_status s ON p.cd_status = s.cd_status
																					JOIN sys_processo_tipo_pgto t ON p.cd_tipo_pagto = t.cd_tipo_pagto
																					WHERE p.cd_status != 5
																					ORDER BY
																					CASE WHEN p.qt_entrega_revisada <> 0 THEN p.dt_entrega_revisada ELSE p.dt_entrega END ASC
																					LIMIT 6", $codSecao, $secao);
												$numRowsProcessoAtrasado = mysql_num_rows($resultProcesso);
												while ($dados = mysql_fetch_array($resultProcesso)) {
													$cd_processo = $dados['cd_processo_pedido'];
													$cd_fabrica = $dados['cd_fabrica'];
													$tagFabrica = retornaTagFabrica($cd_fabrica);
													$ds_proforma = $tagFabrica.$dados['ds_proforma'];
													$tl_cliente = myStripSlashes($dados['tl_razao']);		                	
													$dt_entrega = convDateToAnsi($dados['dt_entrega']);
													
													$rowIdProcessoAtrasado = $rowIdProcessoAtrasado - 1;
													$diasAtrasado = ($dados['qt_entrega_revisada'] == 0) ? retornaDiferencaEntreDatas(date('Y-m-d'), $dados['dt_entrega']) : retornaDiferencaEntreDatas(date('Y-m-d'), $dados['dt_entrega_revisada']);
													if ($diasAtrasado <= 0) {
														$classeAtrasado = 'danger';
													} else if ($diasAtrasado >= 1 && $diasAtrasado <= 15) {
														$classeAtrasado = 'warning';
													} else if ($diasAtrasado > 16) {
														$classeAtrasado = 'success';
													}
											?>
											<!--begin::Item-->
											<div class="d-flex flex-stack">
												<!--begin::Section-->
												<div class="d-flex align-items-center me-5">
													<!--begin::Flag-->
													<?php if($dados['fl_foto_perfil'] == 1){?>
													<img src="images/clientes/perfil_<?=$dados['cd_cliente']?>p.jpg" class="me-4 w-25px" style="border-radius: 4px" alt="" />
													<?php } else { ?>
													<div class="symbol symbol-25px me-4">
													<div class="symbol-label fs-2 fw-bold text-success"><?=$tl_cliente[0]?></div>
													</div>
													<?php } ?>
													<!--end::Flag-->
													<!--begin::Content-->
													<div class="me-5">
														<!--begin::Title-->
														<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6"><?=$ds_proforma?></a>
														<!--end::Title-->
														<!--begin::Desc-->
														<span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0"><?=$tl_cliente?></span>
														<!--end::Desc-->
													</div>
													<!--end::Content-->
												</div>
												<!--end::Section-->
												<!--begin::Wrapper-->
												<div class="d-flex align-items-center">
													<!--begin::Info-->
													<div class="">
														<!--begin::Label-->
														<span class="badge badge-light-<?=$classeAtrasado?> px-2"><?=abs($diasAtrasado)?> Dias</span>
														<!--end::Label-->
													</div>
													<!--end::Info-->
												</div>
												<!--end::Wrapper-->
											</div>
											<!--end::Item-->
											<?php if($rowIdProcessoAtrasado != 0){?>
											<!--begin::Separator-->
											<div class="separator separator-dashed my-3"></div>
											<?php } } ?>
										</div>
										<!--end::Body-->
									</div>
									<!--end::List widget 9-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xxl-4 mb-5 mb-lg-10">
									<!--begin::Chart widget 14-->
									<div class="card card-flush h-xl-100">
										<!--begin::Header-->
										<div class="card-header pt-7">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-dark">Metas</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">Performance de cada Fábrica</span>
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												<!--begin::Menu-->
												<button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
													<!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
													<i class="ki-duotone ki-dots-square fs-1 text-gray-300 me-n1">
														<span class="path1"></span>
														<span class="path2"></span>
														<span class="path3"></span>
														<span class="path4"></span>
													</i>
													<!--end::Svg Icon-->
												</button>
												<!--begin::Menu 3-->
												<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
													<!--begin::Heading-->
													<div class="menu-item px-3">
														<div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
													</div>
													<!--end::Heading-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link px-3">Create Invoice</a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link flex-stack px-3">Create Payment
														<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3">
														<a href="#" class="menu-link px-3">Generate Bill</a>
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
														<a href="#" class="menu-link px-3">
															<span class="menu-title">Subscription</span>
															<span class="menu-arrow"></span>
														</a>
														<!--begin::Menu sub-->
														<div class="menu-sub menu-sub-dropdown w-175px py-4">
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<a href="#" class="menu-link px-3">Plans</a>
															</div>
															<!--end::Menu item-->
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<a href="#" class="menu-link px-3">Billing</a>
															</div>
															<!--end::Menu item-->
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<a href="#" class="menu-link px-3">Statements</a>
															</div>
															<!--end::Menu item-->
															<!--begin::Menu separator-->
															<div class="separator my-2"></div>
															<!--end::Menu separator-->
															<!--begin::Menu item-->
															<div class="menu-item px-3">
																<div class="menu-content px-3">
																	<!--begin::Switch-->
																	<label class="form-check form-switch form-check-custom form-check-solid">
																		<!--begin::Input-->
																		<input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
																		<!--end::Input-->
																		<!--end::Label-->
																		<span class="form-check-label text-muted fs-6">Recuring</span>
																		<!--end::Label-->
																	</label>
																	<!--end::Switch-->
																</div>
															</div>
															<!--end::Menu item-->
														</div>
														<!--end::Menu sub-->
													</div>
													<!--end::Menu item-->
													<!--begin::Menu item-->
													<div class="menu-item px-3 my-1">
														<a href="#" class="menu-link px-3">Settings</a>
													</div>
													<!--end::Menu item-->
												</div>
												<!--end::Menu 3-->
												<!--end::Menu-->
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-5">
											<!--begin::Chart container-->
											<div id="kt_charts_widget_14_chart" class="w-100 h-350px"></div>
											<!--end::Chart container-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Chart widget 14-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
							<!--begin::Row-->
							<div class="row gy-5 g-xl-10">
								<!--begin::Col-->
								<div class="col-xl-4 mb-5 mb-xl-10">
									<!--begin::List widget 12-->
									<div class="card card-flush h-xl-100">
										<!--begin::Header-->
										<div class="card-header pt-7">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-800">To Do</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">Preview de Tarefas de Processos e Amostras</span>
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<?php 
										$totalDeTarefasAmostraAtrasada = retornaNumeroTarefasAtrazadasAmostras();
										$totalDeTarefasProcessoAtrasada = retornaNumeroTarefasAtrazadas();
										$totalDeTarefasAmostrasPendentes = retornaNumeroTarefasPendentesAmostras5dias();
										$totalDeTarefasProcessoPendentes = retornaNumeroTarefasPendentes5dias();
										$ListaTotalDeTarefas = $totalDeTarefasAmostraAtrasada + $totalDeTarefasProcessoAtrasada + $totalDeTarefasAmostrasPendentes + $totalDeTarefasProcessoPendentes;
										if($codFabrica){
											$where = "AND p.cd_fabrica = '".$codFabrica."'";
										} else {
											$where = '';
										}
										?>
										
										<!--begin::Body-->
										<div class="card-body">
											<?php if($ListaTotalDeTarefas != 0){?>
											<?php 
											$resultProcessoPedidoTarefa = $conexao->sql("SELECT t.cd_tarefa AS codTarefa, 
																								t.tl_tarefa AS tlTarefa, 
																								t.cd_processo_pedido AS codProcesso, 
																								t.dt_limite AS dtLimite,
																								p.ds_proforma AS dsProforma, 
																								c.tl_razao AS tlCliente,
																								t.cd_usuario as codUsuario
																						FROM 	sys_processo_pedido_tarefa t,
																								sys_processo_pedido p,
																								sys_cliente c
																						WHERE 	t.fl_status = 0 AND
																								t.cd_processo_pedido = p.cd_processo_pedido AND 
																								p.cd_cliente = c.cd_cliente
																								$where
																						UNION SELECT 	t.cd_tarefa as codTarefa, 
																										t.tl_tarefa as tlTarefa, 
																										t.cd_processo_amostra as codProcesso, 
																										t.dt_limite as dtLimite,
																										p.ds_proforma AS dsProforma, 
																										c.tl_razao AS tlCliente,
																										t.cd_usuario as codUsuario   
																						FROM 	sys_processo_amostra_tarefa t,
																								sys_processo_amostra p, 
																								sys_cliente c 
																						WHERE 	t.fl_status = 0 AND
																								t.cd_processo_amostra = p.cd_processo_amostra AND 
																								p.cd_cliente = c.cd_cliente
																								$where
																						ORDER BY dtLimite ASC
																						LIMIT 5");
											while($dadosTarefasProcessoPedido = mysql_fetch_assoc($resultProcessoPedidoTarefa)) {
											$tipoProforma = 1;
											$codProforma = $dadosTarefasProcessoPedido['dsProforma'];
											if(is_numeric($codProforma[2])){
												$tipoProforma = 2;
											}
											$cd_tarefa_atrazada = $dadosTarefasProcessoPedido['codTarefa'];
											$cd_processo_tarefa = $dadosTarefasProcessoPedido['codProcesso'];
											if($tipoProforma == 2){
												$cd_fabrica_tarefa_atrazada = retornaFabricaDoProcesso($cd_processo_tarefa);
												$tagFabrica_tarefa_atrazada = retornaTagFabrica($cd_fabrica_tarefa_atrazada);
												$ds_proforma_atrazada = $tagFabrica_tarefa_atrazada.$dadosTarefasProcessoPedido['dsProforma'];
											} else {
												$cd_fabrica_tarefa_atrazada = retornaFabricaDaAmostra($cd_processo_tarefa);
												$tagFabrica_tarefa_atrazada = retornaTagFabrica($cd_fabrica_tarefa_atrazada);
												$ds_proforma_atrazada = $dadosTarefasProcessoPedido['dsProforma'];
											}
											$tl_tarefa_atrazada = myStripSlashes($dadosTarefasProcessoPedido['tlTarefa']);
											$fl_status_atrazada = $dadosTarefasProcessoPedido['fl_status'];
											
											$ds_cliente_atrazada = $dadosTarefasProcessoPedido['tlCliente'];
											$cd_usuario_tarefa = $dadosTarefasProcessoPedido['codUsuario'];
											$dadosUsuarioTarefa = retornaDadosUsuario($cd_usuario_tarefa);
											$fl_foto_perfil = $dadosUsuarioTarefa['foto_perfil'];
											$dataAtual = date('Y-m-d');
											$data = convDateToAnsi($dadosTarefasProcessoPedido['dtLimite']);
											$classeStatus = "muted";
											$tip = "";


											if(strtotime($dadosTarefasProcessoPedido['dtLimite']) < strtotime($dataAtual) && $dadosTarefasProcessoPedido[$i]['fl_status'] == 0){	
												$classeStatus = "danger";
												$tip = "Atrasada";
												$data = humanTiming($dadosTarefasProcessoPedido['dtLimite']);
												$classeData = "font-weight-bolder text-danger";
											} else if($dadosTarefasProcessoPedido['dtLimite'] == $dataAtual && $dadosTarefasProcessoPedido['fl_status'] == 0){
												$classeStatus = "info";
												$tip = "é pra Hoje!";
												$data = "Hoje";
												$classeData = "font-weight-bolder text-info";
											} else if (strtotime($dadosTarefasProcessoPedido['dtLimite']) !== FALSE && strtotime($dadosTarefasProcessoPedido['dtLimite']) < strtotime('+5 days') && strtotime($dadosTarefasProcessoPedido['dtLimite']) != strtotime('today')){
												$classeStatus = "warning";
												$tip = "Daqui a alguns dias";
												$classeData = "text-warning";
											}  else {
												$classeStatus = "muted";
												$tip = "Tarefa Futura!";
												$classeData = "font-weight-bolder text-muted";
											}											
											?>
											<!--begin::Item-->
											<div class="d-flex align-items-center mb-8">
												<!--begin::Bullet-->
												<span class="bullet bullet-vertical h-40px bg-<?=$classeStatus?>"></span>
												<!--end::Bullet-->
												<!--begin::Description-->
												<div class="flex-grow-1 mx-5">
													<a href="<?=URL_PATH?>/apps/processos/processoPedidoTarefa.php?codProcessoPedido=<?=$cd_processo_tarefa?>" class="text-gray-800 text-hover-primary fw-bold fs-6"><?=$tl_tarefa_atrazada?></a>
													<span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0"><?=$ds_proforma_atrazada?> - <?=$ds_cliente_atrazada?></span>
												</div>
												<!--end::Description-->
												<span class="badge badge-light-<?=$classeStatus?> fs-8 fw-bold"><?=$data?></span>
											</div>
											<!--end:Item-->
											<?php } ?>
											<!--begin::Link-->
											<div class="text-center pt-8 d-1">
												<a href="/metronic8/demo3/../demo3/apps/ecommerce/sales/details.html" class="text-primary opacity-75-hover fs-6 fw-bold">Gerenciador de Tarefas 
												<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
												<span class="svg-icon svg-icon-3 svg-icon-primary">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
														<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon--></a>
											</div>
											<!--end::Link-->
											<?php } else {?>
											<div data-kt-search-element="empty" class="text-center">
												<!--begin::Message-->
												<div class="fw-bold">
													<div class="text-gray-600 fs-3 mb-2">Parabéns</div>
													<div class="text-muted fs-6">Nenhuma tarefa atrasada nem a caminho nos próximos dias.</div>
												</div>
												<!--end::Message-->
												<!--begin::Illustration-->
												<div class="text-center px-5">
													<img src="assets/media/illustrations/dozzy-1/1.png" alt="" class="w-100 h-200px h-sm-250px">
												</div>
												<!--end::Illustration-->
											</div>
											<?php }?>
										</div>
										<!--end::Body-->
									</div>
									<!--end::List widget 12-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<div class="col-xl-8 mb-5 mb-xl-10">
									<!--begin::Chart widget 15-->
									<div class="card card-flush h-xl-100">
										<!--begin::Header-->
										<div class="card-header pt-7">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-dark">Ranking de Países</span>
												<span class="text-gray-400 pt-2 fw-semibold fs-6">10 Países Maiores Compradores</span>
											</h3>
											<!--end::Title-->
											<!--begin::Toolbar-->
											<div class="card-toolbar">
												
											</div>
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-5">
											<!--begin::Chart container-->
											<div id="kt_charts_widget_15_chart" class="w-100 h-400px"></div>
											<!--end::Chart container-->
										</div>
										<!--end::Body-->
									</div>
									<!--end::Chart widget 15-->
								</div>
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Content-->
<?php include("layout/_footer.php") ?>
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<!--end::Main-->
<?php include("layout/_scrolltop.php") ?>		
<!--begin::Javascript-->	
<?php include("layout/_js.php") ?>	
<!--begin::Page Custom Javascript(used by this page)-->
<?php include_once("assets/js/custom/".$nomeArquivo.".php") ?>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
<?php include("layout/_end.php") ?>