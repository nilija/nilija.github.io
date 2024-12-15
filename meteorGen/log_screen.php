<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 1.12.24.
 * Time: 14.00
 */

$logFile = __DIR__ . '/log.txt'; // Lokacija log fajla

// Funkcija za logovanje poruka
function logMessage($message) {
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

// Učitavanje logova
$logs = [];
if (file_exists($logFile)) {
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Brisanje pojedinačnog loga
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteLogIndex'])) {
    $index = (int)$_POST['deleteLogIndex'];
    if (isset($logs[$index])) {
        unset($logs[$index]);
        file_put_contents($logFile, implode("\n", $logs) . "\n");
        echo json_encode(['success' => true]);
        exit;
    } else {
        echo json_encode(['success' => false, 'error' => 'Neispravan indeks loga.']);
        exit;
    }
}

// Brisanje svih logova
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clearLogs'])) {
    file_put_contents($logFile, "");
    echo json_encode(['success' => true]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteor Web Generator - Log Ekran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #0056b3;
        }
        .log-container {
            margin: 20px 0;
        }
        .log-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .log-item:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .log-time {
            font-weight: bold;
            color: #007bff;
        }
        .log-text {
            flex: 1;
            color: #555;
            margin-left: 10px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #bd2130;
        }
        .clear-btn {
            margin: 20px 0;
            display: block;
            width: 100%;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            cursor: pointer;
        }
        .clear-btn:hover {
            background-color: #218838;
        }
        .info-box {
            background-color: #e9f7fd;
            border-left: 5px solid #007bff;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box h3 {
            margin: 0;
            font-size: 18px;
        }
        .info-box p {
            margin: 10px 0 0;
            font-size: 14px;
            color: #555;
        }
        .empty-log {
            text-align: center;
            font-size: 16px;
            color: #666;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<header>
    <h1>Meteor Web Generator</h1>
    <p>Logovanje i upravljanje aktivnostima aplikacije</p>
</header>
<div class="container">
    <div class="info-box">
        <h3>O Meteoru i MongoDB-u</h3>
        <p>
            Meteor.js je moćan JavaScript framework za brzi razvoj aplikacija. Njegova integracija sa MongoDB-om omogućava
            reaktivno ažuriranje podataka u realnom vremenu. MongoDB je NoSQL baza podataka dizajnirana za skladištenje
            velike količine podataka u fleksibilnom formatu.
        </p>
        <p>
            Ovaj generator koristi snagu Meteora za kreiranje aplikacija na osnovu definisanih kolekcija i polja,
            čineći razvoj brzim i efikasnim.
        </p>
    </div>

    <h2>Log Aktivnosti</h2>
    <div class="log-container">
        <?php if (empty($logs)): ?>
            <div class="empty-log">Nema dostupnih logova.</div>
        <?php else: ?>
            <?php foreach ($logs as $index => $log): ?>
                <div class="log-item">
                    <span class="log-time"><?php echo htmlspecialchars(substr($log, 0, 19)); ?></span>
                    <span class="log-text"><?php echo htmlspecialchars(substr($log, 22)); ?></span>
                    <button class="delete-btn" onclick="deleteLog(<?php echo $index; ?>)">Obriši</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button class="clear-btn" onclick="clearLogs()">Obriši Sve Logove</button>
</div>
<script>
    function deleteLog(index) {
        if (confirm("Da li ste sigurni da želite da obrišete ovaj log?")) {
            fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `deleteLogIndex=${index}`
            })
                .then(response => response.json())
        .then(data => {
                if (data.success) {
                location.reload();
            } else {
                alert("Greška prilikom brisanja loga.");
            }
        });
        }
    }

    function clearLogs() {
        if (confirm("Da li ste sigurni da želite da obrišete sve logove?")) {
            fetch("", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "clearLogs=1"
            })
                .then(response => response.json())
        .then(data => {
                if (data.success) {
                location.reload();
            } else {
                alert("Greška prilikom brisanja svih logova.");
            }
        });
        }
    }
</script>
</body>
</html>
