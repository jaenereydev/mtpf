<?php

class User_model extends CI_Model
{

    //--------------------------------------------------------------------------
    
    public function get($user_id = null)
    {
        if($user_id === null)
        {
            $q = $this->db->get('user');
        }elseif(is_array($user_id)) {
            $q = $this->db->get_where('user', $user_id);
        }else {
            $q = $this->db->get_where('user', ['id' => $user_id]);
        }
        
        return $q->result_array();
        
    }
    
    //--------------------------------------------------------------------------

    public function get_user()
    {
        $query = $this->db->get('user');
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
    public function get_users($id)
    {
        $sql = "Select * from user where id =?";
        $query = $this->db->query($sql, array($id));
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function get_useractive()
    {
        $sql = "Select * from user where status = 'ACTIVE'";
        $query = $this->db->query($sql);
        return $query->result();
        
    }
    
    //--------------------------------------------------------------------------
    
     public function insert_user($user = NULL) 
    {
        $this->db->insert('user',$user);
        return $this->db->insert_id();
    }

    //--------------------------------------------------------------------------
    
    public function updateuser($uno, $u = null) 
    {        
      $this->db->where('id',$uno)
                ->update('user', $u);
    }

    //----------------------------------------------------------------------
    
    public function updatedel_user($u_no) 
    {                       
        $this->password = 'deactivateuser'; $this->accesscode = 'deactivateuser';        
        $this->status = 'DEACTIVATE';         
        $this->db->update('user', $this, array('u_no' => $u_no));
    }

    //----------------------------------------------------------------------
    
    public function zreading_check()
    {
      $sql = "SELECT z_no FROM zreading WHERE date = ? AND u_no = ?";

      $result = $this->db->query($sql, [date('Y-m-d'), $this->session->userdata('u_no')])->result();

      return (isset($result[0]->z_no) ? $result[0]->z_no : false);
    }
}