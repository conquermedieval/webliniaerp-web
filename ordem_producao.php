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
	<link href="css/font-awesome-4.1.0.min.css" rel="stylesheet">

	<!-- Pace -->
	<link href="css/pace.css" rel="stylesheet">

	<!-- Endless -->
	<link href="css/endless.min.css" rel="stylesheet">
	<link href="css/endless-skin.css" rel="stylesheet">

	<link href="css/custom.css" rel="stylesheet">

	<style type="text/css">

		/* Fix for Bootstrap 3 with Angular UI Bootstrap */

		.modal {
			display: block;
		}

		.tr-error-estoque{
			background-color: #FFB1B1;
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


	</style>
  </head>

  <body class="overflow-hidden" ng-controller="OrdemProducaoController" ng-cloak>
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
					 <li class="active"><i class="fa  fa-wrench"></i> Ordem de Produção</li>
				</ul>
			</div><!-- breadcrumb -->

			<div class="main-header clearfix">
				<div class="page-title">
					<h3 class="no-margin"><i class="fa  fa-wrench"></i> Ordem de Produção</h3>
					<br/>
					<a class="btn btn-info" id="btn-novo" ng-disabled="editing" ng-click="showBoxNovo()"><i class="fa fa-plus-circle"></i> Nova Ordem de Produção</a>
				</div><!-- /page-title -->
			</div><!-- /main-header -->

			<div class="padding-md">
				<div class="alert alert-sistema" style="display:none"></div>

				<div class="panel panel-default" id="box-novo" style="display:none">
					<div class="panel-heading"><i class="fa fa-plus-circle"></i> Nova Ordem de Produção</div>

					<div class="panel-body">
						<div class="row">
								<div class="col-sm-4">
									<div class="form-group" id="nme_deposito">
										<label class="control-label">Depósito</label>
										<div class="input-group">
											<input ng-model="ordemProducao.nme_deposito" ng-click="showDepositos()"   type="text" class="form-control input-sm" readonly="readonly" style="background-color: #FFF;cursor:pointer">
											<span  ng-click="showDepositos()" class="input-group-addon"><i class="fa fa-tasks"></i></span>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="empreendimentos form-group" id="itens">
										
											<table class="table table-bordered table-condensed table-striped table-hover">
												<thead>
													<tr>
														<td colspan="2"><i class="fa fa fa-th fa-lg"></i> Produtos</td>
														<td width="60" align="center">
															<button class="btn btn-xs btn-primary" ng-click="showProdutos()"><i class="fa fa-plus-circle"></i></button>
														</td>
													</tr>
												</thead>
												<tbody>
													<tr ng-show="(ordemProducao.itens.length == 0)">
														<td colspan="3" align="center">Nenhum Produto selecionado</td>
													</tr>
													<tr ng-repeat="item in ordemProducao.itens">
														<td>{{ item.nome }}</td>
														<td  width="80"><input onKeyPress="return SomenteNumero(event);" id="produto-qtd-{{$index}}"   ng-model="item.qtd" type="text" class="text-center form-control input-xs" /></td>
														<td align="center">
															<button class="btn btn-xs btn-danger" ng-click="delProduto($index,item)"><i class="fa fa-trash-o"></i></button>
														</td>
													</tr>
												</tbody>
											</table>
								
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="pull-right">
										<button ng-click="showBoxNovo(); reset();" type="submit" class="btn btn-danger btn-sm">
											<i class="fa fa-times-circle"></i> Cancelar
										</button>
										<button ng-click="salvar()" data-loading-text="Aguarde..." id="btn-salvar" type="submit" class="btn btn-success btn-sm">
											<i class="fa fa-save"></i> Salvar
										</button>
									</div>
								</div>
							</div>
					</div>
				</div><!-- /panel -->

				<div class="panel panel-default">
					<div class="panel-heading"><i class="fa fa-tasks"></i> Ordens de Produção</div>

					<div class="panel-body">
						<div class="alert alert-list-pedidos" style="display:none"  >
								
						</div>

						<table class="table table-bordered table-condensed table-striped table-hover">
							<tr>
								<td colspan="5" class="text-center" ng-if="ordem_producao.length == 0">
									Nenhuma Ordem de produção encontrada
								</td>
							</tr>
							<thead>
								<tr>
									<th>#</th>
									<th class="text-center" style="width: 170px;">Dta. Criação</th>
									<th>Responsável</th>
									<th class="text-center" style="width: 250px;">Status</th>
									<th width="125" style="text-align: center;">Opções</th>
								</tr>
							</thead>
							<tbody>
								<tr bs-tooltip ng-repeat="item in ordem_producao">
									<td width="80">{{ item.id }}</td>
									<td  class="text-center">{{ item.dta_create | dateFormat:'dateTime' }}</td>
									<td>{{ item.nome_responsavel }}</td>
									<td  class="text-center">{{ item.nome_status }}</td>
									<td align="center">
										<button ng-if="item.id_status == 1" data-loading-text="<i class='fa fa-refresh fa-spin'/>" type="button" ng-click="changeStatus(item,2,$event)" tooltip="Iniciar Produção" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Iniciar Produção">
											<i class="fa fa-unlock"></i>
										</button>

										<button ng-if="item.id_status == 2" data-loading-text="<i class='fa fa-refresh fa-spin'/>" type="button" ng-click="changeStatus(item,3,$event)" tooltip="Finalizar Produção" class="btn btn-xs btn-success" data-toggle="tooltip" title="Finalizar Produção">
											<i class="fa fa-lock"></i>
										</button>
										<button type="button" ng-click="showView(item)" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Ver Ordem de Produção">
											<i class="fa fa-tasks"></i>
										</button>
										<button type="button" ng-click="delete(item)"  class="btn btn-xs btn-danger delete" data-toggle="tooltip" title="Deletar">
											<i class="fa fa-trash-o"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="panel-footer clearfix">
						<div class="pull-right">
							<ul class="pagination pagination-sm m-top-none" ng-show="paginacao.ordem_producao.length > 1">
								<li ng-repeat="item in paginacao.ordem_producao" ng-class="{'active': item.current}">
									<a href="" h ng-click="loadOrdemProducao(item.offset,item.limit)">{{ item.index }}</a>
								</li>
							</ul>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div><!-- /main-container -->


		<!-- /Modal Produtos-->
		<div class="modal fade" id="list_produtos" style="display:none">
  			<div class="modal-dialog modal-lg">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 >Produtos</span></h4>
      				</div>
				    <div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="input-group">
						            <input ng-model="busca.produtos" ng-enter="loadProdutos(0,10)" type="text" class="form-control input-sm">

						            <div class="input-group-btn">
						            	<button tabindex="-1" class="btn btn-sm btn-primary" type="button"
						            		ng-click="loadProdutos(0,10)">
						            		<i class="fa fa-search"></i> Buscar
						            	</button>
						            </div> <!-- /input-group-btn -->
						        </div> <!-- /input-group -->
							</div><!-- /.col -->
						</div>

						<br>

						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-modal-produtos" style="display:none"></div>
						   		<table class="table table-bordered table-condensed table-striped table-hover">
									<thead ng-show="(produtos.length != 0)">
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Fabricante</th>
											<th>Qtd.</th>
											<th>Tamanho</th>
											<th>Sabor/Cor</th>
											<th width="80" >qtd</th>
											<th width="80"></th>
										</tr>
									</thead>
									<tbody>
										<tr ng-show="(produtos.length == 0)">
											<td colspan="3">Não a resultados para a busca</td>
										</tr>
										<tr ng-repeat="item in produtos">
											<td>{{ item.id_produto }}</td>
											<td>{{ item.nome }}</td>
											<td>{{ item.nome_fabricante }}</td>
											<td>{{ item.qtd_item }}</td>
											<td>{{ item.peso }}</td>
											<td>{{ item.sabor }}</td>
											<td><input onKeyPress="return SomenteNumero(event);" ng-keyUp="" ng-model="item.qtd" type="text" class="form-control input-xs" width="50" /></td>
											<td>
											<button ng-disabled="verificaProduto(item)" ng-click="addProduto(item)" class="btn btn-success btn-xs" type="button">
												<i class="fa fa-check-square-o"></i> Selecionar
											</button>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="input-group pull-right">
						             <ul class="pagination pagination-xs m-top-none" ng-show="paginacao.produtos.length > 1">
										<li ng-repeat="item in paginacao.produtos" ng-class="{'active': item.current}">
											<a href="" ng-click="loadProdutos(item.offset,item.limit)">{{ item.index }}</a>
										</li>
									</ul>
						        </div> <!-- /input-group -->
							</div>
						</div>
					</div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- /Modal Depositos-->
		<div class="modal fade" id="list_depositos" style="display:none">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Depósitos</span></h4>
      				</div>
				    <div class="modal-body">
				    	<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Busca pelo nome do Depósito</label>
									<div class="input-group">
							            <input ng-model="busca.depositos" type="text" class="form-control input-sm">
							            <div class="input-group-btn">
							            	<button ng-click="loadDepositos(0,10)" tabindex="-1" class="btn btn-sm btn-primary" type="button"><i class="fa fa-search"></i> Buscar</button>
							            </div>
							        </div>
								</div>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-sm-12">
						   		<table class="table table-bordered table-condensed table-striped table-hover">
									<thead ng-show="(depositos.length != 0)">
										<tr>
											<th colspan="2">Nome</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-show="(depositos.length == 0)">
											<td colspan="2">Não a Depósitos cadastrados</td>
										</tr>
										<tr ng-repeat="item in depositos">
											<td>{{ item.nme_deposito}}</td>
											<td width="50">
												<button ng-click="addDeposito(item)" class="btn btn-success btn-xs" type="button">
													<i class="fa fa-plus-circle"></i> Selecionar
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="input-group pull-right">
						             <ul class="pagination pagination-xs m-top-none" ng-show="paginacao.depositos.length > 1">
										<li ng-repeat="item in paginacao.depositos" ng-class="{'active': item.current}">
											<a href="" ng-click="loadDepositos(item.offset,item.limit)">{{ item.index }}</a>
										</li>
									</ul>
						        </div>
							</div>
						</div>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->


		<!-- /Modal detalhes da Ordem de Produção-->
		<div class="modal fade" id="list_detalhes" style="display:none">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Detalhes da Ordem de Produção</h4>
						<p class="muted" style="margin: 0px 0 1px;"><strong>Dta Criação </strong> : {{ viewOrdemProducao.dta_create  | dateFormat:"dateTime" }}</p>
						<p class="muted" style="margin: 0px 0 1px;"><strong>ID </strong> :  #{{ viewOrdemProducao.id }}</p>
						<p class="muted" style="margin: 0px 0 1px;" ><strong>Responsável :</strong> {{ viewOrdemProducao.nome_responsavel }}</p>
      					<p class="muted" style="margin: 0px 0 1px;"><strong>Status: </strong>{{ viewOrdemProducao.nome_status }}</p>
      				</div>
				    <div class="modal-body">
				   		<div class="row">
				   			<div class="col-sm-12">
				   				<div class="alert alert-detalhes" style="display:none">
				   					
				   				</div>
				   				<table class="table table-bordered table-condensed  ">
									<thead ng-show="(viewOrdemProducao.itens.length != 0)">
										<tr>
											<th class="text-center"  width="100">ID Produto</th>
											<th class="text-center">Produto</th>
											<th class="text-center" width="60">qtd</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="item in viewOrdemProducao.itens">
											<td  class="text-center">{{ item.id_produto }}</td>
											<td>{{ item.nome_produto }}</td>
											<td class="text-center">{{ item.qtd }}</td>
										</tr>
									</tbody>
								</table>



				   			</div>
				   		</div>
				   		<div class="row">
				   			<div class="col-sm-12">
				   				<ul class="pagination pagination-xs m-top-none pull-right" ng-if="paginacao.itens_ordem_producao.length > 1">
									<li ng-repeat="item in paginacao.itens_ordem_producao" ng-class="{'active': item.current}">
										<a href="" ng-click="loadItensOrdemProducao(item.offset,item.limit,viewOrdemProducao.id)">{{ item.index }}</a>
									</li>
								</ul>
				   			</div>
				   		</div>
				    </div>
				    <div class="modal-footer">
				 
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->


		<!-- /Modal fora de estoque-->
		<div class="modal fade" id="list_out_estoque" style="display:none">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Insumos Insuficientes</h4>
						<!--<p class="muted" style="margin: 0px 0 1px;"><strong>Dta Criação </strong> : {{ viewOrdemProducao.dta_create  | dateFormat:"dateTime" }}</p>
						<p class="muted" style="margin: 0px 0 1px;"><strong>ID </strong> :  #{{ viewOrdemProducao.id }}</p>
						<p class="muted" style="margin: 0px 0 1px;" ><strong>Responsável :</strong> {{ viewOrdemProducao.nome_responsavel }}</p>
      					<p class="muted" style="margin: 0px 0 1px;"><strong>Status: </strong>{{ viewOrdemProducao.nome_status }}</p>-->
      				</div>
				    <div class="modal-body">
				   		<div class="row">
				   			<div class="col-sm-12">
				   				<div class="alert alert-detalhes alert-warning">
				   					Os Insumos a baixo marcados em vermelho não tem estoque para continuar com o processo
				   				</div>
				   			
				   				<table class="table table-condensed">
									<tbody>	
										<tr ng-repeat-start="produto in list_out_estoque">
											<td style="background: #E8E8E8;width: 90%;">
												{{produto.nome_produto}} 
											</td>	
											<td style="background: #E8E8E8;" class="text-center">{{produto.qtd}}</td>
										</tr>
										<tr ng-repeat-end ng-repeat="insumo in produto.itens">
											<td colspan="2">
												<table class="table table-condensed" style="margin-bottom: 0;">
													<tbody>	
														<tr ng-class="{'tr-error-estoque':outEstoque(insumo)}">
															<td style="" class="text-center"> {{ insumo.id }} </td>
															<td style="width:91%;padding-left: 20px;">{{insumo.nome}} {{ insumo.nome_tamanho }} {{ insumo.nome_cor }}</td>	
														</tr>
													</tbody>
												</table>
											</td>	
										</tr>							
									</tbody>
								</table>
				   			</div>
				   		</div>
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

	<!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>

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

	<!-- Extras -->
	<script src="js/extras.js"></script>

	<!-- AngularJS -->
	<script type="text/javascript" src="bower_components/angular/angular.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular-strap/2.1.2/angular-strap.tpl.min.js"></script>
	<script type="text/javascript" src="bower_components/angular-ui-utils/mask.min.js"></script>
    <script src="js/angular-sanitize.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
    <script src="js/dialogs.v2.min.js" type="text/javascript"></script>
    <script src="js/auto-complete/ng-sanitize.js"></script>
    <script src="js/app.js"></script>
    <script src="js/auto-complete/AutoComplete.js"></script>
    <script src="js/angular-services/user-service.js"></script>
	<script src="js/angular-controller/ordem_producao-controller.js"></script>
	<script type="text/javascript"></script>>
	<?php include("google_analytics.php"); ?>
  </body>
</html>
