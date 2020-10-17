<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model 
{

	/**
	 * @param $login
	 * @return false|array
	 */
  public function login($login)
  {
		$uname = $login['username'];
		$pword = $login['password'];
		$where="username='$uname' and password='$pword'";
		$this->db->where($where);
		if ($this->db->count_all_results('admin') == 1){
			return $this->db->get('admin')->row();
		} else {
			return false;
		}
	}
}
