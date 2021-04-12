<?php
// Deze dependencies laden we handmatig in...
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// deze functie stuurt e-mails via je mailaccount...
function mailen($mailTo, $ontvangerNaam, $onderwerp, $bericht) {
    $mail = new PHPMailer();

    //Verbinden met je mail account (<leerlingnummer>@<leerlingnummer>.hbcdeveloper.nl)
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
   
    //$mail->SMTPSecure = 'ssl';
	//Debuginformatie aanzetten… zet deze inproductie uit…
    $mail->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
    //$mail->Host = 'mail.<leerlingnummer>.hbcdeveloper.nl';
    $mail->Host = 'mail.42851.hbcdeveloper.nl';
    $mail->Port = 587;

    //Identificeer jezelf bij je mailaccount
    $mail ->Username = 'h42851';
    $mail ->Password = 'jc3l5zC8m';

    //E-mail opstellen...
    $mail ->isHTML(true);
    $mail->setFrom("42851@42851.hbcdeveloper.nl", "Naam");
    $mail->Subject = $onderwerp;
    $mail->CharSet ='UTF-8';

    $bericht = "<body style=\"font-family: Verdana, Verdana, Geneva, sans-serif; 
                    font-size: 14px; color: #000;\">" . $bericht . "</body>";
    $mail -> addAddress($mailTo, $ontvangerNaam);
    //$mail ->addAddress('bkd@hoornbeeck.nl', "Dick")
    $mail -> Body = $bericht;
    //stuur de mail...
    if ($mail->Send()) {
        echo "<script>alert('Mail is verstuurd');</script>";
        echo "<script>window.location = 'index.php?page=webshop';</script>";
    }
    else {
        echo 'Mailer Error: '.$mail->ErrorInfo;
        echo "<script>alert('Mail kon niet verstuurd worden...');</script>";
    }
}
?>

Testmailen.php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testen mailen...</title>
</head>
<body>
<?php
//include ('registreren.html');
include ('bibliotheek/mailen.php');
include('config/dbconfig.php');
$klant = 'Klant B';
$email = 'bkd@hoornbeeck.nl';

$melding='Testmail';
echo '<div id="melding">'.$melding."</div>";
$onderwerp = "Testmail vanuit phpMailer";
$bericht = "Geachte $klant, hierbij uw inloggegevens.";
//mailen...
mailen($email, $klant, $onderwerp, $bericht );
?>
</body>
</html>
