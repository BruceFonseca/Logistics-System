$(function(){

	// cria uma nova aba referente a transação selecionada pelo usuário
	$(".dropdown-menu li a").click(function(){
		var controller = $(this).attr('ctr'); //este atributo será utilizado para trazer o controller da transaçãoque será utilizado para manupulkar abas (abrir fechar etc) as abas
		var desc = $(this).text(); // pega descrição do menu e utiliza nas abas que serão abertas

		var numTran = numTab();

		$('.nav.nav-tabs li').removeClass('active');
		
		var $addAba = '<li class="active"><a href="#" numtab="'+ numTran +'" id=" '+ desc  +'" crt="'+ controller +'">'+ desc  +'<span>x</span></a></li>';

	    $(".nav.nav-tabs").append($addAba);

	    addConteudo(numTran);//cria uma div com classe conteudo
	    ocultaConteudo(); //oculta todos os conteudos
		exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
		addConteudoDiv(numTran, controller); //
	});

	// deixa a aba ativa e o respectivo conteudo tb
	$(".nav.nav-tabs").on("click", "li", function(){
		var numTran = $(this).children('a').attr('numtab');
	    $('.nav.nav-tabs li').removeClass('active');
		$(this).addClass('active');
		ocultaConteudo(); //oculta todos os conteudos
		exibeConteudo(numTran); //exibe conteudo apenas da aba selecionada
	});

	// fecha a aba e seu respectivo conteudo
	$(".nav.nav-tabs").on("click", "li a span", function(){
		var numtab = $(this).closest("a").attr("numtab");
		$('a[numtab="'+ numtab +'"]').parent().remove();//remove a aba do numtab selecionado
		$('div[numtab="'+ numtab +'"]').remove(); //remove a div que contem o numtab selecionado
	});

	// cria uma div com o conteudo da transação selecionada pelo usuário
	function addConteudo(numTran){
		var counter = numTran;
		$('.conteudo-principal').append('<div class="conteudo" numtab="'+numTran+'">' + numTran+ '</div>');
		// $('<div class="conteudo">conteudo</div>');
	}

	// verifica o maior numero de controle de aba existente e retorna o maior mais 1
	function numTab(){

		numTran = parseInt($(".nav.nav-tabs li a").last().attr('numtab'));

		// se não é um numero, então começa com 100
		if (isNaN(numTran)) {
			numTran = 100;
		} else{ //senão acrescenta mais um
			numTran ++;
		};
		
		return parseInt(numTran);
	}

	// função que exibe o conteudo de acordo com o numtab
	function exibeConteudo(numTran){
		$('div[numtab="'+ numTran +'"]').show();
	}
	//oculta todos os conteudos.
	function ocultaConteudo(){
		$('.conteudo-principal .conteudo').hide();
	}

	//adiciona o conteudo recebido do controler na div conteudo
	function addConteudoDiv(numTran, controller){

		var href = controller;
			$.ajax({
				url: href,
				success: function( response ){
					//forçando o parser
					// var data = $( '<div>'+response+'</div>' ).find('.conteudo').html();
 					$('div[numtab="'+ numTran +'"]').append(response + "    " + href + '<br>');
					// //apenas atrasando a troca, para mostrarmos o loading
					// window.setTimeout( function(){
					// 		content.html( data ).fadeIn();
					// }, 500 );
				}
			});
	}

}); //fim do código