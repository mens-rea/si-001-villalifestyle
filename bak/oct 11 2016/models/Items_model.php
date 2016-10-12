<?php 
class Items_model extends CI_model{

	/* SELECT ACTION*/
	function get_items(){		
		$this->db->order_by("item_id", "desc");
		$this->db->select('item_id, item_name, item_category,item_price, item_stock, item_supplier, letter_code');
		$this->db->from('pos_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');
		$query = $this->db->get();

		return $query;
	}

	function filter_inventory($input) {
		$sql = "SELECT i.item_id, i.item_name, i.item_stock, i.item_price, i.item_category, i.item_supplier, u.letter_code, p.pullout_count, s.sales_count, d.delivery_count
				FROM POS_ITEM i 
				LEFT JOIN (
					SELECT pullout_item, sum(pullout_quantity) as pullout_count
					FROM pos_pullout
					WHERE pullout_status=1
					GROUP BY pullout_item 
				) p ON p.pullout_item = i.item_id
				LEFT JOIN (
					SELECT sales_item, count(sales_id) as sales_count
					FROM pos_sales
					GROUP BY sales_item
				) s ON s.sales_item = i.item_id
				LEFT JOIN(
					SELECT delivery_item, sum(delivery_quantity) as delivery_count
					FROM pos_delivery
					LEFT JOIN pos_delivery_transaction on pos_delivery_transaction.dt_id = pos_delivery.delivery_dt
					where dt_status=1
					GROUP BY delivery_item
				) d	ON d.delivery_item = i.item_id
			LEFT JOIN aauth_users u ON u.name = i.item_supplier

			WHERE 
			item_id like '%".$input."%' or
			item_name like '%".$input."%' or
			item_category like '%".$input."%' or
			letter_code like '%".$input."%' or
			u.name like '%".$input."%'
			ORDER BY item_id desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	function filter_inventory_with_date($start_date, $end_date) {
		$sql = "SELECT distinct i.item_id, i.item_name, i.item_stock, i.item_price, i.item_category, i.item_supplier, u.letter_code, p.pullout_count, s.sales_count, d.delivery_count
				FROM POS_ITEM i 
				LEFT JOIN (
					SELECT pullout_item, sum(pullout_quantity) as pullout_count
					FROM pos_pullout
					WHERE pullout_status=1
					GROUP BY pullout_item 
				) p ON p.pullout_item = i.item_id
				LEFT JOIN (
					SELECT sales_item, count(sales_id) as sales_count
					FROM pos_sales
					GROUP BY sales_item
				) s ON s.sales_item = i.item_id
				LEFT JOIN(
					SELECT delivery_item, sum(delivery_quantity) as delivery_count
					FROM pos_delivery
					LEFT JOIN pos_delivery_transaction on pos_delivery_transaction.dt_id = pos_delivery.delivery_dt
					where dt_status=1
					GROUP BY delivery_item
				) d	ON d.delivery_item = i.item_id

			LEFT JOIN aauth_users u ON u.name = i.item_supplier
			LEFT JOIN pos_pullout p2 on p2.pullout_item = i.item_id
			LEFT JOIN pos_sales s2 on s2.sales_item = i.item_id
			LEFT JOIN pos_delivery d2 on d2.delivery_item=i.item_id
			LEFT JOIN pos_delivery_transaction dt2 on dt2.dt_id = d2.delivery_dt

			WHERE
			(pullout_approved_date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59') or
			(sales_Date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59') or
			(dt_approve_date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59')     
			ORDER BY item_id desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	function filter_inventory_with_item_date($input, $start_date, $end_date) {
		$sql = "SELECT distinct i.item_id, i.item_name, i.item_stock, i.item_price, i.item_category, i.item_supplier, u.letter_code, p.pullout_count, s.sales_count, d.delivery_count
		FROM POS_ITEM i 
		LEFT JOIN (SELECT pullout_item, sum(pullout_quantity) as pullout_count FROM pos_pullout
		WHERE pullout_status='1'
		GROUP BY pullout_item     	
		) p ON p.pullout_item =  i.item_id
		LEFT JOIN (SELECT sales_item, count(sales_id) as sales_count FROM pos_sales
		 GROUP BY sales_item
		) s ON s.sales_item = i.item_id
		LEFT JOIN(SELECT delivery_item, sum(delivery_quantity) as delivery_count FROM pos_delivery
		LEFT JOIN pos_delivery_transaction on pos_delivery_transaction.dt_id = pos_delivery.delivery_dt
		 where dt_status=1
		 GROUP BY delivery_item
		) d ON d.delivery_item = i.item_id

		LEFT JOIN aauth_users u ON u.name = i.item_supplier
		LEFT JOIN pos_pullout p2 on p2.pullout_item = i.item_id
		LEFT JOIN pos_sales s2 on s2.sales_item = i.item_id
		LEFT JOIN pos_delivery d2 on d2.delivery_item=i.item_id
		LEFT JOIN pos_delivery_transaction dt2 on dt2.dt_id = d2.delivery_dt

		WHERE (p2.pullout_approved_date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59' or
		s2.sales_Date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59' or
		dt2.dt_approve_date between '".$start_date." 00:00:00' and '".$end_date." 23:59:59') AND 

		(item_id like '%".$input."%' or
		item_name like '%".$input."%' or
		item_category like '%".$input."%' or
		letter_code like '%".$input."%' or
		u.name like '%".$input."%' or
		item_category like '%".$input."%' )

		order by item_id desc";

		$query = $this->db->query($sql);
		return $query;		
	}

	function get_specific_item($item_id){		
		$this->db->order_by("item_id", "desc");
		$this->db->select('item_id, item_name, item_category,item_price, item_stock, pos_supplier.supplier_name');
		$this->db->from('pos_item');
		$this->db->where('item_id =', $item_id);
		$this->db->join('pos_supplier', 'pos_supplier.supplier_id = pos_item.item_supplier');
		$query = $this->db->get();

		return $query;
	}

	function get_supplier_inventory($supplier_id){
		$this->db->order_by("item_id", "desc");
		$this->db->select('item_id, item_name, item_category,item_price, item_stock, item_supplier');
		$this->db->from('pos_item');
		$this->db->where('item_supplier =', $supplier_id);
		$query = $this->db->get();

		return $query;
	}

	function get_item_price($item_code) {
		$sql = "SELECT item_price FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;
	}

	function get_item_supplier($item_code){
		$sql = "SELECT item_supplier FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;
	}

	function get_item_stock($item_code){
		$sql = "SELECT item_stock FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;
	}
	
	function item_validation($item_code){
		$sql = "SELECT * FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return true;
	    } else {
	    	return false;
	    }
	}

	function get_item_name($item_code) {
		$sql = "SELECT item_name FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;
	}

	function remove_item($item_code){
		$sql = "DELETE FROM pos_item WHERE item_id='".$item_code."'" ;
		$query = $this->db->query($sql);		
	    return true;
	}

	function get_item_category(){			
		$query = $this->db->get('pos_category');

		return $query;
	}

	function get_supplier_code($item_id){
		$this->db->order_by("id", "desc");
		$this->db->select('letter_code');
		$this->db->from('pos_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');
		$this->db->where('item_id =', $item_id);

		$query = $this->db->get();
		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false; 

		/*$sql = "SELECT letter_code FROM pos_item join aauth_users on aauth_users.name = pos_item.item_supplier WHERE item_id='".$item_id."'" ;
		$query = $this->db->query($sql);		
		if($query->num_rows() == 1) {
	        return $query->row();	        
	    }
	    return false;*/

		
	}

	/* INSERT ACTION */
	function add_items($data) {
		$item_data = array(
			'item_id' => '',
			'item_name' => $data['item_name'],
			'item_category' => $data['item_category'],
			'item_price' => $data['item_price'],
			'item_stock' => '0',
			'item_supplier' => $data['item_supplier']
		);
		$this->db->insert('pos_item', $item_data);
	}

	function add_item_category($category_name){
		$category_data = array(
			'category_id' => '',
			'category_name' => $category_name,
			'category_status' => 1,
		);

		$this->db->insert('pos_category', $category_data);
	}


	/* UPDATE ACTION */

	function update_stock($item_code, $stock) {
		$sql = "UPDATE pos_item SET item_stock='".$stock."' WHERE item_id='".$item_code."'" ;
		$this->db->query($sql);	
	}	

	function edit_item($data){
		$item_data = array(
			'item_name' => $data['item_name'],
			'item_category' => $data['item_category'],
			'item_price' => $data['item_price'],
		);

		$item_id=$data['item_id'];

		$this->db->where('item_id', $item_id);
		$this->db->update('pos_item', $data); 
	}

	function activate_category($category_id) {
		$sql = "UPDATE pos_category SET category_status=1 WHERE category_id='".$category_id."'" ;
		$this->db->query($sql);	
	}

	function deactivate_category($category_id) {
		$sql = "UPDATE pos_category SET category_status=0 WHERE category_id='".$category_id."'" ;
		$this->db->query($sql);	
	}

	function update_item_sale($id){
		$sql = "UPDATE pos_item SET item_stock=item_stock-1 WHERE item_id='".$id."'" ;
		$query2 = $this->db->query($sql);
	
		return $query2;
	}



	/* DELETE ACTION */

	function delete_category($category_id){
		$this->db->where('category_id', $category_id);
		$this->db->delete('pos_category'); 
	}


}
?>