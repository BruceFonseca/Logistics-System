<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apontamento extends CI_Controller{

	public function __construct() {
	    parent::__construct();
	    
	   $this->load->helper('url');
	   $this->load->helper('form');
	   $this->load->helper('array');//ajuda a passar dados para o model
	   $this->load->helper('date');//carrega helper para datetime
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->database();//carrega o banco de dados para fazer operações no banco
	   $this->load->library('table');//carrega tabela 
	   $this->load->model('apontamento_model');//carrega o model
	   $this->load->model('ordem_producao_model');//carrega o model
	}

	public function apontar(){

		$this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

		$of= trim($this->input->post('of'));
        $produto= trim($this->input->post('produto'));
        $componente = trim($this->input->post('componente'));
        
        $quantidade = trim($this->input->post('quantidade'));
        $motivo = trim($this->input->post('motivo'));

        //se o motivo for igual a "D" (desabastecer), altera o valor para negativo
        if($motivo == "D"){ $quantidade = ((int) $quantidade) * (-1);}

        //se existir a quan tidade, quer dizer que é um dados que o usuário está informando via post
        //então deve fazer o insert no banco
        if($quantidade){

        	$dados = array(
        		'cd_of'=> $of,
        		'cd_produto'=> $produto,
        		'cd_componente'=> $componente,
        		'dt_apontada'=> mysql_real_escape_string(now()),
        		'username'=> 'username',
        		'cd_motivo'=> $motivo,
        		);
        	
        	$this->apontamento_model->do_insert($dados);

        }

        $dados = array(
        	'dados_of'=> $this->ordem_producao_model->get_dados_of($of, $produto)->row(),
        	'cd_componente'=> $componente ,
            'tela'=> 'apontar',
            'pasta'=> 'apontamento',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->apontamento_model->get_hist_apon($of, $produto, $componente)->result(),
             );

        $this->load->view('conteudo', $dados);
		
	}





}//fim da clase