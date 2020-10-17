<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User_model
 */
class User_model extends CI_Model
{
	/**
	 * @return mixed
	 */
	public function fetch_alldata()
	{
		$this->db->select("*");
		$this->db->from("users");
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * @param array $user_data
	 * @return false
	 */
	public function adduser($user_data=array())
	{
		$ins=$this->db->insert('users', $user_data);
		//var
		if ($ins) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	/**
	 * @param $id
	 */
	public function deleteUser($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	/**
	 * @param $data
	 * @param $id
	 * @return bool
	 */
	public function update_user($data , $id)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);
		return true;
	}

	/**
	 * @param $data
	 * @return false
	 */
	public function search($data)
	{
		$username = ($data['username']) ? "'" .$data['username'] . "%'"  : "'%'" ;
		$select_query = 'select * from users where username like '. $username;

		if(isset($data['email']) && !empty($data['email'])) {
			$select_query .= ' and email like '. "'" . $data['email'] . "'";
		}
		if(isset($data['phone']) && !empty($data['phone'])) {
			$select_query .= ' and phone like '. $data['phone'];
		}
		if(isset($data['dob']) && !empty($data['dob'])) {
			$date = "'" . $data['dob'] . "'";
			$select_query .= ' and dob = '. $date;
		}
		if (isset($data['createddate']) && !empty($data['createddate'])) {
			$date = "'" . $data['createddate'] . "'";
			$select_query .= ' and createddate = '. $date ;
		}
		$query = $this->db->query($select_query);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		return false;
	}

	public function fetch_data($id=array())
	{
		$this->db->where('id', $id['id']);
		return $this->db->get('users')->row();
	}

	/**
	 * @param $data
	 * @return false
	 */
	public function get_user_data($data)
	{
		$query = sprintf(
			"select * from users where email = '%s' and password = '%s' and status = %s",
			$data['email'],
			$data['password'],
			$data['status']
		);
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query->result();
		}
		return false;
	}

}
