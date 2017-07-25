<?php
session_start();//session starts here

?>


<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<style>body{padding-top: 60px;}</style>

		<link href="bootstrap3/css/bootstrap.css" rel="stylesheet" />

		<link href="login-register.css" rel="stylesheet" />
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">

		<script src="jquery/jquery-1.10.2.js" type="text/javascript"></script>
		<script src="bootstrap3/js/bootstrap.js" type="text/javascript"></script>
		<script src="login-register.js" type="text/javascript"></script>
		<!--Animate-->
		<script src="dist/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="dist/sweetalert.css">

	</head>
	<body background="img/bk.png" onload="openLoginModal();">
		<div class="container" onclick="openLoginModal();">


			
<div class="modal fade login" id="loginModal">
<div class="modal-dialog login animated">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
</div>

<div class="modal-body">  
<div class="box">
<div class="content">

<div class="social">
<img width="40%" height="40%" src="Img/logo.png"/>
</div>

<div class="division">

<span> ระบบบริหารทะเบียนสุขภาพ <br>(คลังเวชระเบียนกลาง) </span>

</div>
<div class="error"></div>
<div class="form loginBox">
<form method="post" action="login.php" accept-charset="UTF-8">
<input id="email" class="form-control" type="text" placeholder="Username" name="email">
<input id="pass" class="form-control" type="password" placeholder="Password" name="pass">
<input value="login" name="login" class="btn btn-success btn-login" type="submit" >
</form>
</div>
</div>
</div>

</div>      
</div>
</div>
</div>

		</div>
	</body>
</html>


<?php

include("database/db_conection.php");

if(isset($_POST['login']))
{
	$user_email=$_POST['email'];
	$user_pass=$_POST['pass'];

	$check_user="select * from users WHERE user_email='$user_email'AND user_pass='$user_pass'";

	$run=mysqli_query($dbcon,$check_user);



	if(mysqli_num_rows($run))
	{
		echo "<script>window.open('index.php','_self')</script>";

		$_SESSION['name_login']=$user_email;//here session is used and value of $user_email store in $_SESSION.

	}
	else
	{
		echo '<script type="text/javascript">',
		'shakeModal();',
		'</script>';
		//echo "<script>alert('Email or password is incorrect!')</script>";
	}
}
?>
