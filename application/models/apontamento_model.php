<?php

class Apontamento_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
            $this->db->insert('apontamento',$dados);
            echo 'cadastrook','Cadastro efetuado com sucesso';
            pd($dados);
        endif;
            
    }

   
    public function get_all(){
        $query = 'SELECT id, username, u.dsc_name as nome, dsc_matricula, r.dsc_name as role, ativo as status FROM users u
                    INNER JOIN user_roles r ON u.id_user_roles = r.id_user_roles';     
         
        return $this->db->query($query);
    }
    
    public function get_hist_apon($of, $produto, $componente){
        
        $query = 'SELECT * FROM apontamento 
        WHERE cd_of = ' . $of . ' AND  cd_produto = ' . $produto . ' AND  cd_componente = ' . $componente;
                       
        return $this->db->query($query);
    }



}//fim da classe