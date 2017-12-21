<?php
if (isset($this->session->userdata['logged_in'])) {
header("location: http://localhost/login/index.php/user/login");
}
?><div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo form_open('user/login'); ?>
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
								<input type="text" class="form-control" name="username" id="name" placeholder="username" autofocus/>
								</div>
                                <div class="form-group">
								<input type="password" class="form-control" name="password" id="password" placeholder="**********"/>

                                 </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
								<input type="submit"  class="btn btn-lg btn-success btn-block" value=" Login " name="submit"/><br />
								<a href="<?php echo base_url() ?>index.php/user/registration">To SignUp Click Here</a>
								</br><a href="<?php echo base_url() ?>index.php/user/forgot_password">Forget Password Click Here</a>


                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
</div>
