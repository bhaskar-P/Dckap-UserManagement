<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 */
class Admin extends CI_Controller
{
	/**
	 * Admin constructor.
	 */
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('url_helper');
    $this->load->model('Admin_Model');
    $this->load->model('user_model');
    $this->load->library('pagination');
  }
  /**
   * Load Login form
   */
	public function login()
	{
        $this->load->view('header');
		$this->load->view('adminlogin');
    }

  public function home()
  {
    if ($this->session->userdata('isloggedin')) {
		$data['users'] = $this->user_model->fetch_alldata();
        $data['user']= $this->session->userdata('loguserid');
        $this->load->view('header');
        $this->load->view('home', $data);
		} else {
    	$this->load->view('login');
		}
  }
  
  public function adminlogin()
  {
		$data = array();
		if($this->session->userdata('success_msg')) {
			$data['success_msg'] = $this->session->userdata('success_msg');
			$this->session->unset_userdata('success_msg');
		}
		if ($this->session->userdata('error_msg')) {
			$data['error_msg'] = $this->session->userdata['error_msg'];
			$this->session->unset_userdata('error_msg');
    }

		$this->load->view('header');
		if ($this->input->post('adminlogin')) {
			$this->form_validation->set_rules('userName', 'User name', 'required');
			$this->form_validation->set_rules('password','Password', 'required');
			$login_data=array(
				'username'=>$this->input->post('userName'), 
				'password'=> md5($this->input->post('password'))
			);
			if ($this->form_validation->run() == true) {
			  	$log = $this->Admin_Model->login($login_data);
				if($log){
					$this->session->set_userdata('isloggedin', true);
					$this->session->set_userdata('loguserid', $log->id);
					redirect('index.php/admin/home');
				} else {
					$data['error'] = 'Invalid username or password';
				}
			}
    }
		  $this->load->view('adminlogin', $data); 
  }
	public function search()
	{
		$this->load->view('header');
		$data = array();
		$countarray = array();
		if ($this->input->post('search')) {
			$data['email'] = $this->input->post('email');
			$data['username'] = $this->input->post('username');
			$data['phone'] = $this->input->post('phone');
			$data['dob'] = $this->input->post('dob');
			$data['createddate'] = $this->input->post('created');
		}
		$count = $this->user_model->search($data);
		if ($count) {
			$countarray = $this->user_model->search($data);
		}
		$data['users'] = $countarray ;
		$this->load->view('home' , $data);
	}

	/**
	 * User delete method.
	 */
	public function UserDelete()
	{
		$id = $this->uri->segment(3);
		if ($this->session->userdata('isloggedin')) {
			$this->user_model->deleteUser($id);
			redirect('index.php/admin/home');
		}
		else {
			redirect('index.php/admin/home');
		}
	}

	/**
	 * view user method
	 */
	public function userUpdate()
	{
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		if($this->session->userdata('isloggedin')) {
			$data['info'] = $this->user_model->fetch_data($data);
			$this->load->view('header');
		    $this->load->view('update', $data);
		} else {
			redirect('index.php/admin/home');
		}
	}

	/**
	 * view user method
	 */
	public function UserView()
	{
		$id = $this->uri->segment(3);
		$data['id'] = $id;
		$this->load->view('header');
		if($this->session->userdata('isloggedin')) {
			$info['detail'] = $this->user_model->fetch_data($data);
			$this->load->view('viewUser', $info);
		} else {
			redirect('index.php/admin/home');
		}
	}

	public function userlogin()
	{
		if ($this->input->post('userlogin')) {

			$apiKey = 'Dckap@123';
			$apiUser = "admin";
			$apiPass = "1234";
			$url = base_url().'index.php/api/authentication/login';
			$userData = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
			curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);
			$result = curl_exec($ch);
			curl_close($ch);
            $result = json_decode($result,true);
			if (isset($result['status']) && $result['status'] === true) {
				$this->session->set_userdata('isloggedin', true);
				$data['data'] = $result['data'][0];
				$this->load->view('header');
              $this->load->view('viewUser1', $data);
			} else {
				$data['error'] = 'Invalid UserName or Password.';
				$this->load->view('header');
				$this->load->view('userLogin', $data);
			}
		}
	}
}
