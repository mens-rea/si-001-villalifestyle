<?php 

class Pullout extends CI_Controller{
	
	public function index(){

		$this->load->model('Pullout_model');
        
        $pullout_list = $this->Pullout_model->get_pullout();  
        $packet['pullout'] = $pullout_list;
        //$packet['supplier_name'] = $this->get_supplier_name($pullout_list);
        
        $this->load->view('header');
        $this->load->view('report-pullout', $packet);
        $this->load->view('footer');
	}

    public function input_pullout_item(){
        $item_code = $this->input->post('item_code');
        $item_quantity = $this->input->post('item_quantity');
        $item_supplier = $this->get_item_supplier($item_code);

        $data = array (
            'pullout_item_code' => $item_code,
            'pullout_item_quantity' => $item_quantity,
            'pullout_supplier' => $item_supplier
        );

        $this->load->model('Pullout_model');
        $sales_id = $this->Pullout_model->add_pullout_item($data);  
 
        redirect('report-pullout');

    }

    
    public function get_item_supplier($item_code) {
        $this->load->model('Items_model');
        $result = $this->Items_model->get_item_supplier($item_code);
        
        return $result->item_supplier;        
    }




}
?>