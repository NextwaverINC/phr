<?php 

$table=$_GET["table"];
$cid=$_GET["cid"];
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Null</title>

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        
	
	<style>
	
		.name-color{
			color: white;
		}
	
	</style>
</head>
<body>

<div class="wrapper">
    <div class="fresh-table toolbar-color-green full-screen-table">
    <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange                  
            Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->
        
        <div class="toolbar">
<!--            <button id="alertBtn" class="btn btn-default">Alert</button>-->
			<h5 id="name_people" class="caption name-color">Null</h5>

				<button class="btn btn-default" data-toggle="dropdown"><i class="glyphicon fa fa-list"></i></button> 
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                  <li role="presentation" class="divider"></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                </ul>

        </div>
        
        <table id="fresh-table" class="table">
            <thead>
                <th data-field="id" >ID</th>
            	<th data-field="Item" data-sortable="true">Item</th>
            	<th data-field="Value" data-sortable="true">Value</th>
<!--            	<th data-field="actions"  data-formatter="operateFormatter" data-events="operateEvents">Actions</th>-->
            </thead>
            <tbody id="demo">
               <script>

											var TableName='<?php echo $table; ?>';
				   					        document.title=TableName;
											var seturl="../XMLFile/"+TableName.toLowerCase()+".xml";

											var item_attri=[];
				   							var item_attriTH=[];
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
												;
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




																txt += "<tr><td>"+(itm+1)+"</td><td>"+item_attri[itm]+"</td><td>"+val+"</td></tr>";


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




																	txt += "<tr><td>"+(itm+1)+"</td><td>"+item_attri[itm]+"</td><td>"+val+"</td></tr>";


																}
																document.getElementById("demo").innerHTML = txt;
															}

														}


													}



												}
												
												else{
													alert("Connect Fail");
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


</body>
    <script type="text/javascript" src="assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-table.js"></script>
        
    <script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'), 
            full_screen = false,
            window_height;
            
        $().ready(function(){
            
            window_height = $(window).height();
            table_height = window_height - 20;
            
            
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                height: table_height,
                pageSize: 25,
                pageList: [25,50,100],
                
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..." 
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
            
            window.operateEvents = {
                'click .like': function (e, value, row, index) {
                    alert('You click like icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);
                },
                'click .edit': function (e, value, row, index) {
                    alert('You click edit icon, row: ' + JSON.stringify(row));
                    console.log(value, row, index);    
                },
                'click .remove': function (e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
            
                }
            };
            
            $alertBtn.click(function () {
                alert("You pressed on Alert");
            });
        
            
            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });    
        });
        

        function operateFormatter(value, row, index) {
            return [
                '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Like">',
                    '<i class="fa fa-thumbs-o-up"></i>',
                '</a>',
                '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
                    '<i class="fa fa-edit"></i>',
                '</a>',
                '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
                    '<i class="fa fa-remove"></i>',
                '</a>'
            ].join('');
        }
       
    </script>

</html>