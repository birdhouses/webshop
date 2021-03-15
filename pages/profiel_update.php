<?php
if(isset($_SESSION['ID']) && ($_SESSION['STATUS']!="ACTIEF")) {
  echo "<script>
  alert('U heeft geen toegang tot deze pagina.');
  location.href='../index.php';
  </script>";
}
if(isset($_POST['submit'])) {
  $voornaam = htmlspecialchars($_POST['voornaam']);
  $achternaam = htmlspecialchars($_POST['achternaam']);
  $straat = htmlspecialchars($_POST['straat']);
  $postcode = htmlspecialchars($_POST['postcode']);
  $woonplaats = htmlspecialchars($_POST['woonplaats']);
  $email = htmlspecialchars($_POST['e-mail']);

  $query = "UPDATE klant SET `voornaam`= ?, `achternaam` = ?,
  `straat` = ?, `postcode` = ?, `woonplaats` = ? ,
  `email` = ?
  WHERE `email` = ?";
  $stmt = $verbinding->prepare($query);
  try {
    $stmt = $stmt->execute(array($voornaam, $achternaam,
  $straat, $postcode, $woonplaats, $email, $email));
  if($stmt) {
    echo "<script>alert('Profiel is geüpdatet');
    location.href='index.php?page=webshop';</script>";
  }
}catch(PDOException $e) {
  echo $e->getMessage();
  }
}
 ?>
