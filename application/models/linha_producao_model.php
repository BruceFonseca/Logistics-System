<?php

class Linha_producao_model extends CI_Model{
    
    public function get_all(){

        $query = "select * from linha_producao";     
         
        return $this->db->query($query);

    }

 public function get_linhas(){

    	$query = "select dsc_name from linha_producao";     
         
        return $this->db->query($query);

    }

     public function do_update($dados=NULL, $condicao=NULL){
        if ($dados != NULL && $condicao != NULL){
            $this->db->update('linha_producao',$dados, $condicao);
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
}

