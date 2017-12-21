<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User extends CI_Controller {

public function __construct() {
	
parent::__construct();

// Load form helper library
$this->load->helper('form');

$this->load->helper('url');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

$this->load->library('upload');

// Load Model
$this->load->model('user_model');
}

// Show login page
public function index() {
if($this->session->userdata('username') !=''){
				$username = $this->session->userdata('username');
				$profiles = $this->user_model->get_profile_data();
								
				$data['message_display'] = 'Welcome to'.$username;
				$this->load->view('header',$data);
				$this->load->view('admin_page',$profiles);
				$this->load->view('footer');
				}else{
				$data['title'] = "Login User";
				$this->load->view('header',$data);
				$this->load->view('login_form');
				$this->load->view('footer');
			}
}

	// Show registration page
	public function registration() {
	$data['title'] = "New User registration";
	$this->load->view('header',$data);
	$this->load->view('registration_form');
	$this->load->view('footer');
	}	   
		

// Validate and store registration data in database
public function new_user() {

// Check validation for user input in SignUp form
$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[user_login.user_name]');
$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean|is_unique[user_login.user_email]');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
$this->form_validation->set_rules('age_value', 'Age', 'trim|required|xss_clean');
$this->form_validation->set_rules('mobile_value', 'Mobile', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
		$this->load->view('header');
		$this->load->view('registration_form');
		$this->load->view('footer');
		} else {
				$data = array(
				'user_name' => $this->input->post('username'),
				'user_email' => $this->input->post('email_value'),
				'user_password' => sha1($this->input->post('password')),
				'user_age' => $this->input->post('age_value'),
				'user_mobile' => $this->input->post('mobile_value')); 
				$result = $this->user_model->registration_insert($data);
					if ($result == TRUE) {
					$data['message_display'] = 'Registration Successfully !';
					$this->load->view('header',$data);
					$this->load->view('login_form');
					$this->load->view('footer');
					} else {
					$data['message_display'] = 'Username already exist!';
					$this->load->view('header',$data);
					$this->load->view('registration_form');
					$this->load->view('footer');
					}
		}
	}

// Check for user login process
public function login() {
$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

	if ($this->form_validation->run() == FALSE) {
				if($this->session->userdata('username') !=''){
				$username = $this->session->userdata('username');
				$profiles = $this->user_model->get_profile_data();
				
				
				$data['message_display'] = 'Welcome to'.$username;
				$this->load->view('header',$data);
				$this->load->view('admin_page',$profiles);
				$this->load->view('footer');
				}else{
				$data['message_display'] = 'Welcome to login';
				$this->load->view('header',$data);				
				$this->load->view('login_form');
				$this->load->view('footer');
				}
	} else {
		$data = array(
		'username' => $this->input->post('username'),
		'password' => sha1($this->input->post('password')));
		$result = $this->user_model->login($data);
				if ($result == TRUE) {
				$username = $this->input->post('username');
				$profiles = $this->user_model->get_profile_data();
				$result = $this->user_model->read_user_information($username);
							if ($result !== false) {
							$session_data = array(
							'username' => $result[0]->user_name,
							'email' => $result[0]->user_email,
							);
							// Add user data in session
							$this->session->set_userdata($session_data);
							$username = $this->session->userdata('username');
							$data['message_display'] = 'Welcome to'.$username;
							$this->load->view('header',$data);
							$this->load->view('admin_page',$profiles);
							$this->load->view('footer');
							}
					} else {
					$data = array(
					'error_message' => 'Invalid Username or Password.'
					);
					$this->load->view('header',$data);
					$this->load->view('login_form');
					$this->load->view('footer');
					}
		}
}

	
	public function user_profile(){
		
		$this->form_validation->set_rules('user_id', 'UserId', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('user_image', 'UserImage', 'trim|required|xss_clean');
		$this->form_validation->set_rules('boi', 'AboutUs', 'trim|required|xss_clean');
		$this->form_validation->set_rules('gender', 'Sex', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
		$this->load->view('header');
		$this->load->view('user_profile');
		$this->load->view('footer');
			} else {
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'user_image' => $_FILES['user_image']['name'],
				'boi' => $this->input->post('boi'),			
				'gender' => $this->input->post('gender')); 
				$result = $this->user_model->profile_insert($data);
					
				
			$data['message_display'] = 'Welcome to User profile.';				
			$this->load->view('header',$data);
			$this->load->view('admin_page');
			$this->load->view('footer');	
		}
	}
		
		
		// Show forget password page
public function forgot_password() {
$data['title'] = "Users Forget password.";
$this->load->view('header',$data);
$this->load->view('forgot_password_form');
$this->load->view('footer');
}



/* user forget password */
 public function forgotPassword()
	   {
			 $email = $this->input->post('user_email');      
			 $findemail = $this->user_model->ForgotPassword($email);  
			 if($findemail){
			  $this->user_model->sendpassword($findemail);        
			   }else{
			  $this->session->set_flashdata('msg',' Email not found!');
                 redirect(base_url().'user/Login','refresh');
		  }
	   }
	   
	   
		
	// Logout from admin page
	public function logout() {
	$this->session->unset_userdata('username');
	$this->session->unset_userdata('email');
	$data['message_display'] = 'Successfully Logout.';
     redirect(base_url().'user/Login','refresh');
	$this->load->view('header',$data);
	$this->load->view('login_form');
	$this->load->view('footer');
	}
	
	
}