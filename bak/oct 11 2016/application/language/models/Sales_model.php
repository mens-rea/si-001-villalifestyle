<?php 
class Sales_model extends CI_model{

	function get_sales(){		
		$this->db->order_by("sales_id", "desc");
		$this->db->select('*');
		$this->db->from('pos_sales');
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');

		$query = $this->db->get();

		return $query;
	}

	function get_daily_sales(){
		date_default_timezone_set('Asia/Manila');
		$today = date('Y-m-d');	

	    $this->db->order_by("sales_id", "desc");
		$this->db->select('sales_id,pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st, sales_status,letter_code');
		$this->db->from('pos_sales');
		$this->db->where('sales_date >=', $today);
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');

		$query = $this->db->get();

		return $query;
	}

	function get_all_sales(){
	    $this->db->order_by("sales_id", "desc");
		$this->db->select('sales_id,pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st, sales_status, letter_code');
		$this->db->from('pos_sales');
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');

		$query = $this->db->get();

		return $query;
	}

	function get_sales_by_tenant_daily($input){
		date_default_timezone_set('Asia/Manila');

		$sql = "
		SELECT * FROM pos_sales 
		join pos_item on pos_item.item_id = pos_sales.sales_item
		left join aauth_users on aauth_users.name = pos_item.item_supplier
		WHERE DATE(sales_date) = DATE(now()) 
		and 
			(pos_item.item_name like '%". $input ."%' or
			sales_item like '%". $input ."%' or
			letter_code like '%". $input ."%' or
			sales_supplier like '%". $input ."%'
			) order by sales_date desc";


		$query = $this->db->query($sql);

		return $query;
	}

	function get_sales_by_tenant($input){	
	    $this->db->order_by("sales_id", "desc");
		$this->db->select('sales_id,pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st, sales_status, letter_code');
		$this->db->from('pos_sales');
		$this->db->like('pos_item.item_supplier',$input,'=');
		$this->db->or_like('pos_item.item_id', $input, '=');
		$this->db->or_like('letter_code', $input, '=');
		$this->db->or_like('pos_item.item_name', $input, '=');
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');

		$query = $this->db->get();

		return $query;
	}

	function get_sales_by_fdate_tenant($input,$date_start,$date_end){	
		date_default_timezone_set('Asia/Manila');
	   /* $this->db->order_by("sales_id", "desc");
		$this->db->select('sales_id,pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st, sales_status,letter_code');
		$this->db->from('pos_sales');
		//$this->db->where('sales_date >=', $date_start." 00:00:00");
		//$this->db->where('sales_date <=', $date_end." 23:59:59");

		$this->db->where('sales_date >=', DATE($date_start));
		$this->db->where('sales_date <=', DATE($date_end));
		$this->db->where('sales_date BETWEEN "'. date('Y-m-d', strtotime($date_start)). '" and "'. date('Y-m-d', strtotime($date_end)).'"');

		$this->db->like('pos_item.item_supplier',$input);
		$this->db->like('pos_item.item_id', $input);
		$this->db->like('pos_item.item_name', $input);
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');

		$query = $this->db->get();*/

		$sql = "
		SELECT * FROM pos_sales 
		join pos_item on pos_item.item_id = pos_sales.sales_item 
		left join aauth_users on aauth_users.name = pos_item.item_supplier 
		WHERE 
		sales_date BETWEEN '".$date_start." 00:00:00' AND '2016-07-01 23:59:59' 		
        AND
		(sales_supplier like '%". $input ."%' or
		pos_item.item_name like '%". $input ."%' or
		letter_code like '%". $input ."%' or
		sales_item like '%". $input ."%'
		)
			" ;

			/*sales_date BETWEEN '2016-06-30 00:00:00' AND '2016-07-01 23:59:59' 
			(pos_item.item_name like '%". $input ."%' or
			sales_item like '%". $input ."%' or
			sales_supplier like '%". $input ."%'
			)*/


		$query = $this->db->query($sql);

		return $query;
	}

	function get_supplier_sales($supplier_id){			
		$this->db->order_by("sales_id", "desc");
		$this->db->select('sales_id, pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st');
		$this->db->from('pos_sales');		
		$this->db->where('sales_supplier =', $supplier_id);		
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');

		$query = $this->db->get();

	    return $query;
	}

	function get_sales_certmonth($date_start,$date_end){
		$this->db->order_by("sales_date", "desc");
		$this->db->select('sales_id, pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st, letter_code');
		$this->db->where('sales_date >=', $date_start." 00:00:00");
		$this->db->where('sales_date <=', $date_end." 23:59:59");
		$this->db->from('pos_sales');
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		$this->db->join('aauth_users', 'aauth_users.name = pos_item.item_supplier', 'left');
		$query = $this->db->get();

		return $query;
	}

	function get_sales_supplier_certmonth($date_start,$date_end,$supplier){
		$this->db->order_by("sales_date", "desc");
		$this->db->select('sales_id,pos_item.item_id, pos_item.item_name, pos_item.item_supplier, pos_item.item_category, sales_quantity,sales_total, sales_status, sales_discount, sales_date, sales_supplier, sales_st');
		$this->db->where('sales_date >=', $date_start);
		$this->db->where('sales_date <=', $date_end);
		$this->db->where('sales_supplier =', $supplier);
		$this->db->from('pos_sales');
		$this->db->join('pos_item', 'pos_item.item_id = pos_sales.sales_item');
		
		$query = $this->db->get();

		return $query;
	}

	function sold_item_count($item_id){
		$sql = 	"SELECT * FROM pos_sales WHERE sales_item='".$item_id."'";
		$query = $this->db->query($sql);
		return $query->num_rows();

	}
	
	function add_sales_transaction($supplier,$qty){
		date_default_timezone_set('Asia/Manila');
		$current_date = date('Y-m-d g:i:s');
		
		$st_data = array(
			'st_id' => '',
			'st_total' => '100',	
			'st_date' => $current_date,		
			'st_cashier' => '2010019576'
		);

		$this->db->insert('pos_sales_transaction', $st_data);
		$last_id = $this->db->insert_id();

		return $last_id;
	}

	function add_sales_items($data){
		$sql = array(); 
		$ctr = 0;
		foreach( $data as $row ) {
			$this->db->insert('pos_sales', $data[$ctr]);
		    $ctr++;
		}
		return true;
	}

	function void_sales($sales_id){
		$sql = "UPDATE pos_sales SET sales_status='1' WHERE sales_id='".$sales_id."'" ;
		$query = $this->db->query($sql);
		return $query;
	}
}
?>