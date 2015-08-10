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
            $this->db->update('usuarios',$dados, $condicao);
            $this->session->set_flashdata('edicaook','Cadastro alterado com sucesso');
            redirect(current_url());
        endif;
    }
    
    public function get_all(){
        /*
        $query = "select * from usuarios
                 inner join status on usuarios.id_status_usuario = status.id
                 inner join tipo_usuario on usuarios.id_tipo_usuario = tipo_usuario.id";
         */
          $query = "select usuarios.id as id, nome, login, email,  dt_updaterow, dt_addrow,id_tipo_usuario, 
                tipo_usuario.ds_tipo as ds_tipo, id_status_usuario, status.ds_status as ds_status
                from usuarios
                inner join status on usuarios.id_status_usuario = status.id
                inner join tipo_usuario on usuarios.id_tipo_usuario = tipo_usuario.id;";     
         

        return $this->db->query($query);
    }
    
    
    public function get_byid($id= NULL) {
        $query = "select usuarios.id as id, nome, login, email,  dt_updaterow, dt_addrow,id_tipo_usuario, 
                tipo_usuario.ds_tipo as ds_tipo, id_status_usuario, status.ds_status as ds_status
                from usuarios
                inner join status on usuarios.id_status_usuario = status.id
                inner join tipo_usuario on usuarios.id_tipo_usuario = tipo_usuario.id "." WHERE usuarios.id = ".$id.";" ;

        if ($id != NULL):
            /*$this->db->where('id',$id);
            $this->db->limit(1);
            return $this->db->get('usuarios');*/
            return $this->db->query($query);
            
        else:
            return FALSE;
        endif;
    }
    
}

