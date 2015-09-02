<?php

class Ordem_producao_model extends CI_Model{

	public function get_all(){
          
      $query = 'SELECT cd_linha, 
      				   cd_of, 
      				   cd_produto, 
      				   cd_status, 
      				   qt_planejada, 
      				   qt_produzida,
      				   dt_inicio_plan,
      				   dt_termino_plan
      			FROM ordem_producao 
      			ORDER BY dt_inicio_plan ';     
         
        return $this->db->query($query);
    }
    
    public function get_with_condition($condicao = NULL){

    	$query = 'SELECT cd_linha, 
      				   cd_of, 
      				   cd_produto, 
      				   cd_status, 
      				   qt_planejada, 
      				   qt_produzida,
      				   dt_inicio_plan,
      				   dt_termino_plan
      			FROM ordem_producao '; 

      	$order = ' ORDER BY dt_inicio_plan ';

      	if($condicao != NULL){
      		$query = $query . $condicao . $order;
      	}else{
      		$query = $query . $condicao;
      	}

      	return $this->db->query($query);
    }


	public function verificar($arquivo){

		$this->excel_reader->read('./uploads/' . $arquivo );

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];
		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 1;
		$col = 1;

		if ($numCols != 8){

			//97 é o numero de colunas do arquivo de estrutura 
			
			$msg = "O numero de colunas do arquivo não corresponde ao numero necessário";
			echo '<div class="alert alert-danger" role="alert">
  				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				  <span class="sr-only">Error:</span>'. $msg .'</div>';
			exit();

		}elseif ($cells[$lin][$col] != 'ID_LINHAPLANEJADA') {
			//se na linha 2 e coluna 1 é diferente de 'SKU', então não é o arquivo de estrutura
			
			$msg = "Verifique o arquivo carregado. Conteúdo inválido!";
			echo '<div class="alert alert-danger" role="alert">
  				  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  				  <span class="sr-only">Error:</span>'. $msg .'</div>';
			exit();

		}else{

			$this->importar_ordem_producao();
			return TRUE;
		}

	}

	public function importar_ordem_producao(){
		
		$sql = "DELETE FROM ordem_producao";

		$this->db->query($sql);

		// para carregar todos componentes de cada produto, que atualmente estão disponivilizados
		// em colunas no arquivo excel

		$this->importar_corpo();
	}

	public function importar_corpo(){

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];
		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 3; //linha onde inicial a leitura do arquivo excel

		$query = "INSERT INTO ordem_producao(cd_linha, cd_of, cd_produto, cd_status, qt_planejada, qt_produzida, dt_inicio_plan, dt_termino_plan) VALUES ";

		for ($i= $lin; $i<= $numRows; $i++)
		{
			$cd_linha= $cells[$lin]['1'];
			$cd_of= isset($cells[$lin]['2']) ? $cells[$lin]['2'] : NULL; // se o componente não existe, então é setado NULL
			$cd_produto= $cells[$lin]['3'];
			$cd_status= $cells[$lin]['4'];
			$qt_planejada= $cells[$lin]['5'];
			$qt_produzida= $cells[$lin]['6'];
			$dt_inicio_plan= ($cells[$lin]['7'] - 25569) * 86400;
			$dt_termino_plan= ($cells[$lin]['8'] - 25569) * 86400;

			//se o componente não for NULL, então adiciona na query
			if($cd_linha != NULL){
				// gera a query
				$query = $query . "(" . "'". $cd_linha. "'". "," . 
										"'". $cd_of. "'". "," . 
										"'". $cd_produto. "'". "," . 
										"'". $cd_status. "'". "," . 
										     $qt_planejada. "," . 
										     $qt_produzida.  "," . 
										     date('YmdHis', $dt_inicio_plan) . ", " . 
										     date('YmdHis',$dt_termino_plan) .  
								   "),";
			}

	        $lin++;
		}

		$sql = substr($query, 0, strlen($query)-1); //remove a ultima vírgula da query
		$this->db->query($sql);// insere no banco de dados
	}
    
}//fim da classe
