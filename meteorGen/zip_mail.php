<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 5.12.24.
 * Time: 13.29
 */

// Unesite e-mail adresu korisnika
$email = 'n_ilija@yahoo.com'; // Zamenite ovom adresom
$folderName = basename($email); // Iz e-maila kreiramo naziv foldera

$e_mail = 'n_ilija@yahoo.com';
$workDir = __DIR__ . '/work/';
$logFile = __DIR__ . '/log.txt';

// Unapred definisani fajlovi i folderi
$predefinedItems = [
    'server',
    'collections',
    'public',
    'client',
    '.meteor',
    'start'
];

// Funkcija za logovanje
function logAction($message) {
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL, FILE_APPEND);
}

// Kreiranje tar.gz fajla
$archiveName = $workDir . '/myApp.tar.gz';
$itemsToArchive = implode(' ', array_map('escapeshellarg', $predefinedItems));
$command = "tar -czf " . escapeshellarg($archiveName) . " -C " . escapeshellarg($workDir) . " " . $itemsToArchive;
//tar -czf '/var/www/delovizatraktore_rs/docroot/meteorGen/work/n_ilija@yahoo.com/myApp.tar.gz' -C '/var/www/delovizatraktore_rs/docroot/meteorGen/work/n_ilija@yahoo.com' 'server' 'collections' 'public' 'client' '.meteor' 'start'

exec($command, $output, $returnVar);
echo ' com: ' . $command;
var_dump(' out: ' . $output);
echo ' ret: ' . $returnVar;
if ($returnVar !== 0) {
    logAction("Greška prilikom kreiranja arhive za: $folderName");
    echo "Greška prilikom kreiranja arhive.";
//    exit;
}

echo $archiveName;
echo 'cccccc ';
echo $folderName;
$to = 'n_ilija@yahoo.com';
mailresetlink($to, $folderName, $archiveName);

    function mailresetlink($to, $folderName, $archiveName)
    {
        $subject = "Forgot Password on ClaimsWeb";
        $uri = 'https://claimsweb.auditecsolutions.com';
        $message = '
            <html>
            <head>
            <title>Forgot Password For ClaimsWeb at Auditec Solutions</title>
            </head>
            <body>
<h2>Password Reset Request</h2>
        <p>We received a request to reset your password. If this was you, please click the link below:</p>
        <p><a href="' . $uri . '/reset-password">Reset Your Password</a></p>
        <p>If you didn’t request this, please ignore this email.</p>
        <p>Thank you,<br>ClaimsWeb Team</p>
            </body>
            </html>
                    ';
        $fromName = 'Ilija Nikolic';
        $fromEmail = 'n_ilija@yahoo.com';

        // now we'll build the message headers

        require_once('work/scripts/PHPMailer/SMTP.php');
        require_once('work/scripts/PHPMailer/Exception.php');
        require_once('work/scripts/PHPMailer/PHPMailer.php');

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        // Remove any trailing commas from the $to
        $to = preg_replace("/,$/","", $to);
        try {
            //Server settings

            $mail->isSMTP();                                        //Send using SMTP
            $mail->SMTPDebug = 0;
            $mail->Host        = 'smtp.mail.yahoo.com';             //Set the SMTP server to send through
            $mail->Username    = 'n_ilija@yahoo.com';
            $mail->Password    = 'bkndihvmanpgjbsx';                // App Password na Yahoo nalogu
            $mail->Port    = '587';
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            /*            $mail->SMTPOptions = array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );*/

            //Recipients
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($to);     //Add a recipient
            $mail->addReplyTo($fromEmail, $fromName);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//            $mail->Subject = "Vaša arhiva: $folderName";
//            $mail->Body = "Poštovani, u prilogu se nalazi tražena arhiva.";
            $mail->addAttachment($archiveName);

            $test = $mail->send();
            if ($test) {
                /*        if (@mail($to, $subject, $message, $headers)) {*/
                echo "If the account you provided exists, reset instructions will be emailed to you shortly";
            } else
                echo "If the account you provided exists, reset instructions will be emailed to you shortly";
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            echo "Something went wrong.";
            /*            echo $mail->ErrorInfo;
                        print_r($mail);*/
            return false;
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
