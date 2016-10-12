<?php 
class Delivery extends CI_Controller{
	
	public function index(){
		$this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_delivery_report();  
        $packet['delivery_transaction'] = $delivery_report;
        
        $this->load->view('header');
        $this->load->view('report-delivery', $packet);
        $this->load->view('footer');
	}

    /*public function input_delivery_item(){
        $item_code = $this->input->post('item_code');
        $item_quantity = $this->input->post('item_quantity');
        $item_supplier = $this->get_item_supplier($item_code);

        $data = array (
            'del_item_code' => $item_code,
            'del_item_quantity' => $item_quantity,
            'del_supplier' => $item_supplier
        );

        $this->load->model('Delivery_model');
        $this->Delivery_model->add_delivery_transaction($data);  
 
        redirect('report-delivery');
    }*/

    public function add_delivery_transaction(){
        //insert tons of condition here

        $supplier = '201605000000001'; //enter supplier type here 

        $items = $this->input->post('data');
        $quant = $this->input->post('qty');

        $this->load->model('Delivery_model');
        $last_id = $this->Delivery_model->add_delivery_transaction($supplier, $quant); 

        foreach( $data as $row ) {
            $this->db->insert('pos_delivery', $data[$ctr]);
            $ctr++;
        }

        $data=array();  

        foreach($items as $key => $csm)
        {
            $data[$key]['delivery_id'] = '';
            $data[$key]['delivery_item'] = $items[$key]['ItemName'];
            $data[$key]['delivery_quantity'] = $items[$key]['ItemQuantity'];
            $data[$key]['delivery_dt'] = $last_id;
        }

        /*$this->Delivery_model->add_delivery_transaction($data);  */
        $this->Delivery_model->add_delivery_items($data);
        redirect('report-delivery');
    }

    public function add_delivery_items(){
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
        
        $this->load->view('header');
        $this->load->view('delivery-additem-view', $packet);
        $this->load->view('footer');
    }

    public function view_dt_details(){
        $dt_id = $this->uri->segment(3);
        $data['dt_id'] = $dt_id;

        $this->load->model('Delivery_model');
        
        $delivery_report = $this->Delivery_model->get_specific_delivery($data['dt_id']);  
        $data['delivery_transaction'] = $delivery_report;
        
        $this->load->view('header');
        $this->load->view('delivery-item-view',$data);
        $this->load->view('footer');
    }

    function deliver_more_data() {
        if (isset($_POST['type'])) {
          $this->load->model('nodes_m');
          $data['ajax_req'] = TRUE;
          $data['node_list'] = $this->nodes_m->get_node_by_code($_POST['type']);

          $this->load->view('ajax_items',$data);
        }
    }
}
?>