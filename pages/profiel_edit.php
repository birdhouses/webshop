<?php
if(isset($_SESSION["ID"])&&($_SESSION["STATUS"]!="ACTIEF")){
  echo "<script>
  alert('U heeft geen toegang tot deze pagina.');
  location.href='../index.php';
  </script>";
}
try {
  $sql = "SELECT * FROM klant WHERE email = ?";
  $stmt = $verbinding->prepare($sql);
  $stmt->execute(array( $_SESSION["E-MAIL"] ));
  $resultaat = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
  echo $e->getMessage();
}
 ?>
<div class="content">
  <form method="POST" action="index.php?page=profiel_update">
    <p id="page_titel">Profiel editen</p>
    <label for="voornaam">Voornaam</label>
    <input type="text" required name="voornaam"
    value="<?php echo $resultaat['voornaam']; ?>" />
    <label for="achternaam">Achternaam</label>
    <input type="text" required name="achternaam"
    value="<?php echo $resultaat['achternaam']; ?>" />
    <label for="straat">Straat</label>
    <input type="text" required name="straat"
    value="<?php echo $resultaat['straat']; ?>" />
    <label for="postcode">Postcode</label>
    <input type="text" required name="postcode"
    value="<?php echo $resultaat['postcode']; ?>" />
    <label for="woonplaats">Woonplaats</label>
    <input type="text" required name="woonplaats"
    value="<?php echo $resultaat['woonplaats']; ?>" />
    <label for="e-mail">E-mail</label>
    <input type="email" required name="e-mail"
    value="<?php echo $resultaat['email']; ?>" />
    <br />
    <div class="icon_container">
      <input type="submit" name="submit" class="icon" id="submit" value="&rarr;" />
    </div>
    <a href="index.php?page=webshop">Terug</a>
  </form>
</div>
