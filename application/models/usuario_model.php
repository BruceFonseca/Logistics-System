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
            $this->session->set_flashdata('edicaook','Usuário atualizado com sucesso');
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

    public function reset_senha($id){
        $pass = md5(123); // senha 123

        $query = "UPDATE users
                  SET password = " . "'" . $pass ."'" .
                 ' WHERE id = ' . $id;

        $this->db->query($query);
    }
    
    public function trocar_senha($username, $nova_senha){


        $pass = md5($nova_senha); //criptografa senha em md5

        $query = "UPDATE users
                  SET password = " . "'" . $pass ."'" .
                 ' WHERE username = '. "'" . $username ."'";

        $this->db->query($query);
    }
}

