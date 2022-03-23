<!DOCTYPE html>
<html>
<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>
<body>

<h1>The XMLHttpRequest Object</h1>

<button type="button" onclick="loadDoc()">Get my CD collection</button>
<button type="button" onclick="provaxpath()">Prova xpath</button>
<br><br>
<table id="demo"></table>

<script>
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      myFunction(this);
    }
  };
  xhttp.open("GET", "cd_catalog.xml", true);
  xhttp.send();
}
function myFunction(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var table="<tr><th>Artist</th><th>Title</th></tr>";
  var x = xmlDoc.getElementsByTagName("CD");
  var y = xmlDoc.getElementsByTagName('DatiTrasmissione');
  for (j = 0; j < y.length; j++) {
    alert (y[j].getElementsByTagName('IdPaese')[0].childNodes[0].nodeValue);
    alert (y[j].getElementsByTagName('IdCodice')[0].childNodes[0].nodeValue);
    alert (y[j].getElementsByTagName('ProgressivoInvio')[0].childNodes[0].nodeValue);
    alert (y[j].getElementsByTagName('FormatoTrasmissione')[0].childNodes[0].nodeValue);
    if (y[j].getElementsByTagName('CodiceDestinatario').length != 0) {alert (y[j].getElementsByTagName('CodiceDestinatario')[0].childNodes[0].nodeValue);}
    alert (y[j].getElementsByTagName('PECDestinatario')[0].childNodes[0].nodeValue);
  }
  for (i = 0; i <x.length; i++) { 
    table += "<tr><td>" +
    x[i].getElementsByTagName("ARTIST")[0].childNodes[0].nodeValue +
    "</td><td>" +
    x[i].getElementsByTagName("TITLE")[0].childNodes[0].nodeValue +
    "</td></tr>";
  }
  document.getElementById("demo").innerHTML = table;

}

function provaxpath(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        showResult(xhttp.responseXML);
    }
  };
  xhttp.open("GET", "cd_catalog.xml", true);
  xhttp.send();
}
 

function showResult(xml) {
  var nome = "";  
  var txt = "";
  path = "//CATALOG/CD/TITLE"
  var nodes = xml.evaluate(path, xml, null, XPathResult.ANY_TYPE, null);
  var nodes_count = xml.evaluate('count(' + path + ')', xml, null, XPathResult.ANY_TYPE, null);
  var nodes_name = xml.evaluate('name(' + path + ')', xml, null, XPathResult.ANY_TYPE, null);
  alert (nodes_count.numberValue);
  alert (nodes_name.stringValue);
  var result = nodes.iterateNext();
  
  while (result) {
      txt += result.childNodes[0].nodeValue + "<br>";
      result = nodes.iterateNext();
  } 
  alert(txt);
}

</script>



</body>

</html>