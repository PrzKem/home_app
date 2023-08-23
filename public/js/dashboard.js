function updateValue(value, id) {

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    console.log(this.responseText);
  }
  xhttp.open("POST", "../api/iot/token");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("value=".concat(value,"&id=",id));

}

function sendButtonRequest(btnID)
{
  var checkBox = document.getElementById("btn_".concat(btnID));
  if (checkBox.checked == true){
    updateValue(1,btnID);
  } else {
     updateValue(0,btnID);
  }
}

function bodyLoad()
{
  for (let i = 8; i < 12; i++) {
    getButtonStatus(i);
  }
}

function getButtonStatus(btnID)
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    console.log(this.responseText);
    var element = document.getElementById("btn_".concat(btnID));
    if(this.responseText == "1")
    {
      element.checked = true;
    }
    else {
      element.checked = false;
    }
  }
  xhttp.open("GET", "/api/iot/token/".concat(btnID));
  xhttp.send();
}

let requestLoop1 = setInterval(function(){getButtonStatus(8)}, 1000);
let requestLoop2 = setInterval(function(){getButtonStatus(9)}, 1000);
let requestLoop3 = setInterval(function(){getButtonStatus(10)}, 1000);
let requestLoop4 = setInterval(function(){getButtonStatus(11)}, 1000);
