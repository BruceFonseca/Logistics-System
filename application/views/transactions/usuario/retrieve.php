<?php

echo '<h2> Lista de Usuários </h2>';

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('ID','NOME','MATRICULA','ROLE','ATIVO');

foreach ($status as $linha):
    $this->table->add_row(
    $linha->id, 
    $linha->dsc_name, 
    $linha->dsc_matricula, 
    $linha->id_user_roles, 
    $linha->ativo);
endforeach;

echo $this->table->generate();


