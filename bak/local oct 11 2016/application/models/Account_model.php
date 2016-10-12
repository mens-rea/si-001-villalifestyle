<?php 
class Account_model extends CI_model{

	/* SELECT ACTION */
	function get_user_code($user_id){		
		$this->db->order_by("id", "desc");
		$this->db->select('id,letter_code');
		$this->db->from('aauth_users');
		$this->db->where('id =', $user_id);
		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false; 
		
	}

}
?>