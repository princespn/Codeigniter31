<?php
Class User_Authentication extends CI_Controller {

public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
//$this->load->library('session');



$this->load->library('upload');

// Load Model
$this->load->model('login_database');
}

// Show login page
public function index() {
$data['title'] = "Login User";
$this->load->view('header',$data);
$this->load->view('login_form');
$this->load->view('footer');
}

// Show registration page
public function user_registration_show() {
$data['title'] = "New User registration";
$this->load->view('header',$data);
$this->load->view('registration_form');
$this->load->view('footer');
}

// Show forget password page
public function user_forgot_password() {
$data['title'] = "Users Forget password.";
$this->load->view('header',$data);
$this->load->view('forgot_password_form');
$this->load->view('footer');
}



/* user forget password */
 public function forgotPassword()
	   {
			 $email = $this->input->post('user_email');      
			 $findemail = $this->login_database->ForgotPassword($email);  
			 if($findemail){
			  $this->login_database->sendpassword($findemail);        
			   }else{
			  $this->session->set_flashdata('msg',' Email not found!');
			  redirect(base_url().'user/Login','refresh');
		  }
	   }
	   
	   
    

// Validate and store registration data in database
public function new_user_registration() {

// Check validation for user input in SignUp form
$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[user_login.user_name]');
$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean|is_unique[user_login.user_email]');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
if ($this->form_validation->run() == FALSE) {
$this->load->view('header');
$this->load->view('registration_form');
$this->load->view('footer');
} else {
$data = array(
'user_name' => $this->input->post('username'),
'user_email' => $this->input->post('email_value'),
'user_password' => sha1($this->input->post('password'))); 
$result = $this->login_database->registration_insert($data);
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
public function user_login_process() {

$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE) {
if($this->session->userdata('username') !=''){
$username = $this->session->userdata('username');
$data['message_display'] = 'Welcome to'.$username;
$this->load->view('header',$data);
$this->load->view('admin_page');
$this->load->view('footer');
}else{
$this->load->view('header');
$this->load->view('login_form');
$this->load->view('footer');
}
} else {
$data = array(
'username' => $this->input->post('username'),
'password' => sha1($this->input->post('password')));
$result = $this->login_database->login($data);
if ($result == TRUE) {

$username = $this->input->post('username');
$result = $this->login_database->read_user_information($username);
if ($result != false) {
$session_data = array(
'username' => $result[0]->user_name,
'email' => $result[0]->user_email,
);
// Add user data in session
$this->session->set_userdata($session_data);
$username = $this->session->userdata('username');
$data['message_display'] = 'Welcome to'.$username;
$this->load->view('header',$data);
$this->load->view('admin_page');
$this->load->view('footer');
}
} else {
$data = array(
'error_message' => 'Invalid Username or Password'
);
$this->load->view('header',$data);
$this->load->view('login_form');
$this->load->view('footer');
}
}
}

// Logout from admin page
public function logout() {
$this->session->unset_userdata('username');
$this->session->unset_userdata('email');
$data['message_display'] = 'Successfully Logout';
$this->load->view('header',$data);
$this->load->view('login_form');
$this->load->view('footer');
}

	public function user_profile(){
		//$this->form_validation->set_rules('user_image', 'Picture', 'required|xss_clean');
		$this->form_validation->set_rules('boi', 'Aboutus', 'required|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
		$data['message_display'] = 'Edit user profile';
		$this->load->view('header',$data);
		$this->load->view('user_profile');
		$this->load->view('footer');
		}else{		
						
						$data = array(
						'user_image' => $_FILES['user_image']['name'],
						'user_id' => $this->input->post('user_id'),
						'boi' => $this->input->post('boi'),
						'gender' => $this->input->post('gender')); 
						$result = $this->login_database->profile_insert($data);
						if ($result == TRUE) {
						$data['message_display'] = 'User Update Successfully !';
						$this->load->view('header',$data);
						$this->load->view('user_profile');
						$this->load->view('footer');
						} 
						else
						{
						$data['message_display'] = 'Edit user profile';
						$this->load->view('header',$data);
						$this->load->view('admin_page');
						$this->load->view('footer');			
						}
						
						
						
				

			}
			
	}
}