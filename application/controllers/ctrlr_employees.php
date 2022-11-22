<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlr_employees extends CI_Controller {

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

        $this->form_validation->set_rules('txtFname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('txtLname', 'Last Name', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><a class="alert-link" href="#">', '</a>.</div>');
        $this->form_validation->set_message('required', 'You have not provided %s');       

        if($this->form_validation->run() === false)
        {
            $this->view_employees();
        }
        else
        {
            $this->employee_save();
        }

    }

    public function view_employees()
    {
        $data['name']           = $this->session->userdata('sess_fullname');
        $data['userlevel_desc'] = $this->session->userdata('sess_userTypeDesc');

        $data['userType']       = array();
        $data['alldata']        = array();

        if($res_userType = $this->Model_main->userType())
        {
            $data['userType']   = $res_userType;
        }

        if($alldata = $this->Model_main->employee_alldata())
        {
            $data['alldata']   = $alldata;
        }

        $this->load->view('main/template/bootstrap.php',$data);
        $this->load->view('main/template/sidenav.php');
        $this->load->view('main/template/topnav.php');
        $this->load->view('main/view_employee.php');
        $this->load->view('main/template/footer.php');
        $this->load->view('main/template/script.php');
        $this->load->view('main/customScript/employee_script.php');
        $this->load->view('main/modals/employee_modal.php');
    }

    public function generateQR()
    {
        if(isset($_GET['id']) && $_GET['id'] != 0)
        {

            $empid= $_GET['id'];

            if(!empty($res = $this->Model_main->employee_specific($empid)))
            {
                $data['res'] = $res;
                $this->load->view('main/view_qrcodegenerated.php',$data);
            }
            else
            {
                echo "Unable to generate employee information";
            }

        }
        else
        {
            echo "no employee selected";
        }

        
    }
    private function employee_save()
    {
        $this->db->trans_start();
        $this->load->library('ciqrcode');

        $error = 0;

        $txtFname            = $this->input->post('txtFname');
        $txtLname            = $this->input->post('txtLname');
        $emp_createBy        = $this->myUserID;
        $emp_datetimeAdded   = date("Y-m-d H:i");

        $data = array(  "emp_fname"       =>$txtFname,
                        "emp_lname"       =>$txtLname,
                        "emp_createBy"      =>$emp_createBy,
                        "emp_datetimeAdded" =>$emp_datetimeAdded,
                        "emp_datetimeAdded" =>$emp_datetimeAdded,
                        );

        if($id = $this->Model_main->employee_save($data))
        {
                $data2 = array( "emp_id"           =>$id,
                                "emp_qrCode"       =>$txtLname."-".$id);

            if($this->Model_main->employeeQR_save($data2))
            {
                $qrval                = $txtLname."-".$id;
                $qr_image             = $qrval.'.png';
                $params['data']       = $qrval;
                $params['level']      = 'H';
                $params['size']       = 10;
                $params['savename']   = FCPATH."qr_image/".$qr_image;
                if(!$this->ciqrcode->generate($params))
                {    
                   $error = "Something Went Wrong while Generating the QR Code";
                }
            }
            else
            {
                $error = $this->db->error()['message'];
            }

           

        }
        else
        {
            $error = $this->db->error()['message'];
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('Employee_List?msg=1');
        }
        else
        {

            $this->db->trans_rollback();
            redirect('Employee_List?msg=2&errorMsg='.$error);
             
        }
    }

    public function employeeupdate_validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('m_txtFname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('m_txtLname', 'Last name', 'trim|required');
        $this->form_validation->set_rules('m_emp_id', 'Employee ID', 'trim|required');

        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><a class="alert-link" href="#">', '</a>.</div>');
        $this->form_validation->set_message('required', 'You have not provided %s');

        if($this->form_validation->run() === false)
        {
            $this->view_employees();
        }
        else
        {
            $this->employee_update();
        }
    }

    private function employee_update()
    {

        $this->db->trans_start();

        $error = 0;

        $m_txtFname        = $this->input->post('m_txtFname');
        $m_txtLname        = $this->input->post('m_txtLname');
        $m_emp_id          = $this->input->post('m_emp_id');

        $selUSerTYpe        = trim($this->input->post('m_selUSerTYpe'));
        $ua_datetimeModified   = date("Y-m-d H:i");

        $data = array(  "emp_fname"           =>$m_txtFname,
                        "emp_lname"           =>$m_txtLname,
                        "emp_datetimeUpdated" =>date("Y-m-d H:i"),
                        );


        if(!$this->Model_main->employee_update($m_emp_id,$data))
        {
            $error = $this->db->error()['message'];
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('Employee_List?msg=3');
        }
        else
        {

            $this->db->trans_rollback();
            redirect('Employee_List?msg=2&errorMsg='.$error);
             
        }
    }

    public function view_employeeRemove()
    {
        if(!isset($_POST['btnRemove']))
        {
                $data['name']           = $this->session->userdata('sess_fullname');
                $data['userlevel_desc'] = $this->session->userdata('sess_userTypeDesc');

                $data['alldata']        = array();

                if($alldata = $this->Model_main->employee_alldata())
                {
                    $data['alldata']   = $alldata;
                }

                $this->load->view('main/template/bootstrap.php',$data);
                $this->load->view('main/bootstrap/bstp_employee.php');
                $this->load->view('main/template/sidenav.php');
                $this->load->view('main/template/topnav.php');
                $this->load->view('main/view_employeeDelete.php');
                $this->load->view('main/template/footer.php');
                $this->load->view('main/template/script.php');
                $this->load->view('main/customScript/employee_script.php');
                $this->load->view('main/modals/employee_modal.php');

        }
        else
        {
            $this->employeeDelete();
        }
    }
    private function employeeDelete()
    {
        $myUserID = $this->myUserID;
        $empIds    = $this->input->post('SelEmployeeID');

        $error=0;

        $this->db->trans_start();

        if(!empty($empIds))
        {
            if(!$this->Model_main->employee_delete($empIds))
            {
                $error = $this->db->error()['message'];
            }

            if(!$this->Model_main->employeeQRcode_delete($empIds))
            {
                $error = $this->db->error()['message'];
            }
        }
        else
        {
            $error = "Please select employee/s";
        }
        
        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            redirect('Employee_Remove?msg=1');
        }
        else
        {
            $this->db->trans_rollback();
            redirect('Employee_Remove?msg=2&errorMsg='.$error);
        }


    }
}