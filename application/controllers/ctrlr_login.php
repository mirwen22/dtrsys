<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlr_login extends CI_Controller {

	public function __construct()
	{
		
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('Model_login');	
	    

	  $ua_id = $this->session->userdata('sess_userlevel_ID');
	            
	  if($ua_id) 
	  {
            redirect('Main_Page','location');
      }
	}


	public function login()
	{

	    $this->load->view('login/view_loginpage.php');
	}


	public function loginMember($pw)
    {
            $un = $this->input->post('username');  
            if(empty($pw) || empty($un)) redirect('');
                $res = $this->Model_login->login($un,$pw);

                 if($res)
                 {     

                           $this->session->set_userdata(['sess_user_id' => $res[0]['ua_id'],
                                           'sess_fullname' => ucwords($res[0]['ua_fullname']),
                                           'sess_username' => ucwords($res[0]['ua_username']),
                                           'sess_usertypeid' => ucwords($res[0]['ut_id']),
                                           'sess_userTypeDesc' => $res[0]['ut_desc']]);




                           return true;                    
                 }
                $this->form_validation->set_message('loginMember', 'Invalid username or password');    
                 return false; 
           
    }

	public function index()
	{
		$this->load->helper('security');
		$this->load->library('form_validation');

	    $this->form_validation->set_rules('username','Username','trim|strip_tags|xss_clean|required');
	    $this->form_validation->set_rules('password','Password','trim|strip_tags|xss_clean|required');
	    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable col-md-12"><button class="close" aria-hidden="true" data-dismiss="alert" type="button">&times;</button>', '</div>');

	  	if($this->form_validation->run() === false)
	         {
	              $this->login();
	         }
	         else
	         {
	           $this->form_validation->set_rules('password','Password','callback_loginMember');

	           if($this->form_validation->run() === false)
	            {
	                   	$this->login();
	            }
	            else
	            {
	            	redirect('Main_Page','location');
	           	}
	         }

	}
	
}
