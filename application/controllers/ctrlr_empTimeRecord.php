<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrlr_empTimeRecord extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_main');
        $this->load->helper(array('form', 'url'));

        
        $userid = $this->session->userdata('sess_user_id');
        $userType = $this->session->userdata('sess_usertypeid');
        $this->myUserID = $userid;

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
        $this->load->view('main/view_dtrCapture.php');
        $this->load->view('main/template/footer.php');
        $this->load->view('main/template/script.php');
        $this->load->view('main/customScript/dtrCapture_script.php');

    }
    public function capturelogs()
    {
        $val = $_POST['val'];
        $logtype = $_POST['logtype'];
        $this->db->trans_start();
        $error = 0;
        if($res = $this->Model_main->employee_specific_QRcode($val))
        {
            $emp_id = $res[0]['emp_id'];
            $ua_id = $this->myUserID;
            $emptime_datetime = date("Y-m-d H:i");
            $logdatetime = date("Y-m-d H:i");
            $datenow = date("Y-m-d");

            if($logtype == '1')
            {
                $data = array(  "emp_id"            =>$emp_id,
                                "ua_id"             =>$ua_id,
                                "emptime_datetime"  =>$emptime_datetime,
                                "emptime_timein"    =>$logdatetime,
                        );
            }
            else
            {
                $data = array(  "emp_id"            =>$emp_id,
                                "ua_id"             =>$ua_id,
                                "emptime_datetime"  =>$emptime_datetime,
                                "emptime_timeout"   =>$logdatetime,
                        );
            }

            if($this->Model_main->capturelogs_checkRecord($emp_id,$datenow))
            {
                if(!$this->Model_main->capturelogs_update($emp_id,$data))
                {
                    $error = $this->db->error()['message'];
                }
            }
            else
            {
                if(!$this->Model_main->capturelogs_save($data))
                {
                    $error = $this->db->error()['message'];
                }
            }
            
        }
        else
        {
            $error = "Unregisted QR code";
        }

        if($this->db->trans_status() === TRUE && $error === 0)
        {
            $this->db->trans_complete();
            $result['status'] = 1;
            $result['msg'] = "Success";
            $result['name'] = $res[0]['emp_fname']." ".$res[0]['emp_lname'];
            $result['datetimer'] = $logdatetime;
            $result['logtype'] = $logtype;
            echo json_encode($result);
        }
        else
        {

            $this->db->trans_rollback();
            $result['status'] = 0;
            $result['msg'] = $error;
            echo json_encode($result);
             
        }

    }

    function refreshlogs()
    {
        if($res = $this->Model_main->capturelogs_alldata_top10())
        {
            $data = "";
            foreach($res as $row)
            {
                $timein = "";
                $timeout = "";

                if(!empty($row['emptime_timein']))
                {
                    $timein = date("H:i",strtotime($row['emptime_timein']));
                }
                if(!empty($row['emptime_timeout']))
                {
                    $timeout = date("H:i",strtotime($row['emptime_timeout']));
                }

                $data .= "<tr>";
                $data .= '<td><i class="fa fa-clock-o"></i>'.$row['logdate'].'</td>';
                $data .= '<td><i class="fa fa-clock-o"></i>'.$timein.'</td>';
                $data .= '<td><i class="fa fa-clock-o"></i>'.$timeout.'</td>';
                $data .= '<td>'.$row['emp_fname']." ".$row['emp_lname'].'</td>';
                $data .= "</tr>";
            }

            

            $result['status'] = 1;
            $result['msg'] = "Success";
            $result['data'] = $data;
            echo json_encode($result);
        }
        else
        {
            $result['status'] = 0;
            $result['msg'] = "No Data Display";
            echo json_encode($result);
        }
    }
}