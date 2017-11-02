<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">    
<title><?php if (!empty($title)){ echo $title; } else { echo 'Welcome to Admin'; }  ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/metisMenu.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/main.css">
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo asset_url(); ?>js/bootstrap.min.js" ></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js" ></script>
</head>
<body>
<div class="container"><div class="row">

		<!-- Header -->
			<header id="header">
				<a href="index.php" class="logo"><strong>BHS</strong> SOLUTIONS</a>	
				<?php if($this->session->userdata('username') !=''){ ?><div styles="float:right"><b id="logout"><a href="logout">Logout</a></b></div><?php } ?>
			</header>
<div class="col-md-4 col-md-offset-4">
<div class="panel-heading">
<h3 class="panel-title">                   
<?php
if (isset($logout_message)) {
echo "<div class='message'>";
echo $logout_message;
echo "</div>";
}
?>
<?php
/*if (isset($message_display)) {
echo "<div class='message'>";
echo $message_display;
echo "</div>";
}*/
?>
</h3>
</div>
</div>
</div>
