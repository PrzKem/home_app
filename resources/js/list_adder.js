function displayer(){

  var temp = document.getElementById("ingredients_place").outerHTML;

  var count = (temp.match(/movable_row/g) || []).length;

  var node = document.getElementById("movable_row");

  var clone = node.cloneNode(true);

  document.getElementById("ingredients_place").appendChild(clone);
}
