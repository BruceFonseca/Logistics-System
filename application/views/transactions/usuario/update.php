<?php
//transforma o array $tipo_usuario que tem outros arrays em apenas um array
for($i=0; $i < count($tipo_usuario); $i++){
    $tp_user[($tipo_usuario[$i]['id'])] = ($tipo_usuario[$i]['ds_tipo']);
}
//transforma o array $status_usuario que tem outros arrays em apenas um array
for($i=0; $i < count($status_usuario); $i++){
    
    $st_user[($status_usuario[$i]['id'])] = ($status_usuario[$i]['ds_status']);
}
$id = $this->uri->segment(3);
if($id==NULL) redirect('usuario/retrieve');
$query = $this->usuario_model->get_byid($id)->row();

echo '<h2> Atualizar Usuário </h2>';
echo form_open("usuario/update/$id");
echo validation_errors('<p>','</p>');

if($this->session->flashdata('edicaook')):
    echo '<p>'.$this->session->flashdata('edicaook').'</p>';
endif;

echo form_label('ID');
echo form_input(array('name'=>'id'),  set_value('id', $query->id),'bloqued')."<br>";

echo form_label('Nome Completo');
echo form_input(array('name'=>'nome'),  set_value('id', $query->nome),'autofocus')."<br>";

echo form_label('Email');
echo form_input(array('name'=>'email'),  set_value('id', $query->email))."<br>";

echo form_label('Login');
echo form_input(array('name'=>'login'),  set_value('id', $query->login))."<br>";

echo form_label('Atualizado');
echo form_input(array('name'=>'dt_updaterow'),  set_value('id', $query->dt_updaterow))."<br>";

echo form_label('Tipo Usuário');
echo form_dropdown('id_tipo_usuario',  $tp_user, set_value('id', $query->id_tipo_usuario))."<br>";

echo form_label('Status Usuário');
echo form_dropdown('id_status_usuario',  $st_user,set_value('id', $query->id_status_usuario))."<br>";

echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'content'=>'Atualizar', 'type'=>'submit'))."<br>";


echo form_close();