<?php
// Uključivanje datoteke za spajanje na bazu
include "spajanje.php";

// Provjera sesije, ako korisnik nije prijavljen, preusmjeri na početnu stranicu
session_start();
if (!isset($_SESSION['korisnicko_ime'])) {
    header("Location: index.php");
    exit();
}

// Provjera je li poslan obrazac za dodavanje jelovnika putem POST zahtjeva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dohvaćanje podataka iz POST zahtjeva
    $naziv = $_POST['naziv'];
    $event = $_POST['event'];
    $mjesto = $_POST['mjesto'];
    $koridnate = $_POST['koridnate'];
    $datum_start = $_POST['datum_start'];
    $datum_kraj = $_POST['datum_kraj'];
    $aktivan = $_POST['aktivan'];

    // SQL upit za dodavanje novog jelovnika u bazu
    $sql_insert = "INSERT INTO jelovnik (naziv, Event, mjesto, koridnate, datum_start, datum_kraj, aktivan) 
                    VALUES ('$naziv', '$event', '$mjesto', '$koridnate', '$datum_start', '$datum_kraj', '$aktivan')";

    if ($conn->query($sql_insert) === TRUE) {
        // Ako je jelovnik uspješno dodan, preusmjeri korisnika na stranicu pregled_jelovnici.php
        header("Location: pregled_jelovnici.php?id=" . $conn->insert_id);
        exit();
    } else {
        // Ako je došlo do greške prilikom dodavanja jelovnika, prikaži odgovarajuću poruku
        echo "Greška prilikom dodavanja jelovnika: " . $conn->error;
        exit();
    }
}
?>
