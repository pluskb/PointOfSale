<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Item_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_items(){ // get all item details
        $this->db->select()->from('items');
        $sql=$this->db->get();
        return $sql->result();
    }
    function item_count_for_admin($branch){  
            $this->db->where('branch_id',$branch);
       
            $this->db->where('delete_status',0);
            $this->db->from('items');
            return $this->db->count_all_results();
   }
   function get_item_details_for_admin($limit, $start,$branch) {
               $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$branch); 
                $query = $this->db->get('items');
                return $query->result();         
   }
   function pos_item_count($id,$branch){       
            $this->db->where('item_id <>',$id);
            $this->db->where('item_delete ',0);
            $this->db->where('item_active',0);  
            $this->db->where('active_status',0);
            $this->db->where('branch_id ',$branch);         
            $this->db->from('items_x_branchs');
            return $this->db->count_all_results();
        
    }
    function get_item_details($limit,$start,$id,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('item_id <>',$id);
            $this->db->where('item_delete ',0);
            $this->db->where('active_status',0);
            $this->db->where('item_active',0);        
            $this->db->where('branch_id ',$branch);
       $query = $this->db->get('items_x_branchs');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;  
   }
   function get_selected_branch_for_view(){
         $this->db->select()->from('items_x_branchs')->where('delete_status',0)->where('active_status',0);
         $sql=  $this->db->get();
         return $sql->result();             
    }
    function delete_items_for_user($id,$bid,$uid){
        $data=array('item_active '=>1,
                    'deleted_by'=>$uid);
        $this->db->where('item_id',$id);
        $this->db->where('branch_id',$bid);
        $this->db->update('items_x_branchs',$data);
    }
    function delete_items_details_in_admin($id,$uid){
        $data=array('active_status '=>1,
                    'delete_status '=>1,
                     'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function deactivate_items($id,$uid){
        $data=array('active_status '=>1);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function deactivate_items_by_user($id,$bid,$udi){
        $data=array('item_active '=>1,
            'deleted_by'=>$udi);
        $this->db->where('item_id',$id);        
        $this->db->where('branch_id',$bid);
        $this->db->update('items_x_branchs',$data);
    }
    function to_activate_item($id,$bid){
        $data=array('active_status '=>0);
        $this->db->where('id',$id);        
        $this->db->update('items',$data);
    }
    function add_category($name,$bid){
        $data=array('category_name'=>$name,
                    'branch_id'=>$bid);
                $this->db->insert('item_category',$data);
                return $this->db->insert_id();                
    }
    function add_item_category_branch($id,$bid){
        $this->db->select()->from('branchs')->where('id',$bid);
        $sql=  $this->db->get();
        foreach ($sql->result() as $row){
            $name=$row->store_name;
        }
        $data=array('branch_id'=>$bid,
                    'branch_name'=>$name,
                    'category_id'=>$id);
                $this->db->insert('item_category_x_branchs',$data);
    }
    function check_item_category($cat,$bid){
        $this->db->select()->from('item_category')->where('branch_id',$bid)->where('category_name',$cat);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function get_item_category($id){
        $this->db->select()->from('item_category_x_branchs')->where('branch_id',$id)->where('category_active',0);
        $sql=  $this->db->get();
        return $sql->result();        
    }
    function get_category($id){
        $this->db->select()->from('item_category')->where('branch_id',$id);
        $sql=  $this->db->get();
        return $sql->result(); 
    }
    function get_suppier_in_branch($id){
        $this->db->select()->from('suppliers_x_branchs')->where('branch_id',$id)->where('supplier_active',0);
        $sql=  $this->db->get();
        return $sql->result();  
    }
    function get_supplier_details(){
        $this->db->select()->from('suppliers');
        $sql=  $this->db->get();
        return $sql->result(); 
    }
    function get_selected_item($id){
        $this->db->select()->from('items')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function update_item($id,$code,$barcode,$item_name,$description,$cost,$unit,$saling,$discount,$start,$end,$tax1,$tax2,$quantity,$location,$category,$suppier){
        $data=array('code'=>$code,	
            'barcode'=>$barcode,
            'category_id'=>$category,            
            'supplier_id'=>$suppier, 	
            'name'=>$item_name,
            'description'=>$description,
            'cost_price'=>$cost,
            'current_stock'=>$unit,
            'salling_price'=>$saling,
            'discount_amount'=>$discount,
            'start_date'=>$start,
            'end_date '=>$end,
            'tax1'=>$tax1,
            'tax2 '=>$tax2,
            'quantity'=>$quantity,
            'location'=>$location);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function add_item($bid,$uid,$tax,$area,$brand,$code,$barcode,$item_name,$description,$cost,$sellimg,$landing,$mrf,$discount,$start,$end,$location,$category,$suppier){
        
        $data=array('code'=>$code,	
            'barcode'=>$barcode,
            'category_id'=>$category,
            'added_by '=>$uid,
            'branch_id'=>$bid,
            'supplier_id'=>$suppier, 	
            'name'=>$item_name,
            'description'=>$description,
            'cost_price'=>$cost,
            'landing_cost'=>$landing,
            'selling_price'=>$sellimg,
            'mrf'=>$mrf,
            'discount_amount'=>$discount,
            'start_date'=>$start,
            'end_date '=>$end,
            'tax_id'=>$tax,
            'tax_area_id'=>$area,
            'branch_id'=>$bid,
            'brand_id'=>$brand,
            
            'location'=>$location);
             $this->db->insert('items',$data);
             return $this->db->insert_id();
               
    }
    function item_setting($tax_in,$id,$bid){
        $data=array('item_id'=>$id,
            'branch_id'=>$bid, 	
            'min_q'=>1,
            'max_q'=>1, 	
            'sales'=>1,
            'purchase'=>1, 	
            'salses_return'=>1, 	
            'purchase_return'=>1, 	
            'allow_negative'=>1, 	
            'tax_inclusive'=>$tax_in);
        $this->db->insert('items_settings',$data);
    }
    function item_in_items_branch($id,$bid){
         $this->db->select()->from('branchs')->where('id',$bid);
         $sql=$this->db->get();
         $name="";
         foreach ($sql->result() as $row){
             $name=$row->store_name;
         }
        $value=array('branch_id'=>$bid,
                    'item_id'=>$id,
                    'branch_name'=>$name);
                $this->db->insert('items_x_branchs',$value);
    }
                     
    
  
   
    function update_item_stock_history($id,$Bid,$category,$suppier,$cost,$unit,$quantity,$saling)
                {
        $this->db->select()->from('stocks_history')->where('branch_id',$Bid)->where('item_id',$id);
        $sql=  $this->db->get();
        $hstock="";      
        foreach ($sql->result() as $row){
            $hstock=$row->stock;                        
        }        
        $data=array('category_id'=>$category,
            'supplier_id'=>$suppier,
            'cost'=>$cost,
            'stock'=>$unit,
            'Quantity'=>$quantity);        
        $this->db->where('item_id',$id);
        $this->db->where('branch_id',$Bid);
        $this->db->update('stocks_history',$data);
        
        $this->update_stock($id, $Bid, $unit,$hstock,$saling);
        
        
    }
    function update_stock($id, $Bid, $unit,$hstock,$saling){
        $this->db->select()->from('stocks')->where('branch_id',$Bid)->where('item_id',$id);
        $sql=  $this->db->get();
        $cstock="";   
        $do_stock;
        foreach ($sql->result() as $row){
            $cstock=$row->stock; 
        }
        if($hstock <$unit){
            $do_stock=$cstock+$unit-$hstock;            
        }elseif ($hstock >$unit) {
            $do_stock=$cstock-($hstock-$unit); 
            if($do_stock<0){
                $do_stock=0;
            }
        }else{
            $do_stock=$hstock;
        }
        $data=array('stock'=>$do_stock,'price'=>$saling);
        $this->db->where('item_id',$id);
        $this->db->where('branch_id',$Bid);
        $this->db->update('stocks',$data);
          }
          function get_brands_user($bid){
              $this->db->select()->from('brands')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          
          function get_tax_for_user($bid){
              $this->db->select()->from('taxes')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          
         
          function get_tax_area_for_user($bid){
              $this->db->select()->from('taxes_area')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          function check_item($code,$bid){
              $this->db->select()->from('items')->where('code',$code)->where('branch_id',$bid)->where('delete_status',0);
              $sql=  $this->db->get();
              if($sql->num_rows()>0){
                  return FALSE;
              }else{
                  return TRUE;
              }
          }
          
                                  
                                   
}
?>
