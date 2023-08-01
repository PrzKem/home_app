var today = new Date();
var prevClick = "";

function sendRequest(startDate, endDate){
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "".concat('getShoppingList/',startDate,'/',endDate), false);
  xhttp.send(null);
  const obj = JSON.parse(xhttp.responseText);
  console.log("".concat('getShoppingList/',startDate,'/',endDate));
  //console.log(obj);
  document.getElementById("shopping_list_body").innerHTML = "";
  for(let i=0; i<obj['shopping_list'].length;i++){
    console.log(obj['shopping_list'][i]);
    document.getElementById("shopping_list_body").innerHTML+="".concat(
    "<tr>",
    "<td>",obj['shopping_list'][i]['name'],"</td>",
    "<td>",obj['shopping_list'][i]['quantity'],"</td>",
    "<td>",obj['shopping_list'][i]['measure'],"</td>",
    "<td>",obj['shopping_list'][i]['packages'],"</td>",
    "<td style=\"visibility: hidden\">2,4</td>",
    "</tr>"
  );
  }

}
const getDays = (year, month) => {
    return new Date(year, month, 0).getDate();
};

function addWeek(){
  if(prevClick == "forward")
  {
    addWeekFunction();
  }
  else {
    addWeekFunction();
    addWeekFunction();
  }
  prevClick = "forward";
}

function substractWeek(){
  if(prevClick == "backward")
  {
    substractWeekFunction();
  }
  else {
    substractWeekFunction();
    substractWeekFunction();
  }
  prevClick = "backward";
}

function addWeekFunction(){
  numberOfDaysInMonth = getDays(today.getFullYear(), today.getMonth()+1);
  console.log(numberOfDaysInMonth);
  startDate = "".concat(today.getFullYear(),'-',today.getMonth()+1,'-',today.getDate());
  startDateFormat = "".concat(today.getDate(), '.', today.getMonth()+1,'.',today.getFullYear());
  if(today.getDate()+7>numberOfDaysInMonth)
  {
    today = new Date(today.getFullYear(),today.getMonth()+1,today.getDate()+7-numberOfDaysInMonth);
  }
  else {
    today = new Date(today.getFullYear(),today.getMonth(),today.getDate()+7);
  }

  endDate = "".concat(today.getFullYear(),'-',today.getMonth()+1,'-',today.getDate());
  endDateFormat = "".concat(today.getDate(), '.', today.getMonth()+1,'.',today.getFullYear());
  sendRequest(startDate, endDate);
  document.getElementById("dateDisplayer").innerHTML = "".concat("<h4>",startDateFormat," - ",endDateFormat,"</h4>");
}

function substractWeekFunction()
{
  endDate = "".concat(today.getFullYear(),"-", today.getMonth()+1,"-",today.getDate());
  endDateFormat = "".concat(today.getDate(), '.', today.getMonth()+1,'.',today.getFullYear());
  if(today.getDate()-7<1)
  {
    numberOfDaysInMonth = getDays(today.getFullYear(), today.getMonth());
    today = new Date(today.getFullYear(), today.getMonth()-1, numberOfDaysInMonth-7+today.getDate());
  }
  else {
    today = new Date(today.getFullYear(), today.getMonth(),today.getDate()-7);
  }
  startDate = "".concat(today.getFullYear(),"-", today.getMonth()+1,"-",today.getDate());
  startDateFormat = "".concat(today.getDate(), '.', today.getMonth()+1,'.',today.getFullYear());
  sendRequest(startDate, endDate);
  document.getElementById("dateDisplayer").innerHTML = "".concat("<h4>",startDateFormat," - ",endDateFormat,"</h4>");
}
