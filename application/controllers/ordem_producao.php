<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordem_producao extends CI_Controller{

	public function __construct() {
	    parent::__construct();
	    
	   $this->load->helper('url');
	   $this->load->helper('form');
	   $this->load->helper('array');//ajuda a passar dados para o model
	   $this->load->library('form_validation');
	   $this->load->library('session');
       $this->load->library('table');//carrega tabela ;
	   $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->model('ordem_producao_model');//carrega o model
	   $this->load->model('linha_producao_model');//carrega o model
	   $this->load->library('excel_reader');//carrega library para ler o excel
       date_default_timezone_set('America/Sao_Paulo');//define o timezone
	}

    public function retrieve_OF() {

        $this->output->enable_profiler(false);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR
        $of= $this->input->post('of');
        $produto= $this->input->post('produto');

        $dados = array(
            'dados_of'=> $this->ordem_producao_model->get_dados_of($of, $produto)->row(),
            // 'dados_of'=> $this->ordem_producao_model->get_dados_of($of, $produto)->result_array(),
            'tela'=> 'retrieve_of',
            'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            // 'status'=> $this->ordem_producao_model->get_produto_of($of, $produto)->result(),
             );

        $this->load->view('conteudo', $dados);
    }

    public function retrieve_tabela_of(){

        $of= trim($this->input->post('of'));
        $produto= trim($this->input->post('produto'));

        $dados = array(
            'tela'=> 'retrieve_tabela_of',
            'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->ordem_producao_model->get_produto_of($of, $produto)->result(),
             );

        $this->load->view('conteudo', $dados);
    }

     public function retrieve_OF_admin() {
        //retorna as of's de acordo com a solicitações vindas da view admin_of.php
        
        $status= $this->input->post('status');
        $linha= $this->input->post('linha');
        $data= $this->input->post('data');

        $where = Array();

        //seta as condições para query de acordo com o recebido de POST
        if($status != " "){$where[]   = " `cd_status` LIKE '%".trim($status)."%'";}
        if($linha != " "){$where[]      = " cd_linha LIKE '%".trim($linha)."%'";}
        if($data != " "){$where[] = " dt_inicio_plan LIKE '"."%".trim($data)."%'";}

        $condicao = " WHERE " . implode( ' AND ',$where );

        $dados = array(
            'tela'=> 'tabela_admin_of',
            'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=> $this->ordem_producao_model->get_with_condition($condicao)->result(),
             );

        $this->load->view('conteudo', $dados);
    }

    public function admin_OF() {

        $this->output->enable_profiler(false);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR
        
        // $linha =  $this->linha_producao_model->get_linhas()->result_array();

        // pd($linha);

        $dados = array(
            'linha'=> $this->linha_producao_model->get_linhas()->result_array(),
            'tela'=> 'admin_of',
            'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
            'status'=>'',
             );

        $this->load->view('conteudo', $dados);
    }

    public function update_OF(){
        $seq_prod  = trim($this->input->post('seq_prod'));
        $of_prod   = trim($this->input->post('of_prod'));
        $prod_prod = trim($this->input->post('prod_prod'));

        $this->ordem_producao_model->do_update_OF($of_prod, $prod_prod, $seq_prod );

        // pd($seq_prod . '......'. $of_prod . '........' . $prod_prod);
    }

    public function update_status(){
        
        $of_prod   = trim($this->input->post('of'));
        $prod_prod = trim($this->input->post('produto'));
        $status = trim($this->input->post('status'));

        $this->ordem_producao_model->do_update_status($of_prod, $prod_prod, $status );

    }

    public function retrieve() {
        
        if($this->input->post()){

            $linha= $this->input->post('linha');
            $of= $this->input->post('OF');
            $produto= $this->input->post('produto');
            
            $where = Array();

            if($linha != " "){$where[]   = " `cd_linha` LIKE '%".trim($linha)."%'";}
            if($of != " "){$where[]      = " cd_of LIKE '%".trim($of)."%'";}
            if($produto != " "){$where[] = " cd_produto LIKE '"."%".trim($produto)."%'";}

            $condicao = " WHERE " . implode( ' AND ',$where );

            $dados = array(
                'tela'=> 'retrieve_com_filtro',
                'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
                'status'=> $this->ordem_producao_model->get_with_condition($condicao)->result(),
             );

            $this->load->view('conteudo', $dados);

        }else{
            $condicao = " WHERE cd_linha LIKE '%zzz%'";
            $dados = array(
                'linha'=> $this->linha_producao_model->get_linhas()->result_array(),
                'tela'=> 'retrieve',
                'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
                // 'status'=> $this->ordem_producao_model->get_all()->result(),
                'status'=> $this->ordem_producao_model->get_with_condition($condicao)->result(),
                 );
            $this->load->view('conteudo', $dados);
        }
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

                $this->ordem_producao_model->verificar($arquivo) == TRUE;
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
            'pasta'=> 'ordem_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
        );
        
        $this->load->view('conteudo', $dados );
		
	}//fim importar

}//fim da clase