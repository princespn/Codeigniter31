<?php
/*if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$email = ($this->session->userdata['logged_in']['email']);
} else {
header("location: login");
}*/
?>
<?php
if($this->session->userdata('username') !=''){
$username = $this->session->userdata('username');
$email = $this->session->userdata('email');
} 
?>
<div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Update User profile.</h3>
                    </div>
                    <div class="panel-body">
					<?php echo form_open_multipart('user_authentication/user_profile');?>
                      
                            <fieldset>
							 <div class="form-group">
							 <?php
								echo "<div class='error_msg'>";
								if (isset($error_message)) {
								echo $error_message;
								}
								echo validation_errors();
								echo "</div>";
								?>
							 </div>
							 
								<div class="form-group">
								<?php 
								$userid = $this->session->userdata('username');

								$username = array(
									'type' => 'hidden',
									'name' => 'user_id',
									'value' => $userid);
									echo form_input($username);  ?> </div>
                                <div class="form-group">
								<?php $name = array(
									'name' => 'user_image',
									'id' => 'user_image',
									'value' => '');
									echo form_upload($name);  ?> </div>
                                <div class="form-group">
								<?php $data = array(
									'type' => 'text',
									'name' => 'boi',
									'placeholder' => 'About Us..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>                            </div>
                                 <div class="form-group">
								<?php $data = array(
									'type' => 'text',
									'name' => 'gender',
									'placeholder' => 'Gender..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>  
								<input type="submit"  class="btn btn-lg btn-success btn-block" value="Update profile" name="submit"/><br />
								
                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>