
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
  "<td>"+item['controller_id']+"</td>"+
  "<td>"+item['last_read_value']+" "+item['measurement_unit']+"</td>"+
  "<td>"+d.toLocaleString()+"</td>"+
  "<td><i class=\"fa-solid fa-circle\" style=\"color:"+color+"\"></i></td>"+
  "</tr>";
}

function requestTemporary()
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    console.log("req");
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
