<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlr_main extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main');
        $this->load->helper(array('form', 'url'));



        //$this->CI = & get_instance();
        
        $userid = $this->session->userdata('sess_user_id');

        if(!$userid) 
        {
            $this->logout();
        }
        
    }

    public function logout()
    {
         $this->session->sess_destroy();
            session_destroy();
            redirect('');
    }
    function testQR()
    {
    	$this->load->library('ciqrcode');

    		$qr_image             = rand().'.png';
            $encryptedID          = "sample"; 
            $params['data']       = $encryptedID;
            $params['level']      = 'H';
            $params['size']       = 10;
            $params['savename']   = FCPATH."qr_image/".$qr_image;
            if($this->ciqrcode->generate($params))
            {	 

                echo '<img src="/dtrsys/qr_image/'.$qr_image.'" width="15%">';
            }  
    }
    public function index()
    {

    	$data['name']           = $this->session->userdata('sess_fullname');
        $data['userlevel_desc'] = $this->session->userdata('sess_userTypeDesc');

        $this->load->view('main/template/bootstrap.php',$data);
        $this->load->view('main/template/sidenav.php');
        $this->load->view('main/template/topnav.php');
        $this->load->view('main/adminhomepage.php');
        $this->load->view('main/template/footer.php');
        $this->load->view('main/template/script.php');

    }
    public function restricted()
    {
        $this->load->view('main/view_restricted.php');
    }
    





}