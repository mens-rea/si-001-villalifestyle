<?php 

class Signup extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->library(array('session', 'lib_login'));
        /*$this->load->model('product_model');
        $this->load->model('upload_model');*/
    }
	
	function index(){
/*
		$this->load->model('Income_model');
		$this->load->model('Expense_model');
		$this->load->model('Withdrawal_model');
		
    	$income = $this->Income_model->get_income_month();  
    	$expense = $this->Expense_model->get_expense_month();
    	$withdrawal = $this->Withdrawal_model->get_withdrawal_month();
    	$packet['income'] = $income;
    	$packet['expense'] = $expense;
    	$packet['withdrawal'] = $withdrawal;*/
		
		$this->load->view('cashier-header');
		$this->load->view('home');
		$this->load->view('footer');

	}
	
	
}
?>