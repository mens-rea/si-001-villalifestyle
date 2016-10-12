<?php 

class Items extends CI_Controller{
	
	public function index(){

		$this->load->model('Items_model');
        
        $item_list = $this->Items_model->get_items();  
        $packet['item'] = $item_list;
        
        $this->load->view('header');
        $this->load->view('report-item', $packet);
        $this->load->view('footer');
	}

    public function add_items()
    {
        $data = array (
        'item_name' => $this->input->post('item_name'),
        'item_price' => $this->input->post('item_price'),
        'item_category' => $this->input->post('item_category'),
        'item_supplier' => $this->input->post('item_supplier')
        );

        $this->load->model('Items_model');
        $item_id = $this->Items_model->add_items($data);  
 
        redirect('report-item');
    }

    public function get_item_supplier($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_supplier($item_code);
        
        return $result->item_supplier;        
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

    public function verify_item(){
        if (isset($_POST['type'])) {
          $this->load->model('nodes_m');
          $data['ajax_req'] = TRUE;
          $data['node_list'] = $this->nodes_m->get_node_by_code($_POST['type']);

          $this->load->view('ajax_items',$data);
        }
    }
}
?>