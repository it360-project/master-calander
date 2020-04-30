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
  if(response == "FALSE")
    window.location.href = "./student_courses/courseForm.php";
  else{
  document.getElementById("cal").innerHTML = response;
  var date = new Date();
  console.log(date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate());
  var y = date.getFullYear();
  var d = date.getDate();
  var m = (date.getMonth()+1);

  if((date.getMonth()+1)<10)
    m = "0"+(date.getMonth()+1);

  if(date.getDate()<10)
    d = "0"+(date.getDate());


  console.log(y+"-"+m+"-"+d);
  document.getElementById(y+"-"+m+"-"+d).parentNode.style.backgroundColor = "#FFC9BA";
  var button = document.getElementsByClassName("btn");
  for(var i=0;i<button.length;i++){
    button[i].addEventListener("click",cText,true);
  }
  }
}
};
xhttp.open("POST","./Calendar_Maker/calendar_retriever.php");
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send('function=Calander');




function cText(event){
  var calander_id = event.target.id.substring(1);
  console.log(calander_id);
  var calander  = document.getElementById(calander_id);
  if(event.target.innerHTML == "Minimize"){
    event.target.innerHTML = "Maximize";
    calander.style.display = "none";

  }
  else {
    event.target.innerHTML = "Minimize";
    calander.style.display = "block";


  }


}
