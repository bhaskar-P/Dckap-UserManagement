<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users class 
 */
class Users extends CI_Controller 
{
/**
 * Users class constructor.
 */
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->model('user_model');
  }

/**
 * To load the view.
 */
  public function addUser()
  {
  	$this->load->view('header');
    $this->load->view('addUsers');
  }

  public function isLoggedin()
    {
      if (!$this->session->userdata('isloggedin')) {
            echo sprintf(
                'You must be logged in to have access to this resource'
            );
            exit;
        }
    }

/**
 * add user data.
 * Get the information from Frontend and save the details in database.
 */
  public function addUserData()
  {
    $this->isLoggedin();
	  $this->load->view('header');
    if ($this->input->post('adduser')) {
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('username', 'User Name', 'required');
      $this->form_validation->set_rules('password','Password', 'required');
      $this->form_validation->set_rules('email', 'E-mail','required');
      $this->form_validation->set_rules('dob','Date of Birth', 'required');
      $this->form_validation->set_rules('phone','Phone','required');
      $this->form_validation->set_rules('address','Address','required');
      $this->form_validation->set_rules('city','City','required');
      $this->form_validation->set_rules('state','State','required');
      $this->form_validation->set_rules('country','Country','required');
      //validate the form data 
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('addUsers');
         } else {
      //get the form values
      $data['name'] = $this->input->post('name', TRUE);
      $data['username'] = $this->input->post('username', TRUE);
      $data['email'] = $this->input->post('email', TRUE);
      $data['password'] = $this->input->post('password', TRUE);
      $dob = $this->input->post('dob', TRUE);
      $data['phone'] = $this->input->post('phone', TRUE);
      $data['city'] = $this->input->post('city', TRUE);
      $data['state'] = $this->input->post('state', TRUE);
      $data['country'] = $this->input->post('country', TRUE);
      $data['address'] = $this->input->post('address', TRUE);
      $data['dob'] = $dob;
      $data['status'] = '1';
      $data['createddate'] = date('Y-m-d H:i:s');
      //file upload code 
      //set file upload settings 
      $config['upload_path']          = APPPATH. '../assets/images/profile/';
      $config['allowed_types']        = 'jpg|jpeg|JPG|JPEG|png';
      $config['max_size']             = 10000;
      $this->load->library('upload', $config);
      if ( ! $this->upload->do_upload('picture')) {
          $error = array('error' => $this->upload->display_errors());
          $this->load->view('addUsers', $error);
      } else {
          //file is uploaded successfully
          //now get the file uploaded data 
          $upload_data = $this->upload->data();
          //get the uploaded file name
          $data['image'] = $upload_data['file_name'];
          //store pic data to the db
          $this->user_model->adduser($data);
          $data['success'] = 'User is added Sucessfully';
		  redirect('index.php/admin/home');
      }
      }
    } else {
      $this->load->view('addUsers');
    }
  }

  public function updateUser()
  {
	  if ($this->session->userdata('isloggedin')) {
		  if ($this->input->post('updateUser')) {
			  $this->form_validation->set_rules('name', 'Name', 'required');
			  $this->form_validation->set_rules('username', 'User Name', 'required');
			  $this->form_validation->set_rules('password','Password', 'required');
			  $this->form_validation->set_rules('email', 'E-mail','required');
			  $this->form_validation->set_rules('dob','Date of Birth', 'required');
			  $this->form_validation->set_rules('phone','Phone','required');
			  $this->form_validation->set_rules('address','Address','required');
			  $this->form_validation->set_rules('city','City','required');
			  $this->form_validation->set_rules('state','State','required');
			  $this->form_validation->set_rules('country','Country','required');
		  }
		  $id = $this->input->post('userid');
		  //validate the form data
		  if ($this->form_validation->run() == FALSE) {
			  redirect('index.php/admin/home');
		  } else {
			  //get the form values
			  $data['name'] = $this->input->post('name', TRUE);
			  $data['username'] = $this->input->post('username', TRUE);
			  $data['email'] = $this->input->post('email', TRUE);
			  $data['password'] = $this->input->post('password', TRUE);
			  $dob = $this->input->post('dob', TRUE);
			  $data['phone'] = $this->input->post('phone', TRUE);
			  $data['city'] = $this->input->post('city', TRUE);
			  $data['state'] = $this->input->post('state', TRUE);
			  $data['country'] = $this->input->post('country', TRUE);
			  $data['address'] = $this->input->post('address', TRUE);
			  $data['dob'] = $dob;
			  $data['status'] = '1';
			  $data['createddate'] = date('Y-m-d H:i:s');
			  //file upload code
			  //set file upload settings
			  $config['upload_path']          = APPPATH. '../assets/images/profile/';
			  $config['allowed_types']        = 'jpg|jpeg|JPG|JPEG|png';
			  $config['max_size']             = 10000;
			  $this->load->library('upload', $config);
			  if ( ! $this->upload->do_upload('picture')) {
				  $error = array('error' => $this->upload->display_errors());
				  $this->load->view('update', $error);
			  } else {
				  //file is uploaded successfully
				  //now get the file uploaded data
				  $upload_data = $this->upload->data();
				  //get the uploaded file name
				  $data['image'] = $upload_data['file_name'];
				  //store pic data to the db
				  $update =$this->user_model->update_user($data, $id);
				  if($update){
					  $this->session->set_userdata('success_msg', 'User updated successfuly');
					  redirect('index.php/admin/home');
				  }
				  $data['error_msg']='Some Problem ooccured. Please try again later';
				  redirect('index.php/admin/home');
			  }
		  }
	  } else {
		  redirect('index.php/admin/home');
	  }
  }

	/**
	 *
	 */
  public function login()
  {
	  $this->load->view('header');
	  $this->load->view('userLogin');
  }
}
