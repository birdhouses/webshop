<?php
if(!isset($_SESSION["ID"])&&$_SESSION["STATUS"]!="ACTIEF"){
  echo "<script>
  alert('U heeft geen toegang tot deze pagina.');
  location.href='index.php?page=inloggen'
  </script>";
}
 ?>
<!-- dit is het zoekformulier -->
<script src="js/webshop.js"></script>
  <div class="content" >
    <form name="search" id="search" action="" method="POST" >
        <div style="background-color: #C2F98E; height: 25px;
        margin-top: 5%; padding: 0;">
        <input type="text" style = "float: left; width: 70%;"
        id="patroon" name="patroon" placeholder="Zoek albums" />
        <input type="submit"
        style="float: none; width: 10%; font-size: 1.2rem;"
        id="zoeken" name="zoeken" value="&#128270;" /><br>
        </div>
    </form>
</div>
<?php
    // Hier wordt de sql-opdracht gegenereerd
    if(isset($_POST["zoeken"]) && !empty($_POST["patroon"])){
      $patroon = htmlspecialchars($_POST["patroon"]);
      $sql = "SELECT * FROM album WHERE title LIKE `%patroon%` ||
              artiest LIKE `%$patroon%` || genre LIKE `%$patroon%`";
    } else {
      $sql = "SELECT * FROM album LIMIT 3";
    }
?>
<div class="content" >
  <form name="webshop" id="webshop" action="index.php?page=bestellen" method="POST">
<?php
// Dit is het bestelformulier met albums uit de database
  $stmt = $verbinding->prepare($sql);
  $stmt->execute();
  $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $lus = 0;
  foreach($albums as $album) {
    echo "<img width='100px' src='img/". $album['cover']."'/>";
    echo "<input type='hidden'
    name='id[$lus]' id='id[$lus]'
    value='". $album['ID'] . "' />";
    echo "<input type='hidden'
    name='titel[$lus]' id='titel[$lus]'
    value='".$album['titel'] ."' />";
    echo "<input type='hidden'
    name='artiest[$lus]' id='artiest[$lus]'
    value='".$album['artiest'] ."' />";
    echo "<input type='hidden'
    name='genre[$lus]' id='genre[$lus]'
    value='".$album['genre'] ."' />";
    echo "<input type='hidden'
    name='prijs[$lus]' id='prijs[$lus]'
    value='".$album['prijs'] ."' />";
    echo "<br> titel:". $album["titel"] . " prijs: " .
    $album["prijs"];
    echo "<br> Voorraad: " . $album["voorraad"];
    echo "<br>Aantal:";
    echo "<input class='aantal' type='text' style='width: 10%'
    name='aantal[$lus]' id='aantal[$lus]' value='0' />";
    echo "<hr />";
    $lus ++;
  }
  echo "<input type='hidden' name='lus' id='lus' value='".$lus."'/>";
 ?>
<!-- winkelmandje aan en uit zetten -->
<input type="checkbox" name="winkelmandje_knop" id="winkelmandje_knop"
onclick="javascript:showWinkelmandje();" class="icon"
value="&#128717;" />
<label for="winkelmandje_knop">&#128717;</label>
<br>
<div class="icon_container">
  <input type="submit" class="icon" id="submit"
  name="submit" value="&rarr;" />
</div>
<br>
</form>
</div>
<!-- Winkelmandje -->
<div id="winkelmandje">
  <div id="rijen"></div>
  <input type="checkbox"
  id="winkelmandje_knop"
  onclick="javascript:showWinkelmandje();"
  class="icon" value="X" />
  <label for="winkelmandje_knop"
  style="color: red;">&#8861;</label>
</div>
</body>
</html>
