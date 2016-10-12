<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * @property Login_control $Login_control
 * @property Aauth $aauth Description
 * @version 1.0
 */

class Authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->library("Aauth");
    }

     public function index() {  
        $sess_id = $this->session->userdata('type');
        
        if(empty($sess_id)) {
            $this->landing_page();
        } elseif($sess_id == 1) {
            redirect('admin');
        } elseif($sess_id == 2) {
            redirect('tenant');
        } elseif($sess_id == 3) {
            redirect('cashier');
        } else{
            $this->landing_page();
        }

       

    }

    public function landing_page(){
        $this->load->view('header-landing');
        $this->load->view('login-view');
        $this->load->view('footer');
    }

    public function user_login(){
        $user_name = $this->input->post('user_name');
        $user_password = $this->input->post('user_password');        

	   $this->aauth->login($user_name, $user_password);


        if($this->aauth->is_loggedin($user_name, $user_password)){

            $user_id = $this->aauth->get_user_id();
            $group_id = $this->get_user_groups($user_id);

            $user_code = $this->get_user_code($user_id);

            $this->session->set_userdata('code', $user_code); 
            $this->session->set_userdata('type', $group_id); 

            if($group_id == 1) {            	
                redirect('admin');
            } elseif($group_id == 2) {
                redirect('tenant');
            } elseif($group_id == 3) {
                redirect('cashier');
            } else {
                
                $this->landing_page();
            }

        } else {
            
            $this->landing_page();
        }       
    }

    public function get_user_code($user_id){
        $this->load->model('Account_model');
        $result = $this->Account_model->get_user_code($user_id);

        return $result->letter_code;
    }


    public function session_name(){        
        return $this->session->userdata('name');   
    }

    public function create_account(){
    	$data['sessions'] = $this->session_name();

        $this->load->view('header',$data);
        $this->load->view('create-account');
        $this->load->view('footer');
    }

    public function view_user_list(){
        $user_list = $this->aauth->list_users(FALSE, FALSE, FALSE, TRUE);
        $group_list = $this->aauth->list_groups();

        $packet['users'] = $user_list;
        $packet['groups'] = $group_list;

        $data['sessions'] = $this->session_name();

        $this->load->view('header',$data);
        $this->load->view('report-users', $packet);
        $this->load->view('footer');
    }

    public function user_restriction(){
        $packet['heading'] = '404 Restricted User Access';
        $packet['message'] = '<p>Sorry, you are restricted to access this link.</p>';

        $this->load->view('restricted-access', $packet);
    }


    public function edit_user_info() {
        $packet['users'] = $this->aauth->get_user();

        $data['sessions'] = $this->session->userdata('name'); 
        $data['category_list'] = $this->get_item_category();

        if($this->session->userdata('type')==2){
            $this->load->view('tenant-header', $data);
            $this->load->view('tenant-edit-account', $packet); 
        } elseif($this->session->userdata('type')==3){
            $this->load->view('cashier-header', $data);
            $this->load->view('cashier-edit-account', $packet);
        }

        $this->load->view('footer');
    }

    public function get_item_category(){
        $this->load->model('Items_model');
        $list = $this->Items_model->get_item_category();
        return $list;
    }



    function debug(){

        echo "<pre>";

        print_r(
        //$this->aauth->is_admin()
        //$this->aauth->get_user()
        //$this->aauth->control_group("Mod")
        //$this->aauth->control_perm(1)
        //$this->aauth->list_groups()
        //$this->aauth->list_users()
        //$this->aauth->is_allowed(1)
        //$this->aauth->is_admin()
        //$this->aauth->create_perm("deneme",'defff')
        //$this->aauth->update_perm(3,'dess','asd')
        //$this->aauth->allow(1,1)
        //$this->aauth->add_member(1,1)
        //$this->aauth->deny(1,1)
        //$this->aauth->mail()
        //$this->aauth->create_user('seass@asds.com','asdasdsdsdasd','asd')
        //$this->aauth->verify_user(11, 'MLUguBbXpd9Eeu5B')
        //$this->aauth->remind_password('seass@asds.com')
        //$this->aauth->reset_password(11,'0ghUM3oIC95p7uMa')
        //$this->aauth->is_allowed(1)
        //$this->aauth->control(1)
        //$this->aauth->send_pm(1,2,'asd')
        //$this->session->flashdata('d')
        //$this->aauth->add_member(1,1)
        //$this->aauth->create_user('asd@asd.co','d')
        //$this->aauth->send_pm(1,2,'asd','sad')
        //$this->aauth->list_pms(1,0,3,1)
        //$this->aauth->get_pm(6, false)
        //$this->aauth->delete_pm(6)
        //$this->aauth->set_as_read_pm(13)
        //$this->aauth->create_group('aa')
         $this->aauth->create_perm('asdda')
         //''

        );

        echo '<br>---- error --- <br>';
        echo $this->aauth->get_errors();

        echo '<br>---- info --- <br>';
        echo $this->aauth->get_infos();

        echo "</pre>";
    }

    function flash(){
        $d['a'] = 'asd';
        $d['3'] = 'asdasd';

        $this->session->set_flashdata('d', $d);

        $d['4'] = 'tttt';

        $this->session->set_flashdata('d', $d);
    }


    function settings() {
        
        //echo $this->aauth->_get_login_attempts(4);
        //echo $this->aauth->get_user_id('emre@emreakay.com');
        //$this->aauth->_increase_login_attempts('emre@emreakay.com');
        //$this->aauth->_reset_login_attempts(1);
    }

    public function login_fast(){
        $this->aauth->login_fast(1);
    }
    
    public function is_loggedin() {
        $this->aauth->is_loggedin();        
    }

    public function logout() {

        $this->aauth->logout();
        $this->landing_page();
    }

    public function is_member() {

        if ($this->aauth->is_member('deneme',9))
            echo 'uye';
    }

    public function is_admin() {

        if ($this->aauth->is_member('Admin'))
            echo 'adminovic';
    }

    function get_user_groups($x){        
        foreach($this->aauth->get_user_groups($x) as $a){

            return $a->id;
        }
    }

    public function get_group_name($x) {

        echo $this->aauth->get_group_name($x);
    }

    public function get_group_id() {

        echo $this->aauth->get_group_id("Admin");
    }

    public function list_users() {
        echo '<pre>';
        print_r($this->aauth->list_users());
        echo '</pre>';
    }

    public function list_groups() {
        echo '<pre>';
        print_r($this->aauth->list_groups());
        echo '</pre>';
    }

    public function check_email() {

        if ($this->aauth->check_email("aa@a.com"))
            echo 'uygun ';
        else
            echo 'alindi ';

        $this->aauth->print_errors();
    }

    public function get_user() {
        print_r($this->aauth->get_user());
    }

    function create_user() {

        $user_name = $this->input->post('new_user');
        $user_password = $this->input->post('new_password'); 
        $user_email = $this->input->post('new_email');
        $user_code = $this->input->post('letter_code'); 
        $user_type = $this->input->post('new_account_type'); 

        
        $this->aauth->create_user($user_email, $user_password, $user_name, $user_code);
        
        if($this->aauth->get_errors_array()){
            $this->create_account();
        } else {
            $user_id = $this->aauth->get_user_id($user_email);
            $this->aauth->add_member($user_id, $user_type);
            $this->view_user_list();
        }
    }

    public function is_banned() {
        print_r($this->aauth->is_banned(6));
    }

    public function ban_user() {
        $user_id = $this->uri->segment(3);

        $this->aauth->ban_user($user_id);

        redirect('admin/report-user');
        /*$a = $this->aauth->ban_user(6);

        print_r($a);*/
    }

    public function unban_user() {
        $user_id = $this->uri->segment(3);

        $this->aauth->unban_user($user_id);

        redirect('admin/report-user');

        /*$a = $this->aauth->unban_user(6);

        print_r($a);*/
    }

    function delete_user() {

        $a = $this->aauth->delete_user(7);

        print_r($a);
    }

    

    public function update_user() {
        $user_id = $this->input->post('user_id');
        $user_name = $this->input->post('user_name');
        $user_password = $this->input->post('user_password');
        $user_email = $this->input->post('user_email');

        if($user_password!=null|| $user_password!=''){
            $this->aauth->update_user($user_id, $user_email, $user_password, $user_name);
        } else {
            $this->aauth->update_user($user_id, $user_email, false, $user_name);
        }

        if($this->session->userdata('type')==2){
            redirect('tenant');
        } elseif($this->session->userdata('type')==3){
            redirect('cashier');
        }
        else{
            redirect('admin/report-user');
        }
        
    }

    function update_activity() {
        $a = $this->aauth->update_activity();

        print_r($a);
    }

    function update_login_attempt() {
        $a = $this->aauth->update_login_attempts("a@a.com");

        print_r($a);
    }

    function create_group() {

        $a = $this->aauth->create_group("deneme");
    }

    function delete_group() {

        $a = $this->aauth->delete_group("deneme");
    }

    function update_group() {

        $a = $this->aauth->update_group("deneme", "zxxx");
    }

    function add_member() {

        $a = $this->aauth->add_member(8, "deneme");
    }

    function fire_member() {

        $a = $this->aauth->fire_member(3, "remove");
    }


    function create_perm() {

        $a = $this->aauth->create_perm("deneme","def");
    }


    function update_perm() {

        $a = $this->aauth->update_perm("deneme","deneme","xxx");
    }

    function delete_perm() {

        $a = $this->aauth->update_perm("deneme","deneme","xxx");
    }

    function allow_user() {

        $a = $this->aauth->allow_user(9,"deneme");
    }


    function deny_user() {

        $a = $this->aauth->deny_user(9,"deneme");
    }

    function allow_group() {

        $a = $this->aauth->allow_group("deneme","deneme");
    }

    function deny_group() {

        $a = $this->aauth->deny_group("deneme","deneme");
    }

    function list_perms() {

        $a = $this->aauth->list_perms();
        print_r($a);
    }

    function get_perm_id() {

        $a = $this->aauth->get_perm_id("deneme");
        print_r($a);
    }


    function send_pm() {

        $a = $this->aauth->send_pm(1,8,'s',"w");
        $this->aauth->print_errors();
    }

    function list_pms(){

        print_r( $this->aauth->list_pms() );
    }

    function get_pm(){

        print_r( $this->aauth->get_pm(39,false));
    }

    function delete_pm(){

        $this->aauth->delete_pm(41);
    }


    function count_unread_pms(){

        echo $this->aauth->count_unread_pms(8);
    }

    function error(){

        $this->aauth->error("asd");
        $this->aauth->error("xasd");
        $this->aauth->keep_errors();
        $this->aauth->print_errors();

    }

    function keep_errors(){

        $this->aauth->print_errors();
        //$this->aauth->keep_errors();
    }

    function set_user_var(){
        $this->aauth->set_user_var("emre","akasy");
    }

    function unset_user_var(){
        $this->aauth->unset_user_var("emre");
    }

    function get_user_var(){
        echo $this->aauth->get_user_var("emre");
    }

    function set_system_var(){
        $this->aauth->set_system_var("emre","akay");
    }

    function unset_system_var(){
        $this->aauth->unset_system_var("emre");
    }

    function get_system_var(){
        echo $this->aauth->get_system_var("emre");
    }

}//end

/* End of file welcome.php */
