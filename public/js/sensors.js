
let tableData = "";

function createTableWithData(item,index)
{
  const now = new Date();
  const d = new Date();
  const actualDate = Date.parse(item['updated_at']);
  d.setTime(actualDate);
  let color = "orange";
  if (now>actualDate+(60*60*1000)) {
    color = "red";
  }
  else {
    color = "green";
  }
  tableData+="<tr>"+
  "<td>"+item['id']+"</td>"+
  `<td id="controller_for_`+item['id']+`">`+item['controller_id']+"</td>"+
  "<td>"+item['last_read_value']+" "+item['measurement_unit']+"</td>"+
  "<td>"+d.toLocaleString()+"</td>"+
  "<td><i class=\"fa-solid fa-circle\" style=\"color:"+color+"\"></i></td>"+
  `<td id="description_for_`+item['id']+`">`+item['description']+"</td>"+
  `<td>
    <button type="button" class="btn" onclick="updateSensor(`+item['id']+`)"><i class="fa-solid fa-pen-to-square"></i></button>`+
    //<button type="button" class="btn" onclick="deleteSensor(`+item['id']+`)"><i class="fa-solid fa-trash" style="color:#DC143C"></i></button>
    `</td>`+
  "</tr>";
}

function requestTemporary()
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var table = document.getElementById('tableBody');

    var obj = JSON.parse(this.responseText);
    obj = obj['data']['data'];
    tableData = "";

    obj.forEach(createTableWithData);
    table.innerHTML = tableData;
  }
  xhttp.open("GET", "/api/sensors");
  xhttp.send();
}

let requestLoop = setInterval(requestTemporary, 5000);

function updateController(e) {
  updateToDB(e,"controller_id=");
}

function updateValue(e) {
  updateToDB(e,"description=");
}

function updateToDB(e, keyString)
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {

  }
  xhttp.open("PUT", "../api/sensors/"+e.target.id);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(keyString.concat(e.target.value));
  e.target.offsetParent.innerHTML = e.target.value;
  requestTemporary();
  requestLoop = setInterval(requestTemporary, 5000);
  let loader = document.getElementsByClassName("loader")[0];
  console.log(loader);
  loader.className='loader orbit';
}

function updateSensor(ID)
{
  clearInterval(requestLoop);
  let loader = document.getElementsByClassName("loader")[0];
  console.log(loader);
  loader.className='loader paused';
  //
  let html = "<input type=\'number\' class=\'valueInput\' id='"+ID+"'></input>";
  document.getElementById("controller_for_"+ID).innerHTML = html;
  html = "<input type=\'text\' class=\'textInput\' id='"+ID+"'></input>";
  document.getElementById("description_for_"+ID).innerHTML = html;

  const inputController = document.querySelector(".valueInput");
  const inputDesc = document.querySelector(".textInput");
  inputController.addEventListener("change", updateController);
  inputDesc.addEventListener("change", updateValue);

}
