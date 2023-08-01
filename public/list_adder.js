function displayer2(){

  var temp = document.getElementById("ingredients_place").outerHTML;

  var count = (temp.match(/movable_row/g) || []).length;

  var node = document.getElementById("movable_row");

  var clone = node.cloneNode(true);

  document.getElementById("ingredients_place").appendChild(clone);
}

var i=0;

function displayer()
{
  var temp = document.getElementById("ingredients_place").outerHTML;
  var count = (temp.match(/movable_row/g) || []).length;
  var node = document.getElementById("movable_row_"+i);
  var clone = node.cloneNode(true);
  document.getElementById("ingredients_place").appendChild(clone);

  const elementName = document.getElementById("ingredient["+i+"][name]");
  const elementMeasureType = document.getElementById("ingredient["+i+"][measureType]");
  const elementAmount = document.getElementById("ingredient["+i+"][amount]");
  const newNode = document.getElementById("movable_row_"+i);
  ++i;
  elementName.id = "ingredient["+i+"][name]";
  elementMeasureType.id = "ingredient["+i+"][measureType]";
  elementAmount.id = "ingredient["+i+"][amount]";
  newNode.id = "movable_row_"+i;
  document.getElementById("ingredient["+i+"][name]").setAttribute("name","ingredient["+i+"][name]");
  document.getElementById("ingredient["+i+"][measureType]").setAttribute("name","ingredient["+i+"][measureType]");
  document.getElementById("ingredient["+i+"][amount]").setAttribute("name","ingredient["+i+"][amount]");

}


function removeIngredient(element)
{
  const divId = element.parentElement.parentElement.id;
  const el = document.getElementById(divId);
  el.remove();
}
