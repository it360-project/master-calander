// Author: Jess Lonetti
// Title: Calander.js
// Date: 4.26.2020
// ****--------FUNCTIONALITY---------****
// This javascript is added to a html page
// to get the information from calander_retriever &
// calander_creator

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  // Typical action to be performed when the document is ready
  var response=xhttp.responseText;
  console.log(response);
  document.getElementById("cal").innerHTML = response;
}
};
xhttp.open("POST","http://midn.cs.usna.edu/~m213990/IT360/master-calander/calander_retriever.php");
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send('function=Calander');
