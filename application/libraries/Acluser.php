<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acluser{
    function __construct() {
       
    }
    function user_item_permissions($bid,$id){
       
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
         $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);
          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
         $num=$num+$CI->aclpermissionmodel->item_permission($deaprt[$i],$bid); 
         
         }
         
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $item = array(
                   'item'=>$num,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete
               );

        $_SESSION['Item_per']=$item;
        
        
    }
    function user_employee_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
         $num=$num+$CI->aclpermissionmodel->empl_permission($deaprt[$i],$bid); 
         }
         
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'user'=>$num,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['user_per']=$emp;       
        
    }
    function user_groups_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
         $num=$num+$CI->aclpermissionmodel->user_groups_permission($deaprt[$i],$bid); 
         }
         
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
        
        $emp = array(
                   'depa'=>$num,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['Depa_per']=$emp;       
        
    }
     function user_branch_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
        $num=$num+$CI->aclpermissionmodel->branch_permission($deaprt[$i],$bid); 
         }        echo $num;
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'branch'=>$num,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['Branch_per']=$emp;       
        
    }
    
   
     function set_admin_permission(){
            $branch = array(
                   'branch'=>1,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $item = array(
                   'branch'=>1,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $depa = array(
                   'branch'=>1,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $user = array(
                   'branch'=>1,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
        $_SESSION['Branch_per']=$branch; 
        $_SESSION['Depa_per']=$depa; 
        $_SESSION['user_per']=$user; 
        $_SESSION['Item_per']=$item;
    }
    
}
?>
