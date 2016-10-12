<?php 

class Cashier extends CI_Controller{
    public function __construct() {
        parent::__construct();

        $user_type =  $this->session_type();

        if($user_type!=3){
            redirect('restricted');            
        }        
    }
    
    public function index(){
       $this->view_sales_report();
    }

    public function session_type(){        
        return $this->session->userdata('type');    
    }

    public function session_name(){
        return $this->session->userdata('name'); 
    }

    public function view_sales_report() {
        $account=2; //place account type here

        $this->load->model('Sales_model');
                
        $sale_report = $this->Sales_model->get_daily_sales();  
        $packet['sales'] = $sale_report;        
        $packet['qty_sold'] = $sale_report->num_rows();

        $data['sessions'] = $this->session_name();
    
        $this->load->view('cashier-header',$data);
        $this->load->view('cashier-report-sales', $packet);
        $this->load->view('footer');    
    }

    public function view_sales_report_all(){
        $this->load->model('Sales_model');

        $sale_report = $this->Sales_model->get_all_sales();  
        $packet['sales'] = $sale_report;        
        $packet['qty_sold'] = $sale_report->num_rows();

        $data['sessions'] = $this->session_name();
    
        $this->load->view('cashier-header',$data);
        $this->load->view('cashier-report-all-sales', $packet);
        $this->load->view('footer'); 
    }

    public function suggest_more_cashier_sales_data(){
        if (isset($_POST['type'])) {
          $this->load->model('Sales_model');
          $data['ajax_req'] = TRUE;
          $sale_report = $this->Sales_model->get_sales_by_tenant_daily($_POST['type']);
          $data['sales'] = $sale_report;
          $data['qty_sold'] = $sale_report->num_rows();
          $this->load->view('cashier-report-sales-ajax',$data);
        }
    }

    public function suggest_more_cashier_all_sales_data(){
        if (isset($_POST['type'])) {
          $this->load->model('Sales_model');
          $data['ajax_req'] = TRUE;
          $sale_report = $this->Sales_model->get_sales_by_tenant($_POST['type']);
          $data['sales'] = $sale_report;
          $data['qty_sold'] = $sale_report->num_rows();

          $this->load->view('cashier-report-all-sales-ajax',$data);
        }
    }


    public function add_sales(){
        $this->load->model('Sales_model');
        
        $sales_report = $this->Sales_model->get_sales();  
        $packet['sales_transaction'] = $sales_report;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('cashier-header', $data);
        $this->load->view('sales-add-view', $packet);
        $this->load->view('footer');
    }

    public function add_sales_transaction(){
        date_default_timezone_set('Asia/Manila');
        $current_date = date('Y-m-d H:i:s');

        $items = $this->input->post('data');
        $quant = $this->input->post('qty');

        $data=array();  

        $this->load->model('Items_model');

        foreach($items as $key => $csm)
        {
            $icode = $items[$key]['ItemName'];
            $iqty = $items[$key]['ItemQuantity'];
            $idisc = $items[$key]['ItemDiscount'];
            
            $result = $this->Items_model->get_item_price($icode);
            $supplier = $this->Items_model->get_item_supplier($icode);
            $assprice = $result->item_price;

            $actuald = $idisc;

            $totalprice = $assprice - $actuald; 

            $data[$key]['sales_id'] = '';
            $data[$key]['sales_item'] = $icode;
            $data[$key]['sales_quantity'] = $iqty;
            $data[$key]['sales_total'] = $totalprice;
            $data[$key]['sales_discount'] = $idisc;
            $data[$key]['sales_date'] = $current_date;
            $data[$key]['sales_supplier'] = $supplier->item_supplier;
            $data[$key]['sales_st'] = '0';


            $this->Items_model->update_item_sale($icode);
        }

        $this->load->model('Sales_model');
        $this->Sales_model->add_sales_items($data);
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

    public function deduct_inv_stock($item_code, $item_quantity){
        $current_stock = $this->get_item_stock($item_code);

        if($current_stock != 0) {
            $stock = $current_stock - $item_quantity;
        } else {
            echo "no more stock available";
        }

       return $stock;
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
            
            $this->load->view('cashier-header', $data);
            $this->load->view('cashier-report-sales-f-month', $packet);
            $this->load->view('footer');
    }

    public function filter_pending_delivery_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Delivery_model');
          $data['ajax_req'] = TRUE;
          $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($_POST['type']);

          $this->load->view('cashier-report-delivery-pending-ajax',$data);
        }
    }

    public function filter_approved_delivery_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Delivery_model');
          $data['ajax_req'] = TRUE;
          $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($_POST['type']);

          $this->load->view('admin-report-delivery-approve-ajax',$data);
        }
    }

    public function filter_rejected_delivery_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Delivery_model');
          $data['ajax_req'] = TRUE;
          $data['delivery_transaction'] = $this->Delivery_model->filter_delivery_transaction($_POST['type']);

          $this->load->view('cashier-report-delivery-reject-ajax',$data);
        }
    }

    public function filter_pending_pullout_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Pullout_model');
          $data['ajax_req'] = TRUE;
          $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($_POST['type']);

          $this->load->view('cashier-report-pullout-pending-ajax',$data);
        }
    }

    public function filter_approved_pullout_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Pullout_model');
          $data['ajax_req'] = TRUE;
          $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($_POST['type']);

          $this->load->view('cashier-report-pullout-approve-ajax',$data);
        }
    }

    public function filter_rejected_pullout_transaction(){
        if (isset($_POST['type'])) {
          $this->load->model('Pullout_model');
          $data['ajax_req'] = TRUE;
          $data['pullout'] = $this->Pullout_model->filter_pullout_transaction($_POST['type']);

          $this->load->view('cashier-report-pullout-reject-ajax',$data);
        }
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

    function sales_more_data() {
        $item_code = $_POST['type'];

        if (isset($item_code)) {
          $this->load->model('nodes_m');

            if (is_numeric($item_code))
            {
                $data['node_exists'] = $this->nodes_m->get_node_exists($item_code);
            } else {
                $letter_code = substr($item_code, 0,3); //letter code
                $item_id = substr($item_code, 3); //item_id
                $data['node_exists'] = $this->nodes_m->get_node2_exists($item_id, $letter_code);
            }

          
            if($data['node_exists']){
                $data['ajax_req'] = TRUE;
                $data['node_list'] = $this->nodes_m->get_node_by_spec_code($data['node_exists']->item_id);

                //echo "<pre>";
                //print_r($data['node_list']);
                $this->load->view('ajax_add_sales_items',$data);
            }
            else{
                $data['ajax_req'] = TRUE;
                $data['node_list'] = $this->nodes_m->get_node_by_spec_code($item_code);
            }
            
        }
    }

    public function view_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('cashier-header',$data);
        $this->load->view('cashier-report-delivery', $packet);
        $this->load->view('footer');
    }

    public function view_approved_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('cashier-header',$data);
        $this->load->view('cashier-report-delivery-approve', $packet);
        $this->load->view('footer');
    }

    public function view_rejected_delivery(){
        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;

        $data['sessions'] = $this->session_name();
        
        $this->load->view('cashier-header',$data);
        $this->load->view('cashier-report-delivery-reject', $packet);
        $this->load->view('footer');
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
        
        $this->load->view('cashier-header', $data); 
        $this->load->view('delivery-item-view',$data);
        $this->load->view('footer');
    }

    public function view_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        //$packet['supplier_name'] = $this->get_supplier_name($pullout_list);
        
        $data['sessions'] = $this->session_name();

        $this->load->view('cashier-header', $data);
        $this->load->view('cashier-report-pullout', $packet);
        $this->load->view('footer');
    }

    public function view_approved_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('cashier-header', $data);
        $this->load->view('cashier-report-pullout-approve', $packet);
        $this->load->view('footer');
    }

    public function view_rejected_pullout(){
        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        
        $data['sessions'] = $this->session_name();

        $this->load->view('cashier-header', $data);
        $this->load->view('cashier-report-pullout-reject', $packet);
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
        

        redirect('cashier/report-pullout');

    }

    public function reject_pullout(){
        $pullout_id = $this->uri->segment(3);
        $this->load->model('Pullout_model');
        $pullout = $this->Pullout_model->reject_pullout($pullout_id);

        redirect('cashier/view_pullout');
    }

    public function get_pullout_item($pullout_id){
        $this->load->model('Pullout_model');
        $query = $this->Pullout_model->get_pullout_item($pullout_id);

        return $query;
    }

     public function approved_delivery(){
        $dt_id = $this->uri->segment(3);        

        $this->load->model('Delivery_model');
        
        $pullout = $this->Delivery_model->approve_delivery($dt_id); 
        
        /*$new_stock = $this->deduct_inv_stock($item_code,$item_quantity);
        $this->update_stock($item_code, $new_stock); */
        

        redirect('cashier/report-delivery');

    }

    public function reject_delivery(){
        $dt_id = $this->uri->segment(3);
        $this->load->model('Delivery_model');
        $pullout = $this->Delivery_model->reject_delivery($dt_id);

        redirect('cashier/report-delivery');
    }

    public function void_sales(){
        $sales_id = $this->uri->segment(3);

        $this->load->model('Sales_model');
        $pullout = $this->Sales_model->void_sales($sales_id);

        redirect('cashier/report-sales');
    }
}
?>