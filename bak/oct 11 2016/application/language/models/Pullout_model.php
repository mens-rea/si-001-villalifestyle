<?php 
class Pullout_model extends CI_model{

	/* SELECT ACTIONS */

	//admin
	function get_pullout(){
		$this->db->order_by("pullout_id", "desc");
		$this->db->select('pullout_id, pullout_item, pullout_quantity,pullout_date, pullout_approved_date, pullout_status, aauth_users.name, pos_item.item_name, pos_item.item_id, letter_code');
		$this->db->from('pos_pullout');
		$this->db->join('aauth_users', 'aauth_users.name = pos_pullout.pullout_supplier');
		$this->db->join('pos_item', 'pos_item.item_id = pos_pullout.pullout_item');
		$query = $this->db->get();

		return $query;

	}

	function filter_pullout_transaction($input) {

		$this->db->order_by("pullout_id", "desc");
		$this->db->select('*');
		$this->db->from('pos_pullout');
		$this->db->join('aauth_users', 'aauth_users.name = pos_pullout.pullout_supplier');
		$this->db->join('pos_item', 'pos_item.item_id = pos_pullout.pullout_item');

		$this->db->like('pullout_id',$input,'=');
		$this->db->or_like('aauth_users.name',$input,'=');
		$this->db->or_like('aauth_users.letter_code',$input,'=');
		$this->db->or_like('pos_item.item_name',$input,'=');
		$this->db->or_like('pos_item.item_id',$input,'=');

		$query = $this->db->get();

		return $query;
	}

	//tenant
	function get_pullout_supplier($supplier_id){
		$this->db->order_by("pullout_approved_date", "desc");
		$this->db->select('pullout_id, pullout_item, pullout_quantity,pullout_date, pullout_approved_date, pullout_status, pullout_supplier, pos_item.item_name, pos_item.item_id');
		$this->db->from('pos_pullout');
		$this->db->where('pullout_supplier =', $supplier_id);
		$this->db->join('pos_item', 'pos_item.item_id = pos_pullout.pullout_item');
		$query = $this->db->get();

		return $query;
	}

	function get_pullout_item($pullout_id){
		$sql = "SELECT pullout_item, pullout_quantity FROM pos_pullout WHERE pullout_id='".$pullout_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function pullout_count($item_id){

		$this->db->select_sum('pullout_quantity');		
		$this->db->from('pos_pullout');
		$this->db->where('pullout_item =', $item_id);
		$this->db->where('pullout_status =', 1);
		$query = $this->db->get();

		if($query->row()->pullout_quantity == null){
			return 0;
		} else{
			return $query->row()->pullout_quantity;
		}

	}

	/* INSERT ACTIONS */
	function add_pullout_item($data){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');	
		
		$po_data = array(
			'pullout_id' => '',
			'pullout_item' => $data['pullout_item_code'],			
			'pullout_quantity' => $data['pullout_item_quantity'],
			'pullout_supplier' => $data['pullout_supplier'],
			'pullout_date' => $current_date,
			'pullout_approved_date' => '',
			'pullout_status' => '0',
		);
		$this->db->insert('pos_pullout', $po_data);
	}
	/* UPDATE ACTIONS*/

	function approve_pullout($pullout_id){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');

		$sql = "UPDATE pos_pullout SET pullout_status='1',pullout_approved_date='".$current_date."' WHERE pullout_id='".$pullout_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function reject_pullout($pullout_id){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');
		
		$sql = "UPDATE pos_pullout SET pullout_status='2',pullout_approved_date='".$current_date."' WHERE pullout_id='".$pullout_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function archive_pullout($pullout_id){
		$sql = "UPDATE pos_pullout SET pullout_status='3' WHERE pullout_id='".$pullout_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function archive_rejected_pullout($pullout_id){
		$sql = "UPDATE pos_pullout SET pullout_status='4' WHERE pullout_id='".$pullout_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}
}

/**
NOTE: Pullout status:
1 - Approved Pullout
2 - Rejected Pullout
3 - Archived Approved Pullout
4 - Archived Rejected Pullout
**/
?>