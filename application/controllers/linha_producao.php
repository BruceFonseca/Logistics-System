<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Linha_producao extends CI_Controller {

    function __construct()
    {
       parent::__construct();
                
       $this->load->database();//carrega o banco de dados para fazer operações no banco
       $this->load->helper('url');
       $this->load->helper('form');
       $this->load->helper('array');//ajuda a passar dados para o model
       $this->load->helper('date');//carrega helper para datetime
       $this->load->library('form_validation');
       $this->load->library('session');
       $this->load->library('table');//carrega tabela 
        $this->load->model('linha_producao_model');//carrega o model
       date_default_timezone_set('America/Sao_Paulo');//define o timezone
    }

    public function create(){

        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

        $dados = array(
            'tela'=> 'create',
            'pasta'=> 'linha_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );

        $this->load->view('conteudo', $dados);
    }

    public function retrieve(){

        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

        $dados = array(
            'linhas'=> $this->linha_producao_model->get_all()->result(),
            'tela'=> 'retrieve',
            'pasta'=> 'linha_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
             );

        $this->load->view('conteudo', $dados);
        
    }

    public function update(){

      // recebe o id do usuário através da URL

        if($this->uri->segment(3)){
          $linha = $this->uri->segment(3);

          $dados = array(
                'qt_media_producao'=> trim($this->input->post('qt_media_producao')),
                'cd_status'=> trim($this->input->post('ativo')),
          );

          ;

          if($this->linha_producao_model->do_update($dados, array('dsc_name'=>$linha))==TRUE){
            echo '<div class="alert alert-success">' . ' Linha atualizada com sucesso.</div>';
            exit();
          }else{
            echo '<div class="alert alert-danger" role="alert">
                     <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                     <span class="sr-only">Error:</span>Favor verificar dados inseridos</div>';
            exit();
          }

        }

        $this->output->enable_profiler(FALSE);//MODO NATIVO DE DEBUG CODEIGNITER. MUDE PARA "TRUE" PARA HABILITAR

        $dados = array(
            'linha'=> trim($this->input->post('linha')),
            'qt_media_producao'=> trim($this->input->post('qt_media_producao')),
            'cd_status'=> trim($this->input->post('cd_status')),
            'tela'=> 'update',
            'pasta'=> 'linha_producao',// é a pasta que está dentro de "telas". existe uma pasta para cada tabela a ser cadastrada
        );

        $this->load->view('conteudo', $dados);
        
    }




}//fim da classe