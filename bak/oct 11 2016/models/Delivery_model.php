<?php 
class Delivery_model extends CI_model{

	/* SELECT ACTIONS */
	function get_delivery_report(){		
		$this->db->order_by("dt_id", "desc");
		$this->db->select('*');
		$this->db->from('pos_delivery_transaction');
		$this->db->join('aauth_users', 'pos_delivery_transaction.dt_supplier = 
			aauth_users.name');
		$query = $this->db->get();

		return $query;
	}

	function get_delivery_report_supplier($supplier_id){		
		$this->db->order_by("dt_id", "desc");
		$this->db->select('dt_id, dt_total_quantity,dt_date, dt_approve_date, dt_status, dt_supplier');
		$this->db->from('pos_delivery_transaction');
		$this->db->where('dt_supplier', $supplier_id);

		$query = $this->db->get();

		return $query;
	}

	function get_specific_delivery($transaction_id){
		
		$this->db->select('*');
		$this->db->from('pos_delivery');
		$this->db->where('delivery_dt', $transaction_id);
		$this->db->join('pos_item', 'pos_item.item_id = pos_delivery.delivery_item');

		$query = $this->db->get();

		return $query;
	}

	function get_specific_delivery_transaction($transaction_id){
		
		$this->db->select('*');
		$this->db->from('pos_delivery_transaction');
		$this->db->where('dt_id', $transaction_id);

		$query = $this->db->get();

		return $query;
	}

	function get_supplier_name($supplier_id){
		$sql = "SELECT supplier_name FROM pos_supplier WHERE supplier_id='".$supplier_id."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;
	}

	function delivery_count($item_id){

		$this->db->select_sum('delivery_quantity');
		$this->db->from('pos_delivery');
		$this->db->join('pos_delivery_transaction', 'pos_delivery_transaction.dt_id = pos_delivery.delivery_dt');
		$this->db->where('delivery_item =', $item_id);
		$this->db->where('dt_status =', 1);
		$query = $this->db->get();

		if($query->row()->delivery_quantity == null){
			return 0;
		} else{
			return $query->row()->delivery_quantity;
		}
	}

	function delivery_count_date($item_id,$start_date,$end_date){

		$sql = "select sum(delivery_quantity) from pos_delivery
				JOIN pos_delivery_transaction on pos_delivery_transaction.dt_id = pos_delivery.delivery_dt
				WHERE delivery_item='".$item_id."' 
				and dt_status=1 and
				dt_date >= '".$start_date." 00:00:00' and dt_date <= '".$end_date." 23:59:59'";

		
		$query = $this->db->query($sql);		
		// return $query;	
		// if($query->row()->delivery_quantity == null){
		// 	return 0;
		// } else{
		// 	return $query->row()->delivery_quantity;
		// }		
	}


	function filter_delivery_transaction($input) {

		$this->db->order_by("dt_id", "desc");
		$this->db->select('*');
		$this->db->from('pos_delivery_transaction');
		$this->db->join('aauth_users', 'pos_delivery_transaction.dt_supplier = 
			aauth_users.name');
		$this->db->like('dt_id',$input,'=');
		$this->db->or_like('aauth_users.name',$input,'=');
		$this->db->or_like('aauth_users.letter_code',$input,'=');

		$query = $this->db->get();

		return $query;
	}

	//filter for pending delivery transaction
	function filter_delivery_transaction_with_date($start_date, $end_date){
		$sql = "select * from pos_delivery_transaction
				join aauth_users on aauth_users.name = pos_delivery_transaction.dt_supplier				
				WHERE
				dt_date >= '".$start_date." 00:00:00' and dt_date <= '".$end_date." 23:59:59'
				order by dt_date desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	//filter for pending delivery transaction
	function filter_delivery_transaction_with_item_date($input, $start_date, $end_date){
		$sql = "select * from pos_delivery_transaction
				join aauth_users on aauth_users.name = pos_delivery_transaction.dt_supplier				
				WHERE
				dt_date >= '".$start_date." 00:00:00' and dt_date <= '".$end_date." 23:59:59'
				and (dt_id like '%".$input."%' or 				 	
				 	aauth_users.name like '%".$input."%' or
				 	aauth_users.letter_code like '%".$input."%')
				order by dt_date desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	//filter for approve and reject delivery
	function filter_ar_delivery_transaction_with_date($start_date, $end_date){
		$sql = "select * from pos_delivery_transaction
				join aauth_users on aauth_users.name = pos_delivery_transaction.dt_supplier
				WHERE
				dt_approve_date >= '".$start_date." 00:00:00' and dt_approve_date <= '".$end_date." 23:59:59'
				order by dt_approve_date desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	//filter for approve and reject delivery
	function filter_ar_delivery_transaction_with_item_date($input, $start_date, $end_date){
		$sql = "select * from pos_delivery_transaction
				join aauth_users on aauth_users.name = pos_delivery_transaction.dt_supplier
				WHERE
				dt_approve_date >= '".$start_date." 00:00:00' and dt_approve_date <= '".$end_date." 23:59:59'
				and (dt_id like '%".$input."%' or 				 	
				 	aauth_users.name like '%".$input."%' or
				 	aauth_users.letter_code like '%".$input."%')
				order by dt_approve_date desc";

		$query = $this->db->query($sql);
		return $query;		
	}


	function remove_delivery_item($delivery){
		$sql = "DELETE FROM pos_delivery WHERE delivery_id ='".$delivery."'";
		$query = $this->db->query($sql);			

	    return true;
	}

	function remove_delivery_transaction($dt){
		$sql = "DELETE FROM pos_delivery_transaction WHERE dt_id ='".$dt."'";
		$query = $this->db->query($sql);			

	    return true;
	}

	function edit_delivery_qty($delivery,$qty){
		$sql = "UPDATE pos_delivery SET delivery_quantity='".$qty."' WHERE delivery_id ='".$delivery."'";
		$this->db->query($sql);			

	    return true;
	}

	function update_total_qty($dt,$final_qty){
		$sql2 = "UPDATE pos_delivery_transaction SET dt_total_quantity='".$final_qty."' WHERE dt_id='".$dt."'";
		$this->db->query($sql2);

	    return true;
	}

	/* INSERT ACTIONS */

	/*NOTE: STATIC ADD DELIVERY TRANSACTION BELOW*/
	function add_delivery_transaction($supplier,$qty){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');	
		
		$dt_data = array(
			'dt_id' => '',
			'dt_supplier' => $supplier,			
			'dt_total_quantity' => $qty,
			'dt_date' => $current_date,
			'dt_approve_date' => '',			
			'dt_status' => '0'	
		);

		$this->db->insert('pos_delivery_transaction', $dt_data);
		$last_id = $this->db->insert_id();

		return $last_id;		
	}

	function add_delivery_items($data){

		$sql = array(); 
		$ctr = 0;
		foreach( $data as $row ) {
			$this->db->insert('pos_delivery', $data[$ctr]);
		    $ctr++;
		}	
	}
	/* UPDATE ACTIONS */

	function approve_delivery($dt_id){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');	
		$sql = "UPDATE pos_delivery_transaction SET dt_status='1', dt_approve_date='".$current_date."' WHERE dt_id='".$dt_id."'" ;
		$query = $this->db->query($sql);

		$this->db->select('delivery_quantity, delivery_item');
		$this->db->from('pos_delivery');
		$this->db->where('delivery_dt =', $dt_id);
		$tempquery = $this->db->get();

		foreach($tempquery->result_array() as $row){ 
			$quantity = $row['delivery_quantity'];
			$item = $row['delivery_item'];

			$sql = "UPDATE pos_item SET item_stock=item_stock+".$quantity." WHERE item_id='".$item."'" ;
			$query2 = $this->db->query($sql);
		}

		return $query;
	}

	function reject_delivery($dt_id){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d H:i:s');	
		$sql = "UPDATE pos_delivery_transaction SET dt_status='2', dt_approve_date='".$current_date."' WHERE dt_id='".$dt_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function archive_delivery($dt_id){
		$sql = "UPDATE pos_delivery_transaction SET dt_status='3' WHERE dt_id='".$dt_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}

	function archive_rejected_delivery($dt_id){
		$sql = "UPDATE pos_delivery_transaction SET dt_status='4' WHERE dt_id='".$dt_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}
}

/**
NOTE: Delivery status:
1 - Approved Delivery
2 - Rejected Delivery
3 - Archived Delivery
4 - Archived Rejected Delivery
**/
?>

