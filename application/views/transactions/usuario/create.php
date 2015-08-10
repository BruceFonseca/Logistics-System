<?php
// var_dump($users_roles);

//transforma o array $tipo_usuario que tem outros arrays em apenas um array
for($i=0; $i < count($users_roles); $i++){
    $roles[($users_roles[$i]['id_user_roles'])] = ($users_roles[$i]['dsc_name']);
    }


// //transforma o array $status_imovel que tem outros arrays em apenas um array
// for($i=0; $i < count($users_roles); $i++){  
//     $roles[($users_roles[$i]['id_user_roles'])] = ($users_roles[$i]['dsc_name']);
// }

echo '<h2> Cadastrar Usuário </h2>';
echo form_open('usuario/create');

echo validation_errors('<p>','</p>');

if($this->session->flashdata('cadastrook')):
    echo '<p>'.$this->session->flashdata('cadastrook').'</p>';
endif;

echo form_label('User ID');
echo form_input(array('name'=>'username'),  '','autofocus')."<br>";

echo form_label('Nome Completo');
echo form_input(array('name'=>'dsc_name'),  '')."<br>";

echo form_label('Matrícula');
echo form_input(array('name'=>'dsc_matricula'),  '')."<br>";

echo form_label('Perfil');
echo form_dropdown('id_user_roles', $roles ,'3', 1)."<br>";

echo form_label('Status Usuário');
echo form_dropdown('ativo',  array("A"=>"Ativo", "I"=>"Inativo"),'A', 1)."<br>";

echo form_hidden(array('name'=>'dt_added'),  date("d/m/y H:i:s"))."<br>";

echo form_hidden(array('name'=>'dt_updated'),  date("d/m/y H:i:s"))."<br>";

echo form_hidden('password', md5(123));


echo form_button(array('name'=>'cadastrar', 'class'=>'submit', 'content'=>'Cadastrar', 'type'=>'submit'))."<br>";

echo form_close();
