<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {
	/**
	 * Authentication constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		// Load the user model
		$this->load->model('user_model');
	}

	/**
	 *
	 */
	public function login_post() {
		// Get the post data
		$email = $this->post('email');
		$password = $this->post('password');

		// Validate the post data
		if(!empty($email) && !empty($password)){

			// Check if any user exists with the given credentials
			$con = array(
				'email' => $email,
				'password' => $password,
				'status' => 1
			);
			$user = $this->user_model->get_user_data($con);

			if ($user) {
				// Set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'User login successful.',
					'data' => $user
				], REST_Controller::HTTP_OK);
			} else {
				// Set the response and exit
				//BAD_REQUEST (400) being the HTTP response code
				$this->response("Wrong email or password.", REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			// Set the response and exit
			$this->response("Provide email and password.", REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * @param int $id
	 */
	public function user_get($id = 0)
	{
		// Returns all the users data if the id not specified,
		// Otherwise, a single user will be returned.
		$con = $id?array('id' => $id):'';
		$users = $this->user_model->fetch_data($con);

		// Check if the user data exists
		if (!empty($users)) {
			// Set the response and exit
			//OK (200) being the HTTP response code
			$this->response($users, REST_Controller::HTTP_OK);
		} else {
			// Set the response and exit
			//NOT_FOUND (404) being the HTTP response code
			$this->response([
				'status' => FALSE,
				'message' => 'No user was found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
