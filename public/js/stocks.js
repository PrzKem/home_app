function updateIngredient(ingredientID)
{
  document.getElementById('name').value=document.getElementById("".concat(ingredientID,'.name')).innerText;
  document.getElementById('quantityOnStock').value=document.getElementById("".concat(ingredientID,'.qos')).innerText;
  document.getElementById('measureType').value=document.getElementById("".concat(ingredientID,'.mop')).innerText;

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("boxSize").value =
    this.responseText;
  }
  xhttp.open("GET", "".concat("getIngredientBoxSize/",ingredientID));
  xhttp.send();
  window.scrollTo(0, 0);
}

function deleteIngredient(ingredientID)
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("request_result").value =
    this.responseText;
    var x = document.getElementById("".concat(ingredientID,'.tr'));
    x.style.display = "none";
  }
  xhttp.open("GET", "".concat("deleteIngredient/",ingredientID));
  xhttp.send();

  window.scrollTo(0, 0);
}
