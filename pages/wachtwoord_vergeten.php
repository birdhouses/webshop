<!DOCTYPE html>
<html lang="nl">
  <head>
    <title>Webshop</title>
    <link rel="stylesheet" href="../css/webshop.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <div class="content">
      <form name="Wachtwoord vergeten" method="POST" enctype="multipart/form-data" action="">
        <p id="page_titel">Nieuw wachtwoord aanvragen</p>
        <input type="email" required name="e-mail" placeholder="e-mail"/>
        <div class="g-recaptcha" data-sitekey="6Ld7sN8UAAAAAIg1hJgj5bFhUl8-X5I4ZVzU9Qx4">
        </div>
        <br/>
        <div class="icon_container">
        <input type="submit" class="icon" id="submit"
        name="submit" value="&rarr;" />
      </div>
      <a href="../index.php?page=inloggen">Terug</a>
    </form>
  </div>
<?php
if(isset($_POST["submit"])) {
  $melding = "";
  $email = htmlspecialchars($_POST['e-mail']);

  // Hier genereren we een token en een timestamp
  $token = bin2hex(random_bytes(32));
  $timestamp = new DateTime("now");
  $timestamp = $timestamp->getTimestamp();
  // Hier slaan we het token voor deze klant in de database op
  include('../DBconfig.php');
  try {
    $sql = "UPDATE klant SET `token` = ? WHERE `email` = ?";
    $stmt = $verbinding->prepare($sql);
    $stmt = $stmt->execute(array($token, $email));
    if(!$stmt) {
      echo "<script>alert('Kon niet opslaan in database.');
      location.href='../index.php?page=inloggen';</script>";
    }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
// Hier configureren we de URL van de wachtwoord_resetten-pagina
$url = sprintf("%s://%s",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='of-
f'?'https':'http',$_SERVER['HTTP_HOST'].
dirname($_SERVER['PHP_SELF'])."/wachtwoord_resetten.php");
// Hier voegen we het token en de timestamp aan de url toe
$url = $url."?token=".$token."&timestamp=".$timestamp;
// Hier mailen we de URL naar de klant
include("../bibliotheek/mailen.php");
$onderwerp = "Wachtwoord resetten";
$bericht = "<p>Als je je wachtwoord wilt resetten klik <a href=".$url.">hier</a></p>";
try {
  mailen($email, "klant", $onderwerp, $bericht);
  $melding = 'Open je mail om verder te gaan.';
} catch(Exception $e) {
  $melding = 'Kon geen mail versturen - ' + $mail->ErrorInfo;
}
echo "<div id='melding'>".$melding."</div>";
}
 ?>
  </body>
</html>
