<?php
	include_once "util/login/restrito.php";
	restrito();
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
      <link rel='stylesheet prefetch' href='bootstrap/css/bootstrap.min.css'>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="css/datepicker.css" rel="stylesheet"/>

	<!-- Chosen -->
	<link href="css/chosen/chosen.min.css" rel="stylesheet"/>

	<!-- Endless -->
	<link href="css/endless.min.css" rel="stylesheet">
	<link href="css/endless-skin.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">

	<!-- Agenda -->
    <link href='js/agenda/fullcalendar.css' rel='stylesheet' />
    <link href='js/agenda/fullcalendar.print.css' rel='stylesheet' media='print' />

	<style type="text/css">

		/* Fix for Bootstrap 3 with Angular UI Bootstrap */

		.modal {
			display: block;
		}

		.datepicker {
			z-index: 10000
		}

		/* Custom dialog/modal headers */

		.dialog-header-error { background-color: #d2322d; }
		.dialog-header-wait { background-color: #428bca; }
		.dialog-header-notify { background-color: #eeeeee; }
		.dialog-header-confirm { background-color: #333333; }
		.dialog-header-error span, .dialog-header-error h4,
		.dialog-header-wait span, .dialog-header-wait h4,
		.dialog-header-confirm span, .dialog-header-confirm h4 { color: #ffffff; }

		/* Ease Display */

		.pad { padding: 25px; }

		@media screen and (min-width: 768px) {

			#list_proodutos.modal-dialog  {width:900px;}

		}

		#list_produtos .modal-dialog  {width:70%;}

		#list_produtos .modal-content {min-height: 640px;;}

		/*--------------------------------------*/
		.chosen-choices{
			border-bottom-left-radius: 4px;
			border-bottom-right-radius: 4px;
			border-top-left-radius: 4px;
			border-top-right-radius: 4px;
			font-size: 12px;
			border-color: #ccc;
		}
	</style>
  </head>

  <body class="overflow-hidden" ng-controller="AgendamentoConsultaController" ng-cloak>
  	<!-- Overlay Div -->
	<div id="overlay" class="transparent"></div>

	<div id="wrapper" class="preload">
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
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
						<i class="fa fa-power-off"></i>
					</a>
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

				<div class="main-menu">
					<ul>
						<!-- Dashboard (index) -->
						<li>
							<a href="dashboard.php">
								<span class="menu-icon"><i class="fa fa-dashboard fa-lg"></i></span>
								<span class="text">Dashboard</span>
								<span class="menu-hover"></span>
							</a>
						</li>

						<!-- Módulos -->
						<li class="active openable">
							<a href="#">
								<span class="menu-icon"><i class="fa fa-th fa-lg"></i></span>
								<span class="text">Módulos</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<?php include("menu-modulos.php") ?>
							</ul>
						</li>

						<!-- Relatórios -->
						<li class="openable">
							<a href="#">
								<span class="menu-icon"><i class="fa fa-copy fa-lg"></i></span>
								<span class="text">Relatórios</span>
								<span class="menu-hover"></span>
							</a>
							<ul class="submenu">
								<?php include("menu-relatorios.php"); ?>
							</ul>
						</li>
					</ul>

					<!-- Exemplos de Alerta -->
					<!-- <div class="alert alert-info">Welcome to Endless Admin. Do not forget to check all my pages.</div>
					<div class="alert alert-danger">Welcome to Endless Admin. Do not forget to check all my pages.</div>
					<div class="alert alert-warning">Welcome to Endless Admin. Do not forget to check all my pages.</div> -->
				</div><!-- /main-menu -->
			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			<div id="breadcrumb">
				<ul class="breadcrumb">
					 <li><i class="fa fa-home"></i> <a href="dashboard.php">Home</a></li>
					 <li class="active"><i class="fa fa-list"></i> Controle de Atendimento</li>
				</ul>
			</div><!-- breadcrumb -->

			<div class="main-header clearfix">
				<div class="page-title">
					<h3 class="no-margin"><i class="fa fa-list"></i> Controle de Atendimento</h3>
					<br/>
					<button class="btn btn-info" id="btn-novo" ng-click="showBoxNovo()"><i class="fa fa-plus-circle"></i> Novo Atendimento</button>
				</div><!-- /page-title -->
			</div><!-- /main-header -->

			<div class="padding-md">
				<div class="panel panel-primary"  id="box-novo" style="display: none">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-plus-circle"></i> Novo Atendimento</h3>
					</div>
					<div class="panel-body">
						<fieldset>
							<legend class="clearfix">
								<span class="">Dados do Paciente</span>
								<div class="pull-right">
									<button type="button" class="btn btn-xs btn-default" ng-click="selCliente()"><i class="fa fa-users"></i> Selecionar Paciente Existente</button>
									<button type="button" class="btn btn-xs btn-primary" ng-click="btnInsertCliente()"><i class="fa fa-plus-circle"></i> Cadastrar Novo Paciente</button>
								</div>
							</legend>

							<form class="form form-horizontal" role="form">
								<div class="form-group">
									<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">Nome:</label> 
									<div class="col-xs-12 col-sm-7 col-md-7 col-lg-6" id="nome">
										<input type="text" class="form-control input-sm" ng-model="cliente.nome">
									</div>
								</div>

								<div class="form-group">
									<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label">E-mail:</label> 
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="email">
										<input type="text" class="form-control input-sm" ng-model="cliente.email">
									</div>
								</div>

								<div class="form-group">
									<label class="col-xs-12 col-sm-2 col-md-2 col-lg-2 control-label" style="padding-top: 0;">Telefone<br class="hidden-xs"/><span class="hidden-sm hidden-md hidden-lg"> </span>(Fixo):</label> 
									<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2" id="tel_fixo">
										<input ui-mask="(99) 99999999" ng-model="cliente.tel_fixo" type="text" class="form-control input-sm">
									</div>

									<label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label" style="padding-top: 0;">Telefone<br class="hidden-xs"/><span class="hidden-sm hidden-md hidden-lg"> </span>(Celular):</label> 
									<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2" id="celular">
										<input ui-mask="(99) 99999999?9" ng-model="cliente.celular" type="text" class="form-control input-sm">
									</div>
								</div>
							</form>
						</fieldset>
					</div>

					<div class="panel-footer clearfix">
						<div class="pull-right">
							<button class="btn btn-success" id="btn-incluir-fila"  data-loading-text="<i class='fa fa-refresh fa-spin'></i> Incluindo na fila de atendimento" ng-click="novoAtendimento()"><i class="fa fa-indent"></i> Incluir na fila de atendimento</button>
							<button class="btn btn-danger" ng-click="cancelarCadastroCliente()"><i class="fa fa-times-circle"></i> Cancelar</button>
						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table table-bordered table-hover table-striped table-condensed">
							<thead>
								<th class="text-center">Chegada</th>
								<th class="text-center">Inicio Atend.</th>
								<th class="text-center">Fim Atend.</th>
								<th class="text-center">Ficha</th>
								<th>Paciente</th>
								<th>Status</th>
								<th class="text-center">Valor</th>
								<th>Principal</th>
								<th width="140">Ações</th>
							</thead>
							 <tr ng-show="lista_atendimento == null">
                                <th class="text-center" colspan="9" style="text-align:center"><i class='fa fa-refresh fa-spin'></i> Carregando ...</th>
                            </tr>
                            <tr ng-show="lista_atendimento.length == 0">
                                <th colspan="9" class="text-center">Nenhum atendimento encontrado.</th>
                            </tr>
							<tbody>
								<tr ng-repeat="paciente in lista_atendimento" bs-tooltip>
									<td class="text-center">{{ paciente.dta_entrada | dateFormat:'time' }}</td>
									<td class="text-center">{{ paciente.dta_inicio_atendimento | dateFormat:'time' }}</td>
									<td class="text-center">{{ paciente.dta_fim_atendimento | dateFormat:'time' }}</td>
									<td>{{ null }}</td>
									<td>{{ paciente.nome_paciente }}</td>
									<td>{{paciente.dsc_status}} {{ paciente.id_atendimento_origem == null &&  '(Orçamento)' || '(Procedimento)' }}</td>

									<td class="text-right" ng-show="paciente.id_status > 2 && paciente.id_atendimento_origem == null">R$ {{ paciente.valor | numberFormat:2:',':'.' }}</td>
									<td ng-show="paciente.id_status <= 2 || paciente.id_atendimento_origem != null"></td>

									<td>{{ paciente.nome_profissional }}</td>
									<td>
										<button class="btn btn-xs btn-success" data-loading-text="<i class='fa fa-refresh fa-spin'></i>"  ng-click="setInitAtendimento(paciente,$event)" ng-disabled="paciente.dta_inicio_atendimento != null" data-toggle="tooltip" title="Iniciar Atendimento">
											<i class="fa fa-play"></i>
										</button>
										<button class="btn btn-xs btn-danger" ng-disabled="paciente.dta_inicio_atendimento == null || paciente.dta_fim_atendimento != null"  data-loading-text="<i class='fa fa-refresh fa-spin'></i>" ng-click="selProfissionais(paciente)" data-toggle="tooltip" title="Finalizar Atendimento">
											<i class="fa fa-stop"></i>
										</button>
										<button class="btn btn-xs btn-primary" ng-click="abrirFichaPaciente(paciente)" data-toggle="tooltip" title="Abrir Fichar do Paciente">
											<i class="fa fa-user"></i>
										</button>
										<button class="btn btn-xs btn-warning" data-toggle="tooltip" title="Emitir Recibo">
											<i class="fa fa-file-text-o"></i>
										</button>
										<button class="btn btn-xs btn-info" data-toggle="tooltip" title="Emitir NFS-e">
											<i class="fa fa-barcode"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /main-container -->

		<!-- /Modal Processando Venda-->
		<div class="modal fade" id="modalFichaPaciente" style="display:none">
  			<div class="modal-dialog modal-xl">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Ficha do Paciente</h4>
      				</div>
				    <div class="modal-body bg-trans-dark">
				    	<div class="panel-tab clearfix">
							<ul class="tab-bar">
								<li class="active" ng-show="tab_pagamentos == false"><a href="#dados" data-toggle="tab"><i class="fa fa-user"></i> Dados Cadastrais</a></li>
								<li ng-show="tab_pagamentos == false" ng-click="getItensVenda()"><a href="#procedimentos" data-toggle="tab"><i class="fa fa-list-alt"></i> Procedimentos</a></li>
								<li ng-show="tab_pagamentos" ><a  href="#pagamentos" data-toggle="tab"><i class="fa fa-list-alt"></i> Pagamentos</a></li>
							</ul>
						</div>

						<div class="tab-content">

							<div class="tab-pane fade in active" id="dados">
								<div class="alert alerta-dados-paciente" style="display:none">
										
								</div>
								<form class="form form-horizontal" role="form">
									<div class="form-group">
										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">Nome:</label> 
										<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" id="dados-paciente-nome">
											<input type="text" class="form-control input-sm" ng-model="dados_paciente.nome">
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">E-mail:</label> 
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" id="dados-paciente-email">
											<input type="text" class="form-control input-sm" ng-model="dados_paciente.email">
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-top: 0;">Telefone<br class="hidden-xs"/><span class="hidden-sm hidden-md hidden-lg"> </span>(Fixo):</label> 
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2" id="dados-paciente-tel_fixo">
											<input ui-mask="(99) 99999999" ng-model="dados_paciente.tel_fixo" type="text" class="form-control input-sm">
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label" style="padding-top: 0;">Telefone<br class="hidden-xs"/><span class="hidden-sm hidden-md hidden-lg"> </span>(Celular):</label> 
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2" id="dados-paciente-celular">
											<input ui-mask="(99) 99999999?9" ng-model="dados_paciente.celular" type="text" class="form-control input-sm">
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">CEP:</label> 
										<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" id="dados-paciente-cep">
											<input type="text" class="form-control input-sm" ui-mask="99999-999" ng-model="dados_paciente.cep">
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">Endereço:</label> 
										<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" id="dados-paciente-endereco">
											<input type="text" class="form-control input-sm" ng-model="dados_paciente.endereco">
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">No:</label> 
										<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2" id="dados-paciente-numero">
											<input type="text" class="form-control input-sm" ng-model="dados_paciente.numero">
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">Bairro:</label> 
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" id="dados-paciente-bairro">
											<input type="text" class="form-control input-sm" ng-model="dados_paciente.bairro">
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">Estado:</label> 
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" id="nome">
											<select id="id_select_estado" class="form-control" readonly="readonly" ng-model="dados_paciente.id_estado" ng-options="item.id as item.nome for item in estados" ng-change="loadCidadesByEstado()"></select>
										</div>

										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label">Cidade:</label> 
										<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" id="nome">
											<select class="form-control" readonly="readonly" ng-model="dados_paciente.id_cidade" ng-options="a.id as a.nome for a in cidades"></select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-12 col-sm-1 col-md-1 col-lg-1 control-label sr-only"></label> 
										<div class="col-xs-12 col-sm-11 col-md-11 col-lg-11" id="nome">
											<button class="btn btn-success pull-right" id="salvar-dados-paciente" ng-click="salvarDadosPaciente()"><i class="fa fa-save"></i> Salvar Informações</button>
										</div>
						    		</div>
								</form>
							</div>

							<div class="tab-pane fade" id="procedimentos">
								<form class="form" role="form">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group" id="id_procedimento">
												<label class="control-label">Procedimento</label>
												<div class="controls">
													<div class="input-group">
														<input type="text" ng-model="procedimento.dsc_procedimento" ng-blur="buscaProcedimentoByCod()" ng-focus="procedimento.dsc_procedimento=''" ng-enter="salvarProcedimento()" class="form-control input-sm">
														<span class="input-group-btn">
															<button class="btn btn-default btn-sm" ng-click="selProcedimento()" type="button"><i class="fa fa-search"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group" id="id_dente">
												<label class="control-label">Dente/Região</label>
												<div class="controls">
													<div class="input-group">
														<input ng-model="procedimento.nme_dente" ng-blur="buscaDenteByCod()" ng-focus="procedimento.nme_dente=''" ng-enter="salvarProcedimento()" type="text" class="form-control input-sm">
														<span class="input-group-btn">
															<button ng-click="selOdontograma()"  class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group" id="id_regiao">
												<label class="control-label">Face</label>
												<div class="controls">
													<div class="input-group">
														<input type="text" ng-model="procedimento.dsc_face" ng-blur="buscaFaceDenteByCod()" ng-focus="procedimento.dsc_face=''" ng-enter="salvarProcedimento()" class="form-control input-sm">
														<span class="input-group-btn">
															<button class="btn btn-default btn-sm" ng-click="selFaceDente()" ng- type="button"><i class="fa fa-search"></i></button>
														</span>
													</div>
												</div>
											</div>
										</div>

										<div class="col-lg-2">
											<div class="form-group" id="valor">
												<label class="control-label">Valor</label>
												<div class="controls">
													<input thousands-formatter ng-model="procedimento.valor" ng-enter="salvarProcedimento()" class="form-control"/>
												</div>
											</div>
										</div>

										<div class="col-lg-1">
											<div class="form-group">
												<label class="control-label"><br/></label>
												<div class="controls">
													<button class="btn btn-sm btn-primary" ng-click="salvarProcedimento()" data-toggle="tooltip" title="Incluir procedimento"><i class="fa fa-plus-square"></i></button>
												</div>
											</div>
										</div>
									</div>
								</form>

								<table class="table table-bordered table-hover table-striped table-condensed">
									<thead>
										<th>Procedimento</th>
										<th>Dente/Região</th>
										<th>Face</th>
										<th>Status</th>
										<th>Agendamento</th>
										<th>Valor</th>
										<th>Ações</th>
									</thead>
									<tbody>
										<tr ng-repeat="item in itens_venda" bs-tooltip>
											<td>{{ item.dsc_procedimento }}</td>
											<td>{{ item.nme_dente }}</td>
											<td>{{ item.dsc_face }}</td>
											<td><i class="fa fa-circle" ng-class="{'text-danger':item.id_status_procedimento == 1,'text-warning':item.id_status_procedimento == 2,'text-success': item.id_status_procedimento == 3 }"></i> 
												{{item.dsc_status_procedimento}}
											</td>
											<td style="width: 154px">
												<input ng-disabled="item.id_status_procedimento == 3" ng-model="item.dta_inicio_procedimento" class="form-control input-xs" ui-mask="99/99/9999 99:99">
											</td>
											<td class="text-right"><i class="fa fa-circle" ng-class="{'text-danger':item.flg_item_pago == 0,'text-success':item.flg_item_pago == 1}"></i> R$ {{ item.valor_real_item | numberFormat:2:',':'.'}}</td>
											<td>
												<button class="btn btn-xs btn-primary" ng-disabled="item.flg_item_pago == 1" ng-click="efetuarPagamento(item)" data-toggle="tooltip" title="Efetuar pagamento">
													<i class="fa fa-money"></i>
												</button>
												<button class="btn btn-xs btn-primary" data-loading-text="<i class='fa fa-refresh fa-spin'></i>" ng-disabled="item.id_status_procedimento == 3" ng-click="agendarProcedimento(item,$event)" data-toggle="tooltip" title="Agendar realização">
													<i class="fa fa-calendar"></i>
												</button>
												<button class="btn btn-xs btn-danger" data-toggle="tooltip" title="Cancelar agendamento">
													<i class="fa fa-times-circle"></i>
												</button>
											</td>
										</tr>
										<tr ng-if="itens_venda.length == 0">
											<td colspan="7" class="text-center" text-center>
												Nenhum procedimento encontrado
											</td>
										</tr>
										<tr ng-if="itens_venda==null">
											<td colspan="7" class="text-center">
												<i class='fa fa-refresh fa-spin'></i> Carregando ...
											</td>
										</tr>
									</tbody>
									<tfoot ng-if="itens_venda.length > 0">
										<th class="text-right" colspan="5">Total</th>
										<th class="text-right">R$ {{ totalItensVenda() | numberFormat:2:',':'.' }}</th>
										<th></th>
									</tfoot>
								</table>
							</div>
							<div class="tab-pane fade" id="pagamentos">
								<div class="panel-body">
								    <div class="alert alert-pagamento" style="display:none"></div>
								    <div class="row">
								        <div class="col-sm-9">
								        <div class="row" ng-show="pagamento_fulso">
								            <div class="col-sm-12">
								                <div class="form-group">
								                        <label class="control-label">Cliente</label>
								                        <div class="input-group">
								                            <input ng-click="selCliente(0,10)"  type="text" class="form-control" ng-model="cliente.nome" readonly="readonly" style="cursor: pointer;" />
								                            <span class="input-group-btn">
								                                <button ng-click="selCliente(0,10)" type="button" class="btn btn-info"><i class="fa fa-users"></i></button>
								                            </span>
								                        </div>
								                        
								                </div>
								            </div>
								        </div>
								        <div class="row">
								            <div class="col-sm-12">
								                <div class="form-group">
								                    <div style="font-weight: bold;font-size: 15px;" ng-show="cliente.vlr_saldo_devedor>0">
								                        <span style="color:#000">Saldo Devedor :</span> <span style="color:green">R$ {{ cliente.vlr_saldo_devedor | numberFormat:2:',':'.' }}</span>
								                    </div>
								                    <div style="font-weight: bold;font-size: 15px;" ng-show="cliente.vlr_saldo_devedor<0">
								                        <span style="color:#000">Saldo Devedor :</span> <span style="color:red">R$ {{ cliente.vlr_saldo_devedor | numberFormat:2:',':'.' }}</span>
								                    </div>
								                    <div style="font-weight: bold;font-size: 15px;" ng-show="cliente.vlr_saldo_devedor==0">
								                        <span style="color:#000">Saldo Devedor :</span> <span style="color:blue">R$ {{ cliente.vlr_saldo_devedor | numberFormat:2:',':'.' }}</span>
								                    </div>
								                    </div>
								                </div>
								        </div>
								        <div class="row">
								            <div class="col-sm-6" id="pagamento_forma_pagamento">
								                <label class="control-label">Forma de Pagamento</label>
								                <select ng-model="pagamento.id_forma_pagamento" ng-change="selectChange()" class="form-control input-sm">
								                    <option ng-show="pagamento.id_forma_pagamento != null" value=""></option>
								                    <option ng-repeat="item in formas_pagamento"  value="{{ item.id }}">{{ item.nome }}</option>
								                </select>
								            </div>
								            <div class="col-sm-6" id="pagamento_valor" ng-show="pagamento.id_forma_pagamento == 7" >
								                <label class="control-label">Vale troca</label>
								                <div class="input-group">
								                    <input ng-click="showValeTroca()" thousands-formatter type="text" class="form-control input-sm" ng-model="pagamento.valor" readonly="readonly" style="cursor: pointer;" />
								                    <span class="input-group-btn">
								                        <button ng-click="showValeTroca()" type="button" class="btn btn-info btn-sm"><i class="fa fa-exchange"></i></button>
								                    </span>
								                </div>
								            </div>

								            <div class="col-sm-2" id="pagamento_id_banco" ng-show="pagamento.id_forma_pagamento == 8">
								                <div class="form-group" >
								                    <label class="control-label">Banco</label>
								                    <select ng-model="pagamento.id_banco" class="form-control">
								                        <option ng-repeat="banco in bancos" value="{{ banco.id }}">{{ banco.nome }}</option>
								                    </select>
								                </div>
								            </div>

								            <div class="col-sm-2" id="pagamento_agencia_transferencia" ng-show="pagamento.id_forma_pagamento == 8">
								                <label class="control-label">Agência</label>
								                <div class="form-group ">
								                        <input ng-model="pagamento.agencia_transferencia"  type="text" class="form-control input-sm" />
								                </div>
								            </div>

								            <div class="col-sm-2" id="pagamento_conta_transferencia" ng-show="pagamento.id_forma_pagamento == 8">
								                <label class="control-label">Conta</label>
								                <div class="form-group ">
								                        <input ng-model="pagamento.conta_transferencia"  type="text" class="form-control input-sm" />
								                </div>
								            </div>

								            <div class="col-sm-6" id="pagamento_valor" ng-show="pagamento.id_forma_pagamento != 7 && pagamento.id_forma_pagamento != 8">
								                <label class="control-label">Valor</label>
								                <div class="form-group ">
								                        <input ng-disabled="pagamento.id_forma_pagamento == 2 || pagamento.id_forma_pagamento == 4" ng-model="pagamento.valor" thousands-formatter type="text" class="form-control input-sm" />
								                </div>
								            </div>
								        </div>

								        <div class="row">
								            <div class="col-sm-6" id="pagamento_maquineta" ng-show="pagamento.id_forma_pagamento == 5 || pagamento.id_forma_pagamento == 6 ">
								                <label class="control-label">Maquineta</label>
								                <select ng-model="pagamento.id_maquineta" class="form-control input-sm">
								                    <option ng-repeat="item in maquinetas" value="{{ item.id_maquineta }}">#{{ item.id_maquineta }} - {{ item.dsc_conta_bancaria }}</option>
								                </select>
								            </div>
								            <div class="col-sm-6" id="numero_parcelas" ng-show="pagamento.id_forma_pagamento == 6 || pagamento.id_forma_pagamento == 2 || pagamento.id_forma_pagamento == 4">
								                <label class="control-label">parcelas</label>
								                <div class="form-group ">
								                        <input ng-blur="pushCheques()" ng-focus="qtdCheque()" ng-model="pagamento.parcelas" type="text" class="form-control input-sm" >
								                </div>
								            </div>
								            <div class="col-sm-4" id="proprietario_conta_transferencia" ng-show="pagamento.id_forma_pagamento == 8">
								                <label class="control-label">Proprietário</label>
								                <div class="form-group ">
								                        <input ng-model="pagamento.proprietario_conta_transferencia" type="text" class="form-control input-sm" />
								                </div>
								            </div>
								            <div class="col-sm-4" id="pagamento_id_conta_transferencia_destino" ng-show="pagamento.id_forma_pagamento == 8 ">
								                <label class="control-label">Conta de Destino</label>
								                <select ng-model="pagamento.id_conta_transferencia_destino" class="form-control input-sm">
								                    <option ng-repeat="item in contas" value="{{ item.id }}">#{{ item.id }} - {{ item.dsc_conta_bancaria }}</option>
								                </select>
								            </div>
								            <div class="col-sm-4" id="pagamento_valor" ng-show="pagamento.id_forma_pagamento == 8">
								                <label class="control-label">Valor</label>
								                <div class="form-group ">
								                        <input ng-model="pagamento.valor" thousands-formatter type="text" class="form-control input-sm" />
								                </div>
								            </div>
								        </div>
								        <div class="alert error-cheque" style="display:none"></div>
								            <div class="row" ng-show="pagamento.id_forma_pagamento == 2" ng-repeat="item in cheques">
								                <div class="col-sm-3">
								                    <div class="form-group cheque_data">
								                        <label class="control-label">Data</label>
								                        <div class="input-group">
								                            <input readonly="readonly" style="background:#FFF;cursor:pointer" ng-model="pagamento.data" type="text" id="pagamentoData" class="datepicker form-control chequeData">
								                            <span class="input-group-addon" class="cld_pagameto" ng-click="focusData($index)"><i class="fa fa-calendar"></i></span>
								                        </div>
								                    </div>
								                </div>
								                <div class="col-sm-2">
								                    <div class="form-group cheque_valor">
								                        <label class="control-label">valor</label>
								                        <div class="form-group ">
								                            <input ng-blur="pushCheques()" ng-keyUp="calTotalCheque()"  thousands-formatter ng-model="item.valor_pagamento" type="text" class="form-control" >
								                        </div>
								                    </div>
								                </div>
								                <div class="col-sm-2">
								                    <div class="form-group cheque_banco" >
								                        <label class="control-label">Banco</label>
								                        <select ng-model="item.id_banco" class="form-control">
								                            <option ng-repeat="banco in bancos" value="{{ banco.id }}">{{ banco.nome }}</option>
								                        </select>
								                    </div>
								                </div>

								                <div class="col-sm-2">
								                    <div class="form-group cheque_cc">
								                        <label class="control-label">Núm. C/C</label>
								                        <input ng-model="item.num_conta_corrente" type="text" class="form-control">
								                    </div>
								                </div>

								                <div class="col-sm-2">
								                    <div class="form-group cheque_num">
								                        <label class="control-label">Núm. Cheque</label>
								                        <input ng-model="item.num_cheque" type="text" class="form-control">
								                    </div>
								                </div>

								                <div class="col-sm-1">
								                    <div class="row">
								                        <div class="col-sm-6">
								                            <label class="control-label"><br></label>
								                            <label class="label-checkbox">
								                                <input ng-model="item.flg_cheque_predatado" value="1" type="checkbox" id="toggleLine" ng-true-value="1" ng-false-value="0">
								                                <span class="custom-checkbox"></span>
								                                Pré?
								                            </label>
								                        </div>
								                        <div class="col-sm-6" ng-show="cheques.length > 1">
								                            <div class="form-group">
								                                <label class="control-label"><br></label>
								                                <label class="control-label">
								                                    <i ng-click="delItemCheque($index)" class="fa fa-times-circle-o fa-lg" style="color: red;cursor:pointer"></i>
								                                </label>
								                            </div>
								                        </div>
								                    </div>
								                </div>

								            </div>
								            <div class="row" ng-show="pagamento.id_forma_pagamento == 4" ng-repeat="item in boletos">
								                <div class="col-sm-3">
								                    <div class="form-group boleto_data">
								                        <label class="control-label">Data</label>
								                        <div class="input-group">
								                            <input readonly="readonly" style="background:#FFF;cursor:pointer" ng-model="pagamento.data" type="text" id="pagamentoData" class="datepicker form-control boletoData">
								                            <span class="input-group-addon" class="cld_pagameto" ng-click="focusData($index)"><i class="fa fa-calendar"></i></span>
								                        </div>
								                    </div>
								                </div>
								                <div class="col-sm-2">
								                    <div class="form-group boleto_valor">
								                        <label class="control-label">valor</label>
								                        <div class="form-group ">
								                            <input ng-blur="pushCheques()" ng-keyUp="calTotalBoleto()"  thousands-formatter ng-model="item.valor_pagamento" type="text" class="form-control" >
								                        </div>
								                    </div>
								                </div>
								                <div class="col-sm-2">
								                    <div class="form-group boleto_banco" >
								                        <label class="control-label">Banco</label>
								                        <select ng-model="item.id_banco" class="form-control">
								                            <option ng-repeat="banco in bancos" value="{{ banco.id }}">{{ banco.nome }}</option>
								                        </select>
								                    </div>
								                </div>

								                <div class="col-sm-2">
								                    <div class="form-group boleto_doc">
								                        <label class="control-label">Doc. Boleto</label>
								                        <input ng-model="item.doc_boleto" type="text" class="form-control">
								                    </div>
								                </div>

								                <div class="col-sm-2">
								                    <div class="form-group boleto_num">
								                        <label class="control-label">Núm. Boleto</label>
								                        <input ng-model="item.num_boleto" type="text" class="form-control">
								                    </div>
								                </div>

								                <div class="col-sm-1">
								                    <div class="row">
								                        <div class="col-sm-6">
								                            <label class="control-label"><br></label>
								                            <label class="label-checkbox">
								                                <input ng-model="item.status_pagamento" value="1" type="checkbox" id="toggleLine" ng-true-value="1" ng-false-value="0">
								                                <span class="custom-checkbox"></span>
								                                Pago?
								                            </label>
								                        </div>
								                        <div class="col-sm-6" ng-show="boletos.length > 1">
								                            <div class="form-group">
								                                <label class="control-label"><br></label>
								                                <label class="control-label">
								                                    <i ng-click="delItemBoleto($index)" class="fa fa-times-circle-o fa-lg" style="color: red;cursor:pointer"></i>
								                                </label>
								                            </div>
								                        </div>
								                    </div>
								                </div>

								            </div>
								        <div class="row">
								            <div class="col-sm-12 text-center">
								                <label class="control-label">&nbsp</label>
								                <div class="form-group ">
								                    <button type="button" class="btn btn-md btn-success btn-block"   ng-click="aplicarRecebimento()">Receber</button>
								                </div>
								            </div>
								        </div>
								    </div>
								    <div class="col-sm-3">
								        <table class="table table-bordered table-condensed table-striped table-hover">
								            <thead ng-show="(clientes.length != 0)">
								                <tr>
								                    <th colspan="2" class="text-center">Recebidos</th>
								                </tr>
								            </thead>
								            <tbody>
								                <tr ng-show="(recebidos.length == 0)">
								                    <td colspan="2">Não há nenhum pagamento recebido</td>
								                </tr>
								                <tr ng-repeat="item in recebidos">
								                    <td ng-show="item.id_forma_pagamento != 6 && item.id_forma_pagamento != 2 ">{{ item.forma_pagamento  }} <strong class="pull-right">R$ {{ item.valor | numberFormat:2:',':'.' }}</strong></td>
								                    <td ng-show="item.id_forma_pagamento == 6">C/C em {{item.parcelas}}x <strong class="pull-right">R$ {{ item.valor | numberFormat:2:',':'.' }}</strong></td>
								                    <td ng-show="item.id_forma_pagamento == 2">Cheque em {{ cheques.length }}x <strong class="pull-right">R$ {{ item.valor | numberFormat:2:',':'.' }}</strong></td>
								                    <td width="50" align="center">
								                        <button type="button" class="btn btn-xs btn-danger" ng-click="deleteRecebidos($index)">
								                            <i class="fa fa-times"></i>
								                        </button>
								                    </td>
								                </tr>
								                <tr>
								                    <td colspan="2" style="background: #A2A2A2;">

								                    </td>
								                </tr>
								                <tr>
								                    <td colspan="2">
								                        Total Recebido <strong class="pull-right">R$ {{ total_pg | numberFormat:2:',':'.' }}</strong>
								                    </td>
								                </tr>
								                <tr>
								                    <td colspan="2" ng-show="total_pg <= vlrTotalCompra">
								                        Total a Receber <strong class="pull-right">R$ {{ vlrTotalCompra - total_pg | numberFormat:2:',':'.' }}</strong>
								                    </td>
								                    <td colspan="2" ng-show="total_pg > vlrTotalCompra" >
								                        Total a Receber <strong class="pull-right">R$ 0,00</strong>
								                    </td>
								                </tr>
								                <tr ng-show="modo_venda == 'pdv'">
								                    <td colspan="2">
								                        Troco <strong class="pull-right">R$ {{ troco | numberFormat:2:',':'.' }}</strong>
								                    </td>
								                </tr>
								                <tr ng-show="modo_venda == 'est' && (total_pg > vlrTotalCompra)">
								                    <td colspan="2">
								                        Troco sugerido<strong class="pull-right">R$ {{ ((vlrTotalCompra - total_pg) * (-1)) | numberFormat:2:',':'.' }}</strong>
								                    </td>
								                </tr>
								                <tr ng-show="modo_venda == 'est' && (total_pg > vlrTotalCompra)">
								                    <td colspan="2">
								                        <div class="row">
								                            <div class="col-sm-10">
								                                Troco
								                            </div>
								                            <div class="col-sm-2">
								                                  <input ng-model="troco_opcional" thousands-formatter class="form-control input-sm" >
								                            </div>
								                        </div>
								                    </td>
								                </tr>
								            </tbody>
								        </table>
								    </div>
								    </div>
								    <div class="row">
								    	<div class="pull-right">
											<button class="btn btn-danger" ng-click="cancelarPagamento()"><i class="fa fa-times-circle"></i> Cancelar</button>
											&nbsp;
											<button type="button" class="btn btn-success pull-right" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Aguarde..." id="btn-pagamneto" ng-click="salvarPagamento()" ng-disabled="total_pg < vlrTotalCompra"><i class="fa fa-save"></i> Finalizar</button>
										</div>
								    </div>
								</div>
							</div>
						</div>
				    </div>
			  	</div>
			  	<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- /Modal Clientes-->
        <div class="modal fade" id="list_clientes" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Pacientes</span></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input ng-model="busca.clientes"  ng-enter="loadCliente(0,10)" type="text" class="form-control input-sm">
                                    <div class="input-group-btn">
                                        <button ng-click="loadCliente(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div> <!-- /input-group-btn -->
                                </div> <!-- /input-group -->
                            </div><!-- /.col -->
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-condensed table-striped table-hover">
                                    <tr ng-show="clientes != false && (clientes.length <= 0 || clientes == null)">
                                        <th class="text-center" colspan="9" style="text-align:center"><strong>Carregando</strong><img src="assets/imagens/progresso_venda.gif"></th>
                                    </tr>
                                    <tr ng-show="clientes == false">
                                        <th colspan="4" class="text-center">Não a resultados para a busca</th>
                                    </tr>
                                    <thead ng-show="(clientes.length != 0)">
                                        <tr>
                                            <th >Nome</th>
                                            <th >Apelido</th>
                                            <th >Perfil</th>
                                            <th colspan="2">selecionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in clientes">
                                            <td>{{ item.nome }}</td>
                                            <td>{{ item.apelido }}</td>
                                            <td>{{ item.nome_perfil }}</td>
                                            <td width="50" align="center">
                                                <button type="button" class="btn btn-xs btn-success" ng-click="addCliente(item)">
                                                    <i class="fa fa-check-square-o"></i> Selecionar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pagination pagination-xs m-top-none pull-right" ng-show="paginacao_clientes.length > 1">
                                    <li ng-repeat="item in paginacao_clientes" ng-class="{'active': item.current}">
                                        <a href="" h ng-click="loadCliente(item.offset,item.limit)">{{ item.index }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /Modal procedimentos-->
        <div class="modal fade" id="list_procedimentos" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Procedimentos</span></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input ng-model="busca.procedimentos"  ng-enter="loadProcedimentos(0,10)" type="text" class="form-control input-sm">
                                    <div class="input-group-btn">
                                        <button ng-click="loadProcedimentos(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div> <!-- /input-group-btn -->
                                </div> <!-- /input-group -->
                            </div><!-- /.col -->
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-condensed table-striped table-hover">
                                    <tr ng-show="procedimentos != false && (procedimentos.length <= 0 || procedimentos == null)">
                                        <th class="text-center" colspan="9" style="text-align:center"><strong>Carregando</strong><img src="assets/imagens/progresso_venda.gif"></th>
                                    </tr>
                                    <tr ng-show="procedimentos == false">
                                        <th colspan="4" class="text-center">Não a resultados para a busca</th>
                                    </tr>
                                    <thead ng-show="(procedimentos.length != 0)">
                                        <tr>
                                            <th >ID</th>
                                            <th >Descrição</th>
                                            <th ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in procedimentos">
                                            <td>{{ item.id }}</td>
                                            <td>{{ item.dsc_procedimento }}</td>
                                            <td width="50" align="center">
                                                <button type="button" class="btn btn-xs btn-success" ng-click="addProcedimento(item)">
                                                    <i class="fa fa-check-square-o"></i> Selecionar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pagination pagination-xs m-top-none pull-right" ng-show="paginacao_procedimentos.length > 1">
                                    <li ng-repeat="item in paginacao_procedimentos" ng-class="{'active': item.current}">
                                        <a href="" h ng-click="loadProcedimentos(item.offset,item.limit)">{{ item.index }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- /Modal odontograma-->
		<div class="modal fade" id="list_odontogramas" style="display:none">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4>Odontograma</span></h4>
		            </div>
		            <div class="modal-body">
		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="input-group">
		                            <input ng-model="busca.odontogramas"  ng-enter="loadOdontogramas(0,10)" type="text" class="form-control input-sm">
		                            <div class="input-group-btn">
		                                <button ng-click="loadOdontogramas(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button">
		                                    <i class="fa fa-search"></i> Buscar
		                                </button>
		                            </div> <!-- /input-group-btn -->
		                        </div> <!-- /input-group -->
		                    </div><!-- /.col -->
		                </div>
		                <br />
		                <div class="row">
		                    <div class="col-sm-12">
		                        <table class="table table-bordered table-condensed table-striped table-hover">
		                            <tr ng-show="odontogramas != false && (odontogramas.length <= 0 || odontogramas == null)">
		                                <th class="text-center" colspan="9" style="text-align:center"><strong>Carregando</strong><img src="assets/imagens/progresso_venda.gif"></th>
		                            </tr>
		                            <tr ng-show="odontogramas == false">
		                                <th colspan="4" class="text-center">Não a resultados para a busca</th>
		                            </tr>
		                            <thead ng-show="(odontogramas.length != 0)">
		                                <tr>
		                                    <th >Cod.</th>
		                                    <th >Dente</th>
		                                    <th colspan="2">selecionar</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <tr ng-repeat="item in odontogramas">
		                                    <td>{{ item.cod_dente }}</td>
		                                    <td>{{ item.nme_dente }}</td>
		                                    <td width="50" align="center">
		                                        <button type="button" class="btn btn-xs btn-success" ng-click="addOdontograma(item)">
		                                            <i class="fa fa-check-square-o"></i> Selecionar
		                                        </button>
		                                    </td>
		                                </tr>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <ul class="pagination pagination-xs m-top-none pull-right" ng-show="paginacao_odontogramas.length > 1">
		                            <li ng-repeat="item in paginacao_odontogramas" ng-class="{'active': item.current}">
		                                <a href="" h ng-click="loadOdontogramas(item.offset,item.limit)">{{ item.index }}</a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		 <!-- /Modal odontograma-->
		<div class="modal fade" id="list_face_dente" style="display:none">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4>Faces</span></h4>
		            </div>
		            <div class="modal-body">
		                <div class="row">
		                    <div class="col-md-12">
		                        <div class="input-group">
		                            <input ng-model="busca.faces"  ng-enter="loadFaceDente(0,10)" type="text" class="form-control input-sm">
		                            <div class="input-group-btn">
		                                <button ng-click="loadFaceDente(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button">
		                                    <i class="fa fa-search"></i> Buscar
		                                </button>
		                            </div> <!-- /input-group-btn -->
		                        </div> <!-- /input-group -->
		                    </div><!-- /.col -->
		                </div>
		                <br />
		                <div class="row">
		                    <div class="col-sm-12">
		                        <table class="table table-bordered table-condensed table-striped table-hover">
		                            <tr ng-show="faces != false && (faces.length <= 0 || faces == null)">
		                                <th class="text-center" colspan="9" style="text-align:center"><strong>Carregando</strong><img src="assets/imagens/progresso_venda.gif"></th>
		                            </tr>
		                            <tr ng-show="faces == false">
		                                <th colspan="4" class="text-center">Não a resultados para a busca</th>
		                            </tr>
		                            <thead ng-show="(faces.length != 0)">
		                                <tr>
		                                    <th >Cod.</th>
		                                    <th >Descrição</th>
		                                    <th colspan="2">selecionar</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                                <tr ng-repeat="item in faces">
		                                    <td>{{ item.cod_face }}</td>
		                                    <td>{{ item.dsc_face }}</td>
		                                    <td width="50" align="center">
		                                        <button type="button" class="btn btn-xs btn-success" ng-click="addFaceDente(item)">
		                                            <i class="fa fa-check-square-o"></i> Selecionar
		                                        </button>
		                                    </td>
		                                </tr>
		                            </tbody>
		                        </table>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-sm-12">
		                        <ul class="pagination pagination-xs m-top-none pull-right" ng-show="paginacao_faces.length > 1">
		                            <li ng-repeat="item in paginacao_faces" ng-class="{'active': item.current}">
		                                <a href="" h ng-click="loadFaceDente(item.offset,item.limit)">{{ item.index }}</a>
		                            </li>
		                        </ul>
		                    </div>
		                </div>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

        <!-- /Modal Clientes-->
        <div class="modal fade" id="list_profissionais" style="display:none">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4>Profissionais</span></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input ng-model="busca.profissionais"  ng-enter="loadProfissionais(0,10)" type="text" class="form-control input-sm">
                                    <div class="input-group-btn">
                                        <button ng-click="loadProfissionais(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div> <!-- /input-group-btn -->
                                </div> <!-- /input-group -->
                            </div><!-- /.col -->
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-condensed table-striped table-hover">
                                    <tr ng-show="profissionais != false && (profissionais.length <= 0 || profissionais == null)">
                                        <th class="text-center" colspan="9" style="text-align:center"><strong>Carregando</strong><img src="assets/imagens/progresso_venda.gif"></th>
                                    </tr>
                                    <tr ng-show="profissionais == false">
                                        <th colspan="4" class="text-center">Não a resultados para a busca</th>
                                    </tr>
                                    <thead ng-show="(profissionais.length != 0)">
                                        <tr>
                                            <th >Nome</th>
                                            <th >Apelido</th>
                                            <th >Perfil</th>
                                            <th colspan="2">selecionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="item in profissionais">
                                            <td>{{ item.nome }}</td>
                                            <td>{{ item.apelido }}</td>
                                            <td>{{ item.nome_perfil }}</td>
                                            <td width="50" align="center">
                                                <button ng-show="id_profissional_atendimento != item.id" type="button" class="btn btn-xs btn-success" ng-click="addProfissional(item)">
                                                    <i class="fa fa-check-square-o"></i> Selecionar
                                                </button>
                                                <button ng-show="id_profissional_atendimento == item.id" ng-disabled="true" class="btn btn-primary btn-xs" type="button">
                                               		 <i class="fa fa-check-circle-o"></i> Selecionado
                                           		 </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pagination pagination-xs m-top-none pull-right" ng-show="paginacao_profissionais.length > 1">
                                    <li ng-repeat="item in paginacao_profissionais" ng-class="{'active': item.current}">
                                        <a href="" h ng-click="loadProfissionais(item.offset,item.limit)">{{ item.index }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
				    	<button type="button" ng-disabled="id_profissional_atendimento == null" data-loading-text=" Aguarde..." class="btn btn-block btn-md btn-success"
				    		id="btn-fim-atendimento" ng-click="setFimAtendimento()">
				    		<i class="fa fa-minus-circle"></i> Finalizar
				    	</button>

				    	<button type="button" data-loading-text=" Aguarde..."
				    		class="btn btn-block btn-md btn-default" ng-click="cancelarModal('#list_profissionais')" id="btn-aplicar-sangria">
				    		<i class="fa fa-times-circle"></i> Cancelar
				    	</button>
				    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

		<!-- Footer
		================================================== -->
		<footer>
			<div class="row">
				<div class="col-sm-6">
					<span class="footer-brand">
						<strong class="text-danger">WebliniaERP</strong> Admin
					</span>
					<p class="no-margin">
						&copy; 2014 <strong>Weblinia Co.</strong> Todos os Direitos Reservados.
					</p>
				</div><!-- /.col -->
			</div><!-- /.row-->
		</footer>
	</div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>

	<!-- Logout confirmation -->
	<?php include("logoutConfirm.php"); ?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

	<!-- Jquery -->
	<script src="js/jquery-1.10.2.min.js"></script>

	<!-- Agenda -->
	<script src='js/agenda/lib/moment.min.js'></script>
	<script src='js/agenda/lib/jquery.min.js'></script>
	<script src='js/agenda/fullcalendar.min.js'></script>
	<script src='js/agenda/lang-all.js'></script> 

	<!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Easy Modal -->
    <script src="js/eModal.js"></script>

	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>

    <!-- Pace -->
	<script src='js/pace.min.js'></script>

	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>

    <!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>

	<!-- Datepicker -->
	<script src='js/bootstrap-datepicker.min.js'></script>

	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>

	<!-- Endless -->
	<script src="js/endless/endless.js"></script>

	<!-- Chosen -->
	<script src='js/chosen.jquery.min.js'></script>

	<!-- Extras -->
	<script src="js/extras.js"></script>

	<!-- Moment -->
	<script src="js/moment/moment.min.js"></script>

	<!-- AngularJS -->
	<script type="text/javascript" src="bower_components/angular/angular.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.tpl.min.js"></script>
	<script type="text/javascript" src="bower_components/angular-ui-utils/mask.min.js"></script>
    <script src="js/angular-sanitize.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    <script src="js/dialogs.v2.min.js" type="text/javascript"></script>
    <script src="js/auto-complete/ng-sanitize.js"></script>
    <script src="js/angular-chosen.js"></script>
    <script src="js/app.js"></script>
    <script src="js/auto-complete/AutoComplete.js"></script>
    <script src="js/angular-services/user-service.js"></script>
	<script src="js/angular-controller/agendamento_consulta-controller.js"></script>
	<script type="text/javascript">
		$('.tab-bar li').click(function(event){
	        if ($(this).hasClass('disabled')) {
	            return false;
	        }
    	});
	</script>
	<?php include("google_analytics.php"); ?>
  </body>
</html>
