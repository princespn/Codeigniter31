<?php
Class Login_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "user_name =" . "'" . $data['user_name'] . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('user_login', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($data) {

$condition = "user_name =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "user_name =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

//funtion to get email of user to send password
 public function ForgotPassword($email)
 {
        $this->db->select('user_email');
        $this->db->from('user_login'); 
        $this->db->where('user_email', $email); 
        $query=$this->db->get();
        return $query->row_array();
 }

 
	   
 public function sendpassword($data)
{
        $email = $data['user_email'];
        $query1=$this->db->query("SELECT *  from user_login where user_email = '".$email."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass['user_password'] = md5($passwordplain);
        $this->db->where('user_email', $email);
        $this->db->update('user_login', $newpass); 
        $mail_message='Dear '.$row[0]['user_email'].','. "\r\n";
        $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$passwordplain.'</b>'."\r\n";
        $mail_message.='<br>Please Update your password.';
        $mail_message.='<br>Thanks & Regards';
        $mail_message.='<br>Your company name';        
        date_default_timezone_set('Etc/UTC');
        require FCPATH.'assets/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPSecure = "tls"; 
        $mail->Debugoutput = 'html';
        $mail->Host = "yooursmtp";
        $mail->Port = 587;
        $mail->SMTPAuth = true;   
        $mail->Username = "your@email.com";    
        $mail->Password = "password";
        $mail->setFrom('admin@site', 'admin');
        $mail->IsHTML(true);
        $mail->addAddress($email);
        $mail->Subject = 'OTP from company';
        $mail->Body    = $mail_message;
        $mail->AltBody = $mail_message;
if (!$mail->send()) {
     $this->session->set_flashdata('msg','Failed to send password, please try again!');
} else {
   $this->session->set_flashdata('msg','Password sent to your email!');
}
  redirect(base_url().'user/Login','refresh');        
}
else
{  
 $this->session->set_flashdata('msg','Email not found try again!');
 redirect(base_url().'user/Login','refresh');
}
}


		public function profile_insert($data) {			
			$condition = "user_id =" . "'" . $data['user_id'] . "'";
			$this->db->select('*');
			$this->db->from('user_profile');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			
			if ($query->num_rows() == 0)
				{
					$config['upload_path'] = 'uploads';			
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 0;	
					$this->upload->initialize($config);
					$this->load->library('upload', $config);
				
				
					if (!$this->upload->do_upload('user_image')){
					echo $this->upload->display_errors('<p>', '</p>');
						}
						else
						{			
					$this->db->insert('user_profile', $data);	
						}
				}
				else
				{				
				return $query->result();				
				}
		}


}

?>

