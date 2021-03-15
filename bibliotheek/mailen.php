<?php
// Deze dependencies laden we handmatig in
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// Deze function stuurt e-mails via Gmail
function mailen($ontvangerStraat, $ontvangerNaam, $onderwerp, $bericht){
  $mail = new PHPMailer();

  // Verbinden met Gmail
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;

  // Identificeer jezelf bij Gmail
  $mail->Username = "your@email.here";
  $mail->Password = "yourpass";

  // E-mail opstellen
  $mail->isHTML(true);
  $mail->SetFrom("your@email.here", "Verzekeraar");
  $mail->Subject = $onderwerp;
  $mail->CharSet = 'UTF-8';
  $bericht = "<body style=\"font-family: Verdana, Verdana, Geneva, sans-serif;
                font-size: 14px; color: #000;\">".
  $bericht . "</body></html>";
  $mail->AddAddress($ontvangerStraat, $ontvangerNaam);
  $mail->Body = $bericht;

  // Stuur mail
  if ($mail->Send()) {
    echo "<script>alert('Mail is verstuurd');</script>";
  } else{
    echo "<script>alert('Kon geen mail verzenden');</script>";
  }
}
 ?>
