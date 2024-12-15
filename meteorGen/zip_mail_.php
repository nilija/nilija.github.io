<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 5.12.24.
 * Time: 13.29
 */

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

// Unesite e-mail adresu korisnika
$e_mail = $_SESSION["e_mail"];
//$e_mail = 'n_ilija@yahoo.com';

$folderName = basename($e_mail); // Iz e-maila kreiramo naziv foldera

$workDir = __DIR__ . '/work/' . $e_mail;
$logFile = __DIR__ . '/work/log.file';

// Unapred definisani fajlovi i folderi
$predefinedItems = [
    'server',
    'collections',
    'public',
    'node_modules',
    'client',
    '.meteor',
    'start'
];

// Funkcija za logovanje
function logAction($message) {
    global $logFile;
//    echo 'log ' . $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
}

// Kreiranje tar.gz fajla
$archiveName = $workDir . '/myApp.tar.gz';
$itemsToArchive = implode(' ', array_map('escapeshellarg', $predefinedItems));
$command = "tar -czf " . escapeshellarg($archiveName) . " -C " . escapeshellarg($workDir) . " " . $itemsToArchive;
//tar -czf '/var/www/delovizatraktore_rs/docroot/meteorGen/work/n_ilija@yahoo.com/myApp.tar.gz' -C '/var/www/delovizatraktore_rs/docroot/meteorGen/work/n_ilija@yahoo.com' 'server' 'collections' 'public' 'client' '.meteor' 'start'
/*echo $command;
die;*/
exec($command, $output, $returnVar);
//echo ' com: ' . $command;
//var_dump(' out: ' . $output);
//echo ' ret: ' . $returnVar;
if ($returnVar !== 0) {
    logAction("Greška prilikom kreiranja arhive za: $folderName");
    echo "Greška prilikom kreiranja arhive.";
//    exit;
}

$to = 'n_ilija@yahoo.com';
mailresetlink($to, $folderName, $archiveName);

function mailresetlink($to, $folderName, $archiveName)
{
    $subject = "Meteor myAPP - pocetna aplikacija";
    $uri = 'http://delovizatraktore_rs/docroot/meteorGen/komplet.php';
    $message = '
        <html>
        <head>
        <title>Meteor myAPP - pocetna aplikacija</title>
        </head>
        <body>
        <h2>Password Reset Request</h2>
        <p>Meteor Web Generator je alat za generisanje personalizovanih aplikacija baziranih na Meteor.js i MongoDB.</p>
        <p>Omogućava jednostavno i brzo kreiranje aplikacija uz prilagodljive kolekcije podataka i korisničke interfejse.</p>
        <p>please click the link:<a href="' . $uri . '">Click za start generisanja</a></p>
        <p>If you didn’t request this, please ignore this e_mail.</p>
        <p>Thank you,<br>NikoSoft Team</p>
        </body>
        </html>
    ';

    $fromName = 'Ilija Nikolic';
    $fromEmail = 'n_ilija@yahoo.com';

    require_once('scripts/PHPMailer/SMTP.php');
    require_once('scripts/PHPMailer/Exception.php');
    require_once('scripts/PHPMailer/PHPMailer.php');

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    $to = preg_replace("/,$/", "", $to);
    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.mail.yahoo.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'n_ilija@yahoo.com';
        $mail->Password = 'bkndihvmanpgjbsx';
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($to);
        $mail->addReplyTo($fromEmail, $fromName);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if (file_exists($archiveName)) {
            $mail->addAttachment($archiveName);
        } else {
            error_log("Attachment not found: {$archiveName}");
        }

        if ($mail->send()) {
            echo json_encode([
                'success' => "If the account you provided exists, reset instructions will be emailed to you shortly."
            ]);
//            echo "If the account you provided exists, reset instructions will be emailed to you shortly.";
        } else {
            echo "Failed to send reset instructions.";
        }
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        echo "Something went wrong: {$mail->ErrorInfo}";
    }
}

logAction("Arhiva kreirana: $archiveName");

/*// Slanje arhive na e-mail
$mail = new PHPMailer;
$mail->setFrom('your_email@example.com', 'Web Generator');
$mail->addAddress($email);
$mail->Subject = "Vaša arhiva: $folderName";
$mail->Body = "Poštovani, u prilogu se nalazi tražena arhiva.";
$mail->addAttachment($archiveName);

if (!$mail->send()) {
    logAction("Greška prilikom slanja e-maila: " . $mail->ErrorInfo);
    echo "Greška prilikom slanja e-maila.";
} else {
    logAction("E-mail uspešno poslat: $email");
    echo "Arhiva je uspešno poslata na $email.";
}*/

// Brisanje generisane arhive
unlink($archiveName);
logAction("Arhiva obrisana: $archiveName");
