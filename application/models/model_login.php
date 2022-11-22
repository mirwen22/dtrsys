<?php
class Model_login extends CI_Model
{
	public function login($un,$pw)
	{
		$pw= $this->db->escape($pw);
		$un= $this->db->escape($un);

		if($un === null && $pw === null)
		{
			echo "Error";
		}
		else
		{
			$res=$this->db->query("SELECT * from useraccount ua inner join user_type u on u.ut_id=ua.ut_id
									WHERE ua_username=".$un." and BINARY ua_password=".$pw." and ua_remove=0");
		}

		return $res->result_array();
	}
}