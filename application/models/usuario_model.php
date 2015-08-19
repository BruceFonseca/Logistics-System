<?php

class Usuario_model extends CI_Model{
    
    public function do_insert($dados=NULL){            
        
        if ($dados != NULL):
                $this->db->insert('users',$dados);
                $this->session->set_flashdata('cadastrook','Cadastro efetuado com sucesso');
                redirect('usuario/create');
            endif;
            
    }

    public function do_update($dados=NULL, $condicao=NULL){
        if ($dados != NULL && $condicao != NULL):
            $this->db->update('users',$dados, $condicao);
            $this->session->set_flashdata('edicaook','Cadastro alterado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){
          $query = 'SELECT id, username, u.dsc_name as nome, dsc_matricula, r.dsc_name as role, ativo as status FROM users u
                    INNER JOIN user_roles r ON u.id_user_roles = r.id_user_roles';     
         
        return $this->db->query($query);
    }
    
    
    public function get_byid($id) {
        $query = 'SELECT id, username, u.dsc_name as nome, dsc_matricula, u.id_user_roles , r.dsc_name as role, ativo as status FROM users u
                  INNER JOIN user_roles r ON u.id_user_roles = r.id_user_roles
                  WHERE id = ' . $id ; 

        return $this->db->query($query);
    }
    
}

