<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estrutura_produto extends CI_Controller{

	public function __construct() {
	    parent::__construct();
	    
	   $this->load->helper('url');
	   $this->load->helper('form');
	   $this->load->helper('array');//ajuda a passar dados para o model
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->database();//carrega o banco de dados para fazer operações no banco
	   $this->load->model('estrutura_produto_model');//carrega o model
	   $this->load->library('excel_reader');//carrega library para ler o excel
	}

	function importar() {
		
		// Detect form submission.
        if($this->input->post('submit')){
        
            $path = './uploads/';
            $this->load->library('upload');
                        
            // Define file rules
            $this->upload->initialize(array(
                "upload_path"       =>  $path,
                "allowed_types"     =>  "xls",
                // "max_size"          =>  '1000',
                // "max_width"         =>  '1024',
                // "max_height"        =>  '768'
            ));
            
            if($this->upload->do_multi_upload("uploadfile")){
                $data['upload_data'] = $this->upload->get_multi_upload_data();

                $arquivo = $data['upload_data'][0]["file_name"];

                $this->estrutura_produto_model->verificar($arquivo) == TRUE;
                //se importado, então .... importado com sucesso

                echo '<div class="alert alert-success">' . ' Arquivo carregado com sucesso.</div>';
                
            } else {    
                
                // Output the errors
                $errors = $this->upload->display_errors('<div class="alert alert-danger" role="alert">
                                                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                                        <span class="sr-only">Error:</span>', '<br>Favor inserir um arquivo com extensão <strong>.xls</strong></div>');               
                echo $errors;
            }
            exit();
        } 

		$dados = array(
            'tela'=> 'importar',
            'pasta'=> 'estrutura_produto',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
        );
        
        $this->load->view('conteudo', $dados );
		
	}



}//fim da clase