<?php

class Estrutura_produto_model extends CI_Model{

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

		// function que utilizará a function "importar_corpo($cd_prod, $cd_comp, $ds_comp, $qtde)"
		// para carregar todos componentes de cada produto, que atualmente estão disponivilizados
		// em colunas no arquivo excel

		// $cd_prod  ---> nº da coluna do código do produto pai
		// $cd_comp  ---> nº da coluna do código do componente
		// $ds_comp  ---> nº da coluna da descrição componente
		// $qtde 	 ---> nº da coluna da quantidade

		// importar_corpo($cd_prod, $cd_comp, $ds_comp, $qtde)

		// $this->importar_corpo('1', '2', 'Corpo', '4' );
		$this->importar_corpo('1', '5', 'Tampa Comp', '7' );
		// $this->importar_corpo('1', '8', 'Rotor', '10' );
		// $this->importar_corpo('1', '11', 'Estator/ Lâmina', '13' );
		// $this->importar_corpo('1', '14', 'Bloco Usinado', '16' );
		// $this->importar_corpo('1', '17', 'Eixo Excentrico Usinado', '19' );
		// $this->importar_corpo('1', '20', 'Tampa Cilindro', '22' );
		// $this->importar_corpo('1', '23', 'Pistão Bruto', '25' );
		// $this->importar_corpo('1', '26', 'Passador Descarga', '28' );
		// $this->importar_corpo('1', '29', 'Pacote rotor', '31' );
		// $this->importar_corpo('1', '32', 'Placa Valvula', '34' );
		// $this->importar_corpo('1', '35', 'Camara de sucção', '37' );
		// $this->importar_corpo('1', '38', 'Tampa Camara', '40' );
		// $this->importar_corpo('1', '41', 'Passador proc suc', '43' );
		// $this->importar_corpo('1', '44', 'Helicóide', '46' );
		// $this->importar_corpo('1', '47', 'Pino pistão', '49' );
		// $this->importar_corpo('1', '50', 'Junta Cilindro', '52' );
		// $this->importar_corpo('1', '53', 'Biela', '55' );
		// $this->importar_corpo('1', '56', 'Junta Placa Valvula', '58' );
		// $this->importar_corpo('1', '59', 'Passador processo Minis', '61' );
		// $this->importar_corpo('1', '62', 'placa valvula sinter bruta', '64' );
		// $this->importar_corpo('1', '65', 'Fio', '67' );
		// $this->importar_corpo('1', '68', 'Pistão bruto', '70' );
		// $this->importar_corpo('1', '71', 'Conjunto suporte de mola', '73' );
		// $this->importar_corpo('1', '74', 'Tampa soldado', '76' );
		// $this->importar_corpo('1', '74', 'Tampa soldado', '76' );
		// $this->importar_corpo('1', '77', 'E1', '79' );
		// $this->importar_corpo('1', '80', 'E2', '82' );
		// $this->importar_corpo('1', '83', 'E3', '85' );
	}

	public function importar_corpo($cd_prod, $cd_comp, $ds_comp, $qtde){

		// Get the contents of the first worksheet
		$worksheet = $this->excel_reader->sheets[0];
		$numRows = $worksheet['numRows']; // ex: 14
		$numCols = $worksheet['numCols']; // ex: 4
		$cells = $worksheet['cells']; // the 1st row are usually the field's name

		$lin = 3; //linha onde inicial a leitura do arquivo excel

		$query = "INSERT INTO estrutura (cd_produto, cd_componente, dsc_componente, quantidade ) VALUES ";

		for ($i= $lin; $i<= $numRows; $i++)
		{
			$cd_produto= $cells[$lin][$cd_prod];
			$cd_componente= isset($cells[$lin][$cd_comp]) ? $cells[$lin][$cd_comp] : NULL; // se o componente não existe, então é setado NULL
			$dsc_componente= $ds_comp;
			$quantidade= isset($cells[$lin][$qtde]) ? $cells[$lin][$qtde] : NULL;  // se a quantidade não existe, então é setado NULL

			//se o componente não for NULL, então adiciona na query
			if($cd_componente != NULL){
				// gera a query
				$query = $query . "(" . "'". $cd_produto. "'". "," . "'". $cd_componente. "'". "," . "'". $dsc_componente. "'". "," . $quantidade. "),";
			}

	        $lin++;
		}

		$sql = substr($query, 0, strlen($query)-1); //remove a ultima vírgula da query
		$this->db->query($sql);// insere no banco de dados
	}
    
}//fim da classe
