<?php
    // Uključivanje datoteke za spajanje na bazu i navigacijskog izbornika
    include "spajanje.php";
  

   

    // Provjeri je li poslan ID jelovnika
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Nije pronađen ID jelovnika.</p>';
        echo '</div>';
        exit();
    }

    $jelovnik_id = $_GET['id'];

    // SQL upit za dohvaćanje podataka o jelovniku
    $sql_jelovnik = "SELECT * FROM jelovnik WHERE id = $jelovnik_id";
    $result_jelovnik = $conn->query($sql_jelovnik);

    // Provjera postoji li jelovnik s tim ID-om
    if ($result_jelovnik->num_rows == 0) {
        echo '<div class="container mt-5">';
        echo '<p class="text-danger">Nije pronađen jelovnik s ID-om ' . $jelovnik_id . '.</p>';
        echo '</div>';
        exit();
    }

    $row_jelovnik = $result_jelovnik->fetch_assoc();

    // Provjera je li forma za uređivanje jelovnika poslana
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Dohvaćanje podataka iz POST zahtjeva
        $naziv = $_POST['naziv'];
        $event = $_POST['event'];
        $mjesto = $_POST['mjesto'];
        $koridnate = $_POST['koridnate'];
        $datum_start = $_POST['datum_start'];
        $datum_kraj = $_POST['datum_kraj'];
        $aktivan = $_POST['aktivan'];

        // SQL upit za ažuriranje podataka o jelovniku
        $sql_update = "UPDATE jelovnik SET 
                        naziv = '$naziv',
                        Event = '$event',
                        mjesto = '$mjesto',
                        koridnate = '$koridnate',
                        datum_start = '$datum_start',
                        datum_kraj = '$datum_kraj',
                        aktivan = '$aktivan'
                        WHERE id = $jelovnik_id";

        if ($conn->query($sql_update) === TRUE) {
            echo '<div class="container mt-5">';
            echo '<p class="text-success">Podaci o jelovniku su uspješno ažurirani.</p>';
            echo '</div>';
            header("Location: pregled_jelovnici.php?id=$jelovnik_id");
        } else {
            echo '<div class="container mt-5">';
            echo '<p class="text-danger">Greška prilikom ažuriranja podataka o jelovniku: ' . $conn->error . '</p>';
            echo '</div>';
        }
    }
?>
