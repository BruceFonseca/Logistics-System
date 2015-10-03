<?php

class Estrutura_produto_model extends CI_Model{

	public function verificar_csv($arquivo){

        $file_path =  './uploads/'.$arquivo;

        if ($this->csvimport->get_array($file_path)) {

    		//APAGA TODOS REGISTROS DA TABELA
    		$sql = " DELETE from estrutura";
			$this->db->query($sql);
            
            $this->ler_csv($file_path);

        }

	}

	public function ler_csv($file_path){

		$antes = date("F j, Y, g:i a");
		$linhas = file($file_path);
		$contar = count($linhas);

		$row = 1;
		$cont_to_insert =1;
		$handle = fopen ($file_path,"r");

		$query = "INSERT INTO estrutura (cd_produto, cd_componente, dsc_componente, quantidade ) VALUES ";
		
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			    
			    $num = count ($data);
			    
			    $row++;

			    $cd_produto= substr($data[0], 0, 9);
				$cd_componente= $data[1]; 
				$dsc_componente= $data[2];
				$quantidade= floatval($data[3]);
				$um = $data[4];

				$cont_to_insert++;
				$query = $query . "(" . "'". $cd_produto. "'". "," . "'". $cd_componente. "'". "," . "'". $dsc_componente. "'". "," . $quantidade. "),";

				if($cont_to_insert > 1000){

					$sql = substr($query, 0, strlen($query)-1); //remove a ultima vírgula da query

					$this->db->query($sql);// insere no banco de dados

					$cont_to_insert = 1;
					$query = "INSERT INTO estrutura (cd_produto, cd_componente, dsc_componente, quantidade ) VALUES ";
				}elseif (($contar - $row) < 1000){

					$sql = substr($query, 0, strlen($query)-1); //remove a ultima vírgula da query

					$this->db->query($sql);// insere no banco de dados

					$cont_to_insert = 1;
					$query = "INSERT INTO estrutura (cd_produto, cd_componente, dsc_componente, quantidade ) VALUES ";
				}
		}

		fclose ($handle);
	}

    
}//fim da classe
