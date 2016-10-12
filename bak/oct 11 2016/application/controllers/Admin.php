<?php 

class Admin extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
        $user_type =  $this->session_type();

        if($user_type!=1){
            redirect('restricted');            
        }        
    }
    
	public function index(){
        if($this->session->userdata('loggedin')==1 ){
            $this->view_sales_report();
        }         
    }

    public function session_type(){        
        return $_SESSION["type"];       
    }

    public function session_name(){
        return $this->session->userdata('name'); 
    }

    public function view_sales_report(){
        $this->load->model('Sales_model');

        $sale_report = $this->Sales_model->get_daily_sales();  

        $packet['qty_sold'] = $sale_report->num_rows();
        $packet['sales'] = $sale_report;        

        $data['sessions'] = $this->session_name();
    
        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-sales', $packet);
        $this->load->view('footer');
    }

    public function view_sales_report_all(){
        $this->load->model('Sales_model');

        $sale_report = $this->Sales_model->get_all_sales();  
        $packet['sales'] = $sale_report;        
        $packet['qty_sold'] = $sale_report->num_rows();

        $data['sessions'] = $this->session_name();
    
        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-all-sales', $packet);
        $this->load->view('footer');
    }

    public function suggest_more_admin_all_sales_data(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Sales_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $sale_report = $this->Sales_model->get_sales_by_tenant($filter_item);
			$data['sales'] = $sale_report;
         	$data['qty_sold'] = $sale_report->num_rows();
            $data['ind'] = '1';

		    $this->load->view('admin-report-all-sales-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";
		} elseif(isset($start_date) && isset($end_date) && empty($filter_item)){    		
    		$data['ajax_req'] = TRUE;
		    $sale_report = $this->Sales_model->filter_sales_with_date($start_date, $end_date);
		    $data['sales'] = $sale_report;
         	$data['qty_sold'] = $sale_report->num_rows();

            $data['ind'] = '3';
            $data['filter_start'] = $start_date;
            $data['filter_end'] = $end_date;

		    $this->load->view('admin-report-all-sales-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){        	
    		$data['ajax_req'] = TRUE;
		    $sale_report = $this->Sales_model->filter_sales_with_item_date($filter_item,$start_date, $end_date);
		    $data['sales'] = $sale_report;
         	$data['qty_sold'] = $sale_report->num_rows();

            $data['ind'] = '4';
            $data['filter_start'] = $start_date;
            $data['filter_end'] = $end_date;
            $data['filter_item'] = $filter_item;

		    $this->load->view('admin-report-all-sales-ajax',$data);
        }
    }

    public function suggest_more_admin_sales_data(){
        if (isset($_POST['type'])) {
          $this->load->model('Sales_model');
          $data['ajax_req'] = TRUE;
           $sale_report = $this->Sales_model->get_sales_by_tenant_daily($_POST['type']);
           $data['sales'] = $sale_report;
           $data['qty_sold'] = $sale_report->num_rows();
          $this->load->view('admin-report-sales-ajax',$data);
        }
    }

    public function suggest_more_admin_fdate_sales_data(){
        if (isset($_POST['type'])) {
          $this->load->model('Sales_model');
          $data['ajax_req'] = TRUE;
        
        echo "ajax: ". date("M j, Y", strtotime($_POST['sdate']));
          /*echo $_POST['sdate'] ." ".$_POST['edate'] echo date($_POST['sdate']);;*/

          $data['sales'] = $this->Sales_model->get_sales_by_fdate_tenant($_POST['type'],$_POST['sdate'],$_POST['edate']);

          echo  $data['fro'] = $_POST['sdate'] . ' ';
         echo   $data['to'] = $_POST['edate'];

          $this->load->view('admin-report-fdate-sales-ajax',$data);
        }
    }

    public function filter_sales_month(){
        $this->load->model('Sales_model');       

        $date_start = $this->input->post('filter_start_date');
        $date_end = $this->input->post('filter_end_date');

        $sale_report = $this->Sales_model->get_sales_certmonth($date_start,$date_end);      

        $packet['sales'] = $sale_report;
        $packet['fro'] = $date_start;
        $packet['to'] = $date_end;

        $packet['qty_sold'] = $sale_report->num_rows();

        $data['sessions'] = $this->session_name();
            
        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-sales-f-month', $packet);
        $this->load->view('footer');
    }

    

    public function filter_inventory_item(){
    	$start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Items_model');        
    	$data['category_list'] = $this->Items_model->get_item_category();   

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
    		$data['item'] = $this->Items_model->filter_inventory($filter_item);    		 

			$this->load->view('admin-report-item-ajax',$data);
    	} elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";
    	} elseif(isset($start_date) && isset($end_date) && empty($filter_item)){
    		$data['ajax_req'] = TRUE;
    		$data['item'] = $this->Items_model->filter_inventory_with_date($start_date, $end_date);    		 

			$this->load->view('admin-report-item-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
        	$data['ajax_req'] = TRUE;
    		$data['item'] = $this->Items_model->filter_inventory_with_item_date($filter_item, $start_date, $end_date);    		 

			$this->load->view('admin-report-item-ajax',$data);
        }
    }

    
    public function filter_pending_delivery_transaction(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Delivery_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($filter_item);

		    $this->load->view('admin-report-delivery-pending-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-delivery-pending-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-delivery-pending-ajax',$data);
        }
    }

     public function filter_approved_delivery_transaction(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Delivery_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($filter_item);

		    $this->load->view('admin-report-delivery-approve-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_ar_delivery_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-delivery-approve-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_ar_delivery_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-delivery-approve-ajax',$data);
        }
    }

    public function filter_rejected_delivery_transaction(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Delivery_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($filter_item);

		    $this->load->view('admin-report-delivery-reject-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_ar_delivery_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-delivery-reject-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['delivery_transaction'] = $this->Delivery_model->filter_ar_delivery_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-delivery-reject-ajax',$data);
        }
    }

    public function filter_pending_pullout_transaction(){
    	$start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Pullout_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($filter_item);

		    $this->load->view('admin-report-pullout-pending-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_pullout_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-pullout-pending-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_pullout_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-pullout-pending-ajax',$data);
        }
    }

    public function filter_approved_pullout_transaction(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Pullout_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($filter_item);

		    $this->load->view('admin-report-pullout-approve-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_ar_pullout_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-pullout-approve-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_ar_pullout_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-pullout-approve-ajax',$data);
        }
    }

    public function filter_rejected_pullout_transaction(){
        $start_date = $_POST['sdate'];
    	$end_date = $_POST['edate'];
    	$filter_item = $_POST['type'];

    	$this->load->model('Pullout_model');

    	if(empty($start_date) && empty($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($filter_item);

		    $this->load->view('admin-report-pullout-reject-ajax',$data);
        } elseif(empty($start_date) || empty($end_date)){
    		echo "<script type='text/javascript'>".
                "alert('Please fill up both date fields.');".
                "</script>";

    	} elseif(isset($start_date) && isset($end_date) && !isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_ar_pullout_transaction_with_date($start_date, $end_date);

		    $this->load->view('admin-report-pullout-reject-ajax',$data);
        } elseif(isset($start_date) && isset($end_date) && isset($filter_item)){
    		$data['ajax_req'] = TRUE;
		    $data['pullout'] = $this->Pullout_model->filter_ar_pullout_transaction_with_item_date($filter_item,$start_date, $end_date);

		    $this->load->view('admin-report-pullout-reject-ajax',$data);
        }
    }
    
    public function view_inventory(){
        /*$inventory_details = array();

        $this->load->model('Items_model');
        $this->load->model('Pullout_model');
        $this->load->model('Sales_model');
        $this->load->model('Delivery_model');

        $supplier_id = $this->get_supplier_id();        
        $item_list = $this->Items_model->get_items();  */
        $data['sessions'] = $this->session_name();
        
       /* foreach($item_list->result_array() as $row){
            $inventory_details[] = $row;
        }

        for($x=0 ; $x < sizeof($inventory_details) ; $x++) {
            $id = $inventory_details[$x]['item_id'];
            $inventory_details[$x]['pullout_count'] = $this->Pullout_model->pullout_count($id);
            $inventory_details[$x]['delivery_count'] = $this->Delivery_model->delivery_count($id);
            $inventory_details[$x]['sales_count'] = $this->Sales_model->sold_item_count($id);
        }

        $packet['item'] = $inventory_details;*/
      
        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-item');
        //$this->load->view('admin-report-item', $packet);
        $this->load->view('footer');
    }


    public function view_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('admin-header',$data);
        $this->load->view('admin-report-delivery', $packet);
        $this->load->view('footer');
    }

    public function view_approved_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('admin-header',$data);
        $this->load->view('admin-report-delivery-approve', $packet);
        $this->load->view('footer');
    }

    public function view_rejected_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('admin-header',$data);
        $this->load->view('admin-report-delivery-reject', $packet);
        $this->load->view('footer');
    }


    public function view_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-pullout', $packet);
        $this->load->view('footer');
    }

    public function view_approved_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-pullout-approve', $packet);
        $this->load->view('footer');
    }

    public function view_rejected_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('admin-header', $data);
        $this->load->view('admin-report-pullout-reject', $packet);
        $this->load->view('footer');
    }

    public function approved_pullout(){
        $pullout_id = $this->uri->segment(3);
        $pull_data = $this->get_pullout_item($pullout_id);

        foreach($pull_data->result_array() as $row){ 
            $item_code = $row['pullout_item'];
            $item_quantity = $row['pullout_quantity'];
        }

        $this->load->model('Pullout_model');
        
        $pullout = $this->Pullout_model->approve_pullout($pullout_id); 
        
        $new_stock = $this->deduct_inv_stock($item_code,$item_quantity);
        $this->update_stock($item_code, $new_stock);

        redirect('admin/view_pullout');
    }

    public function reject_pullout(){
        $pullout_id = $this->uri->segment(3);
        $this->load->model('Pullout_model');
        $pullout = $this->Pullout_model->reject_pullout($pullout_id);

        redirect('admin/view_rejected_pullout');
    }

    public function archive_pullout(){
        $pullout_id = $this->uri->segment(3);
        $this->load->model('Pullout_model');
        $pullout = $this->Pullout_model->archive_pullout($pullout_id);

        redirect('admin/view_approved_pullout');
    }

    public function archive_rejected_pullout(){
        $pullout_id = $this->uri->segment(3);
        $this->load->model('Pullout_model');
        $pullout = $this->Pullout_model->archive_rejected_pullout($pullout_id);

        redirect('admin/view_rejected_pullout');
    }

    public function deduct_inv_stock($item_code, $item_quantity){
        $current_stock = $this->get_item_stock($item_code);

        if($current_stock != 0) {
            $stock = $current_stock - $item_quantity;
        } else {
            echo "no more stock available";
        }

       return $stock;
    }

    public function get_item_stock($item_code){
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_stock($item_code);

        return $result->item_stock;
    }

    public function update_stock($item_code, $stock){
        $this->load->model('Items_model');
        $current_stock = $this->Items_model->update_stock($item_code, $stock);
    }

    public function get_pullout_item($pullout_id){
        $this->load->model('Pullout_model');
        $query = $this->Pullout_model->get_pullout_item($pullout_id);

        return $query;
    }

    public function delivery_notification() {
        $data['sessions'] = $this->session_name();

        $this->load->view('header', $data);
        $this->load->view('delivery-notification');
        $this->load->view('footer');
    }   

    
    public function get_item_supplier($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_supplier($item_code);
        
        return $result->item_supplier;        
    }

    public function edit_item(){
        $data = array (
        'item_id' => $this->input->post('item_code'),
        'item_name' => $this->input->post('item_name'),
        'item_price' => $this->input->post('item_price'),
        'item_category' => $this->input->post('item_category'),
        
        );

        $this->load->model('Items_model');        
        
        $this->form_validation->set_rules('item_name', 'Item Name', 'required');
        $this->form_validation->set_rules('item_price', 'Item Name', 'required|numeric');
        $this->form_validation->set_rules('item_category', 'Item Category', 'required');
        

        if ($this->form_validation->run() == FALSE)
        {
            echo "<script type='text/javascript'>".
                "alert('Please fill up required fields.');".
                "</script>";

            $this->view_inventory();


        } else {
            $this->Items_model->edit_item($data);

            echo "<script type='text/javascript'>".
                "alert('Item has been updated.');".
                "</script>";

            $this->view_inventory();
        }
 
        
    }

    public function approved_delivery(){
        $dt_id = $this->uri->segment(3);        

        $this->load->model('Delivery_model');
        
        $pullout = $this->Delivery_model->approve_delivery($dt_id); 
    
        redirect('admin/view_delivery');
    }

    public function reject_delivery(){
        $dt_id = $this->uri->segment(3);
        $this->load->model('Delivery_model');
        $pullout = $this->Delivery_model->reject_delivery($dt_id);

        redirect('admin/view_delivery');
    }

    public function archive_delivery(){
        $dt_id = $this->uri->segment(3);
        $this->load->model('Delivery_model');
        $pullout = $this->Delivery_model->archive_delivery($dt_id);

        redirect('admin/view_approved_delivery');
    }

    public function archive_rejected_delivery(){
        $dt_id = $this->uri->segment(3);
        $this->load->model('Delivery_model');
        $pullout = $this->Delivery_model->archive_rejected_delivery($dt_id);

        redirect('admin/view_rejected_delivery');
    }

    public function view_dt_details(){
        $dt_id = $this->uri->segment(3);
        $data['dt_id'] = $dt_id;

        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_specific_delivery($data['dt_id']); 
        $delivery_transaction = $this->Delivery_model->get_specific_delivery_transaction($data['dt_id']);  
        $data['delivery_transaction'] = $delivery_report;
        $data['delivery_transaction_indiv'] = $delivery_transaction;
        
        $data['sessions'] = $this->session_name();
        
        $this->load->view('admin-header', $data);
        $this->load->view('admin-delivery-item-view',$data);
        $this->load->view('footer');
    }

    public function view_item_category_list(){
        $this->load->model('Items_model');

        $data['category_list'] = $this->Items_model->get_item_category();

        $data['sessions'] = $this->session_name();
        
        $this->load->view('header', $data);
        $this->load->view('report-item-category',$data);
        $this->load->view('footer');
    }

    function alpha_dash_space($str){
        return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    } 

    public function add_item_category(){
        $category_name = $this->input->post('item_category');

        $this->load->model('Items_model');
        $this->form_validation->set_rules('item_category', 'Item Category', 'alpha');
        $this->form_validation->set_rules('item_category', 'Item Category', 'required|is_unique[pos_category.category_name]');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->view_item_category_list();
        }
        else
        {
            $this->Items_model->add_item_category($category_name);
            redirect('admin/report-item-category');
        }
    }

    public function activate_category(){
        $category_id = $this->uri->segment(3);

        $this->load->model('Items_model');
        $this->Items_model->activate_category($category_id);

        redirect('admin/report-item-category');
    }

    public function deactivate_category(){
        $category_id = $this->uri->segment(3);

        $this->load->model('Items_model');
        $this->Items_model->deactivate_category($category_id);

        redirect('admin/report-item-category');
    }

    public function delete_category(){
        $category_id = $this->uri->segment(3);
        $this->load->model('Items_model');
        $this->Items_model->delete_category($category_id);

        redirect('admin/report-item-category');
    }

    public function void_sales(){
        $sales_id = $this->uri->segment(3);

        $this->load->model('Sales_model');
        $pullout = $this->Sales_model->void_sales($sales_id);

        redirect('admin/report-sales');
    }

    public function remove_item(){
        $sales_id = $this->uri->segment(3);

        $this->load->model('Items_model');
        $this->Items_model->remove_item($sales_id);

        redirect('admin/report-inventory');
    }

    public function remove_delivery_item(){
        if(isset($_POST['item'])) {
            $item = $_POST['item'];
            $delivery = $_POST['del'];
            $quantity = $_POST['qty'];
            $dt = $_POST['transaction'];
            $dtotal = $_POST['total'];

            $this->load->model('Delivery_model');

            if($dtotal==0){
                $this->Delivery_model->reject_delivery($dt); 
            }
            else{
                $this->Delivery_model->remove_delivery_item($delivery); 
                $this->Delivery_model->update_total_qty($dt, $dtotal);
            }
        }
        else{
            ?><script type="text/javascript">alert("fail");</script><?php
        }
    }

    public function edit_delivery_item(){
        if(isset($_POST['del'])) {
            $delivery = $_POST['del'];
            $quantity = $_POST['qty'];
            $dtotal = $_POST['total'];
            $dt = $_POST['transaction'];

            $this->load->model('Delivery_model');
            $this->Delivery_model->edit_delivery_qty($delivery,$quantity);
            $this->Delivery_model->update_total_qty($dt,$dtotal);
        }
        else{
        
        }
    }

    public function print_barcode($id){
        $packet['item'] = $id;
        $packet['supp'] = $this->get_supplier_code($id);
        $packet['price'] = $this->get_item_price($id);
        
        $data['sessions'] = $this->session_name();

        $this->load->view('admin-header',$data);
        $this->load->view('admin-item-barcode', $packet);
        $this->load->view('footer');
    }

    public function get_item_price($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_price($item_code);
        
        return $result->item_price;        
    }

    public function get_supplier_code($item_code){  
        $this->load->model('Items_model');
        $result = $this->Items_model->get_supplier_code($item_code);
        return $result->letter_code; 
    }

}
?>