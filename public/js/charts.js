window.onload = function () {
var dps = []; // dataPoints


var chart = new CanvasJS.Chart("chartContainer", {
	title :{
		text: "Dynamic Data"
	},
	data: [{
		type: "line",
		dataPoints: dps
	}]
});

var xVal = -5;
var yVal = 35;
var updateInterval = 20;
var dataLength = 100; // number of dataPoints visible at any point
var sensor_id = 1;

function getData()
{
  const xhttp = new XMLHttpRequest();

  xhttp.onload = function() {
    var obj = JSON.parse(this.responseText);
    var stopPoint = obj['data'].length>dataLength?dataLength:obj['data'].length;
    dps.length = 0;
    console.log(obj['data']);
    for (var j = 0; j < stopPoint; j++) {
      dps.push({
  			x: new Date(obj['data'][j]['created_at']),
  			y: obj['data'][j]['reading_value']
  		});
    }
    if (dps.length > dataLength) {
  		dps.shift();
  	}

  	chart.render();
  }
  xhttp.open("GET", "/api/readings/".concat(dataLength,"/sensor/",sensor_id));
  xhttp.send();
}

$("#sensors").change(function()
{
  sensor_id = this.value;

});

setInterval(function(){getData()}, updateInterval);
}
