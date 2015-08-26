
<div class='form'>
	

<?php


echo '<form method="post" action="" class="ajax_form" enctype="multipart/form-data">';

echo form_fieldset('CImportar estrutura do produto');

?>
<?php 
	echo  validation_errors('<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>','</div>');
 ?>

<?php 
if($this->session->flashdata('cadastrook')):
    echo '<div class="alert alert-success">'.$this->session->flashdata('cadastrook').'</div>';
endif;

echo form_label('User ID');
echo form_input(array('name'=>'username'),  '','autofocus')."<br>";

echo form_label('Nome');
echo form_input(array('name'=>'dsc_name'),  '')."<br>";

echo form_label('Matrícula');
echo form_input(array('name'=>'dsc_matricula'),  '')."<br>";

echo form_label('Perfil');
echo form_dropdown('id_user_roles', $roles ,'3', 1)."<br>";

echo form_label('Status');
echo form_dropdown('ativo',  array("A"=>"Ativo", "I"=>"Inativo"),'A', 1)."<br>";

echo form_hidden(array('name'=>'dt_added'),  date("d/m/y H:i:s"));

echo form_hidden(array('name'=>'dt_updated'),  date("d/m/y H:i:s"));

echo form_hidden('password', md5(123));
echo form_label('');
echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'id'=>'submit','content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_fieldset_close();
echo form_close();

?>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
	$(".submit").click(function(){
		var numtab = $(this).closest("div").attr("numtab");
		
		$('.ajax_form').submit(function(){
				
			var dados = $( this ).serialize();

			$.ajax({
				type: "POST",
				url: "usuario/create",
				data: dados,
				success: function( data )
				{
					alert('deu certo   ' + numTran);
					$('div[numtab="'+ numTran +'"] div').remove();
					$('div[numtab="'+ numTran +'"]').append(data);
				}
			});

			return false;
		});
	});
</script>

