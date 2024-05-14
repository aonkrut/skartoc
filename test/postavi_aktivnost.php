<?php
// Uključivanje datoteke za spajanje na bazu
include "spajanje.php";

// Provjera sesije, ako korisnik nije prijavljen, preusmjeri na početnu stranicu
session_start();
if (!isset($_SESSION['korisnicko_ime'])) {
    header("Location: index.php");
    exit();
}

// Provjera je li poslan ID jelovnika putem POST zahtjeva
if (!isset($_POST['id']) || empty($_POST['id'])) {
    // Ako nije poslan ID jelovnika, prikaži grešku
    echo "Nije poslan ID jelovnika.";
    exit();
}

// Dohvaćanje ID-a jelovnika iz POST zahtjeva
$jelovnik_id = $_POST['id'];

// Provjera je li jelovnik s tim ID-om pronađen u bazi
$sql = "SELECT * FROM jelovnik WHERE id = $jelovnik_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Ako jelovnik s tim ID-om nije pronađen, prikaži grešku
    echo "Jelovnik s ID-om $jelovnik_id nije pronađen.";
    exit();
}

// Postavljanje aktivnosti jelovnika na temelju trenutne vrijednosti
$row = $result->fetch_assoc();
$novi_status = ($row['aktivan'] == 1) ? 0 : 1; // Ako je trenutni status 1 (aktivan), postavi novi status na 0 (neaktivan) i obrnuto

// SQL upit za ažuriranje aktivnosti jelovnika
$sql_update = "UPDATE jelovnik SET aktivan = $novi_status WHERE id = $jelovnik_id";

if ($conn->query($sql_update) === TRUE) {
    
    header("Location: jelovnici.php");
    exit();
} else {
    // Ako je došlo do greške prilikom izvršavanja upita, prikaži grešku
    echo "Greška prilikom postavljanja aktivnosti jelovnika: " . $conn->error;
    exit();
}
?>
