<?php 
class Nodes_m extends CI_Model {
   private $table = "pos_item";
  
  function get_node_list() {
    $this->db->select('item_id,item_name,item_price');
    $this->db->order_by('item_id','DESC');
    $this->db->limit(30,0);
    $query = $this->db->get($this->table);
  
    return $query->result();
  }
  
  function get_node_by_type($type) {
    $this->db->select('item_id,item_name');
    $this->db->where('item_name',$type,'=');
    $this->db->order_by('item_id','DESC');
    $query = $this->db->get($this->table);
  
    return $query->result();
  }

  function get_node_by_name($user){
  	$this->db->select('item_id,item_name,item_price');
    $this->db->like('item_name',$user,'=');
    $this->db->order_by('item_id','DESC');
  	$query = $this->db->get($this->table);
  
    return $query->result();
  }

  function get_node_by_code($id){
    $this->db->select('item_id,item_name,item_price');
    $this->db->like('item_id',$id,'=');
    $this->db->order_by('item_id','DESC');
    $query = $this->db->get($this->table);
  
    return $query->result();
  }

  function get_node_by_spec_code($id){
    $this->db->select('letter_code, item_id,item_name,item_category,item_price,item_supplier');
    $this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');
    $this->db->where('item_id',$id,'=');
    $this->db->order_by('item_id','DESC');
    $query = $this->db->get($this->table);
    
    return $query->result();
  }

  // numeric code
  function get_node_exists($id){
    $this->db->select('item_id');
    $this->db->where('item_id =',$id);
    $this->db->order_by('item_id','DESC');
    $query = $this->db->get($this->table);
    
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
        return false;
    }
  }

  // alphanumeric code
  function get_node2_exists($id,$letter){

    $this->db->order_by('item_id','DESC');
    $this->db->select('item_id');    
    $this->db->from('pos_item');
    $this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');
    //$this->db->where('item_id =', $id);
    $this->db->like('item_id', $id, 'before');
    $this->db->where('letter_code =', $letter);
    $query = $this->db->get();
    
    if($query->num_rows() == 1) {
      return $query->row();
    } else {
        return false;
    }

  }



}
?>