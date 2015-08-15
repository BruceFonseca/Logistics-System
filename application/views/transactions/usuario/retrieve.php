<?php

if($this->session->flashdata('excluirok')):
    echo '<p>'.$this->session->flashdata('excluirok').'</p>';
endif;

$this->table->set_heading('ID', 'User id', 'Nome','Matrícula','Role','Status');

foreach ($status as $linha):
    $this->table->add_row(
    $linha->id, 
    $linha->username, 
    $linha->nome, 
    $linha->dsc_matricula, 
    $linha->role, 
    $linha->status);
endforeach;




echo '<div class="retrieve-usuarios">';
echo '<h2>Administrar usuários</h2>';	

echo $this->table->generate();

echo '</div>';

