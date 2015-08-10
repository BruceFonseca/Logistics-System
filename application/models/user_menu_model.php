<?php

class User_menu_model extends CI_Model{
    
    public function get_all(){

        $query = "select * from user_roles where id_user_roles <> 1";     
         
        return $this->db->query($query);
    }

    public function get_menu_by_role($role){
        // tras o menu do usuário de acordo com a role
        // $role = 'Controlador';

        $query = "  SELECT DISTINCT m.id_menu, m.dsc_name as menu FROM user_menu um
                    INNER JOIN menu m ON um.id_menu = m.id_menu
                    INNER JOIN transactions t ON um.id_transactions = t.id_transactions
                    INNER JOIN user_roles r ON um.id_user_roles = r.id_user_roles
                    WHERE r.dsc_name = '$role' ";

         
        return $this->db->query($query);
    }
    public function get_submenu_by_role($role){
    	// tras o submenu do usuário de acordo com a role
    	// $role = 'Controlador';

        $query = "	SELECT DISTINCT m.id_menu,  t.dsc_name as submenu, t.controller as controller  FROM user_menu um
                    INNER JOIN menu m ON um.id_menu = m.id_menu
                    INNER JOIN transactions t ON um.id_transactions = t.id_transactions
                    INNER JOIN user_roles r ON um.id_user_roles = r.id_user_roles
					WHERE r.dsc_name = '$role'";
         
        return $this->db->query($query);
    }
    
}
