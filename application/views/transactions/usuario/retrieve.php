<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('ID', 'User id', 'Nome','Matrícula','Role','Status', 'Ação');


foreach ($status as $linha):
$id = array('data'=> $linha->id, 'class'=>'id-usuario');

    $this->table->add_row(
    $id, 
    $linha->username, 
    $linha->nome, 
    $linha->dsc_matricula, 
    $linha->role, 
    $linha->status,
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-usuarios">';
echo '<h2>Administrar usuários</h2>';	

echo $this->table->generate();

echo '</div>';

?>


<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
$('.retrieve-usuarios tr td span').on('click',function(){

	//encontra o id do usuário que será atualizado
	var id_usuario = $(this).closest('tr').find('td[class="id-usuario"]').text();
	var desc = 'Atualizar usuário';
	var href = 'usuario/update';
	alert(id_usuario);

	

});



</script>

