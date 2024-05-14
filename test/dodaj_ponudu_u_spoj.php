<?php
// Uključivanje datoteke za spajanje na bazu
include "spajanje.php";

// Provjera je li poslan ID jelovnika i ID ponude
if(isset($_POST['jelovnik_id']) && isset($_POST['ponuda_id'])) {
    // Dobivanje ID-eva jelovnika i ponude iz POST zahtjeva
    $jelovnik_id = $_POST['jelovnik_id'];
    $ponuda_id = $_POST['ponuda_id'];

    // SQL upit za provjeru je li ponuda već pridružena jelovniku
    $sql_check = "SELECT * FROM spoj WHERE jelovnik_id = $jelovnik_id AND ponuda_id = $ponuda_id";
    $result_check = $conn->query($sql_check);

    if($result_check->num_rows > 0) {
        // Ponuda već postoji u spoju
        http_response_code(400); // Bad Request
        echo "Ponuda je već pridružena jelovniku.";
    } else {
        // SQL upit za dodavanje nove ponude u spoj
        $sql_insert = "INSERT INTO spoj (jelovnik_id, ponuda_id) VALUES ($jelovnik_id, $ponuda_id)";

        if($conn->query($sql_insert)) {
            // Uspješno dodana nova ponuda u spoj
            $response['message'] = "Ponuda je uspješno dodana u spoj.";
            echo json_encode($response);
        } else {
            // Greška prilikom izvršavanja SQL upita
            http_response_code(500); // Internal Server Error
            echo "Greška prilikom dodavanja ponude u spoj: " . $conn->error;
        }
    }
} else {
    // Neispravan ili nepotpun POST zahtjev
    http_response_code(400); // Bad Request
    echo "Nedostaju potrebni podaci u zahtjevu.";
}
?>
