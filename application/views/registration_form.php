<?php
if (isset($this->session->userdata['logged_in'])) {
header("location: http://localhost/login/index.php/user/login");
}
?><div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Fill this Form.</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo form_open('user/new_user'); ?>
                            <fieldset>
							 <div class="form-group">
							 <?php
								echo "<div class='error_msg'>";
								if (isset($message_display)) {
								echo $message_display;
								}
								echo validation_errors();
								echo "</div>";
								?>
							 </div>
							 
                                <div class="form-group">
								<?php $name = array(
									'type' => 'text',
									'name' => 'username',
									'placeholder' => 'Username..',
									'class' => 'form-control'
									);
									echo form_input($name);  ?> </div>
                                <div class="form-group">
								<?php $data = array(
									'type' => 'email',
									'name' => 'email_value',
									'placeholder' => 'E-mail..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>
									</div>
                                <div class="form-group">
                                <?php $data = array(
									'type' => 'password',
									'name' => 'password',
									'placeholder' => 'Password..',
									'class' => 'form-control'
									);
									echo form_input($data); ?>
                                </div>
								<div class="form-group">
								<?php $data = array(
									'type' => 'text',
									'name' => 'age_value',
									'placeholder' => 'Age..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>
									</div>
								<div class="form-group">
								<?php $data = array(
									'type' => 'text',
									'name' => 'mobile_value',
									'placeholder' => 'Mobile..',
									'class' => 'form-control'
									);
									echo form_input($data);  ?>
									</div>
								<input type="submit"  class="btn btn-lg btn-success btn-block" value=" Sign Up " name="submit"/><br />
								<a href="<?php echo base_url() ?> ">For Login Click Here</a>
								</br><a href="<?php echo base_url() ?>index.php/user/forgot_password">Forget Password Click Here</a>

                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>