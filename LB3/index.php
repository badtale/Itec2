<?php
include("bd.php");

$res = $mysqli->query("SELECT publisher FROM literature");
		$res->data_seek(0);
		while ($myrow = $res->fetch_assoc())
		{
			if ($myrow['publisher']!=null){
				$publishers=$publishers."<option>".$myrow['publisher']."</option>";
				
			}
			
		}
$res = $mysqli->query("SELECT name FROM authors");
		$res->data_seek(0);
		while ($myrow = $res->fetch_assoc())
		{
			$authors=$authors."<option>".$myrow['name']."</option>";
			
		}



?>
<!DOCTYPE HTML>
<html>
 <head>
  <script>
  function showUser1(str) {
	//document.write(str+"q");
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				var table="<tr><th>Name</th><th>Author</th></tr>";
				let newLine=0;
				//window.alert(this.responseText);
				var i=0;
				JSON.parse(this.responseText, function(k,v) {
					if (v.toString().indexOf(',')==-1){
					if (i==0){
						table += "<tr><td>" +v+"</td>";
					}else
					if (i==1){
						table += "<td>" +v+"</td></tr>";
						i=-1;
					}else{
						table += "<td>" +v+"</td>";
					}
					i++;
					}

				}); 
				console.log(table);
                document.getElementById("myTable").innerHTML = table;
            }
        };
        xmlhttp.open("GET","bdJson.php?q="+str,true);
        xmlhttp.send();
    }
}
function showUser(str) {
	//document.write(str+"q");
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","bdAjax.php?q="+str,true);
        xmlhttp.send();
    }
}
function loadDoc(str) {
	if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onload  = function() {
			//window.alert(xmlhttp.responseText);
            if (this.readyState == 4 && this.status == 200) {
                var xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					//window.alert(xhttp.responseText);
					if (this.readyState == 4 && this.status == 200) {
						myFunction(this);
					}
				};
				xhttp.open("GET", "data.xml", true);
				xhttp.send();
            }
        };
        xmlhttp.open("GET","bdXML.php?q="+str,true);
        xmlhttp.send();
    }

}
function myFunction(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  //window.alert(xml.responseXML.toXMLString());
  var table="<tr><th>Name</th><th>Author</th></tr>";
  var x = xmlDoc.getElementsByTagName("LESSON");
  for (i = 0; i <x.length; i++) { 
  //window.alert(x[i].getElementsByTagName("week_day")[0].childNodes[0].nodeValue);
    table += "<tr><td>" +x[i].getElementsByTagName("name")[0].childNodes[0].nodeValue +"</td>";
    table += "<td>" +x[i].getElementsByTagName("author")[0].childNodes[0].nodeValue +"</td></tr>";

  }
  document.getElementById("myTable").innerHTML = table; 
  //window.alert(table);
}
</script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ЛБ 3</title>
  <link href="external.css" rel="stylesheet">
 </head>
 <body>

<div class="navigation">
<form action="index.php" method="post">
<a style="margin-left: 50px;">Выберите publisher:</a><br>
<span style="margin-left: 130px;" class="custom-dropdown big">
    <select name="publisherToSHow" onchange="showUser(this.value)">    
        <option selected="selected"  disabled>Publisher</option>
		<?php echo $publishers ?>
    </select>
</span>
</form>

<form action="index.php" method="post">
<a style="margin-left: 50px;">Выберите Author(XML):</a><br>
<span style="margin-left: 115px;" class="custom-dropdown big">
    <select name="authorToSHow"  onchange="loadDoc(this.value)">    
        <option selected="selected"  disabled>Author</option>
		<?php echo $authors ?>
    </select>
</span>
</form>

<form action="index.php" method="post">
<a style="margin-left: 50px;">Выберите Author(JSon):</a><br>
<span style="margin-left: 115px;" class="custom-dropdown big">
    <select name="authorToSHow"  onchange="showUser1(this.value)">    
        <option selected="selected"  disabled>Author</option>
		<?php echo $authors ?>
    </select>
</span>
</form>



<div id="txtHint"><b></b></div>
<table id="myTable" class="table_dark">
</table><br>
</div>

 </body>
</html>
