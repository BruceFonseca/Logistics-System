<?php 

$this->table->set_heading( 'Dt_apontamento', 'Motivo', 'Quantidate', 'Username', 'Nome' );

foreach ($status as $linha):
    $motivo = $linha->cd_motivo == "A"? "Abastecimento": "Desabastecimento";

    $this->table->add_row(
    $linha->dt_apontamento,
    $motivo,
    $linha->qt_apontada,
    $linha->usuario,
    $linha->nome
    );
endforeach;

 ?>

<div class='form'>
	
	<button type="button" class="btn btn-default" id="fechar-apontamento-componente">
	 	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Fechar
	</button>

<?php



echo '<form method="post" action="" class="apontamento-componente">';

echo form_fieldset('Apontar componente');

echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');

echo '<div class="msg-apontamento"></div>';
  
echo form_label('OF');
echo form_input(array('name'=>'of', 'class'=>'of', 'disabled'=>'TRUE'),  set_value('of', $dados_of->cd_of),'bloqued');

echo form_label('Linha');
echo form_input(array('name'=>'linha', 'class'=>'linha', 'disabled'=>'TRUE'),  set_value('cd_linha', $dados_of->cd_linha),'bloqued');

echo form_label('Produto');
echo form_input(array('name'=>'produto', 'class'=>'produto', 'disabled'=>'TRUE'),  set_value('cd_produto', $dados_of->cd_produto),'bloqued');

echo form_label('Componente');
echo form_input(array('name'=>'componente', 'class'=>'componente', 'disabled'=>'TRUE'),  set_value('cd_componente', $cd_componente),'bloqued');

echo form_label('Quantidade');
echo form_input(array('name'=>'quantidade', 'class'=>'quantidade'),  '','autofocus');



echo form_label('Ação');
echo form_dropdown('motivo',  array("A"=>"Abastecer", "D"=>"Desabastecer"),'A', 'class="motivo"')."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'submit-apontamento', 'content'=>'Apontar', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<div class="body-table-abastecimento">
    <?php echo $this->table->generate(); ?>
</div>

<script>
	$('#fechar-apontamento-componente').on('click', function(){
		$('.apontamento').hide();
		$('.dados_componente').hide();
		$('.dados_componente .form').remove();
		$('.dados_componente .body-table-abastecimento').remove();
		$('.dados_componente script').remove();
	});

	$(".submit-apontamento").click(function(){
		
		//encontra o id do usuário que será atualizado
	    var cd_of = $(this).closest('.apontamento-componente').find('input[class="of"]').val();
	    var cd_produto = $(this).closest('.apontamento-componente').find('input[class="produto"]').val();
	    var cd_componente = $(this).closest('.apontamento-componente').find('input[class="componente"]').val()
	    var quantidade = $(this).closest('.apontamento-componente').find('input[class="quantidade"]').val()
	    var motivo = $(this).closest('.apontamento-componente').find('select[class="motivo"]').val()

	    var controller = 'apontamento/apontar_componente';

		$('.apontamento-componente').submit(function(){

			$.ajax({
				type: "POST",
				url: controller,
				data:   'of='				+cd_of + 
						' & produto= ' 		+cd_produto  + 
						' & componente= ' 	+ cd_componente +
						' & quantidade= ' 	+ quantidade +
						' & motivo= '		+ motivo,
				
				success: function( data )
				{
					$('.dados_componente .form').remove();
					$('.dados_componente script').remove();
					$('.dados_componente div').remove();
					$('.dados_componente').append(data);
				}
			});

			return false;
		});
	});


</script>

