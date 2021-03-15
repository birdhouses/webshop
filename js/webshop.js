function showWinkelmandje() {
  //Winkelmand aan of uit zetten
  if(document.webshop.winkelmandje_knop.checked) {
    document.getElementById("winkelmandje").style.visibility =
    "visible";
    document.getElementById("rijen").style.visibility=
    "visible";
  }else{
    document.getElementById("winkelmandje").style.visibility =
    "hidden";
    document.getElementById('rijen').style.visibility =
    "hidden";
  }
  rijen = "<table><th width='120'>Titel</th><th>Artiest</th>"+
  "<th>Genre</th><th>Prijs</th><th>Aantal</th><th>Delete</th>";
  rij = "";
  lus = document.getElementById("lus").value;
  for(x=0; x<lus; x++) {
    if(document.getElementById("Aantal["+ x +"]").value==0)
    continue;
    rij="<tr>";
    titel = document.getElementById("titel["+ x +"]").value;
    artiest = document.getElementById("artiest["+ x +"]").value;
    genre = document.getElementById("genre["+ x +"]").value;
    prijs = document.getElementById("prijs["+ x +"]").value;
    aantal = document.getElementById("aantal["+ x +"]").value;
    rij += "<td width='120'>" + titel + "</td>" +
    "<td>" + artiest + "</td>" +
    "<td>" + genre + "</td>" +
    "<td>" + prijs + "</td>" +
    "<td>" + aantal + "</td>" +
    "<td onclick='deleterij(" + x +");'>&#10008;</td></tr>";
    rijen += rij;
  }
  rijen += "</table>";
  document.getElementById("rijen").innerHTML = rijen;
}
function deleterij(id){
  verwijder = confirm("Wil je " + document.getElementById("titel[" +id+"]").value + " verwijderen?");
  if (verwijder){
    document.getElementById("aantal["+ id + "]").value = 0;
    showWinkelmandje();
  }
}
