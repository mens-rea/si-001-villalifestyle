<?php 

class Login extends CI_Controller{
	
	public function index(){

        $account=3; //place account type here
        /*
            1 - admin
            2 - tenants
            3 -cashier
        */
		if($account==1) {
            redirect('admin');
        } elseif($account==2) {
            redirect('tenant');
        } elseif ($account==3) {
            redirect('cashier');
        }
    
	}
}
?>