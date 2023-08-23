function updateValue(e) {

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
  }
  xhttp.open("POST", "../api/iot/token");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("value=".concat(e.target.value,"&id=",e.target.offsetParent.id));

  e.target.offsetParent.innerHTML = e.target.value;
}

function updateTag(ID)
{

  let html = "<input type=\'number\' class=\'valueInput\'></input>";
  document.getElementById(ID).innerHTML = html;

  const input = document.querySelector(".valueInput");
  input.addEventListener("change", updateValue);

}

function showForm()
{
  document.getElementById("formRow").style.visibility = "visible";
  document.getElementById("formRow").style.display = "block";
}
