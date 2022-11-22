<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlr_useraccount extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main');
        $this->load->helper(array('form', 'url'));

        
        $userid = $this->session->userdata('sess_user_id');

        $this->myUserID = $userid;
        
        $userType = $this->session->userdata('sess_usertypeid');
        if($userType == 2)
        {
            redirect('Restricted');
        }

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

    public function index()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('txtFullName', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('txtUserName', 'Username', 'trim|required|alpha_numeric|is_unique[useraccount.ua_username]');
        $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|max_length[30]|min_length[10]|regex_match[/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/]');
        $this->form_validation->set_rules('selUSerTYpe', 'Full Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><a class="alert-link" href="#">', '</a>.</div>');
        $this->form_validation->set_message('required', 'You have not provided %s');
        $this->form_validation->set_message('is_unique', 'This %s already exists');
        $this->form_validation->set_message('regex_match', '%s should be at least 10 characters,1 upper case, ang special character.');
        

        if($this->form_validation->run() === false)
        {
            $this->view_useraccount();
        }
        else
        {
            $this->usersSave();
        }

    }

    private function view_useraccount()
    {
        $data['name']           = $this->session->userdata('sess_fullname');
        $data['userlevel_desc'] = $this->session->userdata('sess_userTypeDesc');

        $data['userType']       = array();
        $data['alldata']        = array();

        if($res_userType = $this->Model_main->userType())
        {
            $data['userType']   = $res_userType;
        }

        if($alldata = $this->Model_main->useraccountAlldata())
        {
            $data['alldata']   = $alldata;
        }

        $this->load->view('main/template/bootstrap.php',$data);
        $this->load->view('main/template/sidenav.php');
        $this->load->view('main/template/topnav.php');
        $this->load->view('main/view_useraccount.php');
        $this->load->view('main/template/footer.php');
        $this->load->view('main/template/script.php');
        $this->load->view('main/customScript/useraccount_script.php');
        $this->load->view('main/modals/useraccount_modal.php');
    }

    private function usersSave()
    {

        $this->db->trans_start();

        $error = 0;

        $txtFullName        = $this->input->post('txtFullName');
        $txtUserName        = $this->input->post('txtUserName');
        $txtPassword        = $this->input->post('txtPassword');

        $selUSerTYpe        = trim($this->input->post('selUSerTYpe'));
        $ua_datetimeAdded   = date("Y-m-d H:i");


        $data = array(  "ua_fullname"       =>$txtFullName,
                        "ua_username"       =>$txtUserName,
                        "ua_password"       =>$txtPassword,
                        "ut_id"             =>$selUSerTYpe,
                        "ua_datetimeAdded"  =>$ua_datetimeAdded,
                        );

        if(!$this->Model_main->user_save($data))
        {
            $error = $this->db->error()['message'];
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('User_Account?msg=1');
        }
        else
        {

            $this->db->trans_rollback();
            redirect('User_Account?msg=2&errorMsg='.$error);
             
        }
    }

    function userupdate_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('m_txtFullName', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('m_txtUserName', 'User name', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('m_selUSerTYpe', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('m_ua_id', 'User Account', 'trim|required');

        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><a class="alert-link" href="#">', '</a>.</div>');
        $this->form_validation->set_message('required', 'You have not provided %s');
        $this->form_validation->set_message('is_unique', 'This %s already exists');

        if($this->form_validation->run() === false)
        {
            $this->view_useraccount();
        }
        else
        {
            $this->userUpdate();
        }
    }

    private function userUpdate()
    {

        $this->db->trans_start();

        $error = 0;

        $txtFullName        = $this->input->post('m_txtFullName');
        $txtUserName        = $this->input->post('m_txtUserName');
        $ua_id              = $this->input->post('m_ua_id');

        $selUSerTYpe        = trim($this->input->post('m_selUSerTYpe'));
        $ua_datetimeModified   = date("Y-m-d H:i");

        $data = array(  "ua_fullname"           =>$txtFullName,
                        "ua_username"           =>$txtUserName,
                        "ut_id"                 =>$selUSerTYpe,
                        "ua_datetimeModified"   =>$ua_datetimeModified,
                        );


        if(!$this->Model_main->user_update($ua_id,$data))
        {
            $error = $this->db->error()['message'];
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('User_Account?msg=3');
        }
        else
        {

            $this->db->trans_rollback();
            redirect('User_Account?msg=2&errorMsg='.$error);
             
        }
    }

    public function useraccount_remove()
    {
        if(!isset($_POST['btnUserRemove']))
        {
                $data['name']           = $this->session->userdata('sess_fullname');
                $data['userlevel_desc'] = $this->session->userdata('sess_userTypeDesc');

                $data['userType']       = array();
                $data['alldata']        = array();

                if($res_userType = $this->Model_main->userType())
                {
                    $data['userType']   = $res_userType;
                }

                if($alldata = $this->Model_main->useraccountAlldata())
                {
                    $data['alldata']   = $alldata;
                }

                $this->load->view('main/template/bootstrap.php',$data);
                $this->load->view('main/bootstrap/bstp_useraccount.php');
                $this->load->view('main/template/sidenav.php');
                $this->load->view('main/template/topnav.php');
                $this->load->view('main/view_useraccountRemove.php');
                $this->load->view('main/template/footer.php');
                $this->load->view('main/template/script.php');
                $this->load->view('main/customScript/useraccount_script.php');
                $this->load->view('main/modals/useraccount_modal.php');

        }
        else
        {
            $this->remove_useraccount();
        }
    }
    private function remove_useraccount()
    {
        $myUserID = $this->myUserID;
        $ua_id    = $this->input->post('SelUserID');

        $error=0;
        $data = array(  "ua_remove"           =>1,
                        "ua_datetimeModified" =>date("Y-m-d H:i"));
        if(!empty($ua_id))
        {
            $this->db->trans_start();

            if(!$this->Model_main->user_updatewhereIN($ua_id,$data,$myUserID))
            {
                $error = $this->db->error()['message'];
            }
            
        }
        else
        {
            $error = "Please select user account to remove";
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('User_AccountRemove?msg=1');
        }
        else
        {
            $this->db->trans_rollback();
            redirect('User_AccountRemove?msg=2&errorMsg='.$error);
        }



    }

    public function generatepass()
    {

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()';
        
        $alpha_length = strlen($alphabet) - 1; 

        $proceed = 0;
        while($proceed === 0)
        {
            $password = array(); 

            for ($i = 0; $i < 10; $i++) 
            {
                $n = rand(0, $alpha_length);
                $password[] = $alphabet[$n];
            }

            $pass = implode($password);


            if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/", $pass))
            {
                $proceed = 1;
                
            }
        }

        echo json_encode($pass);
            
    }

}