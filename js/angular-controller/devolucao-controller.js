app.controller('DevolucaoController', function($scope, $http, $window,$dialogs, UserService){

	var ng = $scope
		aj = $http;

	ng.baseUrl 				= baseUrl();
	ng.userLogged 			= UserService.getUserLogado();
	ng.id_venda				= null ;
	ng.itens_venda          = null ;
	ng.busca_return_empty   = false ;
	ng.view					= { busca_return_empty : false,cadastar_cliente:false,cadastro_novo_cliente:false } ;
	ng.cliente              = {tipo_cadastro:'pf'};
	ng.busca                = {clientes:''};
	ng.clientes             = [];
	ng.cliente_selecionado  = {} ;

	ng.showBoxNovaDevolucao = function(onlyShow){
    	//ng.editing = !ng.editing;

    	if(onlyShow) {
			$('i','#btn-nova-devolucao').removeClass("fa-plus-circle").addClass("fa-minus-circle");
			$('#box-novo-pedido').show();
		}
		else {
			$('#box-novo-pedido').toggle(400, function(){
				if($(this).is(':visible')){
					$('i','#btn-nova-devolucao').removeClass("fa-plus-circle").addClass("fa-minus-circle");
				}else{
					$('i','#btn-nova-devolucao').removeClass("fa-minus-circle").addClass("fa-plus-circle");
				}
			});
		}
	}

	ng.loadVenda = function(id_venda) {
		if(empty(id_venda))
			return ;

		ng.itens_venda = [];
		ng.venda       				  = null ;
		ng.view.cadastar_cliente 	  = false ;
		ng.view.busca_return_empty    = false ;
		ng.cliente_selecionado        = {} ;

		aj.get(baseUrlApi()+"devolucao/venda/"+id_venda+"/"+ng.userLogged.id_empreendimento)
			.success(function(data, status, headers, config) {
					if(ng.configuracoes.id_cliente_movimentacao_caixa == data.venda.id_cliente){
						ng.view.cadastar_cliente = true ;
					}

					ng.itens_venda 	= data.itens ;
					ng.venda    	= data.venda ;

			})
			.error(function(data, status, headers, config) {
				ng.view.busca_return_empty = true ;
				ng.view.busca_id_empty    = ng.id_venda ;
			});
	}

	ng.loadConfig = function(){
		var error = 0 ;
		aj.get(baseUrlApi()+"configuracoes/"+ng.userLogged.id_empreendimento)
			.success(function(data, status, headers, config) {
				ng.configuracoes = data ;
			})
			.error(function(data, status, headers, config) {
					ng.caixa_configurado = false ;
			});
	}

	ng.showModalCastroCliente = function(){
		$('#modal-cadastro_cliente').modal({
		  backdrop: 'static',
		  keyboard: false
		});
		$('.modal-backdrop.in').css({opacity:1,'background-color':'#C7C7C7'});
	}

	ng.loadPerfil = function () {
		ng.perfis = [];

		aj.get(baseUrlApi()+"perfis")
		.success(function(data, status, headers, config) {
			ng.perfis = data;
		})
		.error(function(data, status, headers, config) {

		});
	}

	ng.removeError = function(){
		$($(".has-error").find(".form-control")).tooltip('destroy');
		$(".has-error").tooltip('destroy');
		$(".has-error").css({border:"none",background: 'none'}).addClass('has-error');
		$(".has-error").parent().css({'background':'none'});
		$(".has-error").tooltip('destroy');
		$(".has-error").removeClass("has-error");
	}

	ng.salvarCliente = function(){
		ng.removeError();
		ng.cliente.empreendimentos = [{id:ng.userLogged.id_empreendimento}];
		ng.cliente.id_empreendimento = ng.userLogged.id_empreendimento;
		var btn = $('#btn-salvar-cliente');
		btn.button('loading');
		aj.post(baseUrlApi()+"cliente/cadastro/rapido",ng.cliente)
		.success(function(data, status, headers, config) {
			btn.button('reset');
			ng.view.cadastar_cliente = true ;
			ng.view.cadastro_novo_cliente = false ;
			ng.cliente_selecionado = {id:data.id,nome:ng.cliente.nome} ;
		})
		.error(function(data, status, headers, config) {
			btn.button('reset');
			if(status == 406) {
		 			var errors = data;

		 			$.each(errors, function(i, item) {
		 				$("#"+i).addClass("has-error");

		 				var formControl = $($("#"+i))
		 					.attr("data-toggle", "tooltip")
		 					.attr("data-placement", "bottom")
		 					.attr("title", item)
		 					.attr("data-original-title", item);
		 				formControl.tooltip();

		 				if(i == "email_marketing" || i == "indicacao"){
		 					$("#"+i).parent().css({'background':'#E9D8D7'});
		 					$("#"+i).parent().attr("data-toggle", "tooltip")
		 					.attr("data-placement", "bottom")
		 					.attr("title", item)
		 					.attr("data-original-title", item);
		 					$("#"+i).parent().tooltip();
		 				}
		 			});
		 		}
		});
	}

	ng.loadClientes = function(offset, limit) {
		offset = offset == null ? 0  : offset;
		limit  = limit  == null ? 10 : limit;
		ng.clientes = [] ;
		var query_string = "?(tue->id_empreendimento[exp]=="+ng.userLogged.id_empreendimento+")";

		if(ng.busca.clientes != ""){
			query_string += "&"+$.param({"(usu->nome":{exp:"like'%"+ng.busca.clientes+"%' OR apelido like '%"+ng.busca.clientes+"%')"}})+"";
		}

		aj.get(baseUrlApi()+"usuarios/"+ offset +"/"+ limit +"/"+query_string)
			.success(function(data, status, headers, config) {
				ng.clientes = [];
				ng.paginacao.itens = data.paginacao;
				$.each(data.usuarios,function(i, item){
					item.id_como_encontrou = item.id_como_encontrou == null || item.id_como_encontrou == "" ? 'outros' : item.id_como_encontrou ;
					ng.clientes.push(item);
				});
				ng.loadSaldoDevedorClientes();
			})
			.error(function(data, status, headers, config) {
				if(status == 404)
					ng.clientes = [];
			});
	}

	ng.selCliente = function(){
		var offset = 0  ;
    	var limit  =  10 ;;

			ng.loadCliente(offset,limit);
			$("#list_clientes").modal("show");
	}


	ng.addCliente = function(item){
    	ng.cliente_selecionado = item;
    	$("#list_clientes").modal("hide");
	}

	ng.loadCliente= function(offset,limit) {
		offset = offset == null ? 0  : offset;
    	limit  = limit  == null ? 10 : limit;
		ng.clientes = [];
		query_string = "?(tue->id_empreendimento[exp]=="+ng.userLogged.id_empreendimento+")";

		if(ng.busca.clientes != ""){
			query_string += "&"+$.param({'(usu->nome':{exp:"like'%"+ng.busca.clientes+"%' OR usu.apelido LIKE '%"+ng.busca.clientes+"%')"}});
		}

		aj.get(baseUrlApi()+"usuarios/"+offset+"/"+limit+"/"+query_string)
			.success(function(data, status, headers, config) {
				ng.clientes = data.usuarios;
				ng.paginacao_clientes = data.paginacao;

			})
			.error(function(data, status, headers, config) {

			});
	}

	ng.atualizarRegistros = function(id_venda,id_cliente){
		id_venda   = Number(id_venda);
		id_cliente = Number(id_cliente);

		if(empty(ng.cliente_selecionado.id)){
			$("#busca_cliente").addClass("has-error");

		 				var formControl = $($("#busca_cliente"))
		 					.attr("data-toggle", "tooltip")
		 					.attr("data-placement", "bottom")
		 					.attr("title", 'Selecione um cliente')
		 					.attr("data-original-title", 'Selecione um cliente');
		 				formControl.tooltip();
		 	return;
		}

		var btn = $('#btn-salvar-vincular-cliente');
		btn.button('loading');

		aj.get(baseUrlApi()+"devolucao/atualizar/"+id_venda+"/"+id_cliente+"/"+ng.userLogged.id_empreendimento)
			.success(function(data, status, headers, config) {
				ng.itens_venda 	= data.itens ;
				ng.venda    	= data.venda ;
				ng.cliente_selecionado  = {} ;
				ng.view.cadastar_cliente = false ;
				btn.button('reset');
			})
			.error(function(data, status, headers, config) {
				btn.button('reset');
			});
	}

	ng.comparaQtd = function(item,index){
		//console.log(item,index);
		var qtd 				= Number(item.qtd);
		var qtd_devolvida 		= Number(item.qtd_devolvida);
		var qtd_devolvida_real 	= Number(item.qtd_devolvida_real);

		if(qtd_devolvida > (qtd-qtd_devolvida_real)){
			var formControl = $($("#qtd-devolvida-"+index))
				.attr("data-toggle", "tooltip")
				.attr("data-placement", "bottom")
				.attr("title", 'A quatidade da devolução não pode ser maior que a vendida')
				.attr("data-original-title", 'A quatidade da devolução não pode ser maior que a vendida');
			formControl.tooltip('show');
			$('#qtd-devolvida-'+index).attr('style','') ;
			setTimeout(function(){
				$("#qtd-devolvida-"+index).tooltip('destroy');
			}, 4000);
			item.qtd_devolvida = null ;
		}
	}

	ng.removeItemDevolucao = function(index){
		ng.itens_venda.splice(index,1);
	}

	ng.lancarDevolucao = function(){
		ng.removeError();
		var error = 0 ;
		var btn = $('#btn-lancar-devolucao');
		btn.button('loading');

		var itens_validos = [] ;

		$.each(ng.itens_venda,function(i,v){
			if(!empty(v.dta_devolvida) || !empty(v.qtd_devolvida)){
				itens_validos.push(v);
			}
		});

		$.each(itens_validos,function(i,v){
			if(empty(v.dta_devolvida)){
				$("#dta_validade-devolvida-"+i).parent().addClass("has-error");
				error ++ ;
			}
			if(empty(v.qtd_devolvida)){
				$("#qtd-devolvida-"+i).parent().addClass("has-error");
				error ++ ;
			}
		});

		if(itens_validos.length <= 0){
			ng.mensagens('alert-warning','<strong>É necessario informar a quantidade e a data de validade para os produtos que serão devolvidos</strong>','.alert-validade');
			btn.button('reset');
			return ;
		}

		if(error > 0){
			btn.button('reset');
			return false ;
		}

		var itens_devolucao = [] ;
		$.each(itens_validos,function(i,v){
			var ano       = parseInt(v.dta_devolvida.substring(2,6));
			var mes       = parseInt(v.dta_devolvida.substring(0,2)) -1;
			var objDate   = new Date(ano, mes , 1);

			itens_devolucao.push({
				id_produto           : v.id_produto,
				qtd 				 : v.qtd_devolvida,
				valor_real_devolucao : v.valor_real_item,
				dta_validade         : ano+'-'+(mes+1)+'-'+ultimoDiaDoMes(objDate),
				id_item_venda        : v.id_item,
				id_deposito          : v.id_deposito
			});

		});

		var devolucao = {
			id_empreendimento   : ng.userLogged.id_empreendimento,
			id_venda			: ng.venda.id,
			observacao			: '',
			id_operador         : ng.userLogged.id

		};

		var post = {
			devolucao 	    : devolucao,
			itens_devolucao : itens_devolucao
		}

		aj.post(baseUrlApi()+"devolucao",post)
			.success(function(data, status, headers, config) {
				btn.button('reset');
				ng.venda 		= null ;
				ng.itens_venda  = null ;
				ng.id_venda     = '' ;
				ng.mensagens('alert-success','<strong>Devolução realizada com sucesso</strong>','.alert-validade');
				ng.loadDevolucoes(0,10);
			})
			.error(function(data, status, headers, config) {
				btn.button('reset');
				alert('error fatal');
			});
	}

	ng.loadDevolucoes = function(offset,limit) {
		offset = offset == null ? 0  : offset;
		limit  = limit  == null ? 10 : limit;
		ng.devolucoes = [];
		aj.get(baseUrlApi()+"devolucoes/"+ng.userLogged.id_empreendimento+"/"+offset+"/"+limit)
			.success(function(data, status, headers, config) {
					ng.devolucoes           = data.devolucoes; 
					ng.paginacao_devolucoes = data.paginacao ;

			})
			.error(function(data, status, headers, config) {

			});
	}
	
	ng.viewDetalhes = function(item){
		ng.viewDetalhes.item = item;
		ng.viewDetalhes.itens   = [] ;
		$("#list-itens-devolucao").modal('show');
		aj.get(baseUrlApi()+"devolucao/itens/"+item.id)
			.success(function(data, status, headers, config) {
				ng.viewDetalhes.itens = data;
			})
			.error(function(data, status, headers, config) {
				ng.viewDetalhes.itens = null ;
			});
	}

	ng.mensagens = function(classe , msg, alertClass){
		alertClass = alertClass != null  ?  alertClass:'.alert-sistema' ;
		console.log($(alertClass));
		$(alertClass).fadeIn().addClass(classe).html(msg);
		setTimeout(function(){
			$(alertClass).fadeOut('slow');
		},5000);
	}

	ng.loadConfig();
	ng.loadPerfil();
	ng.loadDevolucoes(0,10);


});
