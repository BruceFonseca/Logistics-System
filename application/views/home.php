<?php

$this->load->view('includes/head_site');
$this->load->view('includes/header_site');
$this->load->view('includes/nav_abas');

if( isset($pasta) && isset($tela)):
        $this->load->view('transactions/' .$pasta .'/'.$tela);
endif;

$this->load->view('transactions/conteudo/conteudo'); //é a div que vai guardar o conteudo de todas as abas.
$this->load->view('includes/footer_site');