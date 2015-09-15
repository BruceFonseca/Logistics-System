<?php

class Linha_producao_model extends CI_Model{
    
    public function get_all(){

    	$query = "select * from linha_producao";     
         
        return $this->db->query($query);

    }
    
}

