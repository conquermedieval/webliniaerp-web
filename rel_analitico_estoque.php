<?php
	include_once "util/login/restrito.php";
	restrito(array(1));
	date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en" ng-app="HageERP">
  <head>
    <meta charset="utf-8">
    <title>WebliniaERP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="css/font-awesome-4.1.0.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="css/datepicker.css" rel="stylesheet"/>

	<!-- Timepicker -->
	<link href="css/bootstrap-timepicker.css" rel="stylesheet"/>

	<!-- Bower Components -->	
	<link href="bower_components/noty/lib/noty.css" rel="stylesheet">

	<!-- Endless -->
	<link href="css/endless.min.css" rel="stylesheet">
	<link href="css/endless-skin.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
  </head>

  <body class="overflow-hidden" ng-controller="RelatorioAnaliticoEstoqueController" ng-cloak>
	<!-- Overlay Div -->
	<!-- <div id="overlay" class="transparent"></div>

	<a href="" id="theme-setting-icon" class="hidden-print"><i class="fa fa-cog fa-lg"></i></a>
	<div id="theme-setting" class="hidden-print">
		<div class="title">
			<strong class="no-margin">Skin Color</strong>
		</div>
		<div class="theme-box">
			<a class="theme-color" style="background:#323447" id="default"></a>
			<a class="theme-color" style="background:#efefef" id="skin-1"></a>
			<a class="theme-color" style="background:#a93922" id="skin-2"></a>
			<a class="theme-color" style="background:#3e6b96" id="skin-3"></a>
			<a class="theme-color" style="background:#635247" id="skin-4"></a>
			<a class="theme-color" style="background:#3a3a3a" id="skin-5"></a>
			<a class="theme-color" style="background:#495B6C" id="skin-6"></a>
		</div>
		<div class="title">
			<strong class="no-margin">Sidebar Menu</strong>
		</div>
		<div class="theme-box">
			<label class="label-checkbox">
				<input type="checkbox" checked id="fixedSidebar">
				<span class="custom-checkbox"></span>
				Fixed Sidebar
			</label>
		</div>
	</div> --><!-- /theme-setting -->

	<div id="wrapper" class="bg-white preload">
		<div id="top-nav" class="fixed skin-1">
			<a href="#" class="brand">
				<span>WebliniaERP</span>
				<span class="text-toggle"> Admin</span>
			</a><!-- /brand -->
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
				<?php include("alertas.php"); ?>
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong>{{ userLogged.nme_usuario }}</strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<img src="img/hage.png" alt="User Avatar">
								<div class="detail">
									<strong>{{ userLogged.nme_usuario }}</strong>
									<p class="grey" style="font-size: 7px;">{{ userLogged.end_email }}</p>
								</div>
							</a>
						</li>
						<li><a tabindex="-1" href="#" class="main-link"><i class="fa fa-inbox fa-lg"></i> {{ userLogged.nome_empreendimento }}</a></li>
						<li><a tabindex="-1" href="#" class="main-link"><i class="fa fa-list-alt fa-lg"></i> Meus Pedidos</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->

		<aside class="fixed skin-1">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<?php include("menu-bar-buttons.php"); ?>
				</div><!-- /size-toggle -->
				<div class="user-block clearfix">
					<img src="img/hage.png" alt="User Avatar">
					<div class="detail">
						<strong>{{ userLogged.nme_usuario }}</strong>
						<ul class="list-inline">
							<li><a href="#">{{ userLogged.nome_empreendimento }}</a></li>
						</ul>
					</div>
				</div><!-- /user-block -->

				<!--<div class="search-block">
					<div class="input-group">
						<input type="text" class="form-control input-sm" placeholder="search here...">
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
						</span>
					</div>--><!-- /input-group -->
				<!--</div>--><!-- /search-block -->

				<?php include_once('menu-modulos.php') ?>
				
			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			<div class="padding-md">
				<div class="clearfix">
					<div class="pull-left">
						<span class="img-demo">
							<img src="assets/imagens/logos/{{ userLogged.nme_logo }}">
						</span>

						<div class="pull-left m-left-sm">
							<h3 class="m-bottom-xs m-top-xs">Relatório Estoque Analítico</h3>
							<small><?php echo date("d/m/Y H:i:s"); ?></small>
						</div>
					</div>

					<div class="pull-right text-right">
						<h6>{{ dados_empreendimento.num_cnpj }} - {{ dados_empreendimento.nome_empreendimento }}</h6>
						<h6>{{ dados_empreendimento.nme_logradouro }}, {{ dados_empreendimento.num_logradouro }}</h6>
						<h6>CEP: {{ dados_empreendimento.num_cep }} - {{ dados_empreendimento.nme_cidade }} - {{ dados_empreendimento.uf }}</h6>
						<h6>Telefone: {{ dados_empreendimento.num_telefone }}</h6>
					</div>
				</div>

				<hr>

				<div class="panel panel-default hidden-print" style="margin-top: 15px;">
					<div class="panel-heading"><i class="fa fa-calendar"></i> Filtros</div>

					<div class="panel-body">
						<form role="form">
							<div class="row">
								<div class="col-lg-4">
									<div class="form-group">
										<label class="control-label">Depósito</label>
										<select class="form-control" ng-model="deposito.id" ng-options="i.id as i.nme_deposito for i in depositos"></select>
									</div>
								</div>

								<div class="col-lg-2">
									<div class="form-group">
										<label class="control-label">Itens por Página</label>
										<select class="form-control" ng-model="itensPorPagina">
											<option value="10">10</option>
											<option value="30">30</option>
											<option value="50">50</option>
										</select>
									</div>
								</div>

								<div class="col-sm-2">
									<div class="form-group">
										<label class="control-label"><br></label>
										<button type="button" class="form-control btn btn-primary" ng-click="aplicarFiltro()"><i class="fa fa-filter"></i> Aplicar Filtro</button>
									</div>
								</div>

								<div class="col-sm-2">
									<div class="form-group">
										<label class="control-label"><br></label>
										<button type="button" class="form-control btn btn-default" ng-click="resetFilter()"><i class="fa fa-times-circle"></i> Limpar Filtro</button>
									</div>
								</div>

								<div class="col-sm-2">
									<div class="form-group">
										<label class="control-label"><br></label>
										<button class="form-control btn btn-success" ng-click="doExportExcel()"><i class="fa fa-file-excel-o"></i> Exportar</button>
									</div>
								</div>								

								<div class="col-sm-2">
									<div class="form-group">
										<label class="control-label"><br></label>
										<button class="form-control btn btn-success hidden-print" ng-show="itens.length > 0" id="invoicePrint"><i class="fa fa-print"></i> Imprimir</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<br>

				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<div class="pull-right">
							<ul class="pagination pagination-sm m-top-none hidden-print" ng-show="paginacao.itens.length > 1">
								<li ng-repeat="item in paginacao.itens" ng-class="{'active': item.current}">
									<a href="" h ng-click="loadItens(item.offset,item.limit)">{{ item.index }}</a>
								</li>
							</ul>
						</div>	
					</div>

					<div class="panel-body" style="overflow-y: scroll; width: 100%; background-color: #fff;">
						<table id="data" class="table table-bordered table-hover table-striped table-condensed" style="font-family: monospace; font-size: 10px; margin-bottom: 0;">
							<thead>
								<tr>
									<th class="text-middle text-center" rowspan="3">Produto</th>
									<th class="text-middle text-center" rowspan="3">Fabricante</th>
									<th class="text-middle text-center" rowspan="3">Tamanho</th>
									<th class="text-middle text-center" rowspan="3">Sabor/Cor</th>
									<th class="text-middle text-center" rowspan="3">Validade</th>
									<th class="text-middle text-center" rowspan="3">Qtd</th>
									<th class="text-middle text-center" rowspan="2" colspan="2">Custo</th>
									<th class="text-middle text-center" colspan="6">Estimativa Venda</th>
								</tr>
								<tr>
									<th colspan="2" class="text-center" ng-if="existeTabelaPreco('atacado')">Atacado</th>
									<th colspan="2" class="text-center" ng-if="existeTabelaPreco('intermediario')">Intermediário</th>
									<th colspan="2" class="text-center" ng-if="existeTabelaPreco('varejo')">Varejo</th>
								</tr>
								<tr>
									<th class="text-center">Unitário</th>
									<th class="text-center">Total</th>

									<th class="text-center" ng-if="existeTabelaPreco('atacado')">Unitário</th>
									<th class="text-center" ng-if="existeTabelaPreco('atacado')">Total</th>

									<th class="text-center" ng-if="existeTabelaPreco('intermediario')">Unitário</th>
									<th class="text-center" ng-if="existeTabelaPreco('intermediario')">Total</th>

									<th class="text-center" ng-if="existeTabelaPreco('varejo')">Unitário</th>
									<th class="text-center" ng-if="existeTabelaPreco('varejo')">Total</th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="item in itens">
									<td class="text-middle" style="min-width: 250px;">{{ item.nome }}</td>
									<td class="text-middle" style="min-width: 100px;">{{ item.nome_fabricante }}</td>
									<td class="text-middle text-center">{{ item.peso }}</td>
									<td class="text-middle text-center">{{ item.sabor }}</td>
									<td class="text-middle text-center">{{ item.dta_validade | dateFormat: 'date' }}</td>
									<td class="text-middle text-center">{{ item.qtd_item }}</td>

									<td class="text-middle text-right" style="min-width: 100px;">R$ {{ item.vlr_custo_real | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>
									<td class="text-middle text-right" style="min-width: 100px;">R$ {{ item.vlr_custo_total | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>

									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('atacado')">R$ {{ item.vlr_venda_atacado | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>
									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('atacado')">R$ {{ item.vlr_total_venda_atacado | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>

									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('intermediario')">R$ {{ item.vlr_venda_intermediario | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>
									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('intermediario')">R$ {{ item.vlr_total_venda_intermediario | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>

									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('varejo')">R$ {{ item.vlr_venda_varejo | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>
									<td class="text-middle text-right" style="min-width: 100px;" ng-if="existeTabelaPreco('varejo')">R$ {{ item.vlr_total_venda_varejo | numberFormat: config.qtd_casas_decimais : ',' : '.' }}</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td class="text-right text-bold" colspan="5">Totais</td>
									<td class="text-center text-bold">{{ qtd_estoque_total }}</td>
									<td></td>
									<td class="text-right text-bold">R$ {{ vlr_custo_total | numberFormat: config.qtd_casas_decimais : ',' : '.'}}</td>
									<td ng-if="existeTabelaPreco('atacado')"></td>
									<td class="text-right text-bold" ng-if="existeTabelaPreco('atacado')">R$ {{ vlr_total_venda_atacado | numberFormat: config.qtd_casas_decimais : ',' : '.'}}</td>
									<td ng-if="existeTabelaPreco('intermediario')"></td>
									<td class="text-right text-bold" ng-if="existeTabelaPreco('intermediario')">R$ {{ vlr_total_venda_intermediario | numberFormat: config.qtd_casas_decimais : ',' : '.'}}</td>
									<td ng-if="existeTabelaPreco('varejo')"></td>
									<td class="text-right text-bold" ng-if="existeTabelaPreco('varejo')">R$ {{ vlr_total_venda_varejo | numberFormat: config.qtd_casas_decimais : ',' : '.'}}</td>
								</tr>
							</tfoot>
						</table>
					</div>

					<div class="panel-footer clearfix">
						<div class="pull-right">
							<ul class="pagination pagination-sm m-top-none hidden-print" ng-show="paginacao.itens.length > 1">
								<li ng-repeat="item in paginacao.itens" ng-class="{'active': item.current}">
									<a href="" h ng-click="loadItens(item.offset,item.limit)">{{ item.index }}</a>
								</li>
							</ul>
						</div>	
					</div>
				</div>

				<div class="padding-sm bg-grey">
					<strong>Nota:</strong>
					<p>VUA = Valor Unitário Atacado, VTA = Valor Total Atacado, VUI = Valor Unitário Intermediário, VTI = Valor Total Intermediário, VUV = Valor Unitário Varejo, VTV = Valor Total Varejo</p>
				</div>
			</div><!-- /.padding20 -->
		</div><!-- /main-container -->
	</div><!-- /wrapper -->

	<div class="modal fade" id="modal-loading">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Aguarde</h4>
				</div>
				<div class="modal-body">
					<p>Carregando dados do relatório...</p>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

	<!-- Logout confirmation -->
	<?php include("logoutConfirm.php"); ?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

	<!-- Jquery -->
	<script src="js/jquery-1.10.2.min.js"></script>

	<!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>

	<!-- Datepicker -->
	<script src='js/bootstrap-datepicker.min.js'></script>

	<!-- Timepicker -->
	<script src='js/bootstrap-timepicker.min.js'></script>

    <!-- Pace -->
	<script src='js/pace.min.js'></script>

	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>

    <!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>

	<!-- Endless -->
	<script src="js/endless/endless.js"></script>

	<!-- Moment -->
	<script src="js/moment/moment.min.js"></script>

	<script src="js/jquery.noty.packaged.js"></script>

	<!-- Bower Components -->	
	<script src="bower_components/noty/lib/noty.min.js" type="text/javascript"></script>
    <script src="bower_components/mojs/build/mo.min.js" type="text/javascript"></script>

	<!-- Extras -->
	<script src="js/extras.js"></script>

	<!-- AngularJS -->
	<script type="text/javascript" src="bower_components/angular/angular.js"></script>
	<script src="js/angular-strap.min.js"></script>
	<script src="js/angular-strap.tpl.min.js"></script>
	<script type="text/javascript" src="bower_components/angular-ui-utils/mask.min.js"></script>
    <script src="js/angular-sanitize.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    <script src="js/dialogs.v2.min.js" type="text/javascript"></script>
    <script src="js/auto-complete/ng-sanitize.js"></script>
    <script src="js/app.js"></script>
    <script src="js/auto-complete/AutoComplete.js"></script>
    <script src="js/angular-services/user-service.js"></script>
	<script src="js/angular-controller/relatorio-analitico-estoque-controller.js"></script>

	<script id="printFunctions">
		function printDiv(id, pg) {
			var contentToPrint, printWindow;

			contentToPrint = window.document.getElementById(id).innerHTML;
			printWindow = window.open(pg);

		    printWindow.document.write("<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>");
			printWindow.document.write("<link href='css/font-awesome.min.css' rel='stylesheet'>");
			printWindow.document.write("<link href='css/pace.css' rel='stylesheet'>");
			printWindow.document.write("<link href='css/endless.min.css' rel='stylesheet'>");
			printWindow.document.write("<link href='css/endless-skin.css' rel='stylesheet'>");

			printWindow.document.write("<style type='text/css' media='print'>@page { size: portrait; } th, td { font-size: 8pt; } </style>");

			printWindow.document.write(contentToPrint);

			printWindow.window.print();
			printWindow.document.close();
			printWindow.focus();
		}

		$(function()	{
			$('#invoicePrint').click(function()	{
				printDiv("main-container", "");
			});
		});

	</script>
	<?php include("google_analytics.php"); ?>
  </body>
</html>
