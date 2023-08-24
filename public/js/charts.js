window.onload = function () {
var dps = []; // dataPoints


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	zoomEnabled: true,
	title :{
		text: "Dynamic Data"
	},
	data: [{
		type: "line",
		dataPoints: dps
	}],
	axisY:{
	 title : "Primary Y Axis"
	}
});

var xVal = -5;
var yVal = 35;
var updateInterval = 400;
var dataLength = 400; // number of dataPoints visible at any point
var sensor_id = 1;

function getData()
{
  const xhttp = new XMLHttpRequest();

  xhttp.onload = function() {
    var obj = JSON.parse(this.responseText);
    var stopPoint = obj['data'].length>dataLength?dataLength:obj['data'].length;
    dps.length = 0;
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
	//console.log("/api/readings/".concat(dataLength,"/sensor/",sensor_id));
  xhttp.open("GET", "/api/readings/".concat(dataLength,"/sensor/",sensor_id));
  xhttp.send();
}

$("#sensors").change(function()
{
	const xhttp = new XMLHttpRequest();

  sensor_id = this.value;
	var obj;
	xhttp.onload = function() {
    obj = JSON.parse(this.responseText);
		obj = obj['data'][0];
		chart.options.title.text = obj['description'];
		chart.axisY[0].options.title = obj['measurement_unit'];
  	getData();
  }
  xhttp.open("GET", "/api/sensors/".concat(sensor_id));
  xhttp.send();

});


	chart.render();
	const xhttp = new XMLHttpRequest();
	var obj;
	xhttp.onload = function() {
    obj = JSON.parse(this.responseText);
		obj = obj['data'][0];
		chart.options.title.text = obj['description'];
		chart.axisY[0].options.title = obj['measurement_unit'];
  	getData();
  }
  xhttp.open("GET", "/api/sensors/".concat(sensor_id));
  xhttp.send();
	chart.render();

setInterval(function(){getData()}, updateInterval);
}
