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
<title>Registration Form</title>
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
                        <h3 class="panel-title">Please Fill this Form.</h3>
                    </div>
                    <div class="panel-body">
                       <?php echo form_open('user_authentication/new_user_registration'); ?>
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
									echo form_input($data);  ?>                            </div>
                                <div class="checkbox">
                                <?php $data = array(
									'type' => 'password',
									'name' => 'password',
									'placeholder' => 'Password..',
									'class' => 'form-control'
									);
									echo form_input($data); ?>
                                </div>
								<input type="submit"  class="btn btn-lg btn-success btn-block" value=" Sign Up " name="submit"/><br />
								<a href="<?php echo base_url() ?> ">For Login Click Here</a>

                            </fieldset>
                       <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>