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
    
    public function get_produto_of($of, $produto){
    	$query = 'SELECT (SELECT SUM(qt_apontada) 
							FROM apontamento a 
							WHERE a.cd_componente = e.cd_componente 
							AND a.cd_of = o.cd_of 
							AND a.cd_produto = o.cd_produto
						 ) as qt_abastecido,
						 qt_planejada, 
						 e.cd_componente as componente, 
						 dsc_componente,
						 e.quantidade as qt_componente
				FROM ordem_producao o
				INNER JOIN estrutura e ON o.cd_produto = e.cd_produto
				WHERE cd_of = ' . $of .
				' AND o.cd_produto = ' . $produto .
				' ORDER BY o.cd_produto '; 

		return $this->db->query($query);
    }

    public function get_dados_of($of, $produto){
    	$query = 'SELECT 
    				   cd_linha, 
      				   cd_of, 
      				   cd_produto, 
      				   cd_status, 
      				   qt_planejada, 
      				   dt_inicio_plan,
      				   dt_termino_plan
      			FROM ordem_producao 
      			WHERE cd_of = ' . $of . ' AND cd_produto = ' . $produto ; 
    	
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
      				   dt_termino_plan,
      				   seq_prod 
      			FROM ordem_producao '; 

      	$order = ' ORDER BY seq_prod ';

      	if($condicao != NULL){
      		$query = $query . $condicao . $order;
      	}else{
      		$query = $query . $condicao;
      	}

      	return $this->db->query($query);
    }

    public function do_update_OF($of_prod=NULL, $prod_prod=NULL, $seq_prod=NULL){
    	
    	$query =   ' UPDATE ordem_producao
					 SET seq_prod = ' . (int) $seq_prod . ' , 
					     cd_status = ' . "'".'PRO' . "' " .
				   ' WHERE cd_of = '. $of_prod .' AND cd_produto = ' . $prod_prod;
		return $this->db->query($query);
    }		

    public function do_update_status($of_prod=NULL, $prod_prod=NULL, $status=NULL){

    	$query =   ' UPDATE ordem_producao
					 SET cd_status = ' . "'". $status . "' " .
				   ' WHERE cd_of = '. $of_prod .' AND cd_produto = ' . $prod_prod;
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
			$cd_produto= substr($cells[$lin]['3'], 0, 9);
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
