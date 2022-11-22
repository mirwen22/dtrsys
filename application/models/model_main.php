<?php
class Model_main extends CI_Model
{
	function userType()
	{

		$query = $this->db->query("SELECT * from user_type");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}

	function user_save($data)
	{
		$this->db->insert('useraccount',$data); 
        $get_id = $this->db->insert_id();
                
        if ($this->db->affected_rows() > 0)
        {
            return $get_id;
        } 

        return false; 
	}

	function useraccountAlldata()
	{

		$query = $this->db->query("SELECT * from useraccount ua
								inner join user_type ut on ut.ut_id = ua.ut_id
								where ua_remove = 0");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}

	function user_update($id,$data)
	{
        $this->db->where('ua_id',$id);
        $this->db->update('useraccount',$data);
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}
	function user_updatewhereIN($id,$data,$myUserID)
	{
		
        $this->db->where_in('ua_id',$id);
        $this->db->where('ua_id !=',$myUserID);
        $this->db->update('useraccount',$data);
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}

	function employee_save($data)
	{
		$this->db->insert('employee',$data); 
        $get_id = $this->db->insert_id();
                
        if ($this->db->affected_rows() > 0)
        {
            return $get_id;
        } 

        return false; 
	}


	function employeeQR_save($data)
	{
		$this->db->insert('employee_qrcode',$data); 
                
        if ($this->db->affected_rows() > 0)
        {
            return true;
        } 

        return false; 
	}


	function employee_alldata()
	{

		$query = $this->db->query("SELECT * from employee e 
									inner join useraccount ua on ua.ua_id = e.emp_createBy
									inner join employee_qrcode eq on eq.emp_id = e.emp_id");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}
	function employee_specific($empid)
	{
		$query = $this->db->query("SELECT * from employee e 
									inner join employee_qrcode eq on eq.emp_id = e.emp_id
									where e.emp_id = '$empid'");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}
	function employee_update($id,$data)
	{
        $this->db->where('emp_id',$id);
        $this->db->update('employee',$data);
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}

	function employee_delete($ids)
	{
		
        $this->db->where_in('emp_id',$ids);
        $this->db->delete('employee');
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}

	function employeeQRcode_delete($ids)
	{
		
        $this->db->where_in('emp_id',$ids);
        $this->db->delete('employee_qrcode');
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}

	function employee_specific_QRcode($qrCode)
	{
		$query = $this->db->query("SELECT * from employee e 
									inner join employee_qrcode eq on eq.emp_id = e.emp_id
									where eq.emp_qrCode = '$qrCode'");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}

	function capturelogs_checkRecord($emp_id,$datenow)
	{
		$query = $this->db->query("SELECT * from dtr
									where emp_id = '$emp_id'
									and DATE(emptime_datetime) = '$datenow'");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}

	function capturelogs_save($data)
	{
		$this->db->insert('dtr',$data); 
                
        if ($this->db->affected_rows() > 0)
        {
            return true;
        } 

        return false; 
	}
	function capturelogs_update($emp_id,$data)
	{
		$this->db->where('emp_id',$emp_id);
        $this->db->update('dtr',$data);
 	
 		if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false; 
	}

	function capturelogs_alldata_top10()
	{
		$query = $this->db->query("SELECT *,DATE(emptime_datetime) as 'logdate' from dtr d
									inner join employee e on e.emp_id = d.emp_id
									ORDER BY emptime_datetime desc
									LIMIT 10");

        if ($this->db->affected_rows() > 0)
        {
            return $query->result_array();
        }
        return false; 
	}

}