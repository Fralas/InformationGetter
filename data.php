<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "musicorthemisery";
$dbname = "datisalvati";

// Crea una connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Ricevi i dati inviati dal client
$data = json_decode(file_get_contents('php://input'), true);

// Prepara e esegui l'istruzione SQL per inserire i dati nel database
$stmt = $conn->prepare("INSERT INTO informazioni_utente (indirizzo_ip, cookies, informazioni_browser, informazioni_dispositivo, attivita_navigazione) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $data['ipAddress'], $data['cookies'], $data['browserInfo'], $data['deviceInfo'], $data['navigationActivity']);
$stmt->execute();

// Chiudi la connessione
$stmt->close();
$conn->close();
?>