<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carregar extends CI_Controller{

	public function __construct() {
	    parent::__construct();
	    
	   $this->load->helper('url');
	   $this->load->helper('form');
	   $this->load->helper('array');//ajuda a passar dados para o model
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->database();//carrega o banco de dados para fazer operações no banco
	   $this->load->library('table');//carrega tabela 
	   $this->load->library('excel_reader');//carrega library para ler o excel
	        
	}

	public function teste(){

		$this->excel_reader->read('./uploads/estrutura.xls');

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];

		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 3;
		$col = 1;
		echo  "<pre>" . print_r($cells);

	}





}//fim da clase