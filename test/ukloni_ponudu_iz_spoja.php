<?php
// Uključivanje datoteke za spajanje na bazu
include "spajanje.php";

// Provjera je li poslan ID jelovnika i ID ponude
if(isset($_POST['jelovnik_id']) && isset($_POST['ponuda_id'])) {
    // Dobivanje ID-eva jelovnika i ponude iz POST zahtjeva
    $jelovnik_id = $_POST['jelovnik_id'];
    $ponuda_id = $_POST['ponuda_id'];

    // SQL upit za brisanje ponude iz spoja
    $sql_delete = "DELETE FROM spoj WHERE jelovnik_id = $jelovnik_id AND ponuda_id = $ponuda_id";

    if($conn->query($sql_delete)) {
        // Uspješno uklonjena ponuda iz spoja
        echo "Ponuda je uspješno uklonjena iz spoja.";
    } else {
        // Greška prilikom izvršavanja SQL upita
        http_response_code(500); // Internal Server Error
        echo "Greška prilikom uklanjanja ponude iz spoja: " . $conn->error;
    }
} else {
    // Neispravan ili nepotpun POST zahtjev
    http_response_code(400); // Bad Request
    echo "Nedostaju potrebni podaci u zahtjevu.";
}
?>
