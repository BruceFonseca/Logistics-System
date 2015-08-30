<?php

class Importar_model extends CI_Model{

	public function verificar($arquivo){

		$this->excel_reader->read('./uploads/' . $arquivo );

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];
		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 2;
		$col = 1;

		if ($numCols != 97){
			//97 é o numero de colunas do arquivo de estrutura 
			
			$msg = "O numero de colunas do arquivo não corresponde ao numero necessário";
			echo '<div class="alert alert-danger" role="alert">
  				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				  <span class="sr-only">Error:</span>'. $msg .'</div>';
			exit();

		}elseif ($cells[$lin][$col] != 'SKU') {
			//se na linha 2 e coluna 1 é diferente de 'SKU', então não é o arquivo de estrutura
			
			$msg = "Verifique o arquivo carregado. Conteúdo inválido!";
			echo '<div class="alert alert-danger" role="alert">
  				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				  <span class="sr-only">Error:</span>'. $msg .'</div>';
			exit();

		}else{

			$this->importar_estrutura_produto();
			return TRUE;
		}

	}

	public function importar_estrutura_produto(){

		$this->importar_corpo();
	}

	public function importar_corpo(){

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];
		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 3;
		$col = 1;


		for ($i= $lin; $i< $numRows; $i++)
		{
			$dados = array(
				'cd_produto'=> $cells[$lin]['1'],
				'cd_componente'=> $cells[$lin]['2'],
				'dsc_componente'=> 'Corpo',
				'quantidade'=> $cells[$lin]['4'],
			);
	    
		    if ($dados != NULL):

	            $this->db->insert('estrutura',$dados);
	        endif;

	        $lin++;

		}

		echo  var_dump($cells[$lin]['1']). 'entrou em importar_estrutura_produto';
		die();
	}
    
}//fim da classe
