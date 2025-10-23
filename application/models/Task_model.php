<?php

class Task_model extends CI_Model
{

  //----------------------------------------------------------------------
  
  public function get_task() 
  {
    $sql = "Select t.*, c.name 
            from task t
            join user c on c.id = t.assign_user_id";
    $query = $this->db->query($sql);
    return $query->result();
  }


  //----------------------------------------------------------------------

  public function inserttask($task) 
  {  
      $this->db->insert('task',$task);
  }

 //----------------------------------------------------------------------

  public function deletetask($t) 
  {                       
      $this->db->delete('task', array('task_no' => $t));
  }

  //-------------------------------------------------------------------------

}
