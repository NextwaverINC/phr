<?php
session_start();
if(!$_SESSION['name_login'])
{

	header("Location: login.php");//redirect to login page to secure the welcome page without login access.
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin (PHR) </title>
		<link rel="icon" href="Img/logo.png">
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!--SweetAlert-->


		<!-- This is what you need -->
		<script src="dist/sweetalert2.js"></script>
		<link rel="stylesheet" href="dist/sweetalert2.css">

		<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
		<script src="dist/core.js"></script>

		<style>
			.signout{
				float: left;
				color: #fff;
				font-size: 20px;
				background: transparent;
				padding: 15px 15px;
			}

			.signout:hover{
				font-size: 20px;
				color: #fff;
				background-color: #d73925;
				color: black;
			}


			.modal-header{
				background-color: darkseagreen;   
			}

			a,a:hover,a:focus{
				text-decoration: underline;
				text-decoration: none;   
			}

			.tooltip {
				position: relative;
				display: inline-block;
				border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
			}

			/* Tooltip text */
			.tooltip .tooltiptext {
				visibility: hidden;
				width: 120px;
				background-color: #555;
				color: #fff;
				text-align: center;
				padding: 5px 0;
				border-radius: 6px;

				/* Position the tooltip text */
				position: absolute;
				z-index: 1;
				bottom: 125%;
				left: 50%;
				margin-left: -60px;

				/* Fade in tooltip */
				opacity: 0;
				transition: opacity 1s;
			}

			/* Tooltip arrow */
			.tooltip .tooltiptext::after {
				content: "";
				position: absolute;
				top: 100%;
				left: 50%;
				margin-left: -5px;
				border-width: 5px;
				border-style: solid;
				border-color: #555 transparent transparent transparent;
			}

			/* Show the tooltip text when you mouse over the tooltip container */
			.tooltip:hover .tooltiptext {
				visibility: visible;
				opacity: 1;
			}

			.table-color{
				color: #7DCEA0;
			}

			.slide-from-top{
				-webkit-transition-delay: 5s; /* Safari */
				transition-delay: 5s;
			}
		


		</style>


	</head>
	<body  class="hold-transition skin-red fixed sidebar-mini" onload="AddItemMenu();"; >

		<script>

			var sesdia = "<?php echo $_SESSION['diaWelcome'] ?>";

			document.onreadystatechange = function(){ 

				if(document.readyState === 'complete'){
					if(sesdia==""){
						<?php $_SESSION['diaWelcome'] = 1;?>
						swal({
							title: 'Welcom to AdminPHR',
							timer: 3000
						});
					}
				}	



			}


			function Logout(){
				swal({
					title: "Confirm Logout",
					text: "Are your sure you want to Logout?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes",
					closeOnConfirm: false
				},
					 function(){
					location.href="logout.php";
				});
			}

		</script>

		<?php
		$Json="";  
		$cid="";
		$cid=$_POST["search"];
		$response_Token; 
		Get_token();
		function Get_token(){
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_PORT => "5000",
				CURLOPT_URL => "http://localhost:5000/connect/token",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "grant_type=password&username=alice&password=alice",
				CURLOPT_HTTPHEADER => array(
					"authorization: Basic cm9jbGllbnQ6c2VjcmV0",
					"cache-control: no-cache",
					"content-type: application/x-www-form-urlencoded"
				),
			));

			$response_Token = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				$json_a = json_decode($response_Token, true);
				//echo $json_a['access_token'];
				$access_tokenval = $json_a['access_token'];
				Get_PHR($access_tokenval);
			}  
		}       


		//**************************************************************    
		function Get_PHR($token){
			//            echo $token;
			$curl = curl_init();
			global $cid;
			global $Json; 
			curl_setopt_array($curl, array(
				CURLOPT_PORT => "5001",
				CURLOPT_URL => "http://localhost:5001/identity/".$cid,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$token,
					"cache-control: no-cache",
					"content-type: application/x-www-form-urlencoded",
					"postman-token: b775b168-3150-23ae-b78d-317c2592b1c1"
				),
			));

			$val_return="";    
			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
				echo "cURL Error #:" . $err;
			} else {
				$Json=$response;

				//echo $Json;
			}
		}

		$return_Json=$Json;

		$json_a=json_decode($return_Json,true);


		$sapce="&nbsp;";
		$fname = $json_a["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["NAME"];
		$lname = $json_a["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["LNAME"];


		if($fname != ""){
			echo "<script>swal('Successful..','คุณ : ";
			echo $fname.'   ';
			echo $lname;
			echo "','success')</script>";

		}

		else{
			if($cid!=""){
				echo "<script>swal({title: 'Not Found.',text: 'Try Again',type: 'warning',confirmButtonText: 'OK'})</script>";
			}

		}



		?> 

		<script type="text/javascript">
			function reply_click(clicked_id)
			{
				document.getElementById("title_get").innerHTML=clicked_id;
			}
		</script> 




		<div class="wrapper">

			<header class="main-header">


				<!-- Logo -->
				<a href="#" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini"><b>P</b>HR</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg"><b>Admin</b>PHR</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">  
					</a>
					<a onclick="Logout();" class="signout pull-right fa fa-sign-out"  role="button">
					</a>

					<nav class="navbar-custom-menu">
						<!-- Sidebar toggle button-->

					</nav>
				</nav>

			</header>
			<!-- Left side column. contains the logo and sidebar -->
			<aside class="main-sidebar">
				<!-- sidebar: style can be found in sidebar.less -->
				<section class="sidebar">
					<!-- Sidebar user panel -->
					<div class="user-panel">
						<div class="pull-left image">
							<img src="dist/img/admin.png" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
							<p>Admin</p>
							<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
						</div>
					</div>
					<!-- search form -->
					<form action="#" method="post" class="sidebar-form">
						<div class="input-group">
							<input id="search"  type="text" name="search" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<button type="submit" name="btn" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>

					<div  id="navitem"></div>
					<script>
						function AddItemMenu() {
							var item=[];
							var tableName=["ทะเบียนประวัติสุขภาพ","ทะเบียนรับบริการสุขภาพ","ข้อมูลถูกสำรวจ"];
							var tableNameFile=["1_cumulative","2_service","3_semi_exploration_service"];


							document.getElementById("navitem").innerHTML+="<ul class='text-center sidebar-menu'><li class='header'>MAIN NAVIGATION</li></ui>";

							var count=0;


							for(var count=0;count<tableNameFile.length;count++){
								var request = new XMLHttpRequest();
								request.open("GET", "XMLFile/TableinFile/"+tableNameFile[count]+".xml", false);
								request.send();
								var xml = request.responseXML;
								var values = xml.getElementsByTagName("Import");

								for(var i = 0; i < values.length; i++) {
									var user = values[i];
									var names = user.getElementsByTagName("table");
									var HTMLAdd="";


									HTMLAdd +='<ul class="sidebar-menu"><li class="treeview"><a href="#"><i class="fa fa-edit"></i> <span>'+tableName[count]+'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';

									for(var j = 0; j < names.length; j++) {

										//											alert("loop4 count"+j);

										HTMLAdd +='<ul class="treeview-menu"><li onClick="setActive(this);" id="'+names[j].childNodes[0].nodeValue.toUpperCase()+'"><a href="#"><i class="fa fa-circle-o"></i>'+" "+names[j].childNodes[0].nodeValue.toUpperCase()+'</a></li></li></ul>';
										
										
										
										
									}
									document.getElementById("navitem").innerHTML += HTMLAdd;
								}
							}
						}
						
						
						
						

					</script>
				</section>
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<p id="table"></p>
				<script>
				var btnold="";
						function setActive(btn){
							var btnID=btn.id;
							
							
							if(btnold!="" && btnold!=btnID){
								document.getElementById(btnold).className ="";
							}
							
							if(btnold!=btnID){
								
								document.getElementById(btnID).className ="active";
								btnold=btnID;
								
								
							}
							
							document.getElementById("table").innerHTML='<iframe src="BoostrapTable/index.php?table='+btnID.toLowerCase()+'&cid=2180300001342" scrolling="no" style="height:680px;width:100%;"></iframe>';
							
						}
					
					
				
				</script>
				
				<!-- Content Header (Page header) -->
				
			</div>


			<footer class="main-footer">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.3.8
				</div>
				<strong>Copyright &copy; 2014-2016 </strong> All rights
				reserved.
			</footer>
			<div class="control-sidebar-bg"></div>
		</div>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
		<!-- SlimScroll -->
		<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- page script -->
		<script>
			$(function () {
				$("#example1").DataTable();
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});
			});
		</script>


	</body>
</html>