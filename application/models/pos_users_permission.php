<?php
class Pos_users_permission extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function item_permission_pos_users($id){
        
        $this->db->select()->from('itempermission')->where('emp_id',$id);
        $sql=$this->db->get();
        return $sql->result();
        
     }
      function emp_permission_pos_users($id){
        
        $this->db->select()->from('pos_users_permission')->where('emp_id',$id);
        $sql=$this->db->get();
       
        return $sql->result();
     }
      function edit_pos_users($id){
       $this->db->select()->from('users')->where('id',$id);
        $sql=$this->db->get();
       
        return $sql->result();
   }
   function update_permission($item,$emp,$id){
       $item_per=array('permission'=>$item);
        $emp_per=array('permission'=>$emp);
        $this->db->where('emp_id',$id);
        $this->db->update('itempermission',$item_per);
        $this->db->where('emp_id',$id);
        $this->db->update('pos_userspermission',$emp_per);
   }
    function adda_default_permission($id){
          $item_per=array('permission'=>'0000','emp_id'=>$id);
          $emp_per=array('permission'=>'0000','emp_id'=>$id);
          $this->db->insert('itempermission',$item_per);
        
          $this->db->insert('employeepermission',$emp_per);
        
    }
    
}
?>
