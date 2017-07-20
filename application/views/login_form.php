<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

header("location: http://localhost/login/index.php/user_authentication/user_login_process");
}
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">    
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/metisMenu.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/font-awesome.min.css">
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrap.min.js" ></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js" ></script>
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo form_open('user_authentication/user_login_process'); ?>
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
								<a href="<?php echo base_url() ?>index.php/user_authentication/user_registration_show">To SignUp Click Here</a>

                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

