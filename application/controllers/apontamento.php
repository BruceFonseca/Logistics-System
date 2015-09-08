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
	   date_default_timezone_set('America/Sao_Paulo');//define o timezone
	}

	public function apontar_componente(){


		$of= 			trim($this->input->post('of'));
        $produto= 		trim($this->input->post('produto'));
        $componente = 	trim($this->input->post('componente'));
        $quantidade = 	(int) trim($this->input->post('quantidade'));
        $motivo = 		trim($this->input->post('motivo'));


        //se o motivo for igual a "D" (desabastecer), altera o valor para negativo
        if($motivo == "D"){ $quantidade = ((int) $quantidade) * (-1);}

        if((int) $quantidade != 0){

        	$session_data = $this->session->userdata('logged_in');

        	$dados = array(
        		'cd_of'=> $of,
        		'cd_produto'=> $produto,
        		'cd_componente'=> $componente,
        		'qt_apontada'=> $quantidade,
        		'dt_apontamento'=> date('YmdHis',now()),
        		'username'=> $session_data['username'],
        		'cd_motivo'=> $motivo,
        		);
        	
        	if($this->apontamento_model->do_insert($dados)==TRUE){
        		echo '<div class="alert alert-success">' . ' Arquivo apontado com sucesso.</div>';
        	}else{
        		echo '<div class="alert alert-danger" role="alert">
                     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                     <span class="sr-only">Error:</span>FAvor verificar dados inseridos</div>';
        	}

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

	public function apontar(){

		$this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

		$of= 			trim($this->input->post('of'));
        $produto= 		trim($this->input->post('produto'));
        $componente = 	trim($this->input->post('componente'));
        // $quantidade = 	(int) trim($this->input->post('quantidade'));
        // $motivo = 		trim($this->input->post('motivo'));


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