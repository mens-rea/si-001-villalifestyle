<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    function __construct(){
    
        parent::__construct();
        $this->is_logged_in();
    
    }
    
    function is_logged_in(){
        
        $is_logged_in = $this->session->userdata('is_logged_in');
        
        if(!isset($is_logged_in) || $is_logged_in != true){
            echo 'You don\'t have permission to access this page.';
            die();
        }
   
    }
    public function FAQ()
    {
        $this->load->view('FAQ');
    }

    public function item_store()
    {
        $this->load->view('item_store');
    }

    public function add_item()
    {
        $this->load->view('additem');
    }

    public function individual_item()
    {
        $this->load->view('individual-item');
    }
    public function all_stores()
    {
        $this->load->view('all-stores');
    }
}
?>   
<!-- /* Location: ./application/controllers/Main.php */
/* End of file Main.php */ -->
