<?php
if (isset($this->session->userdata['logged_in'])) {
header("location: http://localhost/login/index.php/user_authentication/user_login_process");
}
?><div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Fill E-mail ID.</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo form_open('user_authentication/forgotPassword'); ?>
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
								<?php $data = array(
									'type' => 'email',
									'name' => 'user_email',
									'placeholder' => 'E-mail..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>                            </div>
                                
								<input type="submit"  class="btn btn-lg btn-success btn-block" value=" Update Password " name="submit"/><br />
								<a href="<?php echo base_url() ?> ">For Login Click Here</a>
								
                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>