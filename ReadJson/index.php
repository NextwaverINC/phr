<!DOCTYPE html>
<html>
	<body>
		<script>

			xmlhttp = new XMLHttpRequest();

			xmlhttp.onreadystatechange = function() {

				Obj = JSON.parse(this.responseText);
				var tb= "epi";

				if (this.readyState == 4 && this.status == 200) {
					Obj = JSON.parse(this.responseText);

					var name_peo="คุณ:&nbsp "+Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["NAME"]+"&nbsp&nbsp&nbsp"+Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"]["PERSON_LIST"]["PERSON_INFO"]["LNAME"];

					
					var ts=Obj["PHR_INFO"]["SIGN_LIST"]["SIGN_INFO"]["SECTION_LIST"][tb.toUpperCase()+"_LIST"][tb.toUpperCase()+"_INFO"];
					
					alert(Array.isArray(ts));
					
					if(Array.isArray(ts)==true){
						
						alert("true");
					}
					
//						document.getElementById("demo").innerHTML = txt;
					}

				
			};
			xmlhttp.open("POST", "jsonfile.php", false);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("search=");



		</script>



	</body>
</html>