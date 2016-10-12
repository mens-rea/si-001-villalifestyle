<?php 

class Tenant extends CI_Controller{
     public function __construct() {
        parent::__construct();
        $user_type =  $this->session_type();

        if($user_type!=2){
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

    public function session_code(){
        return $this->session->userdata('code'); 
    }

     public function view_sales_report() {
        $supplier_id = $this->session_name();       
        
        $this->load->model('Sales_model');
                
        $sale_report = $this->Sales_model->get_supplier_sales($supplier_id);  
        $packet['sales'] = $sale_report;   
        $packet['qty_sold'] = $sale_report->num_rows();
        $data['category_list'] = $this->get_item_category();

        $data['sessions'] = $this->session_name();
    
        $this->load->view('tenant-header', $data);
        $this->load->view('tenant-report-sales', $packet);
        $this->load->view('footer');
    }

    public function filter_sales_month(){
            $supplier_id = $this->session_name();
            $this->load->model('Sales_model');       

            $date_start = $this->input->post('filter_start_date');
            $date_end = $this->input->post('filter_end_date');

            $sale_report = $this->Sales_model->get_sales_supplier_certmonth($date_start,$date_end,$supplier_id);         
            $packet['sales'] = $sale_report;
            $packet['fro'] = $date_start;
            $packet['to'] = $date_end;
            $packet['qty_sold'] = $sale_report->num_rows();

            $data['category_list'] = $this->get_item_category();
            $data['sessions'] = $this->session_name();
            
            $this->load->view('tenant-header', $data);
            $this->load->view('tenant-report-sales-f-month', $packet);
            $this->load->view('footer');
    }
    
    public function get_supplier_id(){  // add action to get the supplier id of the user
        $supplier_id='201605000000001'; //static supplier id
        return $supplier_id; 
    }

    public function add_items()
    {
        $supplier_id = $this->session->userdata('name');

        $data = array (
        'item_name' => $this->input->post('item_name'),
        'item_price' => $this->input->post('item_price'),
        'item_category' => $this->input->post('item_category'),
        'item_supplier' => $supplier_id
        );

        $this->load->model('Items_model');
        $item_id = $this->Items_model->add_items($data);  
 
        redirect('tenant/report-inventory');
    }

    public function edit_item(){

        $data = array (
        'item_id' => $this->input->post('item_code'),
        'item_name' => $this->input->post('item_name'),
        'item_price' => $this->input->post('item_price'),
        'item_category' => $this->input->post('item_category'),
        
        );

        $this->load->model('Items_model');
        $this->Items_model->edit_item($data);  
 
        redirect('tenant/report-inventory');
    }

    public function view_inventory(){
        $this->load->model('Items_model');
        $packet['supp'] = $this->session->userdata('code');
        $supplier_id = $this->session->userdata('name');
        
        $item_list = $this->Items_model->get_supplier_inventory($supplier_id);  
        $packet['item'] = $item_list;
        $data['category_list'] = $this->get_item_category();

        $data['sessions'] = $this->session_name();

        $this->load->view('tenant-header', $data);
        $this->load->view('tenant-report-item', $packet);
        $this->load->view('footer');
    }

    public function print_barcode($id){
        $packet['item'] = $id;
        $packet['supp'] = $this->session->userdata('code');
        $packet['price'] = $this->get_item_price($id);
        
        $data['sessions'] = $this->session_name();
        $data['category_list'] = $this->get_item_category();

        $this->load->view('tenant-header', $data);
        $this->load->view('item-barcode', $packet);
        $this->load->view('footer');
    }

    public function add_delivery(){
        /*$item_code = $this->input->post('item_code');
        $item_quantity = $this->input->post('item_quantity');
        $dt_id = $this->uri->segment(3);*/
        /*$data = array (
            'del_item_code' => $item_code,
            'del_item_quantity' => $item_quantity,
            'dt_id' => $dt_id          
        );
        $this->load->model('Delivery_model');
        $this->Delivery_model->add_delivery_items($data);  
        redirect('delivery-item-view');*/

        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;
        
        $data['sessions'] = $this->session_name();
        $data['category_list'] = $this->get_item_category();

        $this->load->view('tenant-header', $data);
        $this->load->view('delivery-additem-view', $packet);
        $this->load->view('footer');
    }

    public function add_delivery_transaction(){
        //insert tons of condition here

        $supplier = $this->session_name(); 

        $items = $this->input->post('data');
         $quant = $this->input->post('qty');

        $this->load->model('Delivery_model');
        $last_id = $this->Delivery_model->add_delivery_transaction($supplier, $quant); 

        $data=array();  

        foreach($items as $key => $csm)
        {
            $data[$key]['delivery_id'] = '';
            $data[$key]['delivery_item'] = $items[$key]['ItemName'];
            $data[$key]['delivery_quantity'] = $items[$key]['ItemQuantity'];
            $data[$key]['delivery_dt'] = $last_id;
        }

        //$this->Delivery_model->add_delivery_transaction($data);  
        $this->Delivery_model->add_delivery_items($data);
        redirect('report-delivery');
    }

    public function item_validation() {
        $item_code = '201602000000005'; 

        $this->load->model('Items_model');
        $result = $this->Items_model->item_validation($item_code);

        if($result) {
            echo "i have";
        } else {
            echo "item not existing in the inventory";
        }
    }

    public function view_delivery(){
        $supplier_id = $this->session_name();

        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report_supplier($supplier_id);  
        $packet['delivery_transaction'] = $delivery_report;
        
        $data['sessions'] = $this->session_name();
        $data['category_list'] = $this->get_item_category();

        $this->load->view('tenant-header', $data);
        $this->load->view('tenant-report-delivery', $packet);
        $this->load->view('footer');
    }

    public function view_pullout(){        
        $supplier_id = $this->session_name();       

        $this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout_supplier($supplier_id);  
        $packet['pullout'] = $pullout_list;        
        
        $data['sessions'] = $this->session_name();
        $data['category_list'] = $this->get_item_category();

        $this->load->view('tenant-header', $data);
        $this->load->view('tenant-report-pullout', $packet);
        $this->load->view('footer');
    }

    public function get_item_supplier($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_supplier($item_code);
        
        return $result->item_supplier;        
    }

    public function get_item_price($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_price($item_code);
        
        return $result->item_price;        
    }


    /*public function get_item_supplier($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_supplier($item_code);
        
        return $result->item_supplier;        
    }*/


    public function view_dt_details(){
        $dt_id = $this->uri->segment(3);
        $data['dt_id'] = $dt_id;

        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_specific_delivery($data['dt_id']); 
        $delivery_transaction = $this->Delivery_model->get_specific_delivery_transaction($data['dt_id']);  
        $data['delivery_transaction'] = $delivery_report;
        $data['delivery_transaction_indiv'] = $delivery_transaction;
        
        $data['sessions'] = $this->session_name();
        $data['category_list'] = $this->get_item_category();

        $this->load->view('tenant-header', $data);
        $this->load->view('tenant-delivery-item-view',$data);
        $this->load->view('footer');
    }

    public function get_item_category(){
        $this->load->model('Items_model');
        //$data['category_list'] = $this->Items_model->get_item_category();

        $list = $this->Items_model->get_item_category();

        return $list;
        /*foreach ($list ->result_array() as $row) {
            echo $row['category_id'];
            echo $row['category_name'];
        }*/
    }

    public function input_pullout_item(){
        $item_code = $this->input->post('item_code');
        $item_quantity = $this->input->post('item_quantity');
                    
            $item_supplier = $this->session_name();

            $data = array (
                'pullout_item_code' => $item_code,
                'pullout_item_quantity' => $item_quantity,
                'pullout_supplier' => $item_supplier
            );

            $this->load->model('Pullout_model');
            $sales_id = $this->Pullout_model->add_pullout_item($data);  
     
            redirect('tenant/report-pullout');
    }

    function deliver_more_data() {
        $tenant_code = $this->session_code();

        if (isset($_POST['type'])) {
          $this->load->model('nodes_m');
          $data['node_exists'] = $this->nodes_m->get_node_exists_tenant($_POST['type'],$tenant_code);
          
            if($data['node_exists']){
                $data['ajax_req'] = TRUE;
                $data['node_list'] = $this->nodes_m->get_node_by_spec_code($_POST['type']);

                $this->load->view('ajax_add_del_items',$data);
            }
            else{
                $data['ajax_req'] = TRUE;
                $data['node_list'] = $this->nodes_m->get_node_by_spec_code($_POST['type']);
            }
        }
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
                $this->Delivery_model->remove_delivery_transaction($dt); 
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

            /*if($final_qty==0){
                $this->Delivery_model->reject_delivery($dt); 
            }
            else{
                $this->Delivery_model->remove_delivery_item($delivery, $dt, $final_qty); 
            }

            ?><script type="text/javascript">alert("boom<?php echo $item; ?>, <?php echo $delivery; ?> ,<?php echo $quantity; ?> ,<?php echo $dt; ?>, <?php echo $dtotal; ?>");</script><?php*/
        }
        else{
        
        }
    }
}
?>