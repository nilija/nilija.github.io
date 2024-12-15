<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 3.12.24.
 * Time: 11.36
 */

session_start();

// Definisanje putanja za log i korisnički fajl
$logFile = __DIR__ . '/log.file';
$userFile = __DIR__ . '/users.file'; // Sadrži listu registrovanih korisnika

// Funkcija za beleženje u log fajl
function logAction($message, $logFile) {
    $dateTime = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$dateTime] $message" . PHP_EOL, FILE_APPEND);
}

// Funkcija za proveru korisnika u fajlu
function isUserRegistered($email, $userFile) {
    if (!file_exists($userFile)) {
        return false; // Ako fajl ne postoji, korisnik nije registrovan
    }
    $users = file($userFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return in_array($email, $users); // Provera da li je e-mail u fajlu
}

// Prijavljivanje korisnika
$showRegisterForm = false;
if (isset($_POST['login'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
        if (isUserRegistered($email, $userFile)) {
            $_SESSION['user_email'] = $email;

            // Kreiranje foldera na osnovu e-mail adrese
            $userFolder = __DIR__ . '/users/' . $email;
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true);
            }

            // Beleženje prijave
            logAction("Korisnik prijavljen: $email", $logFile);
            $successMessage = "Prijava uspešna! Dobrodošli, $email";
        } else {
            // Ako korisnik nije registrovan
            $errorMessage = "E-mail nije registrovan. Molimo vas da se registrujete.";
            $showRegisterForm = true; // Prikaži formu za registraciju
        }
    } else {
        $errorMessage = "Molimo unesite e-mail adresu.";
    }
}

// Registracija korisnika
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $userType = $_POST['user_type'];
    $collaboration = $_POST['collaboration'] === 'yes' ? 'Da' : 'Ne';

    if (!empty($email) && !empty($name) && !empty($surname) && !empty($city) && !empty($userType)) {
        // Dodavanje korisnika u fajl
        file_put_contents($userFile, $email . PHP_EOL, FILE_APPEND);

        // Beleženje registracije
        $logMessage = "Registracija: $email | $name $surname | Mesto: $city | Vrsta korisnika: $userType | Saradnja: $collaboration";
        logAction($logMessage, $logFile);

        $successMessage = "Registracija uspešna! Možete se sada prijaviti.";
        $showRegisterForm = false; // Nakon registracije, prikaz forme za registraciju se uklanja
    } else {
        $errorMessage = "Molimo popunite sva polja za registraciju.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteor Web Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0056b3;
            margin-bottom: 15px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input, select, button {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<h1>Meteor Web Generator</h1>
<div class="grid-container">
    <!-- Opis projekta -->
    <div class="section">
        <h2>O projektu</h2>
        <p>Meteor Web Generator je aplikacija za generisanje projekata baziranih na <strong>Meteor.js</strong> i <strong>MongoDB</strong>.
            Omogućava korisnicima da kreiraju personalizovane aplikacije kroz jednostavan interfejs.</p>
        <p>Projekt je namenjen kako programerima, tako i krajnjim korisnicima koji žele prilagođene web aplikacije.</p>
    </div>

    <!-- Forma za prijavu -->
    <div class="section">
        <h2>Prijava</h2>
        <form method="POST">
            <label for="email">E-mail adresa:</label>
            <input type="email" name="email" placeholder="Unesite e-mail" required>
            <button type="submit" name="login">Prijavi se</button>
        </form>
    </div>
</div>

<!-- Poruke -->
<?php if (isset($successMessage)): ?>
    <div class="message success"><?php echo $successMessage; ?></div>
<?php elseif (isset($errorMessage)): ?>
    <div class="message error"><?php echo $errorMessage; ?></div>
<?php endif; ?>

<!-- Forma za registraciju (samo ako je potrebna) -->
<?php if ($showRegisterForm): ?>
    <div class="grid-container">
        <div class="section">
            <h2>Registracija</h2>
            <form method="POST">
                <label for="email">E-mail adresa:</label>
                <input type="email" name="email" placeholder="Unesite e-mail" required>

                <label for="name">Ime:</label>
                <input type="text" name="name" placeholder="Unesite ime" required>

                <label for="surname">Prezime:</label>
                <input type="text" name="surname" placeholder="Unesite prezime" required>

                <label for="city">Mesto:</label>
                <input type="text" name="city" placeholder="Unesite mesto" required>

                <label for="user_type">Vrsta korisnika:</label>
                <select name="user_type" required>
                    <option value="primena">Primena</option>
                    <option value="razvoj">Razvoj</option>
                </select>

                <label for="collaboration">Potrebna saradnja:</label>
                <select name="collaboration" required>
                    <option value="yes">Da</option>
                    <option value="no">Ne</option>
                </select>

                <button type="submit" name="register">Registruj se</button>
            </form>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
