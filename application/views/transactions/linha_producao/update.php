<div class='form'>
<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
	 	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
</button>

<?php

	echo '<form method="post" action="" class="ajax_form">';

	echo form_fieldset('Atualizar linha de produção');

	echo '<div class="msg-apontamento"></div>';

	echo form_label('Linha');
	echo form_input(array('name'=>'linha', 'class'=>'linha'),    set_value('linha', $linha))."<br>";

	echo form_label('Média de produção');
	echo form_input(array('name'=>'qt_media_producao'),    set_value('qt_media_producao', $qt_media_producao))."<br>";

	echo form_label('Status');
	echo form_dropdown('ativo',  array("A"=>"Ativo", "I"=>"Inativo"), set_value('ativo', $cd_status), 1)."<br>";

	echo form_label('');
	echo form_button(array('name'=>'atualizar', 'class'=>'atualizar', 'content'=>'Atualizar', 'type'=>'submit'))."<br>";

	echo form_fieldset_close();
	echo form_close();

?>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	
	$('#fechar-apontamento-componente').on('click', function(){
		$('.apontamento').hide();
		$('.dados_componente').hide();
		$('.dados_componente .form').remove();
		$('.dados_componente .body-table-abastecimento').remove();
		$('.dados_componente script').remove();
	});

	$(".atualizar").click(function(){
		var linha = $(this).closest('fieldset').find('input[class="linha"]').val();
		
		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "linha_producao/update/"+ linha,
				data: dados,
				success: function( data )
				{
					// $('.dados_componente .form').remove();
					// $('.dados_componente script').remove();
					// $('.dados_componente div').remove();
					// $('.dados_componente').append(data);
					$('.msg-apontamento div').remove();
					$('.msg-apontamento').append(data);
				}
			});

			return false;
		});
	});
</script>