<?php 

class Sales extends CI_Controller{
	
	public function index(){
        $account=2; //place account type here

		$this->load->model('Sales_model');
        
        $sale_report = $this->Sales_model->get_sales();  
        $packet['sales'] = $sale_report;
        

        //create an if else statement to redirect to the correct view as per account type
        if($account==1){
            $this->load->view('header');
            $this->load->view('report-sales', $packet);
            $this->load->view('footer');
        }
        elseif ($account==2) {
            $this->load->view('header');
            $this->load->view('report-sales', $packet);
            $this->load->view('footer');
        }
	}

    public function add_sales_transaction(){
        $supplier = '201605000000003'; //enter supplier type here 
        $current_date = date('Y-m-d');

        $items = $this->input->post('data');
        $quant = $this->input->post('qty');

        foreach( $data as $row ) {
            $this->db->insert('pos_sales', $data[$ctr]);
            $ctr++;
        }

        $data=array();  

        foreach($items as $key => $csm)
        {
            $data[$key]['sales_id'] = '';
            $data[$key]['sales_item'] = $items[$key]['ItemName'];
            $data[$key]['sales_quantity'] = $items[$key]['ItemQuantity'];
            $data[$key]['sales_total'] = '1000';
            $data[$key]['sales_discount'] = '10';
            $data[$key]['sales_date'] = $current_date;
            $data[$key]['sales_supplier'] = $supplier;
            $data[$key]['sales_st'] = '';
        }

        $this->Sales_model->add_sales_items($data);
        redirect('cashier');
    }

    public function add_sales(){
        $supplier = '201605000000006'; //enter supplier type here 
        $current_date = date('Y-m-d');

        $items = $this->input->post('data');
        $quant = $this->input->post('qty');

        /*$this->load->model('Sales_model');
        $last_id = $this->Sales_model->add_sales($supplier, $quant); 

        foreach( $data as $row ) {
            $this->db->insert('pos_sales_transaction', $data[$ctr]);
            $ctr++;
        }

        $data=array();*/  

        foreach($items as $key => $csm)
        {
            $data[$key]['sales_id'] = '';
            $data[$key]['sales_item'] = $items[$key]['ItemName'];
            $data[$key]['sales_quantity'] = $items[$key]['ItemQuantity'];
            $data[$key]['sales_total'] = '1000';
            $data[$key]['sales_discount'] = '10';
            $data[$key]['sales_date'] = $current_date;
            $data[$key]['sales_supplier'] = $supplier;
            $data[$key]['sales_st'] = $last_id;
        }
        $this->Sales_model->add_sales_items($data);
        redirect('admin/report-sales');
    }

    public function add_delivery_items(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;
        
        $this->load->view('header');
        $this->load->view('delivery-additem-view', $packet);
        $this->load->view('footer');
    }
    
    public function get_item_price($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_price($item_code);
        
        return $result->item_price;        
    }

    public function get_total_price($item_code, $quantity) {
        
        $item_price = $this->get_item_price($item_code);
        $total_price = $item_price * $quantity;
        
        return $total_price;
    }

	public function add_income()
    {
        $data = array (
        'income_amount' => $this->input->post('income_amount'),
        'income_name' => $this->input->post('income_name'),
        'income_date_acquired' => $this->input->post('income_date_acquired')
        );

        $this->load->model('Income_model');
        $shop_id = $this->Income_model->add_income($data);  
 
        redirect('income-view');
    }

    public function filter_month(){
            $this->load->model('Sales_model');       

            $date_start = $this->input->post('filter_start_date');
            $date_end = $this->input->post('filter_end_date');

            $income = $this->Sales_model->get_sales_certmonth($date_start,$date_end);         
            $packet['sales'] = $income;

            $data['sessions'] = $this->session_name();
            
            $this->load->view('header',$data);
            $this->load->view('report-sales', $packet);
            $this->load->view('footer');
    }

    public function filter_income_date(){
        $this->load->model('Income_model');
        $this->load->model('Expense_model');
        $this->load->model('Withdrawal_model');

        $date_start = $this->input->post('filter_start_date');
        $date_end = $this->input->post('filter_end_date');

        $income = $this->Income_model->get_income_certmonth($date_start,$date_end);  
        $expense = $this->Expense_model->get_expense_certmonth($date_start,$date_end);
        $withdrawal = $this->Withdrawal_model->get_withdrawal_certmonth($date_start,$date_end);
        $packet['income'] = $income;
        $packet['expense'] = $expense;
        $packet['withdrawal'] = $withdrawal;
        
        $this->load->view('header');
        $this->load->view('income-view', $packet);
        $this->load->view('footer');
    }

    function sales_more_data() {
        if (isset($_POST['type'])) {
          $this->load->model('nodes_m');
          $data['ajax_req'] = TRUE;
          $data['node_list'] = $this->nodes_m->get_node_by_code($_POST['type']);

          $this->load->view('ajax_items',$data);
        }
    }
}
?>