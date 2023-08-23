text = "";

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function myFunction(item, index){
  text += '<option value="'.concat(item['id'],'">',item['name'],'</option>');
}

function setMeals(value){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    const valuesToEnter = this.responseText;
    text = "";
    document.getElementById("meal_id").innerHTML = "";
    nvaluesToEnter = JSON.parse(valuesToEnter);
    nvaluesToEnter.forEach(myFunction);
    document.getElementById("meal_id").innerHTML = text;
  }
  xhttp.open("GET", 'http://192.168.50.123/meals/'.concat('',value));
  xhttp.send();
}
