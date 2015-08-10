<?php

echo '<h2> Lista de Usuários </h2>';

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('ID','NOME','LOGIN','EMAIL','TIPO', 'DS TIPO', 'STATUS',  'DS STATUS','DT CRIAÇÃO', 'DT ATUALIZAÇÃO', 'AÇÕES');

foreach ($status as $linha):
    $this->table->add_row(
    $linha->id, 
    $linha->nome, 
    $linha->login, 
    $linha->email, 
    $linha->id_tipo_usuario, 
    $linha->ds_tipo,
    $linha->id_status_usuario, 
    $linha->ds_status , 
    $linha->dt_addrow,
    $linha->dt_updaterow,  
    anchor("usuario/update/$linha->id",  '<img src="../img/sistema/icon/edit.png" />'). " ".
    anchor("usuario/delete/$linha->id",  '<img src="../img/sistema/icon/delete.png" />'));
endforeach;

echo $this->table->generate();


