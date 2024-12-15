<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 1.12.24.
 * Time: 13.53
 */

$logFile = __DIR__ . '/log.txt'; // Lokacija log fajla

// Funkcija za dodavanje poruke u log
function logMessage($message) {
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

// Provera i učitavanje logova
$logs = [];
if (file_exists($logFile)) {
    $logs = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

// Brisanje pojedinačne poruke
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
    <title>Log Ekran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #007bff;
        }
        .log-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        .log-item:last-child {
            border-bottom: none;
        }
        .log-text {
            flex: 1;
            color: #555;
        }
        .log-time {
            font-weight: bold;
            color: #007bff;
            margin-right: 10px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #bd2130;
        }
        .clear-btn {
            margin-top: 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            text-align: center;
            width: 100%;
        }
        .clear-btn:hover {
            background-color: #218838;
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
<div class="log-container">
    <h1>Log Ekran</h1>
    <div id="log-list">
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
