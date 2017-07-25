<?php 

$table=$_GET["table"];
$cid=$_GET["cid"];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="msapplication-tap-highlight" content="no">
		<meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
		<meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
		<title>Data Tables | Materialize - Material Design Admin Template</title>

		<!-- Favicons-->
		<link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
		<!-- Favicons-->
		<link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
		<!-- For iPhone -->
		<meta name="msapplication-TileColor" content="#00bcd4">
		<meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
		<!-- For Windows Phone -->


		<!-- CORE CSS-->

		<link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- Custome CSS-->    
		<link href="css/custom-style.css" type="text/css" rel="stylesheet" media="screen,projection">
		<!-- CSS style Horizontal Nav (Layout 03)-->    
		<link href="css/style-horizontal.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="../../../../cdn.datatables.net/1.10.6/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">



		<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
		<link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
		<link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">

		<style>
			.name-color{
				color: #7DCEA0;
			}

			.right {
				position: absolute;
				right: 0px;
				padding: 10px;
			}
			



		</style>

	</head>

	<body>
		<div id="main">
			<!-- START WRAPPER -->
			<div class="wrapper">
				<!-- START CONTENT -->
				<section id="content">
					<!--start container-->
					<div class="container">
						<h5 id="name_people" class="caption name-color">Null</h5>
						
						<div class="section">
							
							<!--DataTables example-->
							<div id="table-datatables">
								<table id="data-table-simple" class="display">
									<thead>
										<tr>
											<th>Item</th>
											<th>Value</th>
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th>Item</th>
											<th>Value</th>
										</tr>
									</tfoot>

									<tbody id="demo">


										<script>

											var TableName='<?php echo $table; ?>';

											var seturl="../XMLFile/"+TableName.toLowerCase()+".xml";

											var item_attri=[];
											var item=[];
											var request = new XMLHttpRequest();
											request.open("GET",seturl , false);
											request.send();
											var xml = request.responseXML;
											var users = xml.getElementsByTagName("Items");



											for(var i = 0; i < users.length; i++) {

												var user = users[i];
												var names = user.getElementsByTagName("text");

												for(var j = 0; j < names.length; j++) {
													item_attri.push(names[j].childNodes[0].nodeValue.toUpperCase());
												}

											}


											var obj, dbParam, xmlhttp, x,Obj="";
											var txt ="";
											txt += document.getElementById("demo").innerHTML;
											obj = "";
											dbParam = JSON.stringify(obj);
											xmlhttp = new XMLHttpRequest();





											xmlhttp.onreadystatechange = function() {

												Obj = JSON.parse(this.responseText);

												if (this.readyState == 4 && this.status == 200) {
													Obj = JSON.parse(this.responseText);

													var name_peo="คุณ:&nbsp "+Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["NAME"]+"&nbsp&nbsp&nbsp"+Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["LNAME"];

													document.getElementById("name_people").innerHTML =name_peo;


													var ckArray=Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"];

													if(Array.isArray(ckArray)!=true){

														for(var itm=0; itm < Object.keys(Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"]).length;itm++){


															if(item_attri[itm]==="HOSPCODE" || item_attri[itm]==="CID" || item_attri[itm]==="PID" || typeof(item_attri[itm])==="undefined" ){


															}

															else{
																var ObjVal= Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"][item_attri[itm]];




																var val="-";



																if( typeof(ObjVal) === "undefined" || ObjVal === null || ObjVal === "null" || ObjVal === ""){
																	val="-";
																}

																else{


																	val=Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"][item_attri[itm]];

																}




																txt += "<tr><td>"+item_attri[itm]+"</td><td>"+val+"</td></tr>";


															}
															document.getElementById("demo").innerHTML = txt;
														}
													}

													else{

														alert(Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"].length+" รายการ");



														for(var count=0;count<Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"].length;count++){
															for(var itm=0; itm < Object.keys(Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"][count]).length;itm++){


																if(item_attri[itm]==="HOSPCODE" || item_attri[itm]==="CID" || item_attri[itm]==="PID" || typeof(item_attri[itm])==="undefined" ){


																}


																else{

																	var ObjVal= Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"][count][item_attri[itm]];




																	var val="-";



																	if( typeof(ObjVal) === "undefined" || ObjVal === null || ObjVal === "null" || ObjVal === ""){
																		val="-";
																	}

																	else{

																		val=Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][TableName.toUpperCase()+"_LIST"][TableName.toUpperCase()+"_INFO"][count][item_attri[itm]];

																	}




																	txt += "<tr><td>"+item_attri[itm]+"</td><td>"+val+"</td></tr>";


																}
																document.getElementById("demo").innerHTML = txt;
															}

														}


													}



												}
											};
											xmlhttp.open("POST", "getJson.php", false);
											xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
											xmlhttp.send("search=<?php echo $cid ?>");



										</script>



									</tbody>
								</table>
							</div>
						</div>
					</div> 
					<br>
					<!--					<div class="divider"></div> -->
					<!--DataTables example Row grouping-->


				</section>
			</div>
			<!-- END WRAPPER -->

		</div>

		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>    
		<!--materialize js-->
		<script type="text/javascript" src="js/materialize.js"></script>
		<!--prism-->
		<script type="text/javascript" src="js/prism.js"></script>
		<!--scrollbar-->
		<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<!-- data-tables -->
		<script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
		<!-- chartist -->
		<script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   

		<!--plugins.js - Some Specific JS codes for Plugin Settings-->
		<script type="text/javascript" src="js/plugins.js"></script>    
	</body>


	<!-- Mirrored from demo.geekslabs.com/materialize/v2.1/layout03/table-data.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jul 2017 11:45:22 GMT -->
</html>