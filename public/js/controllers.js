function requestTemporary()
{
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    var obj = JSON.parse(this.responseText);
    obj = obj['data']['data'];
    obj.forEach(replaceText);

  }
  xhttp.open("GET", "/api/controllers");
  xhttp.send();
}

function replaceText(index, value)
{
  var element = document.getElementById("device_time_".concat(value));
  var time = new Date(index['updated_at']);
  var now = new Date;
  var color = "#FFFFFF";
  time.setHours(time.getHours()-2);

  if (now < time) {
    now.setDate(now.getDate() + 1);
  }
  var diff = now - time;
  if(diff>2*3600000)
  {
    color = "#DC143C";
  }
  else {
    if(index['actual_work_mode'] == "manu")
    {
      color = "#BF8715";
    }
    else {
      color = "#25733A";
    }
  }


  element.innerHTML = "Last seen at: ".concat(time.toLocaleString());
  element = document.getElementById("device_workmode_".concat(value));
  console.log(element.outerHTML);
  //element.innerHTML = index['actual_work_mode'];
  element.outerHTML = "<h4 id=\"device_workmode_".concat(value,"\" style=\"color:",color,"\">",index['actual_work_mode'],"</h4>");
}

let requestLoop = setInterval(requestTemporary, 5000);
