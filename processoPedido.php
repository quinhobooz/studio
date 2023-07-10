<?php
include("config.php");
$codSecao = 56;
$dadosSecao = retornaDadosSecao($codSecao);

$titSecao = $secao = "Processos";
$breadcumbs = array (
  array("Processos","#")
);
$breadcumbsAtual = "Lista";
$nomeArquivo = $dadosSecao['tl_arquivo'];

if(isset($_GET['codFabrica'])){
	$codFabrica = $_GET['codFabrica'];
}

$ano = date('Y');
if(isset($_GET['ano'])){ $ano = $_GET['ano'];}

function confereProcessosEmAbertoNoMes($mes, $ano){
	
	global $conexao;
	
	$result = $conexao->sql("SELECT count(p.cd_processo_pedido) as totalProcessos
								FROM 
								sys_processo_pedido p
								WHERE 
								MONTH(dt_entrega) = $mes AND YEAR(dt_entrega) = $ano AND
								p.cd_status != 5
								ORDER BY dt_entrega
							 ");
	while($dados = mysql_fetch_array($result)) {
		$total = $dados['totalProcessos'];	
	}
	return $total;
	
}
function confereProcessosEmAbertoNoAno($ano, $codFabrica){
	
	global $conexao;
	
	if($codFabrica != ''){
		$where = "AND p.cd_fabrica = '".$codFabrica."'";
	} else {
		$where = '';
	}
	
	$result = $conexao->sql("SELECT count(p.cd_processo_pedido) as totalProcessos
								FROM 
								sys_processo_pedido p
								WHERE 
								YEAR(dt_entrega) = $ano AND
								p.cd_status != 5
								$where
								ORDER BY dt_entrega
							 ");
	while($dados = mysql_fetch_array($result)) {
		$total = $dados['totalProcessos'];	
	}
	return $total;
	
}

function confereProcessosFaturadosNoMes($mes, $ano){
	
	global $conexao;
	
	$result = $conexao->sql("SELECT count(p.cd_processo_pedido) as totalProcessos
								FROM 
								sys_processo_pedido p
								WHERE 
								MONTH(dt_entrega) = $mes AND YEAR(dt_entrega) = $ano AND
								p.cd_status = 5
								ORDER BY dt_entrega
							 ");
	while($dados = mysql_fetch_array($result)) {
		$total = $dados['totalProcessos'];	
	}
	return $total;
	
}

function retornaPagamentosProcessoPedido($codProcesso) {
	global $conexao;
	
	$result = $conexao->sql("SELECT *
							 FROM sys_processo_pedido_pagamento
							 WHERE cd_processo_pedido = $codProcesso
							 ORDER BY dt_pagamento
							 ");
	while($dados = mysql_fetch_array($result)) {
		$codigo = $dados['cd_pagamento'];
		$nr_pagamento = myStripSlashes($dados['nr_pagamento']);
		$dt_pagamento = convDateToAnsi(myStripSlashes($dados['dt_pagamento']));
		$vl_pagamento = 'USD '.number_format($dados['vl_pagamento'], 2, ',', '.');
		$fl_comprovante = $dados['fl_comprovante'];
		
		$arDados[] = array('codigo' => $codigo,
						   'nr_pagamento' => $nr_pagamento,
						   'dt_pagamento' => $dt_pagamento,
						   'vl_pagamento' => $vl_pagamento,
						   'fl_comprovante' => $fl_comprovante);
	}
	return $arDados;
}

function retornaTotalPagoProcessoPedido($codProcesso){
	global $conexao;
	
	$result = $conexao->sql("SELECT sum(vl_pagamento) as total
							 FROM sys_processo_pedido_pagamento
							 WHERE cd_processo_pedido = $codProcesso");
							 
	$dados = mysql_fetch_assoc($result);
	
	
	return $dados["total"];
}
?>
<?php include("layout/_head.php") ?>
		
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
						<div class="container-xxl" id="kt_content_container">
							<!--begin::Stats-->
							<div class="row g-6 g-xl-9">
								<div class="col-lg-6 col-xxl-4">
									<div class="card card-xxl-stretch mb-5 mb-xl-8 theme-dark-bg-body" style="background-color: #F7D9E3">
										<!--begin::Body-->
										<div class="card-body d-flex flex-column">
											<!--begin::Wrapper-->
											<div class="d-flex flex-column flex-grow-1">
												<!--begin::Title-->
												<a href="#" class="text-dark text-hover-primary fw-bold fs-3 mb-3">Processos Ativos</a>
												<!--end::Title-->
												<!--begin::Chart-->
												
												<!--end::Chart-->
											</div>
											<!--end::Wrapper-->
											<!--begin::Stats-->
											<div class="pt-5">
												<!--begin::Number-->
												<span class="text-dark fw-bold fs-3x me-2 lh-0">47</span>
												<!--end::Number-->
												<!--begin::Text-->
												<span class="text-dark fw-bold fs-6 lh-0"></span>
												<!--end::Text-->
											</div>
											<!--end::Stats-->
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-xxl-4">
									<div class="card card-xxl-stretch mb-5 mb-xl-8 theme-dark-bg-body" style="background-color: #CBF0F4">
										<!--begin::Body-->
										<div class="card-body d-flex flex-column">
											<!--begin::Wrapper-->
											<div class="d-flex flex-column flex-grow-1">
												<!--begin::Title-->
												<a href="#" class="text-dark text-hover-primary fw-bold fs-3 mb-3">Valor Ativo</a>
												<!--end::Title-->
											</div>
											<!--end::Wrapper-->
											<!--begin::Stats-->
											<div class="pt-5">
												<!--begin::Symbol-->
												<span class="text-dark fw-bold fs-2x lh-0">$</span>
												<!--end::Symbol-->
												<!--begin::Number-->
												<span class="text-dark fw-bold fs-3x me-2 lh-0">560.409,49</span>
												<!--end::Number-->
											</div>
											<!--end::Stats-->
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-xxl-4">
									<div class="card card-xxl-stretch mb-5 mb-xl-8 theme-dark-bg-body" style="background-color: #CBD4F4">
										<!--begin::Body-->
										<div class="card-body d-flex flex-column">
											<!--begin::Wrapper-->
											<div class="d-flex flex-column flex-grow-1">
												<!--begin::Title-->
												<a href="#" class="text-dark text-hover-primary fw-bold fs-3 mb-3">Itens Ativos</a>
												<!--end::Title-->
												<!--begin::Chart-->
												
												<!--end::Chart-->
											</div>
											<!--end::Wrapper-->
											<!--begin::Stats-->
											<div class="pt-5">
												<!--begin::Number-->
												<span class="text-dark fw-bold fs-3x me-2 lh-0">32.347</span>
												<!--end::Number-->
												<!--begin::Text-->
												<span class="text-dark fw-bold fs-6 lh-0"></span>
												<!--end::Text-->
											</div>
											<!--end::Stats-->
										</div>
									</div>
								</div>
							</div>
							<!--end::Stats-->
							<!--begin::Toolbar-->
							<div class="d-flex flex-wrap flex-stack my-5">
								<!--begin::Heading-->
								<h2 class="fs-2 fw-bold my-2">Processos
								<span class="fs-6 text-gray-400 ms-1">Por Ordem de Entrega</span></h2>
								<!--end::Heading-->
								<!--begin::Controls-->
								<div class="d-flex flex-wrap my-1">
									<!--begin::Select wrapper-->
									<div class="m-lg-1">
										<!--begin::Select-->
										<select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body border-body fw-bolder w-125px">
											<option value="Active" selected="selected">Active</option>
											<option value="Approved">In Progress</option>
											<option value="Declined">To Do</option>
											<option value="In Progress">Completed</option>
										</select>
										<!--end::Select-->
									</div>
									<div class="m-lg-1">
										<a href="#" class="btn btn-sm btn-light-primary">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
										<span class="svg-icon svg-icon-2">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
												<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
											</svg>
										</span>
										<!--end::Svg Icon-->Novo Processo</a>
									</div>
									<!--end::Select wrapper-->
								</div>
								<!--end::Controls-->
							</div>
							<!--end::Toolbar-->
							
							<?php 
							if(isset($_GET['codFabrica'])){
								$where = "WHERE cd_fabrica = '".$codFabrica."'";
							} else {
								$where = '';
							}
							$resultAno = $conexao->sql("SELECT YEAR(dt_entrega) as ano FROM sys_processo_pedido $where GROUP BY YEAR(dt_entrega) ORDER BY dt_entrega ASC ", $codSecao, $secao);
							//print_r($conexao->getQuery());
							
							while ($dados = mysql_fetch_assoc($resultAno)) {
								$ano = $dados['ano'];
								
								if(isset($_GET['codFabrica'])){
									$totalPedidosAbertosNoAno = confereProcessosEmAbertoNoAno($ano, $_GET['codFabrica']);
								} else {
									$totalPedidosAbertosNoAno = confereProcessosEmAbertoNoAno($ano, '');
								}
								//print_r($totalPedidosAbertosNoAno);
								
								if($totalPedidosAbertosNoAno != 0){
									if(isset($_GET['codFabrica'])){
										$where = "AND cd_fabrica = '".$codFabrica."'";
									} else {
										$where = '';
									}
									$result = $conexao->sql("SELECT MONTH(dt_entrega) as mes FROM sys_processo_pedido WHERE YEAR(dt_entrega) = $ano $where GROUP BY MONTH(dt_entrega) ORDER BY dt_entrega ASC ", $codSecao, $secao);
							
									$numRows = mysql_num_rows($result);
									while ($dados = mysql_fetch_array($result)) {
										$mes = $dados['mes'];
										$nomeMes = convMonthsToPtBr(date("F", mktime(0, 0, 0, $mes, 10)));
										
										$date = strtotime($ano.'-'.$mes);
										$now = time();
										
										if ( $date < $now ) {
											if(date("m", $date) == date("m", $now)){
												$mesPassou = 'text-primary';
											} else {
												$mesPassou = 'text-danger';
											}
										} else {
											$mesPassou = '';
										}
										$totalPedidosAbertos = confereProcessosEmAbertoNoMes($mes, $ano);
										if($totalPedidosAbertos != 0){
															
							?>
							<!--begin::Tables Widget 11-->
							<div class="card mb-5 mb-xl-8">
								<!--begin::Header-->
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bold fs-3 mb-1 <?=$mesPassou?>"><?=$nomeMes?></span>
										<span class="text-muted mt-1 fw-semibold fs-7"><?=$ano?></span>
									</h3>
									<div class="card-toolbar">
										
									</div>
								</div>
								<!--end::Header-->
								<!--begin::Body-->
								<div class="card-body py-3">
									<!--begin::Table container-->
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
											<!--begin::Table head-->
											<thead>
												<tr class="fw-bold text-muted">
													<th width="15%">Proforma/Cliente</th>
													<th width="5%">Data de Entrega</th>
													<th width="5%" style="text-align: right;">Total de Itens</th>
													<th width="8%" style="text-align: right;">Valor do Processo</th>
													<th width="2%">% Pago</th>
													<th width="8%">Status</th>
													<th width="15%"class="text-end">Ações</th>
												</tr>
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody>
												<?php 
												if(isset($_GET['codFabrica'])){
													$where = "AND p.cd_fabrica = '".$codFabrica."'";
												} else {
													$where = '';
												}
												$resultProcesso = $conexao->sql("SELECT p.*, c.tl_razao, s.tl_status, t.ds_tipo_pagto, c.*
																										FROM 
																										sys_processo_pedido p,
																										sys_cliente c,
																										sys_processo_status s,
																										sys_processo_tipo_pgto t
																										WHERE 
																										MONTH(dt_entrega) = $mes AND YEAR(dt_entrega) = $ano AND
																										p.cd_cliente = c.cd_cliente AND
																										p.cd_status = s.cd_status AND
																										p.cd_tipo_pagto = t.cd_tipo_pagto AND
																										p.cd_status != 5
																										$where
																										ORDER BY dt_entrega ASC", $codSecao, $secao);
												$numRowsProcesso = mysql_num_rows($resultProcesso);
												while ($dados = mysql_fetch_array($resultProcesso)) {
													$cd_processo = $dados['cd_processo_pedido'];
													$cd_fabrica = $dados['cd_fabrica'];
													$cd_cliente = $dados['cd_cliente'];
													$tagFabrica = retornaTagFabrica($cd_fabrica);
													$ds_proforma = $tagFabrica.$dados['ds_proforma'];
													$tl_cliente = myStripSlashes($dados['tl_razao']);		                	
													$qt_sapato = number_format(retornaPedidos($cd_processo, 1), 0, ',', '.');
													$qt_bolsa = number_format(retornaPedidos($cd_processo, 2), 0, ',', '.');
													$qt_cinto = number_format(retornaPedidos($cd_processo, 3), 0, ',', '.');
													$qt_carteira = number_format(retornaPedidos($cd_processo, 4), 0, ',', '.');
													$qt_biju = number_format(retornaPedidos($cd_processo, 5), 0, ',', '.');
													$qt_acessorio = number_format(retornaPedidos($cd_processo, 6), 0, ',', '.');
													$qt_diversos = number_format(retornaPedidos($cd_processo, 7), 0, ',', '.');
													$tl_status = myStripSlashes($dados['tl_status']);
													$ds_tipo_pagto = myStripSlashes($dados['ds_tipo_pagto']);
													$vl_processo = retornaValordoProcesso($cd_processo);
													$vl_indenizado = $dados['vl_indenizado'];
													$vl_indenizado = number_format($vl_indenizado, 2, ',', '.');
													$vl_processo = $vl_processo - $dados['vl_indenizado'];
													$dt_entrega = strtotime($dados['dt_entrega']);
													$hoje = time();
													$dias = $dt_entrega - $hoje;
													$dias = floor($dias/(60*60*24));
													$cd_moeda = $dados['cd_moeda'];
													switch ($cd_moeda) {
														case 1:
															$ds_moeda = "Dólar";
															$ico_moeda = 'usd';
															$sigla_moeda = "USD";
															break;
														case 2:
															$ds_moeda = "Euro";
															$ico_moeda = 'eur';
															$sigla_moeda = "EUR";
															break;
													}
													//
													
													$ds_peso_bruto = str_replace('.', ',', $dados['ds_peso_bruto']);
													$ds_peso_liquido = str_replace('.', ',', $dados['ds_peso_liquido']);
													$ds_cbm = str_replace('.', ',', $dados['ds_cbm']);
													
													if($dias < 0){
														$classeDias = 'statusProcessoVermelho';
													} else if($dias > 10 || $dias == 0) {
														$classeDias = 'statusProcessoVerde';
													} else {
														$classeDias = 'statusProcessoAmarelo';
													}
													//$vl_processo = money_format('%i', $vl_processo) . "\n";  
													//
													$dadosPagamento = retornaPagamentosProcessoPedido($cd_processo);
													$totalPago = retornaTotalPagoProcessoPedido($cd_processo);
																				
													$percentual = number_format(($totalPago / $vl_processo) * 100);
													//
													if($percentual == 0){
														$classePercentual = 'danger';
													} else if($percentual == 100) {
														$classePercentual = 'success';
													} else {
														$classePercentual = 'warning';
													}
													//
													$vl_processo = number_format($vl_processo, 2, ',', '.');
													
													$cd_status = $dados['cd_status'];
													if($cd_status == 1 || $cd_status == 2 || $cd_status == 4){
														$classeStatus = 'danger';
													} else if($cd_status == 3){
														$classeStatus = 'primary';
													} else if($cd_status == 5){
														$classeStatus = 'success';
													}
													
													$fl_foto_perfil = $dados['fl_foto_perfil'];
													
													$tarefasAtrasadasDoProcesso = retornaQtTarefaAtrazadaDoProcesso($dados['cd_processo_pedido']);
													$porcentagemData = calculaPorcentagemDatas($dados['dt_entrega_pcp'], $dados['dt_entrega']);
													if($porcentagemData > 0 && $porcentagemData < 30){
														$classePercentualData = 'success';
													} else if($porcentagemData > 30 && $porcentagemData < 80) {
														$classePercentualData = 'primary';
													} else if($porcentagemData > 80 && $porcentagemData < 90) {
														$classePercentualData = 'warning';
													} else {
														$classePercentualData = 'danger';
													}
												?>
												<tr rel="<?=$tagFabrica?>">
													<td>
														<div class="d-flex align-items-center">
															<?php if($fl_foto_perfil == 1){?>
															<div class="symbol symbol-40px me-5">
																<img src="images/clientes/perfil_<?=$cd_cliente?>p.jpg" class="" alt="" />
																<?php if($tarefasAtrasadasDoProcesso != 0){?>
																<span class="symbol-badge badge badge-sm badge-circle bg-danger start-100"><?=$tarefasAtrasadasDoProcesso?></span>
																<?php }?>
															</div>
															
															<?php } else {?>
															<div class="symbol symbol-40px">
																<div class="symbol-label fs-2 fw-semibold text-success"><?=$razao[0]?></div>
															</div>
															<?php }?>
															<div class="d-flex justify-content-start flex-column">
																<a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?=$ds_proforma?></a>
																<span class="text-muted fw-semibold text-muted d-block fs-7"><?=$tl_cliente?></span>
															</div>
														</div>
													</td>
													<td>
														<a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"><?=convDateToAnsi($dados['dt_entrega'])?></a>
													</td>
													<td style="text-align: right;">
														<a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"><?=$qt_sapato?></a>
													</td>
													<td style="text-align: right;">
														<a href="#" class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6"><?=$sigla_moeda?> <?=$vl_processo?></a>
													</td>
													<td>
														<span class="badge badge-light-<?=$classePercentual?> badge-sm"><?=$percentual?>%</span>
													</td>
													<td>
														<span class="badge badge-light-<?=$classeStatus?> fs-7 fw-bold"><?=$tl_status?></span>
													</td>
													<td class="text-end">
														<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
															<!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
															<span class="svg-icon svg-icon-3">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
																	<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</a>
														<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
															<!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
															<span class="svg-icon svg-icon-3">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
																	<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</a>
														<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
															<!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
															<span class="svg-icon svg-icon-3">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
																	<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
																	<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
																</svg>
															</span>
															<!--end::Svg Icon-->
														</a>
													</td>
												</tr>
												<?php }?>
												</tbody>
												<tfoot class="fw-bold text-muted">
													<?php 
														$totalSapatos = number_format(retornaQuantidadeTotal(1, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalBolsas = number_format(retornaQuantidadeTotal(2, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalCintos = number_format(retornaQuantidadeTotal(3, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalCarteiras = number_format(retornaQuantidadeTotal(4, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalBijus = number_format(retornaQuantidadeTotal(5, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalAcessorios = number_format(retornaQuantidadeTotal(6, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalDiversos = number_format(retornaQuantidadeTotal(7, $mes, $ano, 0, $codFabrica), 0, ',', '.');
														$totalItens = retornaQuantidadeTotal(1, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(2, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(3, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(4, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(5, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(6, $mes, $ano, 0, $codFabrica) + retornaQuantidadeTotal(7, $mes, $ano, 0, $codFabrica);
														$totalItens = number_format($totalItens, 0, ',', '.');
														$totalValor = 'USD '.number_format(retornaValorTotal($mes, $ano, 0, $codFabrica), 2, ',', '.');
													?>
													<tr>
														<th width="25%" style="font-weight: 500;">Totais</th>
														<th width="5%"></th>
														<th width="8%" style="text-align: right; font-weight: 500;"><?=$totalItens?></th>
														<th width="10%" style="text-align: right; font-weight: 500;"><?=$totalValor?></th>
														<th width="10%"></th>
														<th width="8%"></th>
														<th width="5%"></th>
													</tr>
												</tfoot>	
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Table container-->
								</div>
								
								<!--begin::Body-->
							</div>
							<?php } } } }?>
							<!--end::Tables Widget 11-->
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
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/plugins/custom/bigtext/jquery-bigtext.js"></script>
		
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<?php if($temFullCalendar){?>
		<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<?php } ?>
		<?php if($temDataTable){?>
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<?php } ?>
		<?php if($_temTimeline) {?>
		<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
		<?php } ?>
		<?php if($_temAmCharts){ ?>
		<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
		<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
		<?php } ?>
		<script src="assets/plugins/custom/plugins.customs.bundle.js"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<?php include_once("assets/js/custom/".$nomeArquivo.".php") ?>
		
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
<?php include("layout/_end.php") ?>