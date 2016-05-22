app.controller('CaixasController', function($scope, $http, $window, $dialogs, UserService){

	var ng = $scope
		aj = $http;

	ng.baseUrl 						= baseUrl();
	ng.userLogged 					= UserService.getUserLogado();
    ng.contas    					= [];
    ng.paginacao           			= {conta:null} ;
    ng.busca               			= {empreendimento:""} ;
    ng.conta                        = {} ;

    ng.editing = false;

    ng.showBoxNovo = function(onlyShow){
    	if(onlyShow) {
			$('i','#btn-novo').removeClass("fa-plus-circle").addClass("fa-minus-circle");
			$('#box-novo').show();
		}
		else {
			$('#box-novo').toggle(400, function(){
				if($(this).is(':visible')){
					$('i','#btn-novo').removeClass("fa-plus-circle").addClass("fa-minus-circle");
				}else{
					$('i','#btn-novo').removeClass("fa-minus-circle").addClass("fa-plus-circle");
				}
			});
		}
	}

	ng.mensagens = function(classe , msg){
		$('.alert-sistema').removeClass("alert-danger");
		$('.alert-sistema').removeClass("alert-success");
		$('.alert-sistema').removeClass("alert-warning");
		$('.alert-sistema').removeClass("alert-info");
		$('.alert-sistema')
			.fadeIn()
			.addClass(classe)
			.html(msg);

		setTimeout(function(){
			$('.alert-sistema').fadeOut('slow');
		},5000);
	}

	ng.reset = function(show) {
		show = show == true ? true : false ;
		ng.conta = {};
		$('[name="perc_taxa_maquineta"]').val('');
		ng.empreendimentosAssociados = [];
		ng.editing = false;
		$($(".has-error").find(".form-control")).tooltip('destroy');
		$(".has-error").removeClass("has-error");
		if(show)
			ng.showBoxNovo();
	}

	ng.loadContas = function(offset,limit) {
		offset = offset == null ? 0  : offset;
    	limit  = limit  == null ? 20 : limit;
		ng.contas = [] ;
		aj.get(baseUrlApi()+"contas_bancarias/?id_tipo_conta=5&id_empreendimento="+ng.userLogged.id_empreendimento)
			.success(function(data, status, headers, config) {
				ng.contas = data.contas;
				ng.paginacao.conta = data.paginacao;
			})
			.error(function(data, status, headers, config) {
				if(status == 404)
					ng.contas = [];
			});
	}

	ng.loadConta = function() {
		ng.conta = {} ;
		aj.get(baseUrlApi()+"conta_bancaria")
			.success(function(data, status, headers, config) {
				ng.conta = data;
			})
			.error(function(data, status, headers, config) {
				if(status == 404)
					ng.conta = [];
	 	});
	}

	ng.loadDepositos = function() {
		aj.get(baseUrlApi()+"depositos?id_empreendimento="+ng.userLogged.id_empreendimento)
			.success(function(data, status, headers, config) {
				$.each(data.depositos,function(i,x){
					data.depositos[i].id = Number(x.id);
				});
				ng.depositos = data.depositos;
			})
			.error(function(data, status, headers, config) {
				if(status == 404)
					ng.depositos = [];
	 	});
	}

	ng.salvar = function() {

		var url   = ng.editing ? "conta_bancaria/update" : "conta_bancaria";
		var conta = angular.copy(ng.conta);

		//conta.perc_taxa_maquineta = conta.perc_taxa_maquineta / 100 ;
		conta.id_empreendimento   = ng.userLogged.id_empreendimento;
		conta.id_tipo_conta       = 5 ;

		/*if(isNaN(conta.perc_taxa_maquineta))
			conta.perc_taxa_maquineta = 0 ;
		*/

		$($(".has-error").find(".form-control")).tooltip('destroy');
		$($(".has-error-plano")).tooltip('destroy');
		$($(".has-error").find("button")).tooltip('destroy');
		$(".has-error").removeClass("has-error");
		$($(".has-error-plano")).removeClass("has-error-plano");

		aj.post(baseUrlApi()+url, conta)
			.success(function(data, status, headers, config) {
				ng.mensagens('alert-success','<strong>Conta salva com sucesso!</strong>');
				ng.showBoxNovo();
				ng.reset();
				ng.loadContas();
			})
			.error(function(data, status, headers, config) {
				if(status == 406) {
					var errors = data;

					$.each(errors, function(i, item) {
						$("#"+i).addClass("has-error");

						var formControl = $("#"+i)
							.attr("data-toggle", "tooltip")
							.attr("data-placement", "bottom")
							.attr("title", item)
							.attr("data-original-title", item);
						formControl.tooltip();
					});
				}
			});
	}

	ng.editar = function(item) {
		ng.editing = true;
		item.perc_taxa_maquineta = item.perc_taxa_maquineta * 100 ;
		$('[name="perc_taxa_maquineta"]').val(numberFormat(item.perc_taxa_maquineta,'2',',','.'));
		ng.conta = angular.copy(item);
		if(!$('#box-novo').is(':visible')){
			ng.showBoxNovo();
		}
	}

	ng.delete = function(item){
		dlg = $dialogs.confirm('Atenção!!!' ,'<strong>Tem certeza que deseja excluir esta conta?</strong>');

		dlg.result.then(function(btn){
			aj.get(baseUrlApi()+"conta_bancaria/delete/"+item.id)
				.success(function(data, status, headers, config) {
					ng.mensagens('alert-success','<strong>Conta excluida com sucesso</strong>','.alert-delete');
					ng.reset();
					ng.loadContas();
				})
				.error(defaulErrorHandler);
		}, undefined);
	}

	ng.loadBancos = function(offset,limit) {
		offset = offset == null ? 0  : offset;
    	limit  = limit  == null ? 20 : limit;

		ng.bancos = [];

		aj.get(baseUrlApi()+"bancos")
			.success(function(data, status, headers, config) {
				ng.bancos = data.bancos;
			})
			.error(function(data, status, headers, config) {

			});
	}

	ng.loadtipos = function(offset,limit) {
		offset = offset == null ? 0  : offset;
    	limit  = limit  == null ? 20 : limit;

		ng.tipos = [];

		aj.get(baseUrlApi()+"contas_bancarias/tipos")
			.success(function(data, status, headers, config) {
				ng.tipos = data.tipos;
			})
			.error(function(data, status, headers, config) {

			});
	}

	ng.loadOperacaoCombo = function() {
		ng.lista_operacao  = [{cod_operacao:null,dsc_operacao:'Selecione'}] ;
		aj.get(baseUrlApi()+"operacao/get/?cod_empreendimento="+ng.userLogged.id_empreendimento+"&flg_excluido=0")
			.success(function(data, status, headers, config) {
				ng.lista_operacao = ng.lista_operacao.concat(data.operacao);
				setTimeout(function(){
					$("select").trigger("chosen:updated");
				},300);
			})
			.error(function(data, status, headers, config) {
					
			});
	}

	ng.mensagens = function(classe , msg, alertClass){
		alertClass = alertClass != null  ?  alertClass:'.alert-sistema' ;
		$(alertClass).fadeIn().addClass(classe).html(msg);
		setTimeout(function(){
			$(alertClass).fadeOut('slow');
		},5000);
	}


	function defaulErrorHandler(data, status, headers, config) {
		ng.mensagens('alert-danger','<strong>'+ data +'</strong>');
	}

	ng.loadContas(0,30);
	ng.loadOperacaoCombo();
	ng.loadBancos();
	ng.loadtipos();
	ng.loadDepositos();
});
